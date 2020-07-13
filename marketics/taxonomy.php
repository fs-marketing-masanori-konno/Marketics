<?php

/*
	taxonomy
*/

$get_query_obj = $wp_query->queried_object;

$get_post_type = get_post_type();
$get_post_obj = get_post_type_object($get_post_type);

// 投稿タイプ
$post_type = $get_post_obj->name;
$post_label = $get_post_obj->label;
$post_description = $get_post_obj->description;

// タクソノミー
$tax = $get_query_obj->taxonomy;
$term_name = $get_query_obj->name;
$term_slug = $get_query_obj->slug;

if ( $tax === 'tagcat' ) {
	require get_template_directory() . '/taxonomy-tagcat.php';
}  else {
	echo '<!-- taxonomy -->';
}


