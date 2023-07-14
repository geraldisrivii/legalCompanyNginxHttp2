<?php
add_action( 'wp_enqueue_scripts', 'add_scripts_and_styles');
add_action( 'after_setup_theme', 'add_features');
add_theme_support( 'custom-logo');

function add_scripts_and_styles(){

    wp_enqueue_script('cookieLib', get_template_directory_uri() . '/assets/js/cookieLib.js', array(), '1.0.0', true);
    wp_enqueue_script('sweetAlert', get_template_directory_uri() . '/assets/js/sweetAlert.js', array(), '1.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('cookieLib', 'sweetAlert'), '1.0.0', true);

    // crucial styles
    // wp_enqueue_style( 'crucial-style' , get_template_directory_uri() . '/assets/css/crucial.css');

    wp_dequeue_style('wp-block-library');
    // wp_enqueue_style( 'fonts' , get_template_directory_uri() . '/assets/css/fonts.css');
    // wp_enqueue_style( 'main' , get_stylesheet_uri());
}

add_action('wp_footer', 'add_deferred_styles_script');

function add_deferred_styles_script(){
    $loadCssUri = get_template_directory_uri() . '/assets/js/loadCss.js';
    $basePath = get_template_directory_uri();
    $mainStylesUri = get_stylesheet_uri();
    echo "<script src='{$loadCssUri}'></script>";
    echo "<script>
            loadCSS('{$basePath}/assets/css/fonts.css');
            loadCSS('{$mainStylesUri}');
        </script>";
}

function add_features(){
    add_theme_support( 'post-thumbnails', [
        'post',
    ] );
    add_image_size( 'servise', '360' , '345', true );
}


add_action( 'admin_post_add_bid_action_index', 'process_custom_form' );
add_action( 'admin_post_nopriv_add_bid_action_index', 'process_custom_form' );

add_action( 'admin_post_add_bid_action_catalog', 'process_custom_form' );
add_action( 'admin_post_nopriv_add_bid_action_catalog', 'process_custom_form' );

function process_custom_form(){
    $regexpArray = json_decode(stripcslashes($_POST['regexp']), true);
    unset($_POST['regexp']);
    unset($_POST['action']);
    require_once get_template_directory() . '/Servises/Validator.php';
    $validator = new Validator($_POST);
    $validator->add_rules($regexpArray);
    $validData = $validator->run();
    // database 
    
    if(!$validator->is_valid_all()){
        return do_action( 'finished_custom_form', 'error' );
    }

    $categoryConsult = get_category_by_slug( 'consult_bid' );
    
    $post_data = array(
        'post_title'    => $validData['phone'],
        'post_content'  => "заявка создана: {$validData['name']}",
        'post_status'   => 'publish',
        'post_category' => [$categoryConsult->term_id],
    );
    
    // Вставляем пост в базу данных
    $post_id = wp_insert_post( $post_data );

    if($post_id != false){
        return do_action( 'finished_custom_form', 'ok' );
    }
    return do_action( 'finished_custom_form', 'error' );
}

add_action('finished_custom_form', 'finished_custom_form');

function finished_custom_form($status){
    setcookie('status', $status, time() + 20, '/');
    return wp_redirect( wp_get_referer() ? wp_get_referer() : home_url() );
}





add_action('wp_ajax_add_bid_action_ajax', 'my_ajax_callback');
add_action('wp_ajax_nopriv_add_bid_action_ajax', 'my_ajax_callback');

function my_ajax_callback() {
    check_ajax_referer('my-ajax-nonce', 'ajax_nonce');

    $stripSlashesRegexp = stripcslashes($_POST['regexp']);
    $FinisedBeforeEncodingRegexp = str_replace('\\', '\\\\' , $stripSlashesRegexp);
    $regexpArray = json_decode($FinisedBeforeEncodingRegexp, true, 2 , JSON_UNESCAPED_UNICODE);

    require_once get_template_directory() . '/Servises/Validator.php';
    $validator = new Validator($_POST);
    $validator->add_rules($regexpArray);
    $validData = $validator->run();
    if(!($validator->is_valid_all())){
        echo json_encode([
            'status' => 'error',
            'message' => 'Заявка не отправлена'
        ], JSON_UNESCAPED_UNICODE);
        wp_die();   
    }

    $categoryConsult = get_category_by_slug( 'servise_bid' );
    $servisePost = get_post($_POST['service_id']);
    $post_data = array(
        'post_title'    => $servisePost->post_title,
        'post_content'  => "заявка создана: {$validData['name']}, телефон: {$validData['phone']}",
        'post_status'   => 'publish',
        'post_category' => [$categoryConsult->term_id],
    );
    
    // Вставляем пост в базу данных
    $post_id = wp_insert_post( $post_data );

    if($post_id != false){
        echo json_encode([
            'status' => 'ok',
            'message' => 'Заявка отправлена'
        ], JSON_UNESCAPED_UNICODE);
        wp_die();
    }

    echo json_encode([
        'status' => 'error',
        'message' => 'Заявка не отправлена'
    ], JSON_UNESCAPED_UNICODE);
    wp_die();
}
?>