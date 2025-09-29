<?php
/**
 * Block template for LC Service Grid.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

// get id of sessions page.
$sessions_page = get_page_by_path( 'sessions' );

if ( ! $sessions_page ) {
	echo '<p>' . esc_html( 'Please create a "Sessions" page to use this block.' ) . '</p>';
	return; // Sessions page not found.
}

// get children of /sessions/.
$services = get_posts(
	array(
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'post_parent'    => $sessions_page->ID,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);

?>
<section class="session-grid pt-4 pb-5">
	<div class="container py-5">
		<h2 class="text-center mb-5 h2">Explore My Sessions</h2>
		<div class="row g-2">
		<?php
		$col_counter = 0;
		foreach ( $services as $service ) {
			$delay = ( $col_counter % 3 ) * 100;
			?>
			<div class="col-lg-6 col-xl-4" data-aos="fade" data-aos-delay="<?= esc_attr( $delay ); ?>">
				<div class="service-item">
					<div class="service-item__image">
						<?= wp_get_attachment_image( get_field( 'card_image', $service->ID ), 'large', false, array( 'class' => 'img-fluid' ) ); ?>
						<div class="service-item__image--title text-white"><?= esc_html( get_field( 'card_title', $service->ID ) ); ?></div>
					</div>
					<div class="service-item__details">
						<h3 class="fw-heading"><?= esc_html( get_field( 'card_title', $service->ID ) ); ?></h3>
						<p><?= esc_html( get_field( 'card_content', $service->ID ) ); ?></p>
						<a href="<?= esc_url( get_permalink( $service->ID ) ); ?>" class="link">Learn More</a>
					</div>
				</div>
			</div>
			<?php
			++$col_counter;
		}
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
	var grid = document.querySelector('.session-grid');
	if (grid && ('ontouchstart' in window || navigator.maxTouchPoints > 0)) {
		grid.classList.add('touch');
	}
});
</script>
		<?php
	},
	9999
);