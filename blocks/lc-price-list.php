<?php
/**
 * Block template for LC Price List.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

// prices is an acf repeater.

$prices = get_field( 'prices' );

if ( ! $prices || count( $prices ) < 2 ) {
	return;
}

// if divisible by 2, use cols-lg-2, else cols-lg-3.
$cols_class = ( count( $prices ) % 2 === 0 ) ? 'cols-lg-2' : 'cols-lg-3';
?>
<section class="price-list">
	<div class="container">
		<ul class="<?= esc_attr( $cols_class ); ?> gap-5 shadow-sm ">
			<?php
			foreach ( $prices as $index => $price ) {
				?>
				<li class="price-item d-flex justify-content-between align-items-center">
					<strong class="price-title"><?= esc_html( $price['title'] ); ?></strong>
					<span class="price-amount"><?= esc_html( $price['price'] ); ?></span>
				</li>
				<?php
			}
			?>
		</ul>
	</div>
</section>