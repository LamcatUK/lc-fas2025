<?php
/**
 * File responsible for registering custom ACF blocks and modifying core block arguments.
 *
 * @package lc-fas2025
 */

/**
 * Registers custom ACF blocks.
 *
 * This function checks if the ACF plugin is active and registers custom blocks
 * for use in the WordPress block editor. Each block has its own name, title,
 * category, icon, render template, and supports various features.
 */
function acf_blocks() {
    if ( function_exists( 'acf_register_block_type' ) ) {

		// INSERT NEW BLOCKS HERE.

        acf_register_block_type(
            array(
                'name'            => 'lc_award_grid',
                'title'           => __( 'LC Award Grid' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-award-grid.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_faq',
                'title'           => __( 'LC FAQ' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-faq.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_page_hero',
                'title'           => __( 'LC Page Hero' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-page-hero.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_contact',
                'title'           => __( 'LC Contact' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-contact.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_pricing',
                'title'           => __( 'LC Pricing' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-pricing.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_gallery',
                'title'           => __( 'LC Gallery' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-gallery.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_service_grid',
                'title'           => __( 'LC Service Grid' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-service-grid.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_studio_map',
                'title'           => __( 'LC Studio Map' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-studio-map.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_awards',
                'title'           => __( 'LC Awards' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-awards.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_seasonal_cta',
                'title'           => __( 'LC Seasonal CTA' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-seasonal-cta.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_text_image',
                'title'           => __( 'LC Text Image' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-text-image.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_home_hero_slideshow',
                'title'           => __( 'LC Home Hero Slideshow' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-home-hero-slideshow.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

    }
}
add_action( 'acf/init', 'acf_blocks' );

// Auto-sync ACF field groups from acf-json folder.
add_filter(
	'acf/settings/save_json',
	function ( $path ) {
		return get_stylesheet_directory() . '/acf-json';
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		unset( $paths[0] );
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;
	}
);

/**
 * Modifies the arguments for specific core block types.
 *
 * @param array  $args The block type arguments.
 * @param string $name The block type name.
 * @return array Modified block type arguments.
 */
function core_block_type_args( $args, $name ) {

	if ( 'core/paragraph' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/heading' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/list' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}

    return $args;
}
add_filter( 'register_block_type_args', 'core_block_type_args', 10, 3 );

/**
 * Helper function to detect if footer.php is being rendered.
 *
 * @return bool True if footer.php is being rendered, false otherwise.
 */
function is_footer_rendering() {
    $backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
    foreach ( $backtrace as $trace ) {
        if ( isset( $trace['file'] ) && basename( $trace['file'] ) === 'footer.php' ) {
            return true;
        }
    }
    return false;
}

/**
 * Adds a container div around the block content unless footer.php is being rendered.
 *
 * @param array  $attributes The block attributes.
 * @param string $content    The block content.
 * @return string The modified block content wrapped in a container div.
 */
function modify_core_add_container( $attributes, $content ) {
    if ( is_footer_rendering() ) {
        return $content;
    }

    ob_start();
    ?>
    <div class="container">
        <?= wp_kses_post( $content ); ?>
    </div>
	<?php
	$content = ob_get_clean();
    return $content;
}

/**
 * Handle Group blocks differently - only add container for non-aligned groups without backgrounds.
 *
 * @param array  $attributes The block attributes.
 * @param string $content    The block content.
 * @return string The modified block content.
 */
function modify_group_block( $attributes, $content ) {
    if ( is_footer_rendering() ) {
        return $content;
    }

    // Check if group has alignment or background.
    $has_alignment  = ! empty( $attributes['align'] ) && in_array( $attributes['align'], array( 'wide', 'full' ), true );
    $has_background = ! empty( $attributes['backgroundColor'] ) || 
                      ! empty( $attributes['style']['color']['background'] ) ||
                      ! empty( $attributes['gradient'] );

    // Only add container for groups without alignment and without background.
    if ( ! $has_alignment && ! $has_background ) {
        ob_start();
        ?>
        <div class="container">
            <?= wp_kses_post( $content ); ?>
        </div>
        <?php
        return ob_get_clean();
    }

    // For groups with backgrounds, add py-5 class.
    if ( $has_background ) {
        // Add py-5 to the group wrapper.
        $content = preg_replace( 
            '/<div class="([^"]*wp-block-group[^"]*)"/', 
            '<div class="$1 py-5"', 
            $content 
        );
    }

    return $content;
}

/**
 * Ensure Group blocks support alignment options
 */
function enable_group_block_alignment() {
    if ( function_exists( 'register_block_type' ) ) {
        // Get the existing Group block and ensure it supports alignment
        $group_block = WP_Block_Type_Registry::get_instance()->get_registered( 'core/group' );
        if ( $group_block ) {
            $group_block->supports['align'] = array( 'wide', 'full' );
        }
    }
}
add_action( 'init', 'enable_group_block_alignment', 20 );
