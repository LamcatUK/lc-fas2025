<?php
/**
 * Block template for LC Gallery.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

$classes = $block['className'] ?? 'pb-5';

// get session_type.
$session_type = get_field( 'session_type', get_the_ID() );
?>
<section class="gallery <?= esc_attr( $classes ); ?>">
	<div class="container">
		<?php
		// Fetch all attachments.
		$args = array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => -1,
			'orderby'        => 'rand',
			'order'          => 'DESC',
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'session_type',
					'field'    => 'term_id',
					'terms'    => $session_type->term_id,
					'operator' => 'IN',
				),
			),
		);

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			?>
		<div class="row g-1" id="gallery_items">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 gallery-item-wrapper">
					<a href="<?= esc_url( wp_get_attachment_image_url( get_the_ID(), 'full' ) ); ?>" class="gallery__link image-4x3 glightbox img-radius" data-gallery="gallery-all" data-type="image">
						<?= wp_get_attachment_image( get_the_ID(), 'large', false, array( 'class' => 'gallery__image' ) ); ?>
					</a>
				</div>
				<?php
			}
			?>
		</div>
			<?php
		} else {
			echo '<p>' . esc_html( 'No images found in the gallery.' ) . '</p>';
		}
		wp_reset_postdata();
		?>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });
});
</script>
		<?php
	}
);