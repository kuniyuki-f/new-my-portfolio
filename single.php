<?php get_header() ?>

<?php
if (have_posts()) :
    while (have_posts()) : the_post();
?>
        <main class="single__main">
            <div class="single__header" style="background-image:url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()) ?>)">
                <?php
                // 現在のページURLを取得してURLエンコード
                $url_encode = urlencode(get_permalink());
                // 現在のページのタイトルを取得してURLエンコード
                $title_encode = urlencode(get_the_title());
                ?>


                <h1 class="single__title">
                    <?php the_title() ?>
                </h1>
                <div class="single__meta">
                    <div class="single__meta-links">
                        <?php
                        $cat = get_the_category();
                        // var_dump($cat);
                        foreach ($cat as $val) :
                            echo '<a href="' . get_category_link($val->cat_ID) . '">' . $val->cat_name . '</a>';
                        endforeach;
                        ?>
                        <?php
                        $tag = get_the_tags();
                        // var_dump($cat);
                        if ($tag) :
                            foreach ($tag as $val) :
                                echo '<a href="' . get_tag_link($val->term_id) . '">' . $val->name . '</a>';
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <time>
                        公開日：<?php echo get_the_time('Y/m/d'); ?>
                        <?php if (get_the_time('Y/m/d') != get_the_modified_date('Y/m/d')) : ?>
                            最終更新日:<?php the_modified_date('Y/m/d') ?>
                        <?php endif; ?>
                    </time>

                </div>
            </div>
            <div class="single__content">
                <?php the_content(); ?>
                <ul class="sns-list">
                    <span>記事をシェアする</span>
                    <li class="sns-twitter">
                        <a class="sns-link" target="_blank" href="<?php echo esc_url('https://twitter.com/share?url=' . $url_encode . '&text=' . $title_encode); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Twitter">
                        </a>
                    </li>
                    <li class="sns-fb">
                        <a class="sns-link" target="_blank" href="<?php echo esc_url('https://www.facebook.com/share.php?u=' . $url_encode); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="Facebook">
                        </a>
                    </li>
                    <li class="sns-line">
                        <a class="sns-link" target="_blank" href="<?php echo esc_url('https://line.me/R/msg/text/?' . $title_encode . '%0A' . $url_encode); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/line.png" alt="LINE">
                        </a>
                    </li>
                    <li class="sns-line">
                        <a class="sns-link" target="_blank" href="<?php echo esc_url('https://getpocket.com/edit?url=' . $url_encode . '&title=' . $title_encode); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/pocket.png" alt="Pocket">
                        </a>
                    </li>
                    <li class="sns-hatena">
                        <a class="sns-link" target="_blank" href="<?php echo esc_url('https://b.hatena.ne.jp/add?mode=confirm&url=' . $url_encode); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/b_hatena.png" alt="はてなブックマーク">
                        </a>
                    </li>
                </ul>
            </div>
        </main>

<?php
    endwhile;
endif;
?>
<div class="single__breadcrumb-wrapper">
    <?php echo breadcrumb(); ?>
</div>

<?php get_footer() ?>