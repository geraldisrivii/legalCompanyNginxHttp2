<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <?= wp_head() ?>
</head>

<body>
    <div class="invisible-site-nav-background">
</div>
<div class="invisible-site-nav">
    <div class="footer-content">
        <div class="logo-side">
            <?= the_custom_logo(  ) ?>
            <div class="logo-desctiption">
                <p class="logo-desctiption__top">Правовой Штаб</p>
                <p class="logo-desctiption__bottom">для Бизнеса</p>
            </div>
        </div>
        <div class="nav-side footer-nav-side">
            <nav class="nav-between-pages">
                <ul class="nav-between-pages-list">
                    <li class="nav-between-pages-list__item"><a href="/"
                            class="nav-between-pages-list__link">Главная</a></li>
                    <li class="nav-between-pages-list__item"><a href="catalog.html"
                            class="nav-between-pages-list__link">Услуги</a></li>
                </ul>
            </nav>
            <div class="nav-side__line"></div>
            <nav class="nav-into-current-page">
                <ul class="nav-into-current-page-list">
                    <li class="nav-into-current-page-list__item"><a href="#!"
                            class="nav-into-current-page-list__link">Преимущества</a></li>
                    <li class="nav-into-current-page-list__item"><a href="#!"
                            class="nav-into-current-page-list__link">Консультация</a></li>
                </ul>
            </nav>

        </div>
    </div>
</div>
<header class="container">
    <div class="logo-side">
    <?= the_custom_logo(  ) ?>
        <div class="logo-desctiption">
            <p class="logo-desctiption__top">Правовой Штаб</p>
            <p class="logo-desctiption__bottom">для Бизнеса</p>
        </div>
    </div>
    <div class="nav-side">
        <nav class="nav-between-pages">
            <ul class="nav-between-pages-list">
                <li class="nav-between-pages-list__item"><a href="/" class="nav-between-pages-list__link">Главная</a></li>
                <li class="nav-between-pages-list__item"><a href="catalog.html" class="nav-between-pages-list__link">Услуги</a></li>
            </ul>
        </nav>
        <div class="nav-side__line"></div>
        <nav class="nav-into-current-page">
            <ul class="nav-into-current-page-list">
                <li class="nav-into-current-page-list__item"><a href="#!" class="nav-into-current-page-list__link">Преимущества</a></li>
                <li class="nav-into-current-page-list__item"><a href="#!" class="nav-into-current-page-list__link button">Консультация</a></li>
            </ul>
        </nav>
    </div>
    <button class="gamburger">
        <div class="gamburger__item"></div>
        <div class="gamburger__item"></div>
        <div class="gamburger__item"></div>
    </button>
</header>