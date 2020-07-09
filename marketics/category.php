<?php get_header(); ?>
<?php
	$catinfo = get_category( $cat );
	$catslug = $catinfo->slug;
	$catname = $catinfo->name;
?>

<div class="container">
	<div class="contents">
	<div class="category-eyecatch">
		<?php
			$cats = get_the_category();
			foreach($cats as $catss):
			if($catss->category_parent) {
				$parent_cat = get_category($catss->category_parent);
				$parent_slug= $parent_cat->slug;
				$parent_name= $parent_cat->name;
				$catChildslug = $catss->category_nicename;
				$catChildname = $catss->cat_name;
				}
		?>
			<?php if($catslug == "interview"): ?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $catslug; ?>.jpg" />
			<?php elseif($catslug == "event-report"): ?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $catslug; ?>.jpg" />
			<?php elseif($parent_slug == "library"||$parent_slug == "marketing"||$parent_slug == "information"): //cat:インタビュー記事一覧 ?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $parent_slug; ?>.jpg" />
			<?php elseif($parent_slug == "interview"): ?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $catChildslug; ?>.jpg" />
			<?php elseif($parent_slug == "event-report"): ?>
				<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $catChildslug; ?>.jpg" />
			<?php endif; ?>
			<div class="cat-title">
				<?php if( is_category('interview')): //cat:インタビュー記事一覧 ?>
					<h1>Interview</h1>
					<p>インタビュー記事一覧</p>
				<?php elseif( is_category('event-report')): //cat:イベントレポート ?>
					<h1>Event report</h1>
					<p>イベントレポート</p>
				<?php elseif( is_category('library')): //cat:ライブラリ ?>
					<h1>Library</h1>
					<p>ライブラリ</p>
				<?php elseif( is_category('marketing')): //cat:マーケティング ?>
					<h1>Marketing</h1>
					<p>マーケティング</p>
				<?php elseif( is_category('information')): //cat:インフォメーション ?>
					<h1>Information</h1>
					<p>インフォメーション</p>
				<?php elseif($parent_slug == "interview"): ?>
				<?php else : ?>
					<h2><?php echo $catname; ?></h2>
				<?php endif; ?>
			</div>
		<?php break; ?>
		<?php endforeach; ?>
		<img class="header-edge" src="<?php bloginfo('template_directory'); ?>/images/common/marketics_key_btm.png" />
	</div>

<div class="category-content">
	<div class="content-box">
		<div class="content-box-inner">
			<?php
				$perpage = 12;
				$sort = "date";
				$sortorder = "DESC";
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				$the_query = new WP_Query( array(
					'paged' => $paged ,
					'post_type' => $post_type,
					'category_name' => $catslug,
					'taxonomy' => $tax,
					'orderby' => $sort,
					'order' => $sortorder,
					'posts_per_page' => $perpage
				)); ?>
			<?php if($the_query->have_posts()): while($the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php if ( has_post_thumbnail() ) {
						$image_id = get_post_thumbnail_id ();
						$image_arr = wp_get_attachment_image_src ($image_id, true);
						$image_url = $image_arr[0];
					} else {
						$image_url = get_bloginfo( 'template_directory' ) . '/images/thumbnail.png';
					} ?>
			<div class="archive-item _<?php echo $catslug; ?>">
				<a href="<?php the_permalink(); ?>">
					<div class="archive-thumb">
						<div class="media-inner"><?php the_post_thumbnail( 'large' ); ?></div>
					</div>
					<div class="archive-content">
						<div class="archive-on-detail">
							<p class="archive-title"><?php the_title(); ?></p>
							<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
							<div class="archive-detail-company">
								<ul>
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
									<div class="archive-off-detail">
										<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php endwhile; ?>
			<?php wp_pagenavi(array('query' => $the_query)); ?>
		<?php endif; ?>
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
