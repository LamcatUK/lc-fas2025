<?php
/**
 * Block template for LC Seasonal CTA.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

$season = get_field( 'active_season', 'option' ) ? get_field( 'active_season', 'option' ) : '';

if ( ! $season ) {
	return;
}

// get the season details from seasons repeater field in site options.
$seasons        = get_field( 'seasons', 'option' );
$season_details = array();
if ( $seasons ) {
	foreach ( $seasons as $ss ) {
		if ( $ss['season'] === $season ) {
			$season_details = $ss;
			break;
		}
	}
}

?>
<section class="seasonal-cta" style="background-image: url('<?= esc_url( wp_get_attachment_image_url( $season_details['background'], 'full' ) ); ?>');">
	<div class="overlay"></div>
	<div class="container py-5 text-white" data-animate="up">
		<h2 class="fw-heading" data-aos="fade"><?= esc_html( $season_details['title'] ); ?></h2>
		<p class="mb-5 h2 fw-regular" data-aos="fade" data-aos-delay="100"><?= esc_html( $season_details['subtitle'] ); ?></p>
		<p data-aos="fade" data-aos-delay="200">
			<a href="<?= esc_url( $season_details['page']['url'] ); ?>" class="btn btn--primary"><?= esc_html( $season_details['page']['title'] ); ?></a>
		</p>
	</div>
</section>