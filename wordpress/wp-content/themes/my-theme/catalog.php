<?php
/* 
    Template Name: Каталог
*/
?>
<?= get_header(); ?>

<main>
    <section id="catalog-section-1" class="catalog-section-1 container">
    <div class="header-box catalog-section-1__header-box">
        <h3 class="header-box__title"><span class="header-box__span">Каталог</span> услуг</h3>
        <p class="header-box__text">И получи самые подробные ответы на свои вопросы</p>
    </div>
    <div class="categories-box">
        <?php
            $servsesCategrory = get_category_by_slug( 'servises' );
            $categories = get_categories( [
                'parent' => $servsesCategrory->term_id,
            ] );
            for ($i = count($categories) - 1; $i >= 0; $i--) {
                $category = (object)$categories[$i];
                ?>
                    <div class="category-catalog-box__line"><?= $category->name ?></div>
                    <div class="catalog-box catalog-section-1__catalog-box">
                <?php
                $services = get_posts( [
                    'numberposts' => -1,
                    'category_name' => $category->slug,
                    'post_type' => 'post',
                    'suppress_filter' => true,
                ] );
                wp_reset_postdata();
                foreach ($services as $key => $post) {
                    setup_postdata($post);
                    // echo '<pre>';
                    // var_dump($post);
                    ?>
                        <div class="catalog-item">
                            <!-- catalog-item__image -->
                            <img src="<?= the_post_thumbnail_url('servise') ?>" alt="catalog-item-image" class="catalog-item__image">
                            <div class="catalog-item__description">
                                <p class="catalog-item__title"><?= $post->post_title ?></p>
                                <?= the_content() ?>
                            </div>
                            <button id="<?= $post->ID ?>" class="catalog-item__button button">Заказать</button>
                        </div>
                    <?php
                    wp_reset_postdata();
                }
                ?>
                    </div>
                <?php
            }
        ?>
    </div>
    </section>
        <section id="catalog-section-2" class="catalog-section-2 container">
        <div class="header-box catalog-section-2__header-box header-box_center">
            <h3 class="header-box__title"><span class="header-box__span">Оставь заявку на </span>консультацию</h3>
            <p class="header-box__text">И получи самые подробные ответы на свои вопросы</p>
        </div>
        <form method="post" action="<?= esc_url( admin_url('admin-post.php') ); ?>" class="catalog-section-2__form form-consult">
            <?php
                $regexpArray = [];
                $formFields = CFS()->get('section_2_form_fields');
                foreach ($formFields as $key => $field) {
                    $field = (object)$field;
                    $regexpArray[$field->name] = $field->regexp;
                    ?>
                    <input class="form-consult__input" placeholder="<?= $field->placeholder ?>" type="text" name="<?= $field->name ?>">
                    <?php
                }
            ?>
            <input type="hidden" name="regexp" value='<?= json_encode($regexpArray, JSON_UNESCAPED_UNICODE) ?>'>
            <input type="hidden" name="action" value="add_bid_action_catalog">
            <button type="submit" class="form-consult__button button button_target"><?= CFS()->get('section_2_button') ?></button>
        </form>
    </section>
</main>
<?= get_footer(); ?>
<?= get_template_part('catalog-script'); ?>