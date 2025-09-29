<?php
/**
 * Footer template for the For All Seasons Photography 2025 theme.
 *
 * This file contains the footer section of the theme, including navigation menus,
 * office addresses, and colophon information.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="footer-top"></div>

<footer class="footer pt-5 pb-3">
    <div class="container">
        <div class="row pb-5 g-4">
			<div class="col-12 col-md-3 text-center">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/fas-logo--footer.jpg' ); ?>" alt="For All Seasons Photography" class="w-100 mb-4 d-block" width="237" height="45">
            </div>
            <div class="col-sm-6 col-md-3">
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu1',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu2',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-md-3 footer__contact">
				<ul class="fa-ul">
					<li><span class="fa-li"><i class="far fa-envelope"></i></span> <?= do_shortcode( '[contact_email]' ); ?></li>
					<li><span class="fa-li"><i class="fas fa-phone"></i></span> <?= do_shortcode( '[contact_phone]' ); ?></li>
					<li><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span> <?= do_shortcode( '[contact_address]' ); ?></li>
				</ul>
				<?php
				$social_media_group = get_field( 'social', 'option' );
				if ( $social_media_group && is_array( $social_media_group ) && array_filter( $social_media_group ) ) {
					?>
				<div class="d-flex flex-wrap align-items-center social-icons gap-3">
					<span>Connect:</span>
					<?= do_shortcode( '[social_icons class="d-flex justify-content-center gap-3 fs-h3"]' ); ?>
				</div>
					<?php
				}
				?>
            </div>
        </div>

        <div class="colophon d-flex justify-content-between align-items-center flex-wrap">
            <div>
                &copy; <?= esc_html( gmdate( 'Y' ) ); ?> For All Seasons Photography
            </div>
            <div>
				<a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/">Cookies</a> |
                Site by <a href="https://www.lamcat.co.uk/" rel="nofollow noopener" target="_blank">Lamcat</a>
            </div>
        </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>