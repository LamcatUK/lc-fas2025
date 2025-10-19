<?php
/**
 * Block template for LC Image Cards.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

$images = get_field( 'images' );
if ( ! $images ) {
	return;
}

?>
<section class="image-cards has-neutral-50-background-color py-5">
	<div class="container">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="mb-4 text-center"><?= esc_html( get_field( 'title' ) ); ?></h2>
			<?php
		}
		if ( get_field( 'intro' ) ) {
			?>
		<p class="mb-4 text-center"><?= wp_kses_post( get_field( 'intro' ) ); ?></p>
			<?php
		}
		?>
		<div class="row g-1" id="gallery_items">
			<?php
			// if divisible by 4 use col-md-3 else col-md-4.
			$col_class = ( count( $images ) % 4 === 0 ) ? 'col-lg-3 col-md-3 col-sm-6' : 'col-lg-4 col-md-4 col-sm-6';
			foreach ( $images as $image ) {
				?>
				<div class="col-sm-6 <?= esc_attr( $col_class ); ?> gallery-item-wrapper">
					<a href="<?= esc_url( wp_get_attachment_image_url( $image, 'full' ) ); ?>" class="gallery__link image-4x3 glightbox img-radius" data-gallery="gallery-sm" data-type="image">
						<?= wp_get_attachment_image( $image, 'large', false, array( 'class' => 'gallery__image' ) ); ?>
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });
});
</script>
		<?php
	}
);