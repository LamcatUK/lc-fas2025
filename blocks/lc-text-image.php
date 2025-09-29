<?php
/**
 * Block template for LC Text Image.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

// Get ACF fields.
$bg        = get_field( 'bg_colour' );
$fg        = get_field( 'fg_colour' );
$col_order = get_field( 'order' ) ? get_field( 'order' ) : 'Text Image';
$split     = get_field( 'split' ) ? get_field( 'split' ) : '50 50';
$level     = get_field( 'level' ) ? get_field( 'level' ) : 'h2';

$classes = array();
$style   = '';

if ( $bg ) {
	$classes[] = 'has-' . sanitize_html_class( $bg ) . '-background-color';
}
if ( $fg ) {
	$classes[] = 'has-' . sanitize_html_class( $fg ) . '-color';
}

// Determine column order classes.
$text_col_order  = 'order-md-1';
$image_col_order = 'order-md-2';
if ( 'Image Text' === $col_order ) {
	$text_col_order  = 'order-md-2';
	$image_col_order = 'order-md-1';
}

// Determine column width classes.
if ( '60 40' === $split ) {
	$text_col_width  = 'col-md-7';
	$image_col_width = 'col-md-5';
} else {
	// Default to 50 50.
	$text_col_width  = 'col-md-6';
	$image_col_width = 'col-md-6';
}

// Determine heading level.
$heading_tag = ( 'h1' === $level ) ? 'h1' : 'h2';
// Generate a unique ID for this block instance.
$block_uid = 'text-image-' . uniqid();
?>
<section id="<?= esc_attr( $block_uid ); ?>" class="text-image <?= esc_attr( implode( ' ', $classes ) ); ?> py-5" >
	<div class="container py-5">
		<div class="row g-5 align-items-center">
			<?php
			// Always output text column first, image column second in the DOM.
			// Parameterise data-animate so that on desktop, columns always slide in from outside in.
			$text_order_class  = $text_col_order;
			$image_order_class = $image_col_order;
			$text_animate      = 'right';
			$image_animate     = 'left';
			if ( 'Image Text' === $col_order ) {
				// Visually swap columns on md+ screens, and swap data-animate so image slides in from left, text from right.
				$text_order_class  = 'order-2 order-md-2';
				$image_order_class = 'order-1 order-md-1';
				$text_animate      = 'left';
				$image_animate     = 'right';
			}
			?>
			<div class="<?= esc_attr( $text_col_width . ' ' . $text_order_class ); ?>"  data-aos="fade">
				<<?= esc_attr( $heading_tag ); ?> class="h2"><?= wp_kses_post( get_field( 'title' ) ); ?></<?= esc_attr( $heading_tag ); ?>>
				<?= wp_kses_post( get_field( 'content' ) ); ?>
				<?php
				if ( get_field( 'cta' ) ) {
					$cta = get_field( 'cta' );
					?>
					<p class="mt-4"><a class="link" href="<?= esc_url( $cta['url'] ); ?>"
						target="<?= esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>"><?= esc_html( $cta['title'] ); ?></a>
					</p>
					<?php
				}
				?>
			</div>
			<div class="<?= esc_attr( $image_col_width . ' ' . $image_order_class ); ?>" data-aos="fade">
				<div class="image-16x9 img-radius text-center">
					<?= wp_get_attachment_image( get_field( 'image' ), 'full', false, array( 'class' => '' ) ); ?>
				</div>
			</div>
		</div>
	</div>
</section>