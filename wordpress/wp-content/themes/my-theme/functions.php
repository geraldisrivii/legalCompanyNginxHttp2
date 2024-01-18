<?php
add_action('wp_enqueue_scripts', 'add_scripts_and_styles');
add_action('after_setup_theme', 'add_features');
add_theme_support('custom-logo');

add_action('init', 'register_post_types');

function register_post_types()
{
    register_post_type('bid_advice', [
        'label' => null,
        'labels' => [
            'name' => 'Заявка на консультацию',
            // основное название для типа записи
            'singular_name' => 'Заявка на консультацию',
            // название для одной записи этого типа
            'add_new' => 'Добавить новое Заявка на консультацию',
            // для добавления новой записи
            'add_new_item' => 'Добавление Заявка на консультацию',
            // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование Заявка на консультацию',
            // для редактирования типа записи
            'new_item' => 'Новое Заявка на консультацию',
            // текст новой записи
            'view_item' => 'Смотреть Заявка на консультацию',
            // для просмотра записи этого типа.
            'search_items' => 'Искать Заявка на консультацию =',
            // для поиска по этим типам записи
            'not_found' => 'Не найдено',
            // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине',
            // если не было найдено в корзине
            'parent_item_colon' => '',
            // для родителей (у древовидных типов)
            'menu_name' => 'Заявка на консультацию',
            // название меню
        ],
        'description' => '',
        'public' => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => true,
        // показывать ли в меню админки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => false,
        // добавить в REST API. C WP 4.7
        // $post_type. C WP 4.7
        'menu_position' => null,
        'menu_icon' => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => ['title'],
        // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);

    register_post_type('bid_buy', [
        'label' => null,
        'labels' => [
            'name' => 'Заявка на приобритение',
            // основное название для типа записи
            'singular_name' => 'Заявка на приобритение',
            // название для одной записи этого типа
            'add_new' => 'Добавить новое Заявка на приобритение',
            // для добавления новой записи
            'add_new_item' => 'Добавление Заявка на приобритение',
            // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование Заявка на консультацию',
            // для редактирования типа записи
            'new_item' => 'Новое Заявка на приобритение',
            // текст новой записи
            'view_item' => 'Смотреть Заявка на приобритение',
            // для просмотра записи этого типа.
            'search_items' => 'Искать Заявка на приобритение =',
            // для поиска по этим типам записи
            'not_found' => 'Не найдено',
            // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине',
            // если не было найдено в корзине
            'parent_item_colon' => '',
            // для родителей (у древовидных типов)
            'menu_name' => 'Заявка на приобритение',
            // название меню
        ],
        'description' => '',
        'public' => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => true,
        // показывать ли в меню админки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => false,
        // добавить в REST API. C WP 4.7
        // $post_type. C WP 4.7
        'menu_position' => null,
        'menu_icon' => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => ['title'],
        // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => true,
        'query_var' => true,
    ]);
}



function add_scripts_and_styles()
{
    wp_enqueue_script('cookieLib', get_template_directory_uri() . '/assets/js/cookieLib.js', array(), '1.0.0', true);
    wp_enqueue_script('sweetAlert', get_template_directory_uri() . '/assets/js/sweetAlert.js', array(), '1.0.0', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('cookieLib', 'sweetAlert'), '1.0.0', true);
    wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/css/fonts.css');
    wp_enqueue_style('main', get_stylesheet_uri());
}

function add_features()
{
    add_theme_support('post-thumbnails', [
        'post',
    ]);
    add_image_size('servise', '360', '345', true);
}


add_action('admin_post_add_bid_action_index', 'process_custom_form');
add_action('admin_post_nopriv_add_bid_action_index', 'process_custom_form');

add_action('admin_post_add_bid_action_catalog', 'process_custom_form');
add_action('admin_post_nopriv_add_bid_action_catalog', 'process_custom_form');

function process_custom_form()
{
    $regexpArray = json_decode(stripcslashes($_POST['regexp']), true);
    unset($_POST['regexp']);
    unset($_POST['action']);
    require_once get_template_directory() . '/Servises/Validator.php';
    $validator = new Validator($_POST);
    $validator->add_rules($regexpArray);
    $validData = $validator->run();
    // database 

    if (!$validator->is_valid_all()) {
        return do_action('finished_custom_form', 'error');
    }

    $post_data = array(
        'post_title' => $validData['phone'],
        'post_content' => "заявка создана: {$validData['name']}",
        'post_status' => 'publish',
        'post_type' => 'bid_advice',
    );

    $post_id = wp_insert_post($post_data);

    CFS()->save(['name' => $validData['name']], ['ID' => $post_id]);


    if ($post_id != false) {
        return do_action('finished_custom_form', 'ok');
    }
    return do_action('finished_custom_form', 'error');
}

add_action('finished_custom_form', 'finished_custom_form');

function finished_custom_form($status)
{
    setcookie('status', $status, time() + 20, '/');
    return wp_redirect(wp_get_referer() ? wp_get_referer() : home_url());
}





add_action('wp_ajax_add_bid_action_ajax', 'my_ajax_callback');
add_action('wp_ajax_nopriv_add_bid_action_ajax', 'my_ajax_callback');

function my_ajax_callback()
{
    check_ajax_referer('my-ajax-nonce', 'ajax_nonce');

    $stripSlashesRegexp = stripcslashes($_POST['regexp']);
    $FinisedBeforeEncodingRegexp = str_replace('\\', '\\\\', $stripSlashesRegexp);
    $regexpArray = json_decode($FinisedBeforeEncodingRegexp, true, 2, JSON_UNESCAPED_UNICODE);

    require_once get_template_directory() . '/Servises/Validator.php';

    $validator = new Validator($_POST);

    $validator->add_rules($regexpArray);

    $validData = $validator->run();

    if (!($validator->is_valid_all())) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Заявка не отправлена'
        ], JSON_UNESCAPED_UNICODE);
        wp_die();
    }

    $categoryConsult = get_category_by_slug('servise_bid');
    $servisePost = get_post($_POST['service_id']);

    $post_data = array(
        'post_title' => $servisePost->post_title,
        'post_status' => 'publish',
        'post_category' => [$categoryConsult->term_id],
        'post_type' => 'bid_buy',
    );


    $post_id = wp_insert_post($post_data);

    CFS()->save(
        ['name' => $validData['name'], 'phone' => $validData['phone'], 'post' => $servisePost->ID],
        ['ID' => $post_id]
    );

    if ($post_id != false) {
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