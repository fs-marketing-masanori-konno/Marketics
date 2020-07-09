<?php
/**
 * admin - 管理画面周りのカスタマイズ
 */

/*** リセット ***/

# 固定ページではビジュアルエディタでの編集を無効
function disable_visual_editor_in_page(){
	global $typenow;
	if( $typenow == 'page' ){
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
}
function disable_visual_editor_filter(){
	return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );

# サイドバーから不要な項目を削除
function remove_menus () {
	remove_menu_page( 'edit.php' ); // 投稿
	remove_menu_page( 'edit-comments.php' ); // コメント
}
add_action('admin_menu', 'remove_menus');

# 管理バーから項目を削除
function remove_bar_menus( $wp_admin_bar ) {
	$wp_admin_bar->remove_menu( 'menus' ); // サイト名 -> メニュー
	$wp_admin_bar->remove_menu( 'widgets' ); // サイト名 -> ウィジェット
	$wp_admin_bar->remove_menu( 'customize' ); // サイト名 -> カスタマイズ (公開側)
	$wp_admin_bar->remove_menu( 'comments' ); // コメント
	$wp_admin_bar->remove_menu( 'new-user' ); // 新規 -> ユーザー
	$wp_admin_bar->remove_menu( 'search' ); // 検索 (公開側)
}
add_action('admin_bar_menu', 'remove_bar_menus', 201);

# 「WordPress のご利用ありがとうございます。」を非表示
function custom_admin_footer() {}
add_filter('admin_footer_text', 'custom_admin_footer');

# 本体アップデート通知を非表示
add_filter('pre_site_transient_update_core', create_function('$a', "return  null;"));

# プラグイン更新通知を非表示
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', create_function( '$a', "return null;" ));

# 管理バー周りのCSSを調整
function mytheme_admin_bar_callback() {
	if ( is_user_logged_in() && is_admin_bar_showing() ) {
		echo '<style type="text/css">
		html { padding-top: 0 !important; margin-top: 0 !important; }
		* html body { margin-top: 0 !important; }
		.header { top: 0; }
		.header.is-hidden { // top: 0!important; }
		@media screen and (max-width: 782px) {
			html { margin-top: 0!important; }
			.header { top: 0; }
			#wpadminbar { display: none; }
		}
		</style>';
	}
}
add_action( 'wp_head', 'mytheme_admin_bar_callback', 20);


# カスタム投稿
function create_post_type() {

	// 新着情報 news
	$newsLabels = array(
		'name' => __( '新着情報', '' ),
		'singular_name' => __( '新着情報', '' ),
		'menu_name' => __( '新着情報', '' ),
		'all_items' => __( '新着情報一覧', '' ),
		'add_new' => __( '新規追加', '' ),
		'add_new_item' => __( '新着情報の新規追加', '' ),
		'edit_item' => __( '新着情報を編集', '' ),
		'not_found' => __( '見つかりませんでした。', '' ),
		'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' ),
	);
	$newsArgs = array(
		'labels' => $newsLabels,
		'description' => '',
		'public' => true,
		// 'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'has_archive' => true,
		'show_in_menu' => true,
		// 'exclude_from_search' => false,
		// 'map_meta_cap' => true,
		// 'hierarchical' => false,
		// 'query_var' => true,
		'menu_position' => 5,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'news', $newsArgs );

	// 導入事例 case
	$caseLabels = array(
		'name' => __( '導入事例', '' ),
		'singular_name' => __( '導入事例', '' ),
		'menu_name' => __( '導入事例', '' ),
		'all_items' => __( '導入事例一覧', '' ),
		'add_new' => __( '新規追加', '' ),
		'add_new_item' => __( '導入事例の新規追加', '' ),
		'edit_item' => __( '導入事例を編集', '' ),
		'not_found' => __( '見つかりませんでした。', '' ),
		'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' )
	);
	$caseArgs = array(
		'labels' => $caseLabels,
		'description' => '',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'has_archive' => true,
		'show_in_menu' => true,
		'exclude_from_search' => false,
		'map_meta_cap' => true,
		'hierarchical' => false,
		'query_var' => true,
		'menu_position' => 6,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'case', $caseArgs );

	// セミナー seminar
	$seminarLabels = array(
		'name' => __( 'セミナー', '' ),
		'singular_name' => __( 'セミナー', '' ),
		'menu_name' => __( 'セミナー', '' ),
		'all_items' => __( 'セミナー一覧', '' ),
		'add_new' => __( '新規追加', '' ),
		'add_new_item' => __( 'セミナーの新規追加', '' ),
		'edit_item' => __( 'セミナーを編集', '' ),
		'not_found' => __( '見つかりませんでした。', '' ),
		'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' )
	);
	$seminarArgs = array(
		'labels' => $seminarLabels,
		'description' => '',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'has_archive' => true,
		'show_in_menu' => true,
		'exclude_from_search' => false,
		'map_meta_cap' => true,
		'hierarchical' => false,
		'query_var' => true,
		'menu_position' => 7,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
	register_post_type( 'seminar', $seminarArgs );

	// ブログ blog
	$seminarLabels = array(
		'name' => __( 'ブログ', '' ),
		'singular_name' => __( 'ブログ', '' ),
		'menu_name' => __( 'ブログ', '' ),
		'all_items' => __( 'ブログ一覧', '' ),
		'add_new' => __( '新規追加', '' ),
		'add_new_item' => __( 'ブログの新規追加', '' ),
		'edit_item' => __( 'ブログを編集', '' ),
		'not_found' => __( '見つかりませんでした。', '' ),
		'not_found_in_trash' => __( 'ゴミ箱内に見つかりませんでした。', '' )
	);
	$seminarArgs = array(
		'labels' => $seminarLabels,
		'description' => '',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'has_archive' => true,
		'show_in_menu' => true,
		'exclude_from_search' => false,
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'about-ma/blog' ),
		'query_var' => true,
		'menu_position' => 8,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'yarpp_support' => true // Yet Another Related Posts Pluginの対象にする
	);
	register_post_type( 'blog', $seminarArgs );

}
add_action( 'init', 'create_post_type' );

# カスタムタクソノミー
function create_post_type_taxes() {

	// 新着情報タクソノミー 'newscat'
	$newsLabels = array(
		'name' => __( '新着情報カテゴリ', '' ),
		'singular_name' => __( '新着情報カテゴリ', '' ),
		'menu_name' => __( '新着情報カテゴリ', '' ),
		'all_items' => __( '新着情報カテゴリ', '' ),
		'edit_item' => __( '新着情報カテゴリを編集', '' ),
		'view_item' => __( '新着情報カテゴリを表示', '' ),
		'update_item' => __( '新着情報カテゴリを更新', '' ),
		'add_new_item' => __( '新規新着情報カテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$newsArgs = array(
		'labels' => $newsLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		//'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		//'rest_base' => '',
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'newscat', 'news', $newsArgs );

	// 導入事例タクソノミー 'case_function'
	$caseFunctionLabels = array(
		'name' => __( '機能カテゴリ', '' ),
		'singular_name' => __( '機能カテゴリ', '' ),
		'menu_name' => __( '機能カテゴリ', '' ),
		'all_items' => __( '機能カテゴリ', '' ),
		'edit_item' => __( '機能カテゴリを編集', '' ),
		'view_item' => __( '機能カテゴリを表示', '' ),
		'update_item' => __( '機能カテゴリを更新', '' ),
		'add_new_item' => __( '新規機能カテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$caseFunctionArgs = array(
		'labels' => $caseFunctionLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'case_function', array( 'case' ), $caseFunctionArgs );

	// 導入事例タクソノミー 'case_theme'
	$caseThemeLabels = array(
		'name' => __( 'テーマカテゴリ', '' ),
		'singular_name' => __( 'テーマカテゴリ', '' ),
		'menu_name' => __( 'テーマカテゴリ', '' ),
		'all_items' => __( 'テーマカテゴリ', '' ),
		'edit_item' => __( 'テーマカテゴリを編集', '' ),
		'view_item' => __( 'テーマカテゴリを表示', '' ),
		'update_item' => __( 'テーマカテゴリを更新', '' ),
		'add_new_item' => __( '新規テーマカテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$caseThemeArgs = array(
		'labels' => $caseThemeLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'case_theme', array( 'case' ), $caseThemeArgs );

	// 導入事例タクソノミー 'case_industry'
	$caseIndustryLabels = array(
		'name' => __( '業界カテゴリ', '' ),
		'singular_name' => __( '業界カテゴリ', '' ),
		'menu_name' => __( '業界カテゴリ', '' ),
		'all_items' => __( '業界カテゴリ', '' ),
		'edit_item' => __( '業界カテゴリを編集', '' ),
		'view_item' => __( '業界カテゴリを表示', '' ),
		'update_item' => __( '業界カテゴリを更新', '' ),
		'add_new_item' => __( '新規業界カテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$caseIndustryArgs = array(
		'labels' => $caseIndustryLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'case_industry', array( 'case' ), $caseIndustryArgs );

	// 導入企業タクソノミー 'case_tag'
//	$caseTagLabels = array(
//		'name' => __( '導入事例タグ', '' ),
//		'singular_name' => __( '導入事例タグ', '' ),
//		'menu_name' => __( '導入事例タグ', '' ),
//		'all_items' => __( '導入事例タグ', '' ),
//		'edit_item' => __( '導入事例タグを編集', '' ),
//		'view_item' => __( '導入事例タグを表示', '' ),
//		'update_item' => __( '導入事例タグを更新', '' ),
//		'add_new_item' => __( '新規導入事例タグを追加', '' ),
//		'not_found' => __( '見つかりませんでした', '' ),
//		'no_terms' => __( 'タームがありません', '' )
//	);
//	$caseTagArgs = array(
//		'labels' => $caseTagLabels,
//		'hierarchical' => false,
//		'show_ui' => true,
//		'show_in_menu' => true,
//		'show_admin_column' => false,
//		'query_var' => true,
//		'public' => true,
//		'show_in_rest' => false,
//		'rest_base' => '',
//		'show_in_quick_edit' => false
//	);
//	register_taxonomy( 'case_tag', array( 'case' ), $caseTagArgs );

	// ブログタクソノミー 'blogcat'
	$blogLabels = array(
		'name' => __( 'ブログカテゴリ', '' ),
		'singular_name' => __( 'ブログカテゴリ', '' ),
		'menu_name' => __( 'ブログカテゴリ', '' ),
		'all_items' => __( 'ブログカテゴリ', '' ),
		'edit_item' => __( 'ブログカテゴリを編集', '' ),
		'view_item' => __( 'ブログカテゴリを表示', '' ),
		'update_item' => __( 'ブログカテゴリを更新', '' ),
		'add_new_item' => __( '新規ブログカテゴリを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$blogArgs = array(
		'labels' => $blogLabels,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'public' => true,
		'show_in_rest' => false,
		'rest_base' => '',
		'rewrite' => array( 'slug' => 'about-ma/blogcat' ),
		'show_in_quick_edit' => true
	);
	register_taxonomy( 'blogcat', array( 'blog' ), $blogArgs );

	// ブログタクソノミー 'specialcat'
//	$blogSpecialLabels = array(
//		'name' => __( '特別枠カテゴリ', '' ),
//		'singular_name' => __( '特別枠カテゴリ', '' ),
//		'menu_name' => __( '特別枠カテゴリ', '' ),
//		'all_items' => __( '特別枠カテゴリ', '' ),
//		'edit_item' => __( '特別枠カテゴリを編集', '' ),
//		'view_item' => __( '特別枠カテゴリを表示', '' ),
//		'update_item' => __( '特別枠カテゴリを更新', '' ),
//		'add_new_item' => __( '新規特別枠カテゴリを追加', '' ),
//		'not_found' => __( '見つかりませんでした', '' ),
//		'no_terms' => __( 'タームがありません', '' )
//	);
//	$blogSpecialArgs = array(
//		'labels' => $blogSpecialLabels,
//		'hierarchical' => true,
//		'show_ui' => true,
//		'show_in_menu' => true,
//		'show_admin_column' => false,
//		'query_var' => true,
//		'public' => true,
//		'show_in_rest' => false,
//		'rest_base' => '',
//		'show_in_quick_edit' => true
//	);
//	register_taxonomy( 'specialcat', array( 'blog' ), $blogSpecialArgs );

	// ブログタクソノミー 'tagcat'
	$blogTagLabels = array(
		'name' => __( 'ブログタグ', '' ),
		'singular_name' => __( 'ブログタグ', '' ),
		'menu_name' => __( 'ブログタグ', '' ),
		'all_items' => __( 'ブログタグ', '' ),
		'edit_item' => __( 'ブログタグを編集', '' ),
		'view_item' => __( 'ブログタグを表示', '' ),
		'update_item' => __( 'ブログタグを更新', '' ),
		'add_new_item' => __( '新規ブログタグを追加', '' ),
		'not_found' => __( '見つかりませんでした', '' ),
		'no_terms' => __( 'タームがありません', '' )
	);
	$blogTagArgs = array(
		'labels' => $blogTagLabels,
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
	register_taxonomy( 'tagcat', array( 'blog' ), $blogTagArgs );

}
add_action( 'init', 'create_post_type_taxes' );

# カスタム投稿タイプの記事一覧を日付順にする
function set_post_types_admin_order( $wp_query ) {
	if (is_admin()) {
		$post_type = $wp_query->query['post_type'];

		if ( $post_type == 'news' || $post_type == 'case' || $post_type == 'seminar' || $post_type == 'blog' ) {
			$wp_query->set('orderby', 'date');
			$wp_query->set('order', 'DESC');
		}
	}
}
add_filter('pre_get_posts', 'set_post_types_admin_order');

# タクソノミーで絞り込み表示
function add_post_taxonomy_restrict_filter() {
	global $post_type;
	if ( $post_type == 'news' ) { ?>
	<select name="newscat">
		<option value="">カテゴリー指定なし</option>
		<?php
			$terms = get_terms('newscat');
			foreach ($terms as $term) { ?>
		<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
		<?php } ?>
	</select>
	<?php }
}
add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );

# 一覧ページのタイトル枠の幅を調整
function adjust_admin_col_width(){
	global $post_type;
	if ( $post_type == 'case' ) {
		echo '<style type="text/css">
		body.post-type-case .wp-list-table thead #title { width: 50%; }
		</style>';
	}
}
add_action('admin_head', 'adjust_admin_col_width');

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

# ACFのテキストエリアのmin-heightを除去
function textarea_temp_fix() {
	echo '<style type="text/css">.acf_postbox .field textarea {min-height:0 !important;}</style>';
}
add_filter('admin_head','textarea_temp_fix');


# 投稿一覧にカスタムフィールドの項目を追加
//function add_manage_posts_columns($columns) {
//	global $post_type;
//	if ( $post_type === 'case' ) {
//		$columns['acf_case_type'] = "投稿の種類";
//		return $columns;
//	} else {
//		return $columns;
//	}
//}
//function add_manage_posts_custom_column($column_name, $post_id) {
//	if( $column_name == 'acf_case_type' ) {
//		// $stitle = get_post_meta($post_id);
//		$field = get_field_object('acf_case_type');
//		$value = $field['value'];
//		$label = $field['choices'][ $value ];
//		// var_dump($label);
//	}
//	if ( isset($label) && $label ) {
//		echo attribute_escape($label);
//	} else {
//		echo __('');
//	}
//}
//add_filter( 'manage_posts_columns', 'add_manage_posts_columns' );
//add_action( 'manage_posts_custom_column', 'add_manage_posts_custom_column', 10, 2 );


# 投稿一覧にカスタムフィールドの項目による絞り込み機能を追加
# http://nxpg.net/blog/?p=7467
add_filter('query_vars', function($vars){
	global $post_type;
	if( is_admin() ) {
		if ( $post_type === 'case' ) {
			array_push($vars, 'acf_case_top_check');
		}
		if ( $post_type === 'seminar' ) {
			array_push($vars, 'acf_seminar_top_check');
		}
	}
	return $vars;
});

function add_restrict_manage_posts_filter() {
	global $post_type;
	
	if ( $post_type === 'case' || $post_type === 'seminar' ) {
		if ( $post_type === 'case' ) {
			$meta_key = 'acf_case_top_check';
			$items = array(
				'' => '導入事例フィルター',
				'isCheck' => 'スライダー掲載の記事のみ表示'
			);
		} elseif ( $post_type == 'seminar' ) {
			$meta_key = 'acf_seminar_top_check';
			$items = array(
				'' => 'セミナーフィルター',
				'isCheck' => 'スライダー掲載の記事のみ表示',
			);
		}
		$selected_value = filter_input( INPUT_GET, $meta_key );

		$output = '';
		$output .= '<select name="' . esc_attr($meta_key) . '">';
		foreach ( $items as $value => $text ) {
			$selected = selected( $selected_value, $value, false );
			$output .= '<option value="' . esc_attr($value) . '"' . $selected . '>' . esc_html($text) . '</option>';
		}
		$output .= '</select>';

		echo $output;
	}
}
add_action('restrict_manage_posts', 'add_restrict_manage_posts_filter');

function show_posts_where_filter($where) {
	global $wpdb;
	global $post_type;
	
	if( is_admin() ) {
		if ( $post_type === 'case' ) {
			$value = get_query_var('acf_case_top_check');
			if(!empty($value)) {
				$where .= $wpdb->prepare(" AND EXISTS ( SELECT * FROM {$wpdb->postmeta} as m
					WHERE m.post_id = {$wpdb->posts}.ID AND m.meta_key = 'acf_case_top_check' AND m.meta_value like %s )",
																 "%{$value}%" );
			}
		} elseif ( $post_type === 'seminar' ) {
			$value = get_query_var('acf_seminar_top_check');
			if(!empty($value)) {
				$where .= $wpdb->prepare(" AND EXISTS ( SELECT * FROM {$wpdb->postmeta} as m
					WHERE m.post_id = {$wpdb->posts}.ID AND m.meta_key = 'acf_seminar_top_check' AND m.meta_value like %s )",
																 "%{$value}%" );
			}
		}
	}
	return $where;
}
add_filter('posts_where', 'show_posts_where_filter');

add_filter('wp_theme_editor_filetypes', function ($default_types) { $default_types[] = 'js'; return $default_types; });