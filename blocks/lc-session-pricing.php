<?php
/**
 * Block template for LC Session Pricing.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="session-pricing">
	<div class="container py-5">
		<div class="session-pricing__inner">
			<?php
			if ( get_field( 'title' ) || get_field( 'intro' ) ) {
				?>
			<div class="session-pricing__header text-center mb-4">
				<?php
				if ( get_field( 'title' ) ) {
					?>
				<h2 class="session-pricing__title"><?php echo esc_html( get_field( 'title' ) ); ?></h2>
					<?php
				}
				if ( get_field( 'intro' ) ) {
					?>
				<p class="session-pricing__intro"><?php echo esc_html( get_field( 'intro' ) ); ?></p>
					<?php
				}
				?>
			</div>
				<?php
			}
			if ( have_rows( 'session_pricing_plans' ) ) {
				?>
			<div class="session-pricing__content">
				<div class="row g-4">
					<?php
					while ( have_rows( 'session_pricing_plans' ) ) {
						the_row();
						$plan_name     = get_sub_field( 'plan_name' );
						$plan_price    = get_sub_field( 'plan_price' );
						$plan_features = get_sub_field( 'plan_features' );
						?>
						<div class="col-md-6">
							<div class="session-pricing__plan card shadow-sm h-100">
								<div class="card-body">
									<div class="h3 card-title"><?= esc_html( $plan_name ); ?></div>
									<div class="align-content-center text-center"><strong><?= esc_html( $plan_price ); ?></strong></div>
									<div class="session-pricing__plan-feature text-muted"><?= esc_html( $plan_features ); ?></div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
			</div>
			<?php
			if ( get_field( 'after_content' ) ) {
				?>
			<div class="session-pricing__after-content text-center fs-ui"><?= esc_html( get_field( 'after_content' ) ); ?></div>
				<?php
			}
			?>
		</div>
	</div>
</section>