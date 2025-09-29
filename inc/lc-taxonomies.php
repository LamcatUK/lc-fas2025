<?php
/**
 * Custom taxonomies for the CB TXP theme.
 *
 * This file defines and registers custom taxonomies such as 'Teams' and 'Offices'.
 *
 * @package lc-fas2025
 */

use function Avifinfo\read;

/**
 * Register custom taxonomies for the theme.
 *
 * This function registers a custom taxonomy: 'Session Types'.
 * The taxonomy is set to be publicly queryable, have a UI in the admin,
 * and support REST API.
 *
 * @return void
 */
function lc_register_taxes() {

    $args = array(
        'labels'             => array(
            'name'          => 'Session Types',
            'singular_name' => 'Session Type',
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'hierarchical'       => true,
        'show_ui'            => true,
        'show_in_nav_menus'  => true,
        'show_tagcloud'      => false,
        'show_in_quick_edit' => true,
        'show_admin_column'  => false,
        'show_in_rest'       => true,
        'rewrite'            => false,
    );
    register_taxonomy( 'session_type', array( 'attachment' ), $args );
}
add_action( 'after_setup_theme', 'lc_register_taxes', 0 );

add_action(
    'restrict_manage_posts',
    function () {
        global $typenow;
        if ( 'attachment' !== $typenow ) {
            return;
        }

        $tax = 'session_type';

        // This is a filter dropdown, not a data-changing action. Nonce verification is not required.
        // phpcs:disable WordPress.Security.NonceVerification.Missing
        $selected = isset( $_GET[ $tax ] ) ? sanitize_text_field( wp_unslash( $_GET[ $tax ] ) ) : '';
        // phpcs:enable WordPress.Security.NonceVerification.Missing

        $args = array(
            'show_option_all' => 'All Session Types',
            'taxonomy'        => $tax,
            'name'            => $tax,
            'orderby'         => 'name',
            'selected'        => $selected,
            'hierarchical'    => true,
            'depth'           => 3,
            'show_count'      => false,
            'hide_empty'      => false,
        );
        // Defensive: ensure taxonomy exists and is not WP_Error.
        $terms = get_terms(
            array(
                'taxonomy'   => $tax,
                'hide_empty' => false,
                'fields'     => 'ids',
            )
        );
        if ( is_wp_error( $terms ) ) {
            return;
        }
        wp_dropdown_categories( $args );
    }
);

/**
 * Bulk-assign Work Types to Media Library attachments.
 * Requires a hierarchical taxonomy 'work_type' registered for 'attachment'.
 */

/**
 * 1) Add bulk actions in Media Library (upload.php)
 */
add_filter(
    'bulk_actions-upload',
    function ( array $actions ): array {
        // Fetch work_type terms (limit to reasonable number).
        $terms = get_terms(
            array(
                'taxonomy'   => 'session_type',
                'hide_empty' => false,
                'number'     => 30,
            )
        );

        if ( is_wp_error( $terms ) || empty( $terms ) ) {
            return $actions;
        }

        // Group under a separator label.
        $actions['lc_sep'] = '──────────';

        foreach ( $terms as $t ) {
            $actions[ 'lc_assign_session_type_' . (int) $t->term_id ] = sprintf(
                'Set Session Type: %s',
                $t->name
            );
        }

        // Clear option.
        $actions['lc_clear_session_type'] = 'Clear Session Type';

        return $actions;
    }
);

/**
 * 2) Handle the selected bulk action
 */
add_filter(
    'handle_bulk_actions-upload',
    function ( string $redirect_url, string $action, array $ids ): string {
        if ( empty( $ids ) ) {
            return $redirect_url;
        }

        // Clear all session_type terms.
        if ( 'lc_clear_session_type' === $action ) {
            $updated = 0;
            foreach ( $ids as $id ) {
                if ( 'attachment' !== get_post_type( $id ) ) {
                    continue;
                }
                $terms = wp_get_object_terms( (int) $id, 'session_type', array( 'fields' => 'ids' ) );
                if ( is_wp_error( $terms ) ) {
                    $terms = array();
                }
                $res = wp_set_object_terms( (int) $id, array(), 'session_type', false );
                if ( ! is_wp_error( $res ) ) {
                    $updated++;
                }
            }
            return add_query_arg(
                array( 'lc_session_type_cleared' => $updated ),
                $redirect_url
            );
        }

        // Set a specific session_type term.
        if ( 0 === strpos( $action, 'lc_assign_session_type_' ) ) {
            $term_id = (int) substr( $action, strlen( 'lc_assign_session_type_' ) );
            if ( $term_id > 0 ) {
                $updated = 0;
                foreach ( $ids as $id ) {
                    if ( 'attachment' !== get_post_type( $id ) ) {
                        continue;
                    }
                    $res = wp_set_object_terms( (int) $id, array( $term_id ), 'session_type', false ); // replace, don’t append.
                    if ( ! is_wp_error( $res ) ) {
                        $updated++;
                    }
                }
                return add_query_arg(
                    array(
                        'lc_session_type_set'  => $updated,
                        'lc_session_type_term' => $term_id,
                    ),
                    $redirect_url
                );
            }
        }

        return $redirect_url;
    },
    10,
    3
);

/**
 * 3) Admin notices for feedback
 */
add_action(
    'admin_notices',
    function (): void {
        if ( ! empty( $_REQUEST['lc_session_type_cleared'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            $n = (int) $_REQUEST['lc_session_type_cleared'];     // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            printf(
                '<div class="notice notice-success is-dismissible"><p>%s</p></div>',
                sprintf( 1 === $n ? 'Cleared Session Type on %d item.' : 'Cleared Session Type on %d items.', esc_html( $n ) )
            );
        }
        if ( ! empty( $_REQUEST['lc_session_type_set'] ) && ! empty( $_REQUEST['lc_session_type_term'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            $n       = (int) $_REQUEST['lc_session_type_set'];                                       // phpcs:ignore
            $term_id = (int) $_REQUEST['lc_session_type_term'];                                      // phpcs:ignore
            $term    = get_term( $term_id, 'session_type' );
            $label   = $term && ! is_wp_error( $term ) ? $term->name : 'selected term';
            printf(
                '<div class="notice notice-success is-dismissible"><p>%s</p></div>',
                sprintf(
                    1 === $n ? 'Set Session Type "%2$s" on %1$d item.' : 'Set Session Type "%2$s" on %1$d items.',
                    esc_html( $n ),
                    esc_html( $label )
                )
            );
        }
    }
);

/**
 * Show Work Type terms as a column in the Media Library (list view).
 */

// 1) Register the column
add_filter(
    'manage_upload_columns',
    function ( $cols ) {
        $cols['session_type'] = 'Session Types';
        return $cols;
    }
);

// 2) Populate the column
add_action(
    'manage_media_custom_column',
    function ( $col, $post_id ) {
        if ( 'session_type' === $col ) {
            $terms = get_the_terms( $post_id, 'session_type' );
            if ( is_wp_error( $terms ) || empty( $terms ) ) {
                echo '<span class="na">—</span>';
                return;
            }
            $out = array();
            foreach ( $terms as $t ) {
                $url   = esc_url(
                    add_query_arg(
                        array(
                            'post_type'    => 'attachment',
                            'session_type' => $t->slug,
                            'mode'         => 'list',
                        ),
                        admin_url( 'upload.php' )
                    )
                );
                $out[] = sprintf(
                    '<a href="%s">%s</a>',
                    $url,
                    esc_html( $t->name )
                );
            }
            echo wp_kses_post( implode( ', ', $out ) );
        }
    },
    10,
    2
);

// 3) Make it sortable (optional)
add_filter(
    'manage_upload_sortable_columns',
    function ( $cols ) {
        $cols['session_type'] = 'session_type';
        return $cols;
    }
);

// 4) Adjust query for sorting (optional)
add_action(
    'pre_get_posts',
    function ( $query ) {
        if ( is_admin() && $query->is_main_query() ) {
            $orderby = $query->get( 'orderby' );
            if ( 'session_type' === $orderby ) {
                $query->set( 'orderby', 'taxonomy' );
                $query->set( 'taxonomy', 'session_type' );
            }
        }
    }
);


if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command(
        'fas recount_session_type',
        function () {
            $taxonomy    = 'session_type';
            $object_type = 'attachment';
            $terms       = get_terms(
                array(
                    'taxonomy'   => $taxonomy,
                    'hide_empty' => false,
                )
            );
            $updated     = 0;
            global $wpdb;
            foreach ( $terms as $term ) {
                // Get term_taxonomy_id for this term/taxonomy.
                $term_taxonomy_id = $wpdb->get_var(
                    $wpdb->prepare(
                        "SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE term_id = %d AND taxonomy = %s",
                        $term->term_id,
                        $taxonomy
                    )
                );
                if ( ! $term_taxonomy_id ) {
                    continue;
                }
                // Recount for this term.
                $count = 0;
                $ids   = get_objects_in_term( $term->term_id, $taxonomy );
                foreach ( $ids as $id ) {
                    if ( get_post_type( $id ) === $object_type ) {
                        $count++;
                    }
                }
                // Update the count in wp_term_taxonomy.
                $wpdb->update(
                    $wpdb->term_taxonomy,
                    array(
                        'count' => $count,
                    ),
                    array(
                        'term_taxonomy_id' => $term_taxonomy_id,
                    )
                );
                $updated++;
                WP_CLI::log( sprintf( 'Term \"%s\" (%d) count set to %d', $term->name, $term->term_id, $count ) );
            }
            WP_CLI::success( sprintf( 'Recounted %d session_type terms.', $updated ) );
        }
    );
}


/**
 * Add session_type taxonomy dropdown to the Media Library attachment edit screen.
 */
add_filter(
    'attachment_fields_to_edit',
    function ( $form_fields, $post ) {
        if ( 'attachment' !== get_post_type( $post ) ) {
            return $form_fields;
        }
        $taxonomy = 'session_type';
        $terms    = get_terms(
            array(
                'taxonomy'   => $taxonomy,
                'hide_empty' => false,
            )
        );
        if ( is_wp_error( $terms ) || empty( $terms ) ) {
            return $form_fields;
        }
        $current_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
        if ( is_wp_error( $current_terms ) ) {
            $current = '';
        } else {
            $current = ! empty( $current_terms ) ? $current_terms[0] : '';
        }
        $options = '<option value="">— Select —</option>';
        foreach ( $terms as $term ) {
            $selected = selected( $current, $term->term_id, false );
            $options .= '<option value="' . esc_attr( $term->term_id ) . '"' . $selected . '>' . esc_html( $term->name ) . '</option>';
        }
        $form_fields[ $taxonomy ] = array(
            'label' => 'Session Type',
            'input' => 'html',
            'html'  => '<select name="attachments[' . $post->ID . '][' . $taxonomy . ']">' . $options . '</select>',
            'value' => $current,
            'helps' => 'Assign a session type to this file.',
        );
        return $form_fields;
    },
    10,
    2
);

add_filter(
    'attachment_fields_to_save',
    function ( $post, $attachment ) {
        $taxonomy = 'session_type';
        if ( isset( $attachment[ $taxonomy ] ) ) {
            $term = (int) $attachment[ $taxonomy ];
            if ( $term ) {
                // Only assign if this is a valid, existing term ID for session_type.
                $term_obj = get_term( $term, $taxonomy );
                if ( $term_obj && ! is_wp_error( $term_obj ) ) {
                    $result = wp_set_object_terms( $post['ID'], array( $term ), $taxonomy, false );
                    // Optionally handle error here.
                }
                // If not valid, do not assign or create a new term.
            } else {
                $result = wp_set_object_terms( $post['ID'], array(), $taxonomy, false );
                // Optionally handle error here.
            }
        }
        return $post;
    },
    10,
    2
);
