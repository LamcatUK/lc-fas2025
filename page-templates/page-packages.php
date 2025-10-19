<?php
/**
 * Template Name: Packages
 * Description: Displays the currently active seasonal package page as defined in ACF options.
 *
 * @package lc-fas2025
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Get the repeater and active season name.
$seasons       = get_field( 'seasons', 'option' );
$active_season = get_field( 'active_season', 'option' );

if ( $seasons && $active_season ) {

    // Find the matching repeater row by season name.
    $matched = null;

    foreach ( $seasons as $row ) {
        if ( isset( $row['season'] ) && $row['season'] === $active_season ) {
            $matched = $row;
            break;
        }
    }

if ( $matched && ! empty( $matched['page']['url'] ) ) {
    $parsed = wp_parse_url( $matched['page']['url'], PHP_URL_PATH );
    $path   = trim( $parsed, '/' );

    $page = get_page_by_path( $path, OBJECT, 'page' );

    if ( $page ) {
        echo apply_filters( 'the_content', $page->post_content );
    } else {
        echo '<p>Seasonal page not found: ' . esc_html( $path ) . '</p>';
    }
} else {
        echo '<p>No seasonal page URL set.</p>';
    }

} else {
    echo '<p>No active season configured.</p>';
}

get_footer();
