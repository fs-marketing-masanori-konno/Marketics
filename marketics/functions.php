<?php
/**
 * functions
 */

# 初期化
require get_template_directory() . '/functions/init.php';

# ショートコード
require get_template_directory() . '/functions/shortcode.php';

# 管理画面
require get_template_directory() . '/functions/admin.php';

# サイト設定

# デフォルトの機能を調整

# 汎用的な関数

# テーマ固有の関数

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
