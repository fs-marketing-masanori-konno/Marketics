<?php
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

/* ============
  ショートコード
============ */
# ショートコード サイトURLを出力：[url]/
function shortcode_url() {
    return get_bloginfo('url');
}
add_shortcode('url', 'shortcode_url');
# ショートコード テンプレートURLを出力：[t_url]/
function shortcode_templateurl() {
    return get_bloginfo('template_directory');
}
add_shortcode('t_url', 'shortcode_templateurl');
# ショートコード インクルード：[myphp file='hoge']
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/inc/$file.php");
    return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');

/* ============
  カスタム投稿
============ */
// カスタム投稿
function create_post_type() {

  //ニュース news
  $newsLabels = array(
    'name' => __( 'ニュース', '' ),
    'singular_name' => __( 'ニュース', '' ),
    'menu_name' => __( 'ニュース', '' ),
    'all_items' => __( 'ニュース一覧', '' ),
    'add_new' => __( '新規追加', '' ),
    'add_new_item' => __( 'ニュースの新規追加', '' ),
    'edit_item' => __( 'ニュースを編集', '' ),
    'not_found' => __( '見つかりませんでした。', '' ),
    'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' ),
  );
  $newsArgs = array(
    'labels' => $newsLabels,
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => false,
    'rest_base' => '',
    'has_archive' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'thumbnail' )
  );
  register_post_type( 'news', $newsArgs );

  //イベントテンプレ eventTemp
  $eventLabels = array(
    'name' => __( 'イベント', '' ),
    'singular_name' => __( 'イベント', '' ),
    'menu_name' => __( 'イベントテンプレ', '' ),
    'all_items' => __( 'イベント一覧', '' ),
    'add_new' => __( '新規追加', '' ),
    'add_new_item' => __( 'イベントの新規追加', '' ),
    'edit_item' => __( 'イベントを編集', '' ),
    'not_found' => __( '見つかりませんでした。', '' ),
    'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' ),
  );
  $eventArgs = array(
    'labels' => $eventLabels,
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => false,
    'rest_base' => '',
    'has_archive' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'thumbnail' )
  );
  register_post_type( 'event', $eventArgs );

    //人物テンプレ personTemp
  $personLabels = array(
    'name' => __( '人物', '' ),
    'singular_name' => __( '人物', '' ),
    'menu_name' => __( '人物テンプレ', '' ),
    'all_items' => __( '人物一覧', '' ),
    'add_new' => __( '新規追加', '' ),
    'add_new_item' => __( '情報の新規追加', '' ),
    'edit_item' => __( '情報を編集', '' ),
    'not_found' => __( '見つかりませんでした。', '' ),
    'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' ),
  );
  $personArgs = array(
    'labels' => $personLabels,
    'description' => '',
    'public' => true,
    'show_ui' => true,
    'show_in_rest' => false,
    'rest_base' => '',
    'has_archive' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'supports' => array( 'title', 'thumbnail' )
  );
  register_post_type( 'personalinfo', $personArgs );
  
}
add_action( 'init', 'create_post_type' );

// カスタムタクソノミー
function create_post_type_taxes() {
  //広告タクソノミー 'adcat'
	$adLabels = array(
		'name' => __( '広告カテゴリ', '' ),
		'singular_name' => __( '広告カテゴリ', '' ),
		'menu_name' => __( '広告カテゴリ', '' ),
		'all_items' => __( '広告カテゴリ', '' ),
		'edit_item' => __( '広告カテゴリを編集', '' ),
		'view_item' => __( '広告カテゴリを表示', '' ),
		'update_item' => __( '広告カテゴリを更新', '' ),
		'add_new_item' => __( '広告カテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$adArgs = array(
		'labels' => $adLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'public' => true,
		'show_in_rest' => false,
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'adcat', 'post', $adArgs );

  //登壇者タクソノミー 'speakercat'
	$speakerLabels = array(
		'name' => __( 'スピーカーカテゴリ', '' ),
		'singular_name' => __( 'スピーカーカテゴリ', '' ),
		'menu_name' => __( 'スピーカーカテゴリ', '' ),
		'all_items' => __( 'スピーカーカテゴリ', '' ),
		'edit_item' => __( 'スピーカーカテゴリを編集', '' ),
		'view_item' => __( 'スピーカーカテゴリを表示', '' ),
		'update_item' => __( 'スピーカーカテゴリを更新', '' ),
		'add_new_item' => __( 'スピーカーカテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$speakerArgs = array(
		'labels' => $speakerLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'public' => true,
		'show_in_rest' => false,
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'personalcat', 'personalinfo', $speakerArgs );

	//投稿タグ 'singletag'
	$singleTagLabels = array(
		'name' => __( '投稿タグ', '' ),
		'singular_name' => __( '投稿タグ', '' ),
		'menu_name' => __( '投稿タグ', '' ),
		'all_items' => __( '投稿タグ', '' ),
		'edit_item' => __( '投稿タグを編集', '' ),
		'view_item' => __( '投稿タグを表示', '' ),
		'update_item' => __( '投稿タグを更新', '' ),
		'add_new_item' => __( '新規投稿タグを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$singleTagArgs = array(
		'labels' => $singleTagLabels,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'rewrite' => array( 'slug' => 'about-ma/tagcat' ),
		'show_in_quick_edit' => false
	);
	register_taxonomy( 'singletag', array( 'post' ), $singleTagArgs );

  //ニュースタクソノミー 'newscat'
	$newsLabels = array(
		'name' => __( 'ニュースカテゴリ', '' ),
		'singular_name' => __( 'ニュースカテゴリ', '' ),
		'menu_name' => __( 'ニュースカテゴリ', '' ),
		'all_items' => __( 'ニュースカテゴリ', '' ),
		'edit_item' => __( 'ニュースカテゴリを編集', '' ),
		'view_item' => __( 'ニュースカテゴリを表示', '' ),
		'update_item' => __( 'ニュースカテゴリを更新', '' ),
		'add_new_item' => __( 'ニュースカテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$newsArgs = array(
		'labels' => $newsLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'public' => true,
		'show_in_rest' => false,
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'newscat', 'news', $newsArgs );

  //ニュースタグ 'newstag'
	$newsTagLabels = array(
		'name' => __( 'ニュースタグ', '' ),
		'singular_name' => __( 'ニュースタグ', '' ),
		'menu_name' => __( 'ニュースタグ', '' ),
		'all_items' => __( 'ニュースタグ', '' ),
		'edit_item' => __( 'ニュースタグを編集', '' ),
		'view_item' => __( 'ニュースタグを表示', '' ),
		'update_item' => __( 'ニュースタグを更新', '' ),
		'add_new_item' => __( '新規ニュースタグを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$newsTagArgs = array(
		'labels' => $newsTagLabels,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => false,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'show_in_quick_edit' => false
	);
	register_taxonomy( 'newstag', array( 'news' ), $newsTagArgs );
}
add_action( 'init', 'create_post_type_taxes' );


# TinyMCEにエディタースタイルを適応
add_editor_style("editor-style.css");

# TinyMCEにclassを追加
function custom_editor_settings( $initArray ){
	global $typenow;

	if ( $typenow == 'case') {
		$initArray['body_class'] = 'l-article case-article-content';
	} elseif ( $typenow == 'news') {
		$initArray['body_class'] = 'l-article news-article-content';
	} elseif ( $typenow == 'blog') {
		$initArray['body_class'] = 'l-article blog-article-content';
	}
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

# TinyMCEから不要な要素を削除
function my_tiny_mce_before_init( $ar ) {
	$ar['block_formats'] = '段落=p;見出し2=h2;見出し3=h3;見出し4=h4;見出し5=h5;見出し6=h6;';
	return $ar;
}
add_filter( 'tiny_mce_before_init', 'my_tiny_mce_before_init' );

# TinyMCEに独自スタイルを追加
if ( !function_exists( 'initialize_tinymce_styles' ) ):
function initialize_tinymce_styles($init_array) {
	//追加するスタイルの配列を作成
	$style_formats = array(
//		array(
//		'title' => '導入事例-クエスチョン',
//		'block' => 'div',
//		'classes' => 'text-question'
//	),
		array(
		'title' => 'ブロック-青',
		'block' => 'div',
		'classes' => 'box-blue'
	),
	);
	//JSONに変換
	$init_array['style_formats'] = json_encode($style_formats);
	return $init_array;
}
endif;
add_filter('tiny_mce_before_init', 'initialize_tinymce_styles', 10000);

//自動整形の実行順を変更
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop', 99 );
add_filter( 'the_content', 'shortcode_unautop', 100 );

// /* ============
//   メディア設定　画像サイズを新たに追加
// ============ */
// add_image_size( 'size700x466', 700 , 466, false );
// add_image_size( 'size700x394', 700 , 394, false );
// add_image_size( 'size700x350', 700 , 350, false );

/* ============
  広告カテゴリーを複数選択から単一選択に変更
============ */
function change_category_to_radio() {
?>
<script>
jQuery(function($) {
    // カテゴリーをラジオボタンに変更
    $('#adcatchecklist input[type=checkbox]').each(function() {
        $(this).replaceWith($(this).clone().attr('type', 'radio'));
    });
    // 「新規カテゴリーを追加」を非表示
    //$('.adcat-checklist').hide();
    $('.adcat-checklist input[type=checkbox]').each(function() {
        $(this).replaceWith($(this).clone().attr('type', 'radio'));
    });
    // 「新規カテゴリーを追加」を非表示
    $('#adcat-adder').hide();
    // 「よく使うもの」を非表示
    $('#adcat-tabs').hide();
});
</script>
<?php
}
add_action( 'admin_head-post-new.php', 'change_category_to_radio' );
add_action( 'admin_head-post.php', 'change_category_to_radio' );
add_action( 'admin_print_footer_scripts', 'change_category_to_radio');

/* ============
  ページネーション
============ */
function the_pagination($my_query) {
	// global $wp_query;
	$big = 99999999;
	$page_format = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		// 'format' => '?paged=%#%',
		'total' => $my_query->max_num_pages,
		'current' => max( 1, get_query_var('paged') ),
		'prev_next' => False,
		'prev_text' => __('PREV'),
		'next_text' => __('NEXT'),
		'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		// echo '<div><span>'. $paged . ' of ' . $my_query->max_num_pages .'</span></div>';
		echo '<div class="pagination"><ul class="pagination-list">';
		foreach ( $page_format as $page ) {
			echo '<li class="pagination-item">'. $page . '</li>';
		}
		echo '</ul></div>';
	}
	wp_reset_query();
}
