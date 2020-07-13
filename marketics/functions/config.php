<?php
/**
 * config - サイト設定のカスタマイズ
 */

# jsファイルの読み込み
// function enqueue_script() {
// 	$uri = get_stylesheet_directory_uri();

// 	// ライブラリ（MCのみ）
// 	if ( is_post_type_archive( 'blog' ) || is_singular(array('blog')) || is_tax(array('blogcat', 'tagcat')) ){
// 		wp_enqueue_script( 'lib', $uri . '/common/js/lib/lib.js', 'jquery', null, true);
// 	}
// }

// 投稿記事
// if ( $query->is_post_type_archive( 'blog' ) || $query->is_tax( 'blogcat' ) || $query->is_tax( 'tagcat' ) ) {
// 	$query->set( 'posts_per_page', '1' );
// 	return;
// }

?>