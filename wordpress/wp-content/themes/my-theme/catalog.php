<?php
/* 
    Template Name: Каталог
*/
?>
<?= get_header(); ?>

<main>
    <section class="catalog-section-1 container">
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
            foreach ($categories as $key => $category) {
                $category = (object)$category;
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
                            <form action="<?= esc_url(admin_url('admin-ajax.php')); ?>" method="post" class="catalog-item__form">
                                <input type="hidden" name="id" value="<?= $post->ID ?>">
                                <?= wp_nonce_field('my-ajax-nonce', 'ajax_nonce'); ?>
                                <button class="catalog-item__button button">Заказать</button>
                            </form>
                        </div>
                    <?php
                    wp_reset_postdata();
                }
                ?>
                    </div>
                <?php
            }
        ?>
        <!-- <div class="category-catalog-box">
            <div class="category-catalog-box__line">Некая категория - 1</div>
            <div class="catalog-box catalog-section-1__catalog-box">
                <div class="catalog-item">
                    <img src="assets/img/good-1.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
                </div>
                <div class="catalog-item">
                    <img src="assets/img/good-2.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
    
                </div>
                <div class="catalog-item">
                    <img src="assets/img/good-2.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
                </div>
            </div>
        </div>
        <div class="category-catalog-box">
            <div class="category-catalog-box__line">Некая категория - 1</div>
            <div class="catalog-box catalog-section-1__catalog-box">
                <div class="catalog-item">
                    <img src="assets/img/good-1.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
                </div>
                <div class="catalog-item">
                    <img src="assets/img/good-2.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
    
                </div>
                <div class="catalog-item">
                    <img src="assets/img/good-2.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
                </div>
            </div>
        </div>
        <div class="category-catalog-box">
            <div class="category-catalog-box__line">Некая категория - 1</div>
            <div class="catalog-box catalog-section-1__catalog-box">
                <div class="catalog-item">
                    <img src="assets/img/good-1.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
                </div>
                <div class="catalog-item">
                    <img src="assets/img/good-2.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
    
                </div>
                <div class="catalog-item">
                    <img src="assets/img/good-2.webp" alt="catalog-item-image" class="catalog-item__image">
                    <div class="catalog-item__description">
                        <p class="catalog-item__title">Lorem ipsum sit amet</p>
                        <p class="catalog-item__text">Pellentesquet mollis risus a lobortis finibus. Curabitur sit amet accumsan. </p>
                    </div>
                    <a href="!#" class="catalog-item__button button">Заказать</a>
                </div>
            </div>
        </div> -->
    </div>
    </section>
        <section class="catalog-section-2 container">
        <div class="header-box catalog-section-2__header-box header-box_center">
            <h3 class="header-box__title"><span class="header-box__span">Оставь заявку на </span>консультацию</h3>
            <p class="header-box__text">И получи самые подробные ответы на свои вопросы</p>
        </div>
        <form method="post" action="<?= esc_url( admin_url('admin-post.php') ); ?>" class="catalog-section-2__form form-consult">
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
            <input type="hidden" name="action" value="add_bid_action">
            <button type="submit" class="form-consult__button button button_target"><?= CFS()->get('section_5_button') ?></button>
        </form>
    </section>
</main>

<?= get_footer(); ?>
