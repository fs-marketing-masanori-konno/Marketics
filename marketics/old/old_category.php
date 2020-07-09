<?php get_header(); ?>
<?php 
	$catinfo = get_category( $cat );
	$catslug = $catinfo->slug;
	$catname = $catinfo->name;
?>

<div class="container">
	<div class="contents">
		
	<div class="category-eyecatch">
		<img class="header-img" src="<?php bloginfo('template_directory'); ?>/images/category/eyecatch-<?php echo $catslug; ?>.jpg" />
			<div class="cat-title">
			<?php 
				if($catslug=="interview"): //cat:インタビュー ?>
					<h1>Interview</h1>
					<p>インタビュー記事一覧</p>
				<?php elseif($catslug=="event-report"): //cat:イベント ?>
					<h1>Event report</h1>
					<p>イベントレポート</p>
				<?php elseif($catslug=="marketing"): //cat:マーケティング ?>
					<h1>Marketing</h1>
					<p>マーケティング</p>
				<?php elseif($catslug=="library"): //cat:ライブラリ ?>
					<h1>Library</h1>
					<p>ライブラリ</p>
				<?php elseif($catslug=="information"): //cat:インフォメーション ?>
					<h1>Information</h1>
					<p>インフォメーション</p>
			<?php endif; ?>
			</div>
		<img class="header-edge" src="<?php bloginfo('template_directory'); ?>/images/common/donwloadlist_key_btm.png" />
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

									<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>

									<p class="archive-title"><?php the_title(); ?></p>
									<div class="archive-detail-company">
										<ul>

												<?php
														$cats = get_the_category();
														foreach($cats as $cat):
															if($cat->parent) {
																//子カテゴリスラッグ
																$catchildslug = $cat->category_nicename;
																//子カテゴリ名前
																$catchildname = $cat->cat_name;
															}
														endforeach;
												?>

												<?php
													$args = array(
														'slug' => $catslug );
														$catChildren = get_categories( $args );
														$catChildslug = $catChildren->slug;
													$postCat_Mid   = get_field('acf_post_mid_cat');
													//if($catslug=="event" or "interview"): //cat:イベントまたはインタビュー
													if($catslug=="event-report" or $catslug=="interview"): //cat:イベントまたはインタビュー
												?>

												<?php if(have_rows('acf_subcat_speaker')): ?>
												<?php while(have_rows('acf_subcat_speaker')): the_row(); ?>
													<?php if(have_rows('repeater-interview')): ?>
													<?php while(have_rows('repeater-interview')): the_row(); ?>
													<?php if($catslug=="interview") {
															$groupSubCat_spk = get_sub_field('acf_person_i');
														} elseif($catChildslug =="b-academy") {
															$groupSubCat_spk = get_sub_field('acf_person_b');
														} elseif($catChildslug =="mixer") {
															$groupSubCat_spk = get_sub_field('acf_person_m');
														} ?>
													<?php
														foreach ((array)$groupSubCat_spk as $Vi ):
														$Ti_name = get_field('personal_name', $Vi);
													?> 
															<?php if(have_rows('personal_company',$Vi)): ?>
															<?php while(have_rows('personal_company',$Vi)): the_row();
																			$Ti_coName  = get_sub_field('company_name');
																			$Ti_coLabel = get_sub_field('company-label');
															?>
													<li>
															<p class="archive-name"><?php echo $Ti_coName; ?></p>
															<p class="archive-position">
																<?php if(have_rows('position')): ?>
																	<?php while(have_rows('position')): the_row(); ?>
																		<?php echo get_sub_field('position_detail'); ?>
																	<?php endwhile; ?>
																<?php endif; ?>
															</p>
															<?php endwhile; ?>
															<?php endif; ?>

															<?php endforeach; ?>
															<?php endwhile; ?>
															<?php endif; ?>
													</li>

												<?php endwhile; ?>
												<?php endif; ?>

										</ul>
									<p class="archive-company"><?php echo $Ti_name; ?></p>

										<?php elseif($catslug=="library" or $catslug=="marketing" or $catslug=="information"): ?>
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
