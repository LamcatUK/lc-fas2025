<?php
/**
 * Block template for LC Full Width Text.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

// Get ACF fields.
$bg        = get_field( 'bg_colour' );
$fg        = get_field( 'fg_colour' );
$alignment = get_field( 'alignment' ) ? 'text-center' : '';
$constrain = get_field( 'constrain' ) ? 'w-constrained-md' : '';
$margins   = $alignment && $constrain ? 'mx-auto' : '';
$cta       = get_field( 'link' );

$classes = array();
$style   = '';

if ( $bg ) {
	$classes[] = 'has-' . sanitize_html_class( $bg ) . '-background-color';
}
if ( $fg ) {
	$classes[] = 'has-' . sanitize_html_class( $fg ) . '-color';
}
// Generate a unique ID for this block instance.
$block_uid = 'full-width-text-' . uniqid();
?>
<section id="<?= esc_attr( $block_uid ); ?>" class="full-width-text <?= esc_attr( implode( ' ', $classes ) ); ?> py-5" >
	<div class="container py-5 <?= esc_attr( $alignment ); ?>">
		<h2><?= esc_html( get_field( 'title' ) ); ?></h2>
		<div class="<?= esc_attr( $constrain ); ?> <?= esc_attr( $margins ); ?>"><?= wp_kses_post( wpautop( get_field( 'content' ) ) ); ?></div>
		<?php
		if ( $cta ) {
			$cta_url    = $cta['url'];
			$cta_title  = $cta['title'] ? $cta['title'] : $cta_url;
			$cta_target = $cta['target'] ? $cta['target'] : '_self';
			?>
			<a class="btn btn--primary mt-4" href="<?= esc_url( $cta_url ); ?>" target="<?= esc_attr( $cta_target ); ?>">
				<?= esc_html( $cta_title ); ?>
			</a>
			<?php
		}
		?>
	</div>
</section>