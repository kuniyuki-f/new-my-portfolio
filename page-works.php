<?php get_header() ?>


<main class="page__main">
    <?php
    // 固定ページ「制作実績」の中身を出力する
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
            <div class="works-page__content">
                <?php the_content(); ?>
            </div>
    <?php
        endwhile;
    endif;
    ?>

    <div class="entry-items">
        <?php
        $args = array(
            'post_type' => 'work',
            'posts_per_page' => 0,
        );
        $the_query = new WP_Query($args);
        ?>

        <?php
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post();
        ?>
                <article class="works-article">
                    <div class="works-article__inner">
                        <a href="<?php echo get_field("link"); ?>">
                            <div class="works-article__img">
                                <img class="works-article__thumb" src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                            </div>
                            <h3 class="works-article__title">
                                <?php the_title(); ?>
                            </h3>
                            <p class="works-article__description">
                                <?php
                                echo get_field("description");
                                ?>
                            </p>
                        </a>
                    </div>
                </article>

        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <!-- <div class="entry-loading">
        <img src="<?php echo get_template_directory_uri() . '/images/loading.gif'; ?>">
    </div> -->

    <div class="works-breadcrumb-wrapper">
        <?php echo breadcrumb(); ?>
    </div>

</main>

<?php get_footer() ?>