<?php
/**
 * Block template for LC Award Grid.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="awards-grid">
	<div class="container py-5">
		<div class="award-grid">
			<?php
			while ( have_rows( 'awards' ) ) {
				the_row();
				$image       = get_sub_field( 'image' );
				$title       = get_sub_field( 'title' );
				$description = get_sub_field( 'description' );
				$full_image  = wp_get_attachment_image_url( $image, 'full' );
				$thumb_image = wp_get_attachment_image_url( $image, 'large' );
				?>
			<a href="<?= esc_url( $full_image ); ?>" class="award glightbox" data-glightbox="title: <?= esc_attr( $title ); ?>; description: <?= esc_attr( $description ); ?>; descPosition: right;">
				<img src="<?= esc_url( $thumb_image ); ?>" alt="<?= esc_attr( $title ); ?>">
				<div class="award-caption">
					<h3><?= esc_html( $title ); ?></h3>
					<p><?= esc_html( $description ); ?></p>
				</div>
			</a>
				<?php
			}
			?>
		</div>
	</div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const lightbox = GLightbox({
			selector: '.glightbox'
		});
	});
</script>
		<?php
	},
	20
);