<?php

/* 
    Template Name: Главная
*/

?>


<?= get_header(); ?>
<main>
        <style>
            .index-section-1{
                background: url('<?= CFS()->get('section_1_background') ?>') no-repeat center / cover;
                @media screen and (max-width: 450px){
                    background: url('<?= CFS()->get('section_1_background_mobile') ?>') no-repeat center / cover;
                }
            }
        </style>
    <section id="index-section-1" class="index-section-1">
    <div class="index-section-1__rectangle"></div>
    <div class="index-section-1__container container">
        <div class="index-section-1-content">
            <h1 class="index-section-1-content__title"><?= CFS()->get('section_1_main_title') ?></h1>
            <h2 class="index-section-1-content__span"><?= CFS()->get('section_1_sub_title') ?></h2>
            <div class="index-section-1-content-description">
                <div class="index-section-1-content-description__line"></div>
                <p class="index-section-1-content-description__text"><?= CFS()->get('section_1_text') ?></p>
            </div>
        </div>
    </div>
    </section>
    <section id="index-section-2" class="index-section-2 container">
    <div class="header-box index-section-2__header-box">
        <h3 class="header-box__title"><?= CFS()->get('section_2_main_title') ?> <span class="header-box__span"><?= CFS()->get('section_2_main_title_span') ?></span></h3>
        <p class="header-box__text"><?= CFS()->get('section_2_sub_title') ?></p>
    </div>
    <div class="diginity-way-box">
        <?php
            $WayCards = CFS()->get('section_2_cards');
            foreach ($WayCards as $card) {
                $card = (object)$card;
                ?>
                    <div class="diginity-way diginity-way-box__item">
                        <img src="<?= $card->icon ?>" class="diginity-way__image" alt="icon-diginity-way">
                        <div class="diginity-way-description">
                            <h4 class="diginity-way-description__title"><?= $card->title ?></h4>
                            <p class="diginity-way-description__text"><?= $card->text ?></p>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
    </section>
    <section id="index-section-3" class="index-section-3 container">
    <div class="header-box index-section-3__header-box">
        <h3 class="header-box__title"><?= CFS()->get('section_3_main_title') ?> <span class="header-box__span"><?= CFS()->get('section_3_main_title_span') ?></span></h3>
        <p class="header-box__text"><?= CFS()->get('section_3_sub_title') ?></p>
    </div>
    <div class="diginity-box index-section-3-diginity-box">
        <?php
            $CompanyCards = CFS()->get('section_3_cards');
            foreach ($CompanyCards as $key => $card) {
                $card = (object)$card;
                ?>
                    <div class="diginity <?= $key % 2 == 0 ? '' : 'diginity_reverse' ?>">
                        <div class="diginity-description">
                            <p class="diginity-description__title"><?= $card->title ?></p>
                            <p class="diginity-description__text"><?= $card->text ?></p>
                        </div>
                        <img class="diginity__image" 
                        src="<?= $card->image ?>" srcset="<?= $card->mobile_image ?> 400w, <?= $card->image ?> 580w" 
                        sizes="(max-width: 450px) 100vw, 50vw"
                        alt="">
                    </div>
                <?php
            }
        ?>
    </div>
    </section>
    <section id="index-section-4" class="index-section-4 container">
        <div class="header-box index-section-4__header-box">
            <h3 class="header-box__title"><span class="header-box__span">Каталог</span> услуг</h3>
            <p class="header-box__text">И получи самые подробные ответы на свои вопросы</p>
        </div>
        <div class="catalog-box index-section-4__catalog-box">
            <?php
                $servsesCategrory = get_category_by_slug( 'servises' );
                $categories = get_categories( [
                    'parent' => $servsesCategrory->term_id,
                    'number' => 1,
                ] );
                $category = (object)$categories[0];
                $services = get_posts( [
                    'numberposts' => -1,
                    'category_name' => $category->slug,
                    'post_type' => 'post',
                    'suppress_filter' => true,
                ] );
                wp_reset_postdata();
                foreach ($services as $key => $post) {
                    if($key > 1){
                        break;
                    }
                    setup_postdata($post);
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
            <div class="more-catalog-box">
                <a href="<?= get_permalink( 32 ); ?>" class="more-catalog-box__link">Подробнее <img src="<?= CFS()->get('arrow_icon') ?>" alt="arrow"></a>
            </div>
        </div>
    </section>
    <section id="index-section-5" class="index-section-5 container">
        <div class="header-box index-section-5__header-box header-box_center">
            <h3 class="header-box__title"><span class="header-box__span"><?= CFS()->get('section_5_main_title_span') ?></span> <?= CFS()->get('section_5_main_title') ?></h3>
            <p class="header-box__text"><?= CFS()->get('section_5_sub_title') ?></p>
        </div>
        <form method="post" action="<?= esc_url( admin_url('admin-post.php') ); ?>" class="index-section-5__form form-consult">
            <?php
                $regexpArray = [];
                $formFields = CFS()->get('section_5_form_fields');
                foreach ($formFields as $key => $field) {
                    $field = (object)$field;
                    $regexpArray[$field->name] = $field->regexp;
                    ?>
                    <input class="form-consult__input" placeholder="<?= $field->placeholder ?>" type="text" name="<?= $field->name ?>">
                    <?php
                }
            ?>
            <input type="hidden" name="regexp" value='<?= json_encode($regexpArray, JSON_UNESCAPED_UNICODE) ?>'>
            <input type="hidden" name="action" value="add_bid_action_index">
            <button type="submit" class="form-consult__button button button_target"><?= CFS()->get('section_5_button') ?></button>
        </form>
    </section>
</main>
<?= get_footer(); ?>

<?= get_template_part('catalog-script'); ?>
