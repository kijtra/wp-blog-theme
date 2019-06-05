<?php
add_action('after_setup_theme', function () {
    /**
     * 概要文の使用
     */
    add_post_type_support('page', 'excerpt');

    // 投稿とコメントのRSSフィードリンクをヘッダに出力するかどうか
    // add_theme_support( 'automatic-feed-links' );

    /**
     * Gutembergの無効化
     */
    // add_filter('use_block_editor_for_post', '__return_false');

    /**
     * GutembergのCSS無効化
     */
    // add_action('wp_enqueue_scripts', function () {
    //     wp_dequeue_style('wp-block-library');
    //     wp_dequeue_style('wp-block-library-theme');
    // }, 999);

    /**
     * Gutembergのアセット適用
     */
    add_action('enqueue_block_editor_assets', function () {
        wp_enqueue_style('theme-editor-style', mix('style-editor.css'));
    });

    /**
     * Pタグの自動挿入を無効化
     */
    remove_filter('the_content', 'wpautop');

    /**
     * コメントフィードのみ無効化
     */
    remove_action('wp_head', 'feed_links', 2);
    add_action('wp_head', function() {
      printf('<link rel="alternate" type="application/rss+xml" title="%s" href="%s">%s', get_bloginfo('name'), get_bloginfo('rss2_url'), "\n");
    });

    /**
     * フィード自体を無効化
     */
    // remove_theme_support('automatic-feed-links');

    /**
     * XML-RPC機能の無効化
     */
    add_filter('xmlrpc_enabled', '__return_false');

    /**
     * 自己ピンバックの無効化
     */
    add_action('pre_ping', function (&$links) {
        foreach ($links as $l => $link) {
            if (0 === strpos($link, get_option('home'))) {
                unset($links[$l]);
            }
        }
    });

    /**
     * meta name="generator" を削除
     * ※WordPressのバージョン確認機能
     */
    remove_action('wp_head', 'wp_generator');

    /**
     * link rel="wlwmanifest" を削除
     * ※Windows Live Writer用の機能
     */
    remove_action('wp_head', 'wlwmanifest_link');

    /**
     * RSDリンク（link rel="EditURI"）を削除
     * ※外部の投稿ツールからの編集機能
     */
    remove_action('wp_head', 'rsd_link');

    /**
     * link rel="shortlink" を削除
     * ※短縮URLの機能
     */
    remove_action('wp_head', 'wp_shortlink_wp_head');

    /**
     * 絵文字関連のタグを削除
     */
    add_filter('emoji_svg_url', '__return_false');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');

    /**
     * oEmbed関連のタグを削除
     */
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');

    // TinyMCE側の設定
    add_filter('tiny_mce_before_init', function ($in) {
        $in['indent'] = true; //インデントを有効に
        // $in['remove_linebreaks'] = false;
        $in['verify_html'] = false;
        // $in['wpautop'] = false; //テキストやインライン要素を自動的にpタグで囲む機能を無効に
        // $in['force_p_newlines'] = false; //改行したらpタグを挿入する機能を無効に
        return $in;
    });

    // SVGファイルのアップロード許可
    // add_action('upload_mimes', function ($mimes) {
    //   $mimes['svg'] = 'image/svg+xml';
    //   return $mimes;
    // });

    /*
    　* タイトルタグの自動出力
    　*/
    add_theme_support('title-tag');

    /*
    　* サムネイル
    　*
    　* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    　*/
    add_theme_support('post-thumbnails');

    /*
     * 検索やコメント等の部分をHTML5の形式で出力
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Enqueue editor styles.
    add_editor_style('style-editor.css');

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    add_filter('wp_resource_hints', function ($hints, $relation_type) {
        if (!is_admin()) {
            if ('dns-prefetch' === $relation_type) {
                $hints[] = '//ajax.googleapis.com';
                $hints[] = '//fonts.gstatic.com';
                // $hints[] = '//cdn.materialdesignicons.com';
                $hints[] = '//connect.facebook.net';
                $hints[] = '//platform.twitter.com';
            }
        }
        return $hints;
    }, 10, 2);

    // メディアファイル名を urlencode する
    add_filter('sanitize_file_name', function ($fileName) {
        return rawurlencode($fileName);
    }, 10);

    /**
     * カスタムテーマのロゴ対応
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 89,
            'width' => 85,
            'flex-width' => true,
            'flex-height' => true,
        )
    );

    /*
    　* カスタム画像サイズ
    　*
    　* @link https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_image_size
    　*/
    // add_image_size('hero', 1980, 1080, true);
});
