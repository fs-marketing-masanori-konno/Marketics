<?php
/**
 * admin - 管理画面周りのカスタマイズ
 */


function hide_taxonomy_from_menu() {
    global $wp_taxonomies; 
	    // タグの非表示
	    if ( !empty( $wp_taxonomies['post_tag']->object_type ) ) {
	        foreach ( $wp_taxonomies['post_tag']->object_type as $i => $object_type ) {
	            if ( $object_type == 'post' ) {
	                unset( $wp_taxonomies['post_tag']->object_type[$i] );
	            }
	        }
	    }
	    return true;
}
add_action( 'init', 'hide_taxonomy_from_menu' );

/* ============
  カスタム投稿
============ */
// カスタム投稿
function create_post_type() {

  // //ニュース news
  // $newsLabels = array(
  //   'name' => __( 'ニュース', '' ),
  //   'singular_name' => __( 'ニュース', '' ),
  //   'menu_name' => __( 'ニュース', '' ),
  //   'all_items' => __( 'ニュース一覧', '' ),
  //   'add_new' => __( '新規追加', '' ),
  //   'add_new_item' => __( 'ニュースの新規追加', '' ),
  //   'edit_item' => __( 'ニュースを編集', '' ),
  //   'not_found' => __( '見つかりませんでした。', '' ),
  //   'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' ),
  // );
  // $newsArgs = array(
  //   'labels' => $newsLabels,
  //   'description' => '',
  //   'public' => true,
  //   'show_ui' => true,
  //   'show_in_rest' => false,
  //   'rest_base' => '',
  //   'has_archive' => true,
  //   'show_in_menu' => true,
  //   'menu_position' => 5,
  //   'supports' => array( 'title', 'editor', 'thumbnail' )
  // );
  // register_post_type( 'news', $newsArgs );

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
	
	//投稿タグ 'tagcat'
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
		'show_admin_column' => true,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'show_in_quick_edit' => false
	);
	register_taxonomy( 'tagcat', array( 'post' ), $singleTagArgs );

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

 //  //ニュースタクソノミー 'newscat'
	// $newsLabels = array(
	// 	'name' => __( 'ニュースカテゴリ', '' ),
	// 	'singular_name' => __( 'ニュースカテゴリ', '' ),
	// 	'menu_name' => __( 'ニュースカテゴリ', '' ),
	// 	'all_items' => __( 'ニュースカテゴリ', '' ),
	// 	'edit_item' => __( 'ニュースカテゴリを編集', '' ),
	// 	'view_item' => __( 'ニュースカテゴリを表示', '' ),
	// 	'update_item' => __( 'ニュースカテゴリを更新', '' ),
	// 	'add_new_item' => __( 'ニュースカテゴリを追加', '' ),
	// 	'not_found' => __( '見つかりませんでした', '' ),
	// 	'no_terms' => __( 'タームがありません', '' )
	// );
	// $newsArgs = array(
	// 	'labels' => $newsLabels,
	// 	'hierarchical' => true,
	// 	'show_ui' => true,
	// 	'show_in_menu' => true,
	// 	'show_admin_column' => true,
	// 	'public' => true,
	// 	'show_in_rest' => false,
	// 	'show_in_quick_edit' => true
	// );
	// register_taxonomy( 'newscat', 'news', $newsArgs );

 //  //ニュースタグ 'newstag'
	// $newsTagLabels = array(
	// 	'name' => __( 'ニュースタグ', '' ),
	// 	'singular_name' => __( 'ニュースタグ', '' ),
	// 	'menu_name' => __( 'ニュースタグ', '' ),
	// 	'all_items' => __( 'ニュースタグ', '' ),
	// 	'edit_item' => __( 'ニュースタグを編集', '' ),
	// 	'view_item' => __( 'ニュースタグを表示', '' ),
	// 	'update_item' => __( 'ニュースタグを更新', '' ),
	// 	'add_new_item' => __( '新規ニュースタグを追加', '' ),
	// 	'not_found' => __( '見つかりませんでした', '' ),
	// 	'no_terms' => __( 'タームがありません', '' )
	// );
	// $newsTagArgs = array(
	// 	'labels' => $newsTagLabels,
	// 	'hierarchical' => false,
	// 	'show_ui' => true,
	// 	'show_in_menu' => true,
	// 	'show_admin_column' => false,
	// 	'query_var' => true,
	// 	'public' => true,
	// 	'show_in_rest' => false,
	// 	'rest_base' => '',
	// 	'show_in_quick_edit' => false
	// );
	// register_taxonomy( 'newstag', array( 'news' ), $newsTagArgs );
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

?>

