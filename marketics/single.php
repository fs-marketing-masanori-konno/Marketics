<?php get_header(); ?>


<!-- main -->
<div class="container" id="pagetop">
  <div class="contents">

<?php if(have_posts()): the_post(); ?>
<article>
  <!-- アイキャッチ -->
  <?php if ( has_post_thumbnail() ) {
    $image_id = get_post_thumbnail_id ();
    $image_arr = wp_get_attachment_image_src ($image_id, true);
    $image_url = $image_arr[0];
  } else {
    $image_url = get_bloginfo( 'template_directory' ) . '/images/thumbnail.png';
  } ?>
  <div class="article-eyecatch">
  	<img class="bg-eyecatch" src="<?php echo $image_url; ?>" >
    <div class="eyecatch-img l-left _thumb"><?php the_post_thumbnail( 'large' ); ?></div>
    <div class="l-right"></div>
  </div>

  <div class="article-inner">
    <div class="article-content l-left">

   <div class="article-info">

	    <div class="article-pan">
		<?php
			$post_cats = get_the_category();
			$cats = $sort = array();
			$catid =  $post_cats[0]->term_id;
			$separator = '';
			$output = '';
			foreach ($post_cats as $cat) {
				$layer = count(get_ancestors($cat->term_id, 'category'));
				$cats[] = array(
				'name' => $cat->name,
				'id' => $cat->term_id,
				'layer' => $layer
				);
				$sort[] = $layer;
				}
				array_multisort($sort, SORT_ASC, $cats);
				foreach ($cats as $cat) {
				echo '<a href="'.get_category_link( $cat['id'] ).'">'.$cat['name'].'</a>'.$separator;
				}
				echo trim( $output, $separator );
				?>
		</div>
        <h1><?php the_title(); ?></h1>
        <div class="article-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></div>

    	<div class="itemfixed">
			<div class="blog-share">
			<ul class="circle_group cf">
			    <li class="sns_circle facebook"><span><i class="fab fa-facebook-f"></i></span><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink() ?>"></a></li>
			    <li class="sns_circle twitter"><span><i class="fab fa-twitter"></i></span><a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?> - Marketer’s Compass <?php the_permalink() ?>"></a></li>
			    <li class="sns_circle hatebu"><span><i class="fa fa-hatena"></i></span><a href="http://b.hatena.ne.jp/entry/<?php the_permalink() ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php the_title(); ?>" data-hatena-bookmark-layout="simple"></a></li>
			    <li class="sns_circle pocket"><span><i class="fab fa-get-pocket"></i></span><a href="http://getpocket.com/edit?url=<?php the_permalink() ?>"></a></li>
			    <li class="sns_circle line"><span></span><img src="<?php bloginfo('url'); ?>/wp-content/themes/marketics/images/common/line_app_rgb.svg" class="share-line"><a href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink() ?>"></a></li>
			</ul>
			</div>
		</div>
   </div><!-- /.article-info -->

   <div class="article-body">


	<?php
		$groupCat_int = get_field('acf_post_interview');
		$prevInt   	  = $groupCat_int['interview-url-bf'];
		$prevPart     = $groupCat_int['interview-url-bfp'];
		$nextInt      = $groupCat_int['interview-url-af'];
		$nextPart     = $groupCat_int['interview-url-afp'];
	?>
	<?php if ( $prevInt ): ?>
		<div class="prev-content"><a href="<?php get_bloginfo( 'template_directory' ); ?>/interview/<?php echo $prevInt; ?>/" >前編を読む</a></div>
	<?php elseif( $prevPart ): ?>
		<div class="prev-content"><a href="<?php get_bloginfo( 'template_directory' ); ?>/interview/<?php echo $prevPart; ?>/" >前のページへ</a></div>
 	<?php endif; ?>

	<?php the_content(); ?>

	<?php if ( $nextInt ): ?>
		<div class="next-content"><a href="<?php get_bloginfo( 'template_directory' ); ?>/interview/<?php echo $nextInt; ?>/" >後編へつづく</a></div>
	<?php elseif( $nextPart ): ?>
		<div class="next-content"><a href="<?php get_bloginfo( 'template_directory' ); ?>/interview/<?php echo $nextPart; ?>/" >次のページへ</a></div>
 	<?php endif; ?>


	<div id="itemfixedcancel">
	<ul class="credit" >
		<?php if(get_field('acf_mc_editor') ): ?>
	        <li><span class="credit-role">TEXT BY</span><?php the_field('acf_mc_editor'); ?></li>
		<?php endif; ?>
		<?php if(get_field('acf_mc_bannerdesign') ): ?>
			<li><span class="credit-role">BANNER DESIGN BY</span><?php the_field('acf_mc_bannerdesign'); ?></li>
		<?php endif; ?>
		<?php if(get_field('acf_mc_photographer') ): ?>
	        <li><span class="credit-role">PHOTOGRAPH BY</span><?php the_field('acf_mc_photographer'); ?></li>
	   <?php endif; ?>
	</ul>
	</div>

<?php
    $postCat = get_field('acf_post_cat');
    if($postCat=="Event"): //cat:イベント
 	$groupCat_Mid = get_field('acf_post_mid_cat');
?>
	<?php
	 	$postCat_Mid   = get_field('acf_post_mid_cat');
	 	if($postCat_Mid=="b-academy"): //mid_cat:bacademy
	    $groupCat_aca  = get_field('acf_subcat_academy');
			$overviews_aca = $groupCat_aca['academy_overview_pic'];
	?>
  <div class="event-overview">
			<p class="event-overview-title">Event Overview</p>
				<img src="<?php echo $overviews_aca['url']; ?>" class="alignnone size-full wp-image-8" alt="<?php echo $overviews_aca['alt']; ?>" width="700" height="467" />
			<p class="overview-text _date"><?php echo $groupCat_aca['academy_date']; ?></p>
			<p class="overview-text _ov-text"><?php echo $groupCat_aca['academy_overview_text']; ?></p>
  </div>


	<?php if(have_rows('acf_subcat_speaker')): ?>
	<div class="interview-profile">
	 	<p class="interview-profile-title">Speaker Profile</p>
			<ul class="speaker-detail">
				<?php while(have_rows('acf_subcat_speaker')): the_row(); ?>
	    		<?php if(have_rows('repeater-academy')): ?>
					<?php while(have_rows('repeater-academy')): the_row(); ?>
	      		<?php
	      			$groupSubCat_spk = get_sub_field('acf_person_b');
	      			foreach ((array)$groupSubCat_spk as $Vb ): ?> 
		  			<?php setup_postdata($Vb); ?>
		  			<?php
						$Tb_img     = get_field('personal_pic', $Vb);
						$Tb_name    = get_field('personal_name', $Vb);
						$Tb_career  = get_field('personal_career',$Vb);
						$Tb_company = get_field('personal_company', $Vb);
						$Tb_state   = get_sub_field_object('personal_moderator');
						$Tb_check   = get_sub_field('personal_moderator');
						$valuesB    = $Tb_state['value'];
					?>
					<li>
					   <img src="<?php echo $Tb_img['url']; ?>" class="alignnone wp-speaker-img" alt="<?php echo $Tb_img['alt'] ?>" width="240" height="240"/>
							<?php if( $valuesB ): ?>
								<div class="meta-label _moder">moderator</div>
							<?php endif; ?>
				    	<div class="profile-info">
							<p class="profile-name"><?php echo $Tb_name; ?></p>

									<?php if(have_rows('personal_company',$Vb)): ?>
									<?php while(have_rows('personal_company',$Vb)): the_row();
										$Tb_coName 	= get_sub_field('company_name');
							   			$Tb_coLabel = get_sub_field('company-label');
							   		?>
							<p class="profile-company"><?php echo $Tb_coName; ?></p>
							   			<?php if(have_rows('position')): ?>
										<?php while(have_rows('position')): the_row(); ?>
							<p class="profile-position"><?php echo get_sub_field('position_detail'); ?></p>
						 	 	  		<?php endwhile; ?>
					 	 	  			<?php else: ?>
										<?php endif; ?>
					 	 	  		<?php endwhile; ?>
					 	 	  		<?php else: ?>
									<?php endif; ?>
							<p class="profile-career"><?php echo $Tb_career; ?></p>
				    	</div>
			    	</li>
				<?php
				endforeach;
	    		endwhile; ?>
    		<?php else: ?>
				<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		<?php wp_reset_postdata(); ?>
	</div>
	<?php else: ?>
	<?php endif; ?>

	<div class="about-event">
		<p class="about-event-title">About b→academy</p>
		<?php 
			$concept_aca  = $groupCat_aca['academy_concept_id'];
			$post_data    = get_page_by_path($concept_aca, OBJECT, 'event');
			$post_id      = $post_data->ID;
			$eventCat_aca = get_field('acf_catgroup_b-academy', $post_id);
			$academy_pic  = $eventCat_aca['acf_subcat_academy-pic'];
		?>
		<img src="<?php echo $academy_pic['url']; ?>" class="alignnone size-full wp-image-8" alt="<?php echo $academy_pic['alt']; ?>" width="700" height="467" />
		<p class="concept-text"><?php echo $eventCat_aca['acf_subcat_academy-concept']; ?></p>
		<a href="<?php echo $eventCat_aca['acf_subcat_academy-url']; ?>" class="event-link"><?php echo $eventCat_aca['acf_subcat_academy-url']; ?></a>
	</div>


	<?php
		elseif($postCat_Mid=="MiXER"): //mid_cat:MiXER
		$groupCat_mix  = get_field('acf_subcat_mixer');
		$groupCat_spk  = get_field('acf_subcat_speaker');
		$about_mix     = get_field('acf_catgroup_mixer');
		$overviews_mix = get_field('acf_catgroup_mixer');
	?>

 	<?php if(have_rows('acf_subcat_speaker')): ?>
	<div class="interview-profile">
		<p class="interview-profile-title">Speaker Profile</p>
		<ul class="speaker-detail">
		<?php while(have_rows('acf_subcat_speaker')): the_row(); ?>
    		<?php if(have_rows('repeater-mixer')): ?>
			<?php 
				while(have_rows('repeater-mixer')): the_row();
	   			$groupSubCat_spk = get_sub_field('acf_person_m');
	   			foreach ((array) $groupSubCat_spk as $Vm ): ?> 
	  			<?php 
	  				setup_postdata($Vm);
					$Tm_img     = get_field('personal_pic', $Vm);
					$Tm_name    = get_field('personal_name', $Vm);
					$Tm_career  = get_field('personal_career', $Vm);
					$Tm_company = get_field('personal_company', $Vm);
					$Tm_state   = get_sub_field_object('personal_moderator');
					$Tm_check   = get_sub_field('personal_moderator');
					$valuesM    = $Tm_state['value'];
				?>
					<li>
					   <img src="<?php echo $Tm_img['url']; ?>" class="alignnone wp-speaker-img" alt="<?php echo $Tm_img['alt'] ?>" width="240" height="240"/>
							<?php if( $valuesM ): ?>
								<div class="meta-label _moder">moderator</div>
							<?php endif; ?>
				    	<div class="profile-info">
							<p class="profile-name"><?php echo $Tm_name; ?></p>
									<?php if(have_rows('personal_company',$Vm)): ?>
									<?php while(have_rows('personal_company',$Vm)): the_row(); ?>
		   							<?php $Tm_coName = get_sub_field('company_name');
							   			$Tm_coLabel = get_sub_field('company-label');
							   		?>
							<p class="profile-company"><?php echo $Tm_coName; ?></p>
							   			<?php if(have_rows('position')): ?>
										<?php while(have_rows('position')): the_row(); ?>
							<p class="profile-position"><?php echo get_sub_field('position_detail'); ?></p>
						 	 	  		<?php endwhile; ?>
					 	 	  		<?php else: ?>
										<?php endif; ?>
					 	 	  		<?php endwhile; ?>
				 	 	  		<?php else: ?>
									<?php endif; ?>
							<p class="profile-career"><?php echo $Tm_career; ?></p>
				    	</div>
			    	</li>
				<?php endforeach; ?>
    			<?php endwhile; ?>
    			<?php else: ?>
				<?php endif; ?>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	</div>
	<?php else: ?>
	<?php endif; ?>

	<div class="about-event">
		<p class="about-event-title">About MiXER</p>
		<?php
			$concept_mix  = $groupCat_mix['mixer_concept_id'];
			$post_data    = get_page_by_path($concept_mix, OBJECT, 'event');
			$post_id      = $post_data->ID;
			$eventCat_mix = get_field('acf_catgroup_mixer', $post_id);
			$mixer_pic    = $eventCat_mix['acf_subcat_mixer-pic'];
		?>
		<img src="<?php echo $mixer_pic['url']; ?>" class="alignnone size-full wp-image-8" alt="<?php echo $mixer_pic['alt']; ?>" width="700" height="467" />
		<p class="concept-text"><?php echo $eventCat_mix['acf_subcat_mixer-concept']; ?></p>
		<a href="<?php echo $eventCat_mix['acf_subcat_mixer-url']; ?>" class="event-link"><?php echo $eventCat_mix['acf_subcat_mixer-url']; ?></a>
	</div>

	<?php   endif; ?>

<?php elseif($postCat=="Interview"): //cat:インタビュー
	$groupCat = get_field('acf_catgroup_interview');
?>
	<div class="interview-profile">
     	<p class="interview-profile-title">Speaker Profile</p>

      	<?php if(have_rows('acf_subcat_speaker')): ?>
			<ul class="speaker-detail">
			<?php while(have_rows('acf_subcat_speaker')): the_row(); ?>
	    	<?php if(have_rows('repeater-interview')): ?>
				<?php while(have_rows('repeater-interview')): the_row(); ?>
	      		<?php
	      			$groupSubCat_spk = get_sub_field('acf_person_i');
	      			foreach ((array)$groupSubCat_spk as $Vi ): ?>
		  			<?php setup_postdata($Vi); ?>
		  			<?php
						$Ti_img      = get_field('personal_pic', $Vi);
						$Ti_name     = get_field('personal_name', $Vi);
						$Ti_career   = get_field('personal_career',$Vi);
						$Ti_company  = get_sub_field('company_name',$Vi);
						$Ti_label    = get_sub_field('company-label');
						$Ti_position = get_sub_field('position');
					?>
					<li>
						<img src="<?php echo $Ti_img['url']; ?>" class="alignnone wp-speaker-img" alt="<?php echo $Ti_img['alt'] ?>" width="240" height="240"/>
				    	<div class="profile-info">
				        	<p class="profile-name"><?php echo $Ti_name; ?></p>

									<?php if(have_rows('personal_company',$Vi)): ?>
									<?php while(have_rows('personal_company',$Vi)): the_row();
										$Ti_coName 	= get_sub_field('company_name');
							   			$Ti_coLabel = get_sub_field('company-label');
							   		?>
							<p class="profile-company"><?php echo $Ti_coName; ?></p>
							   			<?php if(have_rows('position')): ?>
										<?php while(have_rows('position')): the_row(); ?>
							<p class="profile-position"><?php echo get_sub_field('position_detail'); ?></p>
						 	 	  		<?php endwhile; ?>
										<?php endif; ?>
					 	 	  		<?php endwhile; ?>
									<?php endif; ?>

							<p class="profile-career"><?php echo $Ti_career; ?></p>
				    	</div>
			    	</li>
				<?php endforeach; ?>
		    	<?php endwhile; ?>
				<?php endif; ?>
			<?php endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
    </div>

<?php   elseif($postCat=="未選択"): //cat:未選択 ?>
    <?php if(in_category('interview')): ?>
	    <div class="interview-profile">
	      <p class="interview-profile-title">Interviewee Profile</p>
	      <img src="<?php the_field('acf_mc_person_pic'); ?>" class="alignnone size-full wp-image-8" alt="" width="700" height="467" />
	      <div class="profile-info">
	        <p class="profile-name"><?php the_field('acf_mc_interviewee'); ?></p>
	        <p class="profile-company"><?php the_field('acf_mc_company_name'); ?></p>
	        <p class="profile-position"><?php the_field('acf_mc_department'); ?></p>
	        <p class="profile-career"><?php the_field('acf_mc_career'); ?></p>
	      </div>
	    </div>
    <?php endif; ?>

<?php   elseif($postCat=="Library"): //cat:ライブラリ ?>
<?php   elseif($postCat=="Information"): //cat:インフォメーション ?>
<?php   endif; ?>

    <div class="article-cat-tag">
      <div class="blog-cat-tag">Category</div>
			<div class="blog-tags">
				<?php array_multisort($sort, SORT_ASC, $cats);
				foreach ($cats as $cat) {
					echo '<a href="'.get_category_link( $cat['id'] ).'">'.$cat['name'].'</a>';
				} ?>
			</div>
    </div>

    <div class="article-cat-tag">
      <div class="blog-cat-tag">Tag</div>
      <div class="blog-tags">
				<?php echo get_the_term_list($post->ID,'tagcat'); ?>
			</div>
    </div>

<div class="article-share">
  	<div class="share-h1">SHARE</div>

    <div class="share -s-baloon">
		<ul class="share-list">
			<li class="share-item -tw">
				<a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?> - Marketer’s Compass <?php the_permalink() ?>" class="twitter-share-button" data-url="<?php the_permalink() ?>" data-text="<?php the_title(); ?>" data-lang="ja" data-show-count="false" >ツイート</a>
				<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</li>
			<li class="share-item -fw">
    			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
   			</li>

			<li class="share-item -hatena">
				<a href="https://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php the_title(); ?>｜入力したブログタイトル" data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加">
				<img src="https://b.st-hatena.com/images/v4/public/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
			</li>
		</ul>
	</div>
</div>	


<?php 
	$prevpost = get_adjacent_post(true, '', true);
	$nextpost = get_adjacent_post(true, '', false);
if( $prevpost or $nextpost )
{ ?>
	<ul class="PrevNextPost">
		<?php
		if ( $nextpost ) {
		echo '<li class="nextpost"><a href="' . get_permalink($nextpost->ID) . '"><p>' . get_the_title($nextpost->ID) . '</p><div>' . get_the_post_thumbnail($nextpost->ID, 'full') . '</div></a></li>';
		}
		if ( $prevpost && $nextpost ) { echo '<div class="post-line"></div>' ;
		}
		if ( $prevpost ) {
		echo '<li class="prevpost"><a href="' . get_permalink($prevpost->ID) . '"><div>' . get_the_post_thumbnail($prevpost->ID, 'full') . '</div><p>' . get_the_title($prevpost->ID) . '</p></a></li>';
		} ?>
	</ul>
<?php } ?>

<div class="related">
	<div class="article-related">
		<div class="related-heading">Related Articles <p>- 関連記事</p></div>
		<h1></h1>

	<div class='related-Articles threerows'>
	<!-- <div class="yarpp-related"> -->
	<ul class="blog-latest-list cf">
		<?php
			// 条件の設定 = 同じカテゴリから記事を6件呼び出す
			$categories = get_the_category($post->ID);
			$category_ID = array();
				foreach($categories as $category):
				  array_push( $category_ID, $category -> cat_ID);
				endforeach ;
			$args = array(
			  'post__not_in'   => array($post -> ID), // 今読んでいる記事を除く
			  'posts_per_page' => 6,
			  'category__in'   => $category_ID,
			  'orderby' 			 => 'rand', // ランダムに記事を選ぶ
			);
			$query = new WP_Query( $args );
				if( $query -> have_posts() ): while ($query -> have_posts()) : $query -> the_post();
		?>
			<li class="related-article-item cf">
			  <a href="<?php the_permalink(); ?>" title='<?php the_title(); ?>'>
				  <div class="related-article-item-wrap">
			    	<div class="related-article-thumb"><?php the_post_thumbnail(); ?></div>
			    	<div class="related-article-content cf">
			    		<h2 class="related-article-title"><?php the_title(); ?></h2>
			      	<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_time( 'Y/m/d' ); ?></time></p>
			      </div>
			    </div>
				</a>
			</li>
			<?php endwhile; endif; wp_reset_postdata(); ?>

			<?php
				$the_query = new WP_Query( $args );
				$post_count = $the_query->post_count;//表示される投稿の数
				$post_shortage = 6 - $post_count;
				if( $post_count < 6){
					// 条件の設定 = カテゴリ内記事数が不足している場合
			  	$args = array(
				    'numberposts' => $post_shortage, // 投稿の表示数を指定
				    'post_type' 	=> 'post', // 投稿を指定
				    'orderby' 		=> 'rand',
				    'tax_query' 	=> array( // 複数条件の設定
				      array(
				        'taxonomy' => 'category', //タクソノミーを指定
				        'field' 	 => 'slug', //ターム名をスラッグで指定する term_id,name,slug のいずれかを指定
				        'terms'		 => array('interview','event') //表示したいタームをスラッグで指定(文字列かIDを指定)
				      )
				    ),
				  );
		 		$posts = get_posts( $args );
				if( $posts ) : foreach( $posts as $post) : setup_postdata( $post );
			?>
				<li class="related-article-item cf">
				<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'>
				  <div class="related-article-item-wrap">
				    <div class="related-article-thumb"><?php the_post_thumbnail(); ?></div>
				    <div class="related-article-content cf">
				      	<h2 class="related-article-title"><?php the_title(); ?></h2>
	  			  		<p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_time( 'Y/m/d' ); ?></time></p>
				    </div>
				  </div>
				</a>
				</li>
			<?php endforeach; endif; wp_reset_postdata();	?>
			<?php } ?>
		</ul>
	</div>

	</div>
</div>


<div class="backToTop btn anchorlink">
	<a href="#pagetop" title="" class="backToTop-button notpop">
		<img src="<?php bloginfo('template_directory'); ?>/images/common/arrow_backToTop.png" alt="ページトップに戻る">
		<p>ページトップに戻る</p>
	</a>
</div>

		</div><!-- /.article-body -->

  	</div><!-- /.article-content -->
	    <div class="article-side l-right">
	      <?php get_sidebar(); ?>
	    </div><!-- /.article-side -->
  </div><!-- /.article-inner -->
</article>
<?php endif; ?>

  </div><!-- /.contents -->
</div><!-- /.container -->


<?php get_footer(); ?>
