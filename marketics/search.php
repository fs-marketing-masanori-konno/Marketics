<?php get_header(); ?>
<?php $thePosts = query_posts(
		array(
		'paged' => $paged ,
		'posts_per_page' => 12,
		'post_type' =>'post',
		'tax_query' => array(
		array(
				'taxonomy' => 'tag',
				'field' => 'slug',
				//'terms' => array('words','interview'),
				'terms' => array('words'),
				'operator'  => 'NOT IN'
			)
		),
		's' => $s
		)
	);
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$search_query = get_search_query();
 ?>
<!-- main -->
<div class="container">
	<div class="contents">
		<div class="category-eyecatch">
			<div class="blog-left">
				<div class="blog-archive threerows">
					<?php if(empty(get_search_query())) { ?>
						<p>検索キーワードが未入力です。</p>
						<div class="searchform-box"><?php get_search_form(); ?></div>
					<?php } else { ?>
						<div class="blog-archive-header">
							<h1 class="blog-archive-heading">
								「<?php echo $search_query; ?>」の検索結果<span>（<?php echo $total_results; ?>件）</span> 
							</h1>
						</div>
											
						<?php
							//$paged = get_query_var('paged') ? get_query_var('paged') : 1;
							if( $total_results >0 ):
						?> 
							<?php if(have_posts()): ?> 
								<ul class="blog-archive-list m-list js-infinite-scroll" data-infinite-max="<?php echo $maxPageNum ?>">
									<?php while(have_posts()): the_post(); ?>
										<li class="blog-archive-item -col -post">
											<a href="<?php the_permalink(); ?>">
												<div class="blog-item-wrap">
													<div class="blog-archive-thumb">
															<?php the_post_thumbnail( 'blog-archive-thumb' ); ?>
													</div>
													<div class="blog-archive-content">
														<h2 class="blog-archive-title"><?php the_plane_content($post->post_title, 280); ?></h2>
														<div class="blog-tags">
															<?php echo get_the_term_list( $post->ID,'tagcat','','、' ); ?>
														</div>
														<div class="blog-date"><?php the_time('Y.m.d'); ?></div>
													</div>
												</div>
											</a>
										</li>
									<?php endwhile; ?> 
								</ul>
							<?php wp_pagenavi(); ?>

						<?php endif; else: ?>
							<p><?php echo $search_query; ?> に一致する情報は見つかりませんでした。</p>
						<?php endif; ?>
							<div class="m-page-nav">
								<?php next_posts_link( '', $the_query->max_num_pages ); ?>
							</div>

						<?php wp_reset_postdata();?> 
					<?php } ?>
				</div>
			</div><!-- /blog-left -->
		</div><!-- /l-inner -->
	</div><!-- /blog -->
</div>
<!-- /main -->
<?php get_footer(); ?>
