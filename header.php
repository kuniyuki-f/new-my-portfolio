<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open();  ?>


    <div class="loading-box">
        <div class="cat">
            <div class="cat__body"></div>
            <div class="cat__body"></div>
            <div class="cat__tail"></div>
            <div class="cat__head"></div>
        </div>
    </div>


    <header>
        <?php
        if (is_home() || is_front_page()) :
        ?>
            <h1 class="header__site-title"><?php the_custom_logo(); ?></h1>
        <?php else : ?>
            <div><?php the_custom_logo(); ?></div>
        <?php endif; ?>

        <nav class="header__navigation">
            <?php if (is_active_sidebar('header-g-nav')) : ?>
                <ul class="header-menu">
                    <?php dynamic_sidebar('header-g-nav'); ?>
                </ul>
                <!-- <button class="hamburger__btn">
                    <i class="material-icons">
                        menu
                    </i>
                </button>
                <div class="hamburger__menu">
                    <?php dynamic_sidebar('global-menu-header'); ?>
                </div> -->
            <?php else : ?>
                <span>global-menu-widget is not found.</span>
            <?php endif; ?>
        </nav>
    </header>