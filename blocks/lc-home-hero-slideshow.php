<?php
/**
 * Block template for LC Home Hero Slideshow.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="home-hero py-5">
	<div class="container pb-5">
		<div class="row g-5 align-items-center">
			<div class="col-md-6" data-aos="fade">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/fas-logo.jpg' ); ?>" alt="" class="mb-4">
				<div class="fs-subtle"><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
				<a href="/contact/" class="btn btn--primary mt-4">Book Your Session</a>
			</div>
		   	<div class="col-md-6" data-aos="fade" data-aos-delay="100">
			   	<?php
			   	if ( get_field( 'slides' ) ) {
				   	?>
				   	<div class="swiper home-hero-swiper">
					   	<div class="swiper-wrapper">
						   	<?php
						   	foreach ( get_field( 'slides' ) as $slide ) {
							   	?>
								<div class="swiper-slide">
									<?= wp_get_attachment_image( $slide['id'], 'large', false, array( 'class' => 'img-radius' ) ); ?>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		const homeHeroSwiper = new Swiper('.home-hero-swiper', {
			loop: true,
			effect: 'fade',
			speed: 1000,
            fadeEffect: {
                crossFade: true
            },
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			pagination: false
		});
	});
</script>
		<?php
	}
);