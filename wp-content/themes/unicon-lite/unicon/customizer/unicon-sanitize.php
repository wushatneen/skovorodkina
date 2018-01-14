<?php 

/**
 * Sanitize switch button
 *
 * @package AccessPress Themes
 * @subpackage Unicon
 * @since 1.0.0
 */
function unicon_lite_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => __( 'Enable', 'unicon-lite' ),
            'hide'  => __( 'Disable', 'unicon-lite' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize checkbox field
 *
 * @package AccessPress Themes
 * @subpackage Unicon
 * @since 1.0.0
 */
function unicon_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize text field
 *
 * @package AccessPress Themes
 * @subpackage Unicon
 * @since 1.0.0
 */
function unicon_lite_text_sanitize( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/**
 * Sanitize multiple categories for blog
 *
 * @since 1.0.0
 */
function unicon_lite_multiple_categories_sanitize( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}


/**
 * Sanitize number fields
 *
 * @since 1.0.0
 */
function unicon_lite_number_sanitize( $input ) {
    $output = intval($input);
    return $output;
} 