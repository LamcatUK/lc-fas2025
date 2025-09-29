<?php
/**
 * Block template for LC Awards.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="awards pt-4 pb-5 bg-neutral-50">
	<div class="container py-5">
		<h2 class="text-center mb-5 h2">Awards &amp; Recognition</h2>
		<?php
		// swiper slider.
		$awards = get_field( 'awards', 'option' );
		if ( $awards ) {
			echo '<div class="swiper awards-swiper">';
			echo '<div class="swiper-wrapper">';
			foreach ( $awards as $award ) {
				echo '<div class="swiper-slide">';
				echo wp_get_attachment_image( $award, 'full' );
				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
		}
		?>
		<div class="text-center pt-5">
			<a href="/about/#awards" class="btn btn--primary">Find Out More</a>
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
	if (window.Swiper) {
		new Swiper('.awards-swiper', {
			slidesPerView: 1,
			spaceBetween: 10,
			autoplay: true,
			loop: true,
			breakpoints: {
				0: {
					slidesPerView: 1
				},
				768: {
					slidesPerView: 3
				},
				992: {
					slidesPerView: 5
				},
			}
		});
	}
});
</script>
		<?php
	},
	9999
);