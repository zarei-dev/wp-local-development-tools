<?php
/**
 * Plugin Name:         WP Local Development Tools
 * Description:         Bunch of tools that usefull for WP with stage mode
 * Version:             0.0.1
 * Author:              Mohammad Zarei
 * Author URI:          https://moza.dev/
 * License:             GPL v3
 */

add_filter( 'wp_get_attachment_url', function ($url, $post_id) {
    // replace with your stage domain
    $url = str_ireplace(get_home_url(), 'https://example.com/', $url);

    return $url;
}, 10, 200 );

add_filter( 'max_srcset_image_width', function ( $max_width ) {
    return false;
} );

add_filter( 'wp_calculate_image_srcset', function ( $sources ) {
    return false;
});


if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}
