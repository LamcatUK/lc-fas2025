<?php
/**
 * Block template for LC Pricing.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

// Fetch pricing data from site-wide settings.
$pricing_data = get_field( 'prices', 'option' );

if ( ! $pricing_data || ! is_array( $pricing_data ) ) {
    echo '<p>No pricing data available. Please check the Site-Wide Settings.</p>';
    return;
}
?>
<section class="pricing">
	<div class="container my-5">

    	<!-- Desktop tabs -->
		<div class="row g-4 text-center d-none d-md-flex" role="tablist">
			<?php
			foreach ( $pricing_data as $index => $pricing_item ) {
				$tab_id  = 'tab_' . $index;
				$pane_id = 'pane_' . $index;
				?>
		<div class="col-md-4">
			<div class="card shadow-sm h-100">
				<div class="card-body">
					<h5 class="card-title"><?php echo esc_html( $pricing_item['size'] ); ?></h5>
					<p><strong>From <?php echo esc_html( $pricing_item['from'] ); ?></strong></p>
					<p class="text-muted"><?php echo esc_html( $pricing_item['message'] ?? '' ); ?></p>
					<button class="btn btn-outline-primary" 
							data-bs-toggle="tab"
							data-bs-target="#<?php echo esc_attr( $pane_id ); ?>">
            View Prices
            		</button>
          		</div>
        	</div>
      	</div>
      			<?php
	  		}
	  		?>
	</div>

    <!-- Desktop full-width content -->
    <div class="tab-content d-none d-md-block mt-4">
      	<?php
	  	foreach ( $pricing_data as $index => $pricing_item ) {
        	$pane_id = 'pane_' . $index;
      		?>
      	<div class="tab-pane fade" 
        	id="<?php echo esc_attr( $pane_id ); ?>">
        	<h4><?php echo esc_html( $pricing_item['size'] ); ?></h4>
			<ul class="list-unstyled cols-lg-2 gap-5">
        		<?php
				foreach ( $pricing_item['sizes'] as $size_item ) {
					?>
          		<li class="pricing-item d-flex justify-content-between border-bottom py-2">
					<span><?php echo esc_html( $size_item['size'] ); ?></span>
					<span><?php echo esc_html( $size_item['price'] ); ?></span>
				</li>
        			<?php
				}
				?>
      		</ul>
      	</div>
      		<?php
		}
		?>
    </div>

	<!-- Mobile accordion -->
	<div class="accordion d-md-none mt-4" id="pricingAccordion">
		<?php
		foreach ( $pricing_data as $index => $pricing_item ) {
			$acc_id = 'acc_' . $index;
			?>
		<div class="accordion-item">
			<h2 class="accordion-header" id="heading_<?= esc_attr( $index ); ?>">
				<button class="accordion-button collapsed" 
					type="button" data-bs-toggle="collapse" 
					data-bs-target="#<?php echo esc_attr( $acc_id ); ?>">
					<div class="w-100 text-start">
						<div class="fw-bold">
							<?php echo esc_html( $pricing_item['size'] ); ?> — From <?php echo esc_html( $pricing_item['from'] ); ?>
						</div>
						<?php
						if ( ! empty( $pricing_item['message'] ) ) {
							?>
						<small class="text-muted"><?php echo esc_html( $pricing_item['message'] ); ?></small>
							<?php
						}
						?>
					</div>
				</button>
			</h2>
			<div id="<?php echo esc_attr( $acc_id ); ?>" 
				class="accordion-collapse collapse" 
				data-bs-parent="#pricingAccordion">
				<div class="accordion-body">
					<?php
					foreach ( $pricing_item['sizes'] as $size_item ) {
						?>
					<div class="pricing-item d-flex justify-content-between border-bottom py-2">
						<span><?php echo esc_html( $size_item['size'] ); ?></span>
						<span><?php echo esc_html( $size_item['price'] ); ?></span>
					</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
			<?php
		}
		?>
	</div>
</section>
