<?php

// read stylesheet, javascript
function my_scripts()
{
    //管理画面を除外
    if (!is_admin()) {
        //事前に読み込まれるjQueryを解除
        wp_deregister_script('jquery');

        //Google CDNのjQueryを出力
        wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), NULL, true);
    }


    // wp_enqueue_script('modal-lib', "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js", array(), false, true);
    // wp_enqueue_script('pagination-lib', get_template_directory_uri() . "/js/jquery.pagination.js", array(), false, true);
    // wp_enqueue_script('slick', "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js", array(), false, true);
    // wp_enqueue_script('infinit-scroll', get_template_directory_uri() . '/js/infinit-scroll.js', array(), false, true);
    wp_enqueue_script('mainJS', get_template_directory_uri() . '/js/main.js', array(), false, true);

    // wp_enqueue_style("slick-style", "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css", array(), '1.0.0', 'all');
    // wp_enqueue_style("modal-lib-style", "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css", array(), '1.0.0', 'all');
    // google material icons
    // wp_enqueue_style("google-icons", "https://fonts.googleapis.com/icon?family=Material+Icons", array(), '1.0.0', 'all');
    wp_enqueue_style("google-icons", "https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp", array(), '1.0.0', 'all');
    wp_enqueue_style("style", get_template_directory_uri() . "/css/style.css", array(), '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'my_scripts');


// add customize functions 
function my_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');

    register_nav_menus(array(
        'header-g-nav' => 'グローバルナビゲーション(ヘッダ用)',
        'footer-g-nav' => 'グローバルナビゲーション(フッタ用)',
    ));
}
add_action('after_setup_theme', 'my_setup');


// functions.php
function add_widgets()
{
    // ウィジェットを登録
    register_sidebar(array(
        'id' => 'header-g-nav',
        'name' => 'グローバルメニュー(ヘッダ用)',
    ));
    register_sidebar(array(
        'id' => 'footer-g-nav',
        'name' => 'グローバルメニュー(フッタ用)',
        'before_widget' => '<ul>',
        'after_widget' => '</ul>'
    ));
    register_sidebar(array(
        'id' => 'post-list-widget',
        'name' => '最新記事一覧',
        // 'before_widget' => '<ul>',
        // 'after_widget' => '</ul>'
    ));
}
add_action('widgets_init', 'add_widgets');


function create_post_type()
{
    $Supports = [  // supports のパラメータを設定する配列（初期値だと title と editor のみ投稿画面で使える）
        'title',  // 記事タイトル
        'editor',  // 記事本文
        'excerpt', //抜粋
        'custom-fields',
        'thumbnail',  // アイキャッチ画像
        'revisions'  // リビジョン
    ];
    register_post_type(
        'work',  // カスタム投稿ID
        array(
            'label' => '活動実績',  // カスタム投稿名(管理画面の左メニューに表示されるテキスト)
            'labels' => array(
                'add_new' => '新規実績追加',
                'edit_item' => '実績を編集',
                'view_item' => '実績を表示',
                'search_items' => '実績を検索',
                'not_found' => '実績は見つかりませんでした。',
                'not_found_in_trash' => 'ゴミ箱に実績はありませんでした。'
            ),
            'public' => true,  // 投稿タイプをパブリックにするか否か
            'description' => '実績投稿用の機能です。',
            'hierarchicla' => false, // コンテンツを階層構造にするか否か
            'has_archive' => true,  // アーカイブ(一覧表示)を有効にするか否か
            'show_in_rest' => true,
            'menu_position' => 5,  // 管理画面上でどこに配置するか今回の場合は「投稿」の下に配置
            'supports' => $Supports,  // 投稿画面でどのmoduleを使うか的な設定
            'taxonomies' => array()
        )
    );

    //カスタムタクソノミー（実績カテゴリー：カテゴリー形式）の登録
    register_taxonomy(
        'work_category',   //カスタムタクソノミー名
        'work',   //このタクソノミーが使われる投稿タイプ
        array(
            'label' => '実績カテゴリー',  //カスタムタクソノミーのラベル
            'labels' => array(
                'popular_items' => 'よく使う実績カテゴリー',
                'edit_item' => '実績カテゴリーを編集',
                'add_new_item' => '新規実績カテゴリーを追加',
                'search_items' => '実績カテゴリーを検索'
            ),
            'public' => true,  // 管理画面及びサイト上に公開
            'description' => '実績カテゴリーです。',  //説明文
            'hierarchical' => true,  //カテゴリー形式
            'show_in_rest' => true  //Gutenberg で表示
        )
    );

    //カスタムタクソノミー（実績タグ：タグ形式）の登録
    register_taxonomy(
        'work_tag',   //カスタムタクソノミー名
        'work',  //このタクソノミーが使われる投稿タイプ
        array(
            'label' => '実績タグ', //カスタムタクソノミーのラベル
            'labels' => array(
                'popular_items' => 'よく使う実績タグ',
                'edit_item' => '実績タグを編集',
                'add_new_item' => '新規実績タグを追加',
                'search_items' => '実績タグを検索'
            ),
            'public' => true,  // 管理画面及びサイト上に公開
            'description' => '実績タグです。',  //説明文
            'hierarchical' => false, //タグ形式
            'update_count_callback' => '_update_post_term_count',
            'show_in_rest' => true //Gutenberg で表示
        )
    );
}
add_action('init', 'create_post_type'); // アクションに上記関数をフックします


function my_add_columns($columns)
{
    $columns['work_thumbnail'] = 'サムネイル';
    $columns['work_tag'] = 'タグ';
    $columns['work_category'] =  'カテゴリー';


    // 日付を列の最後に移動
    $date = $columns['date'];
    unset($columns['date']);
    $columns['date'] = $date;

    return $columns;
}
add_filter('manage_edit-work_columns', 'my_add_columns');


function my_add_columns_content($column_name, $post_id)
{
    if ($column_name == 'work_tag') {
        $terms = get_the_terms($post_id, 'work_tag');
        if ($terms && !is_wp_error($terms)) {
            $draught_links = array();
            foreach ($terms as $term) {
                $draught_links[] = $term->name;
            }
            $stitle = join(", ", $draught_links);
        }
    }

    if ($column_name == 'work_category') {
        $terms = get_the_terms($post_id, 'work_category');
        if ($terms && !is_wp_error($terms)) {
            $draught_links = array();
            foreach ($terms as $term) {
                $draught_links[] = $term->name;
            }
            $stitle = join(", ", $draught_links);
        }
    }

    if ($column_name == 'work_thumbnail') {
        $thum = get_the_post_thumbnail($post_id, array(150, 150), "thumbnail");
        echo $thum;
    }

    if (isset($stitle) && $stitle) {
        echo esc_attr($stitle);
    }
}
add_action('manage_work_posts_custom_column', 'my_add_columns_content', 10, 2);

// パンくずリスト
function breadcrumb()
{

    $breadcrumb = '<ul class="breadcrumb">';
    $home = '<li class="breadcrumb__item"><a href="' . get_bloginfo('url') . '" >HOME</a></li>';
    // $blog = get_page_by_path('blog');
    // $blog = '<li class="breadcrumb__item"><a href="' . esc_url(get_permalink($blog->ID)) . '">' . 'ブログ' . '</a></li>';
    $breadcrumb = $breadcrumb . $home;

    if (is_front_page()) {
        // トップページの場合
    } else if (is_category()) {
        // カテゴリページの場合
        $cat = get_queried_object();
        $cat_id = $cat->parent;
        $cat_list = array();
        while ($cat_id != 0) {
            $cat = get_category($cat_id);
            $cat_link = get_category_link($cat_id);
            array_unshift($cat_list, '<li class="breadcrumb__item"><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
            $cat_id = $cat->parent;
        }
        foreach ($cat_list as $value) {
            $breadcrumb = $breadcrumb . $value;
        }
        $breadcrumb = $breadcrumb . '<li class="breadcrumb__item">' . get_the_archive_title() . '</li>';
    } else if (is_archive()) {
        // 月別アーカイブ・タグページの場合
        $breadcrumb = $breadcrumb . '<li class="breadcrumb__item">' . get_the_archive_title() . '</li>';
    } else if (is_single()) {
        // 投稿ページの場合
        // $breadcrumb = $breadcrumb . $blog;
        $cat = get_the_category();
        if (isset($cat[0]->cat_ID)) $cat_id = $cat[0]->cat_ID;
        $cat_list = array();
        while ($cat_id != 0) {
            $cat = get_category($cat_id);
            $cat_link = get_category_link($cat_id);
            array_unshift($cat_list, '<li class="breadcrumb__item"><a href="' . $cat_link . '">' . $cat->name . '</a></li>');
            $cat_id = $cat->parent;
        }
        foreach ($cat_list as $value) {
            $breadcrumb = $breadcrumb . $value;
        }
        $breadcrumb = $breadcrumb . '<li class="breadcrumb__item">' . get_the_title() . '</li>';
    } else if (is_page()) {
        // 固定ページの場合
        $breadcrumb = $breadcrumb . '<li class="breadcrumb__item">' . get_the_title() . '</li>';
    } else if (is_search()) {
        // 検索ページの場合
        $breadcrumb = $breadcrumb . '<li class="breadcrumb__item">「' . get_search_query() . '」の検索結果</li>';
    } else if (is_404()) {
        // 404ページの場合
        $breadcrumb = $breadcrumb . '<li class="breadcrumb__item">ページが見つかりません</li>';
    }
    $breadcrumb = $breadcrumb . "</ul>";
    return $breadcrumb;
}

// アーカイブの余計なタイトルを削除
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_month()) {
        $title = single_month_title('', false);
    }
    return $title;
});

// アーカイブの余計なタイトルを削除(All In One SEO用)
function change_about_page_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_month()) {
        $title = single_month_title('', false);
    }
    return $title;
}
add_filter('aioseo_title', 'change_about_page_title', 100);


add_shortcode('breadcrumb', function () {
    return breadcrumb();
});

function get_front_page_works()
{
    $args = array(
        'post_type' => 'work',
        'posts_per_page' => 3,
    );
    $works = new WP_Query($args);
    $html = '<ul class="front-page-works">';
    $html = $html;
    if ($works->have_posts()) :
        while ($works->have_posts()) : $works->the_post();
            $html = $html . '<li class="front-page-works__item">';
            $html = $html . '<a class="front-page-works__link" href="' . get_field('link') . '">';
            $html = $html
                . '<div class="front-page-works__img">'
                . '<img class="front-page-works__thumb" src="' . get_the_post_thumbnail_url() . '">'
                . '</div>';
            $html = $html . '<h3 class="front-page-works__title">' . get_the_title() . '</h3>';
            $html = $html . '</a></li>';
        endwhile;
    endif;
    $html = $html . '</ul>';
    return $html;
}
add_shortcode('get_front_page_works', 'get_front_page_works');

function get_front_page_posts()
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    );
    $works = new WP_Query($args);
    $html = '<ul class="front-page-posts">';
    $html = $html;
    if ($works->have_posts()) :
        while ($works->have_posts()) : $works->the_post();
            $html = $html . '<li class="front-page-posts__item">';
            $html = $html . '<a class="front-page-posts__link" href="' . get_the_permalink() . '">';
            $html = $html
                . '<div class="front-page-posts__img">'
                . '<img class="front-page-posts__thumb" src="' . get_the_post_thumbnail_url() . '">'
                . '</div>';
            $html = $html . '<h3 class="front-page-posts__title">' . get_the_title() . '</h3>';
            $html = $html . '<div class="front-page-posts__meta">';
            $html = $html . '<time class="front-page-posts__time">' . get_the_modified_time('Y/m/d') . '</time>';
            $cat = get_the_category();
            foreach ($cat as $val) :
                $html = $html . '<span class="front-page-posts__cat">' . $val->cat_name . '</span>';
            endforeach;
            $html = $html . '</div>';
            $html = $html . '<p class="front-page-posts__excerpt">' . get_the_excerpt() . '</p>';
            $html = $html . '</a></li>';
        endwhile;
    endif;
    $html = $html . '</ul>';
    return $html;
}
add_shortcode('get_front_page_posts', 'get_front_page_posts');

// 抜粋に関する設定
function twpp_change_excerpt_length($length)
{
    // 抜粋の最大文字長を50文字に設定
    return 50;
}
add_filter('excerpt_length', 'twpp_change_excerpt_length', 999);

function twpp_change_excerpt_more($more)
{
    // 抜粋の最大文字長を超えるときの文末に付与する文字列を設定
    return '...';
}
add_filter('excerpt_more', 'twpp_change_excerpt_more');

// 投稿のアーカイブページを作成する
// function post_has_archive($args, $post_type)
// {
//     if ('post' == $post_type) {
//         $args['rewrite'] = true; // リライトを有効にする
//         $args['has_archive'] = 'blog'; // 任意のスラッグ名
//     }


//     return $args;
// }
// add_filter('register_post_type_args', 'post_has_archive', 10, 2);


/* URL構造リライト */
// global $wp_rewrite;
// $wp_rewrite->flush_rules();
