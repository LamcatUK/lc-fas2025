<?php
/**
 * Block template for CB Seasonal Package Banner.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="seasonal-banner has-accent-400-background-color has-white-color py-4">
	<div class="container text-center" data-animate="up">
		<h2 class="fs-h2 fw-heading" data-aos="fade"><?= esc_html( get_field( 'title' ) ); ?></h2>
		<p class="h4 fw-regular" data-aos="fade" data-aos-delay="100"><?= esc_html( get_field( 'subtitle' ) ); ?></p>
		<p data-aos="fade" data-aos-delay="200">
			<a href="/contact/" class="btn btn--ghost">Book Your Session Today</a>
		</p>
	</div>
</section>