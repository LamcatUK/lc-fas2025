<?php
/**
 * Block template for LC Image CTA.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

$l = get_field( 'link' );

?>
<section class="seasonal-cta" style="background-image: url('<?= esc_url( wp_get_attachment_image_url( get_field( 'background' ), 'full' ) ); ?>');">
	<div class="overlay"></div>
	<div class="container py-5 text-white" data-animate="up">
		<h2 class="fw-heading" data-aos="fade"><?= esc_html( get_field( 'title' ) ); ?></h2>
		<p class="mb-5 h2 fw-regular" data-aos="fade" data-aos-delay="100"><?= esc_html( get_field( 'subtitle' ) ); ?></p>
		<p data-aos="fade" data-aos-delay="200">
			<a href="<?= esc_url( $l['url'] ); ?>" class="btn btn--primary"><?= esc_html( $l['title'] ); ?></a>
		</p>
	</div>
</section>