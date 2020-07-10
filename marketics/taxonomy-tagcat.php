<?php

/*
	taxonomy - 'tagcat'
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
$tax = $get_query_obj->taxonomy;
$term_name = $get_query_obj->name;
$term_description = $get_query_obj->description;
$term_slug = $get_query_obj->slug;


// class
function the_blog_class($interview_type){
	if ( $interview_type === 'interview' ) {
		echo '-interview';
	} elseif ( $interview_type === 'dialogue' ) {
		echo '-dialogue';
	}
}
?>
<?php get_header(); ?>

<!-- main -->
<div class="container">
	<div class="contents">
		<div class="category-eyecatch">

			<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $catslug; ?>.jpg" />
			<div class="cat-title">
				<h1>Interview</h1>
				<p>インタビュー記事一覧</p>
			</div>
			<img class="header-edge" src="<?php bloginfo('template_directory'); ?>/images/common/marketics_key_btm.png" />
		</div>


		<div class="category-content">
				<div class="content-box">
					<div class="content-box-inner">
						<?php 
							$taxonomy_slug = get_query_var('taxonomy');
							if( $taxonomy_slug !== "tagcat" ) {
						?>
								<h1 class="blog-archive-heading"><?php if ($term_description) echo $term_description; ?></h1>
								<div class="blog-archive-heading-sub"><?php echo $term_name; ?>一覧</div>
						<?php } else { ?>
								<h1 class="blog-archive-heading <?php echo $taxonomy_slug; ?>">#<?php echo $term_name; ?></h1>
						<?php } ?>
					</div>					
			<?php
				$perpage = 12;
				$sort = "date";
				$sortorder = "DESC";
				if($term_slug === "words") { 
					$perpage = -1;
					$sort = "title";
					$sortorder = "ASC";
				}
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$the_query = new WP_Query( array(
					'paged' => $paged ,
					'post_type' => $post_type,
					'category_name' => $catslug,
					'taxonomy' => $tax,
					'term' => $term_slug,
					'orderby' => $sort,
					'order' => $sortorder,
					'posts_per_page' => $perpage
				)); ?>
				<?php if($term_slug == "b-academy"){
					$the_query = new WP_Query( array(
					'paged' => $paged ,
					'post_type' => $post_type,
					'tax_query' => array(
						array(
							'taxonomy' => $tax, //タクソノミーを指定
							'field' => 'slug', //ターム名をスラッグで指定する
							'terms' => array( 'b-academy','event' ) //表示したいタームをスラッグで指定
						),
					 ),
					'orderby' => $sort,
					'order' => $sortorder,
					'posts_per_page' => $perpage
					));
				}
				$maxPageNum = $the_query->max_num_pages;

				if ($the_query->have_posts()) : ?> 
									
			<?php //通常カテゴリーループ
				if($term_slug != "words"): while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<ul class="blog-archive-list m-list js-infinite-scroll" data-infinite-max="<?php echo $maxPageNum ?>">
					<li class="blog-archive-item -col -post">
						<div class="blog-item-wrap">
							<a href="<?php the_permalink(); ?>">
							<div class="blog-archive-thumb">
								<?php the_post_thumbnail( 'blog-archive-thumb' ); ?>
							</div>
							<div class="blog-archive-content">
								<h2 class="blog-archive-title"><?php the_plane_content($post->post_title, 280); ?></h2>
								<div class="blog-tags"><?php //echo get_the_term_list( $post->ID,'tagcat','','、' ); ?></div>
								<div class="blog-date"><?php the_time('Y.m.d'); ?></div>
							</div>
							</a>
						</div>
					</li>
					<?php endwhile; ?> 
				</ul>						
				<?php wp_pagenavi(array('query' => $the_query)); ?>
			<?php endif; ?>

				<div class="m-page-nav">
					<?php next_posts_link( '', $the_query->max_num_pages ); ?>
				</div>
				<div class="m-loading"></div>
				<?php wp_reset_postdata();?> 
			</div>

		</div><!-- /category-content -->
	</div><!-- /contents -->
</div><!-- /container -->

		<!-- /main -->

<?php get_footer(); ?>
