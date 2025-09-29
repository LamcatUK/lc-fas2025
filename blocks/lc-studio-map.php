<?php
/**
 * Block template for LC Studio Map.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="studio-map">
	<div class="container py-5">
		<h2 class="text-center mb-4">My Studio</h2>
		<div class="text-center mb-5"><?= do_shortcode( '[contact_address]' ); ?></div>
		<iframe title="Map" src="<?= esc_url( get_field( 'map_embed_code', 'option' ) ); ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="img-radius"></iframe>
		<?php
		// Swiper slider of studio images.
		$studio_images = get_field( 'studio_images', 'option' );
		if ( $studio_images ) {
			?>
		<div class="swiper studio-images-swiper mb-5">
			<div class="swiper-wrapper">
				<?php
				foreach ( $studio_images as $image ) {
					?>
					<div class="swiper-slide text-center">
						<?= wp_get_attachment_image( $image, 'large', false, array( 'class' => 'img-fluid img-radius' ) ); ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
			<?php
			add_action(
				'wp_footer',
				function () {
					?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	if (window.Swiper) {
		new Swiper('.studio-images-swiper', {
			slidesPerView: 1,
			spaceBetween: 9,
			loop: true,
			autoplay: true,
			pagination: false,
			breakpoints: {
				0: {
					slidesPerView: 1
				},
				768: {
					slidesPerView: 2
				},
				1200: {
					slidesPerView: 4
				}
			}
		});
	}
});
</script>
					<?php
				},
				9999
			);
		}
		?>
	</div>
</section>