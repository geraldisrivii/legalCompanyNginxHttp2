<ul class="nav-into-current-page-list">
    <?php
        global $template;
        $basename = basename($template, '.php');
        if($basename == 'index'){
            ?>
                <li class="nav-into-current-page-list__item"><a href="#index-section-3"
                    class="nav-into-current-page-list__link">Преимущества</a></li>
                <li class="nav-into-current-page-list__item"><a href="#index-section-5"
                    class="nav-into-current-page-list__link">Консультация</a></li>
            <?php
        }
        if($basename == 'catalog'){
            ?>
                <li class="nav-into-current-page-list__item"><a href="#catalog-section-1"
                    class="nav-into-current-page-list__link">Каталог</a></li>
                <li class="nav-into-current-page-list__item"><a href="#catalog-section-2"
                    class="nav-into-current-page-list__link">Консультация</a></li>
            <?php
        }
    ?>
</ul>