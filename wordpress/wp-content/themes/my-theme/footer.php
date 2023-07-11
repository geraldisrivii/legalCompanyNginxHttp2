<footer>
    <div class="footer-content">
        <div class="logo-side">
            <?= the_custom_logo(  ) ?>
            <a href="<?= home_url(); ?>" class="logo-desctiption">
                <p class="logo-desctiption__top">Правовой Штаб</p>
                <p class="logo-desctiption__bottom">для Бизнеса</p>
            </a>
        </div>
        <div class="nav-side footer-nav-side">
            <nav class="nav-between-pages">
                <ul class="nav-between-pages-list">
                    <li class="nav-between-pages-list__item"><a href="<?= home_url(); ?>"
                                class="nav-between-pages-list__link">Главная</a></li>
                    <?php
                        $page_url = get_permalink( 32 );
                    ?>
                    <li class="nav-between-pages-list__item"><a href="<?= $page_url ?>"
                                class="nav-between-pages-list__link">Услуги</a></li>
                </ul>
            </nav>
            <div class="nav-side__line"></div>
            <nav class="nav-into-current-page">
                <?= get_template_part('footer-ul') ?>
            </nav>

        </div>
    </div>
</footer>
<?= wp_footer() ?>

</body>

</html>