<?php
/*
	taxonomy - 'tagcat'
*/
?>
<?php
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
$term_description = $get_query_obj->description;
$term_slug = $get_query_obj->slug;

get_header(); ?>

<!-- main -->
<div class="container">
	<div class="contents">
	<div class="category-eyecatch">
			<?php
				$taxonomy_slug = get_query_var('taxonomy');
				if( $taxonomy_slug === "tagcat" ) {
			?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-interview-temp.jpg" />
					<div class="cat-title <?php echo $taxonomy_slug; ?>">
						<h1><?php echo $term_name; ?></h1>
					</div>
			<?php } else { //親カテゴリ記事一覧 ?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $parent_slug; ?>.jpg" />
			<?php }; ?>
		<img class="header-edge" src="<?php bloginfo('template_directory'); ?>/images/common/marketics_key_btm.png" />
	</div>

<div class="category-content">
	<div class="content-box">
		<div class="content-tag-box">
			<h2>関連記事タグ</h2>
			<?php
			  $terms = get_the_terms($post->ID,'tagcat');
			  foreach ( $terms as $term ) {
			    echo '<a href="'.get_term_link($term).'">#'.$term->name.'</a>';
			  }
			?>
		</div>
		<div class="content-box-inner">
			<?php
				$perpage = 12;
				$sort = "date";
				$sortorder = "DESC";
				$tax = "tagcat";
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$the_query = new WP_Query( array(
					'paged' => $paged,
					'post_type' => $post_type,
					'taxonomy' => $tax,
					'term' => $term_slug,
					'orderby' => $sort,
					'order' => $sortorder,
					'posts_per_page' => $perpage
				)); ?>
	  <ul class="top-archive _information">
			<?php if($the_query->have_posts()): while($the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php if ( has_post_thumbnail() ) {
					$image_id = get_post_thumbnail_id ();
					$image_arr = wp_get_attachment_image_src ($image_id, true);
					$image_url = $image_arr[0];
				} else {
					$image_url = get_bloginfo( 'template_directory' ) . '/images/thumbnail.png';
				} ?>
			<li class="archive-item _<?php echo $catslug; ?>">
				<div class="archive-thumb">
					<a href="<?php the_permalink(); ?>">
						<div class="media-inner">
	            <?php
              if (has_post_thumbnail()){
                the_post_thumbnail( 'large' );
              } else {
                /* アイキャッチ無い場合の画像 */
              }	?>
            </div>
					</a>
					<div class="archive-detail-company">
						<ul>
							<?php // Repeater Fields
								$cats = get_the_category();
								foreach($cats as $catss) {
									if($catss->category_parent) {
										$parent_cat   = get_category($catss->category_parent);
										$parent_slug  = $parent_cat->slug;
										$parent_name  = $parent_cat->name;
										$catChildslug = $catss->category_nicename;
										$catChildname = $catss->cat_name;
									}
								}
							?>
							<?php if($parent_slug == "event-report" || $parent_slug=="interview" ): ?>

							<?php if(have_rows('acf_subcat_speaker')): ?>
							<?php while(have_rows('acf_subcat_speaker')): the_row(); ?>
								<?php if(have_rows('repeater-interview')): ?>
								<?php while(have_rows('repeater-interview')): the_row(); ?>
								<?php if($parent_slug=="interview") {
										$groupSubCat_spk = get_sub_field('acf_person_i');
								} elseif($catChildslug =="b-academy") {
										$groupSubCat_spk = get_sub_field('acf_person_b');
								} elseif($catChildslug =="mixer") {
										$groupSubCat_spk = get_sub_field('acf_person_m');
								} ?>
								<?php	foreach ((array)$groupSubCat_spk as $Vi ):
									$Ti_name = get_field('personal_name', $Vi);
								?>
									<?php if(have_rows('personal_company',$Vi)): ?>
									<?php while(have_rows('personal_company',$Vi)): the_row();
										$Ti_coName  = get_sub_field('company_name');
										$Ti_coLabel = get_sub_field('company-label');
									?>
								<li>
									<p class="archive-name"><?php echo $Ti_coName; ?></p>
										<?php endwhile; ?>
										<?php endif; ?>
									<p class="archive-company"><?php echo $Ti_name; ?></p>
								</li>
								<?php endforeach; ?>
								<?php endwhile; ?>
								<?php endif; ?>
							<?php endwhile; ?>
							<?php endif; ?>
						</ul>

						<?php elseif($parent_slug=="library" || $parent_slug=="marketing" || $parent_slug=="information"): ?>
               <!-- undefined */ -->
						<?php endif; ?>
					</div>
				</div>
				<div class="archive-content">
					<div class="archive-on-detail">
	          <div class="top-archive-meta">
							<a href="<?php the_permalink(); ?>">
								<p class="archive-title"><?php the_title(); ?></p>
							</a>
							<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
						</div>
		          <div class="blog-tags">
            		<?php echo get_the_term_list( $post->ID, 'tagcat'); ?>
        			</div>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
				<?php wp_pagenavi(array('query' => $the_query)); ?>
			<?php endif; ?>
		</ul>
	</div> <!-- content-box-inner -->
</div> <!-- content-box -->
</div> <!-- category-content -->

<div class="m-page-nav">
<?php next_posts_link( '', $the_query->max_num_pages ); ?>
</div>
<div class="m-loading"></div>
<?php wp_reset_postdata(); ?>


	</div><!-- /.contents -->
</div><!-- /.container -->
<?php get_footer(); ?>
