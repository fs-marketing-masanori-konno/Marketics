<?php
/**
 * init - 初期化
 */

//テーマのセットアップ
// HTML5でマークアップさせる
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
// Feedのリンクを自動で生成する
add_theme_support( 'automatic-feed-links' );
//アイキャッチ画像を使用する設定
add_theme_support( 'post-thumbnails' );

/* ============
  wp_head()
============ */
//コメントのフィードなどを削除
remove_action('wp_head', '_wp_render_title_tag', 1);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

//ブログ投稿ツールのためのタグを削除
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

//rel="prev"とrel="next"を削除
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

//WordPressのバージョンを削除
remove_action('wp_head', 'wp_generator');

//4.2以降で追加された絵文字対応のスクリプトを無効化
function disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emoji' );

?>
