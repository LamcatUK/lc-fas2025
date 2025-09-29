<?php
/**
 * Block template for LC Contact.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="contact">
	<div class="container">
		<div class="row g-4">
			<div class="col-md-6" data-aos="fade">
				<h3 class="h3 mb-3">Contact Information</h3>
				<ul class="fa-ul mb-4">
					<li class="mb-2"><span class="fa-li"><i class="fas fa-envelope"></i></span>  <?= do_shortcode( '[contact_email]' ); ?></li>
					<li class="mb-2"><span class="fa-li"><i class="fas fa-phone"></i></span> <?= do_shortcode( '[contact_phone]' ); ?></li>
					<li class="mb-2"><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span> <?= do_shortcode( '[contact_address]' ); ?></li>
				</ul>
				<?php
				$social_media_group = get_field( 'social', 'option' );
				if ( $social_media_group && is_array( $social_media_group ) && array_filter( $social_media_group ) ) {
					?>
				<h4 class="h4">Find me on social media:</h4>
				<div class="social-icons my-3">
					<?= do_shortcode( '[social_icons class="fa-2x"]' ); ?>
				</div>
					<?php
				}
				?>
			</div>
			<div class="col-md-6" data-aos="fade" data-aos-delay="200">
				<h3 class="h3 mb-3">Send a Message</h3>
				<?= do_shortcode( '[contact-form-7 id="38ce6d9" title="Contact form"]' ); ?>
			</div>
		</div>
	</div>
</section>