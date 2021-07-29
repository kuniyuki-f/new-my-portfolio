<?php
require_once '../../../wp-load.php';

$offset         = isset($_POST['post_num_now']) ? $_POST['post_num_now'] : 1;
$posts_per_page = isset($_POST['post_num_add']) ? $_POST['post_num_add'] : 0;

$ajax_query = new WP_Query(
    array(
        'post_type'      => 'work',
        'posts_per_page' => $posts_per_page,
        'offset'         => $offset,
    )
);
?>
<?php if ($ajax_query->have_posts()) : ?>
    <?php while ($ajax_query->have_posts()) : ?>
        <?php $ajax_query->the_post(); ?>

        <!-- 一覧のアイテム -->
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
    <?php endwhile; ?>
<?php endif; ?>
<?php
wp_reset_postdata();
?>