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
		<h2 class="text-center mb-4 h2">Get in Touch</h2>
		<div class="row g-4">
			<div class="col-md-6" data-aos="fade">
				<h3 class="h3 mb-3">Contact Information</h3>
				<p class="mb-1"><strong>Email:</strong> <?= do_shortcode( '[contact_email]' ); ?></p>
				<p class="mb-1"><strong>Phone:</strong> <?= do_shortcode( '[contact_phone]' ); ?></p>
				<p class="mb-1"><strong>Address:</strong> <?= do_shortcode( '[contact_address]' ); ?></p>
			</div>
			<div class="col-md-6" data-aos="fade" data-aos-delay="200">
				<h3 class="h3 mb-3">Send a Message</h3>
				<?= do_shortcode( '[contact_form]' ); ?>
			</div>
		</div>
	</div>
</section>