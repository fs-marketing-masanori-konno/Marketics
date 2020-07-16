<?php get_header(); ?>
<?php
	$thePosts = query_posts(array(
		'paged' => $paged,
		'posts_per_page' => 12,
		'post_type' =>'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'tagcat',
				'field' => 'slug',
				'terms' => array('words'),
				'operator' => 'NOT IN'
			)
		),
		's' => $s
	));
	global $wp_query;
	$total_results = $wp_query->found_posts;
	$search_query  = get_search_query();
?>

<!-- container -->
<div class="container">
	<div class="contents">

			<?php if(empty(get_search_query())) { ?>
			<!-- 検索キーワード未入力 -->
				<div class="category-eyecatch _search-result">
					<div class="search-result-box">
						<h1 class="search-result">検索キーワードが未入力です。</h1>
						<div class="searchform-box"><?php get_search_form(); ?></div>
					</div>
				</div>

			<?php } else { ?>
			<!-- 検索キーワードの検索結果 -->
				<div class="category-eyecatch _search-result">
					<div class="search-result-box">
						<div class="searchform-box"><?php get_search_form(); ?></div>
						<div class="heading-search-result">
							<h1><?php echo $search_query; ?>の検索結果</h1>
							<div class="search-result">
			        	<span class="search-result-num"><?php echo $total_results; ?></span>
		          	<span class="search-result-text">件</span>
		          </div>
      			</div>
					</div>
				</div>
				<?php //$paged = get_query_var('paged') ? get_query_var('paged') : 1;
					if($total_results > 0):
				?>
					<div class="category-content">
						<div class="content-box">
							<div class="content-box-inner">

  							<ul class="top-archive _interview">
									<?php if(have_posts()): ?>
										<?php while(have_posts()): the_post(); ?>
											<li class="archive-item _<?php echo $catslug; ?>" data-infinite-max="<?php echo $maxPageNum ?>">
												<div class="archive-itembox">
													<div class="archive-thumb">
														<a href="<?php the_permalink(); ?>">
															<div class="media-inner">
											          <?php
											            if (has_post_thumbnail()){
											            	the_post_thumbnail( 'large' );
				            	            } else {
											              /* アイキャッチ無い場合の画像 */
											            }
											          ?>
										          </div>
														</a>
													</div>
													<div class="archive-content">
														<div class="archive-on-detail">
															<a href="<?php the_permalink(); ?>">
																<p class="archive-title"><?php the_title(); ?></p>
															</a>
															<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
															<div class="blog-tags">
																<?php echo get_the_term_list( $post->ID, 'tagcat'); ?>
															</div>
														</div>
													</div>
												</div>
											</li>
										<?php endwhile; ?>
										<?php wp_pagenavi(); ?>
									<?php endif; ?>
								</ul>

							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="category-eyecatch">
						<div class="search-result-box">
							<h1 class="search-result"><?php echo $search_query; ?> に一致する情報は見つかりませんでした。</h1>
							<div class="searchform-box"><?php get_search_form(); ?></div>
						</div>
					</div>
				<?php endif; ?>

					<div class="m-page-nav">
						<?php next_posts_link( '', $the_query->max_num_pages ); ?>
					</div>
					<div class="m-loading"></div>
				<?php wp_reset_postdata(); ?>
			<?php } ?>

	</div><!-- /contents -->
</div><!-- /container -->
<?php get_footer(); ?>
