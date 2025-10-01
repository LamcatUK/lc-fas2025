<?php
/**
 * LC Theme Functions
 *
 * This file contains theme-specific functions and customizations for the LC Harrier 2025 theme.
 *
 * @package lc-fas2025
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-acf-theme-palette.php';
require_once LC_THEME_DIR . '/inc/lc-taxonomies.php';


require_once LC_THEME_DIR . '/inc/lc-blocks.php';

// Remove unwanted SVG filter injection WP.
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

// Remove WordPress layout styles that interfere with alignment.
add_filter( 'wp_theme_json_get_style_nodes', function( $nodes ) {
    // Remove layout styles from theme.json output
    foreach ( $nodes as $key => $node ) {
        if ( isset( $node['selector'] ) && strpos( $node['selector'], '.is-layout-constrained' ) !== false ) {
            unset( $nodes[ $key ] );
        }
    }
    return $nodes;
} );

// Also try removing the layout stylesheet entirely
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'global-styles' );
}, 100 );

/**
 * Editor styles: opt-in so WP loads editor.css in the block editor.
 * With theme.json present, this just adds your custom CSS on top (variables, helpers).
 */
add_action(
    'after_setup_theme',
    function () {
        add_theme_support( 'editor-styles' );
        add_editor_style( 'css/editor.css' );
    },
    5
);

/**
 * Force enable alignment options for blocks
 */
function force_enable_block_alignments() {
    add_theme_support( 'align-wide' );
    add_theme_support( 'align-full' );
}
add_action( 'after_setup_theme', 'force_enable_block_alignments', 1 );

/**
 * Neutralise legacy palette/font-size support (if parent/Understrap adds them).
 * theme.json is authoritative, but some themes still register supports in PHP.
 * Remove them AFTER the parent has added them (high priority).
 */
add_action(
    'after_setup_theme',
    function () {
        remove_theme_support( 'editor-color-palette' );
        remove_theme_support( 'editor-gradient-presets' );
        remove_theme_support( 'editor-font-sizes' );
    },
    99
);

/**
 * (Optional) Ensure custom colours *aren’t* forcibly disabled by parent.
 * If Understrap disables custom colours, this re-enables them so theme.json works fully.
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' ); // performance nicety.

/**
 * Removes specific page templates from the available templates list.
 *
 * @param array $page_templates The list of page templates.
 * @return array The modified list of page templates.
 */
function child_theme_remove_page_template( $page_templates ) {
    unset(
        $page_templates['page-templates/blank.php'],
        $page_templates['page-templates/empty.php'],
        $page_templates['page-templates/left-sidebarpage.php'],
        $page_templates['page-templates/right-sidebarpage.php'],
        $page_templates['page-templates/both-sidebarspage.php']
    );
    return $page_templates;
}
add_filter( 'theme_page_templates', 'child_theme_remove_page_template' );

/**
 * Removes support for specific post formats in the theme.
 */
function remove_understrap_post_formats() {
    remove_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
add_action( 'after_setup_theme', 'remove_understrap_post_formats', 11 );



if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title' => 'Site-Wide Settings',
            'menu_title' => 'Site-Wide Settings',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
        )
    );
}

/**
 * Initializes widgets, menus, and theme supports.
 *
 * This function registers navigation menus, unregisters sidebars and menus,
 * and adds theme support for custom editor color palettes.
 */
function widgets_init() {

    register_nav_menus(
        array(
            'primary_nav'  => __( 'Primary Nav', 'lc-fas2025' ),
            'footer_menu1' => __( 'Footer Nav 1', 'lc-fas2025' ),
            'footer_menu2' => __( 'Footer Nav 2', 'lc-fas2025' ),
        )
    );

    unregister_sidebar( 'hero' );
    unregister_sidebar( 'herocanvas' );
    unregister_sidebar( 'statichero' );
    unregister_sidebar( 'left-sidebar' );
    unregister_sidebar( 'right-sidebar' );
    unregister_sidebar( 'footerfull' );
    unregister_nav_menu( 'primary' );

    // add_theme_support( 'disable-custom-colors' );
}
add_action( 'widgets_init', 'widgets_init', 11 );

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Registers a custom dashboard widget for the Lamcat theme.
 */
function register_lc_dashboard_widget() {
    wp_add_dashboard_widget(
        'lc_dashboard_widget',
        'Lamcat',
        'lc_dashboard_widget_display'
    );
}
add_action( 'wp_dashboard_setup', 'register_lc_dashboard_widget' );

/**
 * Displays the content of the Lamcat dashboard widget.
 */
function lc_dashboard_widget_display() {
    ?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;"
            src="<?= esc_url( get_stylesheet_directory_uri() . '/img/lc-full.jpg' ); ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
            href="mailto:hello@lamcat.co.uk/">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Lamcat!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
    <?php
}

// phpcs:disable
// add_filter('wpseo_breadcrumb_links', function( $links ) {
//     global $post;
//     if ( is_singular( 'post' ) ) {
//         $t = get_the_category($post->ID);
//         $breadcrumb[] = array(
//             'url' => '/guides/',
//             'text' => 'Guides',
//         );

//         array_splice( $links, 1, -2, $breadcrumb );
//     }
//     return $links;
// }
// );
// phpcs:enable


/**
 * Enqueues theme-specific scripts and styles.
 *
 * This function deregisters jQuery and disables certain styles and scripts
 * that are commented out for potential use in the theme.
 */
function lc_theme_enqueue() {
    $the_theme = wp_get_theme();
    // phpcs:disable
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox-plus-jquery.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), null, true);
    // wp_enqueue_script('parallax', get_stylesheet_directory_uri() . '/js/parallax.min.js', array('jquery'), null, true);
    // wp_enqueue_style( 'splide-stylesheet', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css', array(), null );
    // wp_enqueue_script( 'splide-scripts', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js', array(), null, true );
    // wp_enqueue_style('lightbox-stylesheet', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script( 'gsap' , 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), $the_theme->get( 'Version' ), true );
    // wp_enqueue_script( 'gsap-scrolltrigger' , 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array( 'gsap' ), $the_theme->get( 'Version' ), true );
    // phpcs:enable
    wp_enqueue_style( 'aos-style', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array() ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
    wp_enqueue_script( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
    wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
    wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), null, true ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

    wp_enqueue_style( 'glightbox-style', 'https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'glightbox', 'https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/js/glightbox.min.js', array(), $the_theme->get( 'Version' ), true );

    wp_deregister_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'lc_theme_enqueue' );


// phpcs:disable
function add_custom_menu_item($items, $args)
{
    if ($args->theme_location == 'primary_nav') {

        $new_item  = '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="d-lg-none menu-item menu-item-type-post_type menu-item-object-page nav-item fs-subtle pt-2 pb-4"><i class="fa-solid fa-envelope text-accent-400"></i> ' . do_shortcode( '[contact_email]' ) . '</li>';
        $new_item .= '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="d-lg-none menu-item menu-item-type-post_type menu-item-object-page nav-item fs-subtle"><i class="fa-solid fa-phone text-accent-400"></i> ' . do_shortcode( '[contact_phone]' ) . '</li>';

        $items .= $new_item;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_custom_menu_item', 10, 2);
// phpcs:enable


add_filter(
    'acf/load_field/name=season',
    function ( $field ) {
        // Only apply to the seasonal CTA season field.
        if ( 'field_lc_seasonal_cta_season' !== $field['key'] ) {
            return $field;
        }

        // Get the seasons repeater from options (Site-Wide Settings).
        $seasons = get_field( 'seasons', 'option' );
        $choices = array();

        // Debug: Add a default option to see if the filter is working.
        $choices[''] = 'Select a season...';

        if ( $seasons && is_array( $seasons ) ) {
            foreach ( $seasons as $row ) {
                if ( ! empty( $row['season'] ) ) {
                    $choices[ $row['season'] ] = $row['season'];
                }
            }
        } else {
            // Debug: Add message if no seasons found.
            $choices['no_seasons'] = 'No seasons found in settings';
        }

        $field['choices'] = $choices;
        return $field;
    }
);

add_filter(
    'acf/load_field/name=active_season',
    function ( $field ) {
        // Get the seasons repeater from options (Site-Wide Settings).
        $seasons = get_field( 'seasons', 'option' );
        $choices = array();

        // Add empty option.
        $choices[''] = 'Select active season...';

        if ( $seasons && is_array( $seasons ) ) {
            foreach ( $seasons as $row ) {
                if ( ! empty( $row['season'] ) ) {
                    $choices[ $row['season'] ] = $row['season'];
                }
            }
        }

        $field['choices'] = $choices;
        return $field;
    }
);
