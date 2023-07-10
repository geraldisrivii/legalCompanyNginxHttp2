<?php
add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles');
add_action( 'after_setup_theme', 'add_features');
add_theme_support( 'custom-logo');

function add_scripts_and_styles(){
    wp_enqueue_script('cookieLib', get_template_directory_uri() . '/assets/js/cookieLib.js', array(), '1.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('cookieLib'), '1.0.0', true);
    wp_enqueue_style( 'fonts' , get_template_directory_uri() . '/assets/css/fonts.css');
    wp_enqueue_style( 'main' , get_stylesheet_uri());
}

function add_features(){
    add_theme_support( 'post-thumbnails', [
        'post',
    ] );
    add_image_size( 'servise', '360' , '345', true );
}


add_action( 'admin_post_add_bid_action', 'process_custom_form' );
add_action( 'admin_post_nopriv_add_bid_action', 'process_custom_form' );

function process_custom_form(){
    $regexpArray = json_decode(stripcslashes($_POST['regexp']), true);
    unset($_POST['regexp']);
    unset($_POST['action']);
    require_once get_template_directory() . '/Servises/Validator.php';
    $validator = new Validator($_POST);
    $validator->add_rules($regexpArray);
    $validData = $validator->run();
    // database 
    global $wpdb;
    if(!$validator->is_valid_all()){
        return do_action( 'finished_custom_form', 'error' );
    }
    $result = $wpdb->insert($wpdb->prefix . 'bids', $validData);
    if($result != false){
        return do_action( 'finished_custom_form', 'ok' );
    }
    return do_action( 'finished_custom_form', 'error' );
}

add_action('finished_custom_form', 'finished_custom_form');

function finished_custom_form($status){
    setcookie('status', $status, time() + 20, '/');
    return wp_redirect( home_url() );
}
?>