<?php get_header() ?>

<main class="page__main page__blog">
    <h2 class="page__blog__title">Blog</h2>

    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
        'posts_per_page' => 6,
        'post_type' => 'post',
        'paged' => $paged,
    );
    $my_posts = new WP_Query($args);
    ?>

    <section class="blog-grid">
        <?php
        if ($my_posts->have_posts()) :
            while ($my_posts->have_posts()) : $my_posts->the_post();
        ?>
                <article class="blog-article">
                    <a class="blog-article__link" href="<?php echo get_the_permalink(); ?>">
                        <div class="blog-article__img">
                            <img class="blog-article__thumb" src="<?php echo get_the_post_thumbnail_url(); ?>">
                        </div>
                        <h3 class="blog-article__title">
                            <?php the_title(); ?>
                        </h3>
                        <div class="blog-article__meta">
                            <time class="blog-article__time">
                                <?php the_time('Y/m/d H:i'); ?>
                            </time>
                            <p class="blog-article__cat">
                                <?php
                                $cat = get_the_category();
                                foreach ($cat as $val) :
                                ?>
                                    <span>
                                        <?php echo $val->cat_name; ?>
                                    </span>
                                <?php endforeach; ?>
                            </p>
                        </div>
                        <p class="blog-article__excerpt">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    </a>
                </article>
        <?php
            endwhile;
        endif;

        ?>

        <?php
        $GLOBALS['wp_query']->max_num_pages = $my_posts->max_num_pages;
        the_posts_pagination(
            array(
                'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
                'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
                'prev_text'     => __('前へ'), // 「前へ」リンクのテキスト
                'next_text'     => __('次へ'), // 「次へ」リンクのテキスト
                'type'          => 'list', // 戻り値の指定 (plain/list)
            )
        );

        wp_reset_postdata();
        ?>

    </section>

    <div class="blog-breadcrumb-wrapper">
        <?php echo breadcrumb(); ?>
    </div>
</main>

<?php get_footer() ?>