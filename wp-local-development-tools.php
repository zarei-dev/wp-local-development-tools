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

    $is_staging = get_post_meta( $post_id, 'staging' );
    if ( isset($is_staging[0]) && $is_staging[0] == 'yes') {
        return $url;
    }

    $url = str_ireplace(get_home_url(), get_production_domain(), $url);

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


add_action( 'add_attachment', function ( $post_ID ) {
    add_post_meta( $post_ID, 'staging', 'yes' );
});


if ( !function_exists( 'get_production_domain' ) && defined( 'WP_PRODUCTION_DOMAIN' ) ) {

    function get_production_domain() {
        return WP_PRODUCTION_DOMAIN;
    }

}