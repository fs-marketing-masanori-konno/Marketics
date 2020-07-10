<?php
/**
 * shortcode - ショートコード
 */

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

?>