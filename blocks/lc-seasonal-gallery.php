<?php
/**
 * Block template for LC Seasonal Gallery.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

$classes = $block['className'] ?? 'pb-5';

// get session_type.
?>
<section class="gallery <?= esc_attr( $classes ); ?>">
	<div class="container">
		<?php
		$images = get_field( 'images' );
		if ( $images ) {
			?>
		<div class="row g-1" id="gallery_items">
			<?php
			foreach ( $images as $image ) {
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 gallery-item-wrapper">
					<a href="<?= esc_url( wp_get_attachment_image_url( $image, 'full' ) ); ?>" class="gallery__link image-4x3 glightbox img-radius" data-gallery="gallery-all" data-type="image">
						<?= wp_get_attachment_image( $image, 'large', false, array( 'class' => 'gallery__image' ) ); ?>
					</a>
				</div>
				<?php
			}
			?>
		</div>
			<?php
		} else {
			echo '<p>' . esc_html( 'No images found in the gallery.' ) . '</p>';
		}
		wp_reset_postdata();
		?>
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