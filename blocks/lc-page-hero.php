<?php
/**
 * Block template for LC Page Hero.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="home-hero py-5">
	<div class="container pb-5">
		<div class="row g-5 align-items-center">
			<div class="col-md-6" data-aos="fade">
				<h1><?= esc_html( get_field( 'title' ) ); ?></h1>
				<div class="fs-subtle"><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
				<?php
				if ( get_field( 'cta' ) ) {
					?>
					<p class="mt-4">
						<a href="<?= esc_url( get_field( 'cta' )['url'] ); ?>" class="btn btn--primary"><?= esc_html( get_field( 'cta' )['title'] ); ?></a>
					</p>
					<?php
				}
				?>
			</div>
		   	<div class="col-md-6" data-aos="fade" data-aos-delay="100">
				<?php
				if ( get_field( 'image' ) ) {
					?>
					<?= wp_get_attachment_image( get_field( 'image' ), 'large', false, array( 'class' => 'img-radius' ) ); ?>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>