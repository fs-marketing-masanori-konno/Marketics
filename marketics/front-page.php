<?php get_header(); ?>

<div class="header-eyecatch">
	<div class="slider-for">
	  <div class="top-slider-bg-wrap">
	    <img src="<?php echo get_the_post_thumbnail_url(160); ?>" class="slide-1" alt="">
	  </div>
	  <div class="top-slider-bg-wrap">
	    <img src="<?php echo get_the_post_thumbnail_url(110); ?>" class="slide-2" alt="">
	  </div>
	  <div class="top-slider-bg-wrap">
	    <img src="<?php echo get_the_post_thumbnail_url(1); ?>" class="slide-3" alt="">
	  </div>
	  <div class="top-slider-bg-wrap">
	    <img src="<?php echo get_the_post_thumbnail_url(197); ?>" class="slide-4" alt="">
	  </div>
	  <div class="top-slider-bg-wrap">
	    <img src="<?php echo get_the_post_thumbnail_url(3766); ?>" class="slide-5" alt="">
	  </div>
	</div>
	<div class="top-slide">
	  <div class="top-slider-item-wrap">
	      <a href="<?php bloginfo('url'); ?>/interview/160/">
	        <div class="header-thumb">
	          <img src="<?php echo get_the_post_thumbnail_url( 160 ); ?>" alt="" style="width: unset;">
	        </div>
	        <div class="caption-box">
	          <p class="caption"><?php echo get_the_title( 160 ); ?></p>
	        </div>
	      </a>
	  </div>
	  <div class="top-slider-item-wrap">
	    <a href="<?php bloginfo('url'); ?>/interview/110/">
	      <div class="header-thumb">
	        <img src="<?php echo get_the_post_thumbnail_url( 110 ); ?>" alt="" style="width: unset;">
	      </div>
	      <div class="caption-box">
	        <p class="caption"><?php echo get_the_title( 110 ); ?></p>
	      </div>
	    </a>
	 </div>
	  <div class="top-slider-item-wrap">
	    <a href="<?php bloginfo('url'); ?>/interview/1/">
	      <div class="header-thumb">
	        <img src="<?php echo get_the_post_thumbnail_url( 1 ); ?>" alt="" style="width: unset;">
	      </div>
	      <div class="caption-box">
	        <p class="caption"><?php echo get_the_title( 1 ); ?></p>
	      </div>
	    </a>
	  </div>
	  <div class="top-slider-item-wrap">
	    <a href="<?php bloginfo('url'); ?>/interview/197/">
	      <div class="header-thumb">
	        <img src="<?php echo get_the_post_thumbnail_url( 197 ); ?>" alt="" style="width: unset;">
	      </div>
	      <div class="caption-box">
	        <p class="caption"><?php echo get_the_title( 197 ); ?></p>
	      </div>
	    </a>
	  </div>
	  <div class="top-slider-item-wrap">
	    <a href="<?php bloginfo('url'); ?>/interview/3766/">
	      <div class="header-thumb">
	        <img src="<?php echo get_the_post_thumbnail_url( 3766 ); ?>" alt="" style="width: unset;">
	      </div>
	      <div class="caption-box">
	        <p class="caption"><?php echo get_the_title( 3766 ); ?></p>
	      </div>
	    </a>
	 </div>
	</div>
	<div class="header-edge">
    <img src="<?php bloginfo('template_directory'); ?>/images/common/marketics_key_btm_f8f8f8.png" alt="" />
	</div>
</div>
<div class="container">
  <div class="contents">

<section class="top-section top-interview">
  <div class="cat_name_heading _interview">
     <a href="<?php bloginfo('url'); ?>/interview/"><h1>Interview</h1>
    <p>インタビュー</p></a>
  </div>
<?php
  $arg = array(
    'posts_per_page' => 6, // 表示する件数
    'orderby' => 'date', // 日付でソート
    'order' => 'DESC', // DESCで最新から表示、ASCで最古から表示
    'category_name' => 'interview' // 表示したいカテゴリーのスラッグを指定
  );
  $posts = get_posts( $arg );
  if( $posts ):
?>
  <ul class="top-archive _interview">
  <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
    <li class="top-archive-item">
      <a href="<?php the_permalink(); ?>">
        <div class="top-archive-thumb">
          <div class="media-inner">
          <?php
            if (has_post_thumbnail()){
              the_post_thumbnail( 'large' );
            } else {
              /* アイキャッチ無い場合の画像 */
            }
          ?>
          </div>
        </div>
        <div class="top-archive-meta">
          <p class="title"><?php the_title(); ?></p>
          <p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php
  endif;
  wp_reset_postdata();
?>
  <div class="section-button _interview">
    <a href="<?php bloginfo('url'); ?>/interview/">インタビュー記事一覧</a>
  </div>
</section>

<section class="top-section top-event-report bg-stripe">
  <div class="cat_name_heading _event-report">
    <a href="<?php bloginfo('url'); ?>/event-report/">
      <h1>Event Report</h1>
      <p>イベントレポート</p>
    </a>
  </div>
<?php
  $arg = array(
    'posts_per_page' => 4, // 表示する件数
    'orderby' => 'date', // 日付でソート
    'order' => 'DESC', // DESCで最新から表示、ASCで最古から表示
    'category_name' => 'event-report' // 表示したいカテゴリーのスラッグを指定
  );
  $posts = get_posts( $arg );
  if( $posts ):
?>
  <ul class="top-archive _event-report">
  <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
    <li class="top-archive-item">
      <a href="<?php the_permalink(); ?>">
        <div class="top-archive-thumb">
          <div class="media-inner">
          <?php
            if (has_post_thumbnail()){
              the_post_thumbnail( 'large' );
            } else {
              /* アイキャッチ無い場合の画像 */
            }
          ?>
          </div>
        </div>
        <div class="top-archive-meta">
          <p class="title"><?php the_title(); ?></p>
          <p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php 
  endif;
  wp_reset_postdata();
?>
  <div class="section-button _event-report">
    <a href="<?php bloginfo('url'); ?>/event-report/">イベントレポート記事一覧</a>
  </div>
</section>

<section class="top-section top-marketing">
  <div class="cat_name_heading _marketing">
    <a href="<?php bloginfo('url'); ?>/marketing/">
      <h1>Marketing</h1>
      <p>マーケティングに関わる記事</p>
    </a>
  </div>
<?php
  $arg = array(
    'posts_per_page' => 6, // 表示する件数
    'orderby' => 'date', // 日付でソート
    'order' => 'DESC', // DESCで最新から表示、ASCで最古から表示
    'category_name' => 'marketing' // 表示したいカテゴリーのスラッグを指定
  );
  $posts = get_posts( $arg );
  if( $posts ):
?>
  <ul class="top-archive _marketing">
  <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
    <li class="top-archive-item">
      <a href="<?php the_permalink(); ?>">
        <div class="top-archive-thumb">
          <div class="media-inner">
          <?php
            if (has_post_thumbnail()){
              the_post_thumbnail( 'large' );
            } else {
              /* アイキャッチ無い場合の画像 */
            }
          ?>
          </div>
        </div>
        <div class="top-archive-meta">
          <p class="title"><?php the_title(); ?></p>
          <p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php
  endif;
  wp_reset_postdata();
?>
  <div class="section-button _marketing">
    <a href="<?php bloginfo('url'); ?>/marketing/">マーケティング記事一覧</a>
  </div>
</section>

<section class="top-section top-library bg-stripe">
  <div class="cat_name_heading _library">
    <a href="<?php bloginfo('url'); ?>/library/">
      <h1>Library</h1>
      <p>ライブラリ</p>
    </a>
  </div>
<?php
  $arg = array(
    'posts_per_page' => 4, // 表示する件数
    'orderby' => 'date', // 日付でソート
    'order' => 'DESC', // DESCで最新から表示、ASCで最古から表示
    'category_name' => 'library' // 表示したいカテゴリーのスラッグを指定
  );
  $posts = get_posts( $arg );
  if( $posts ):
?>
  <ul class="top-archive _library">
  <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
    <li class="top-archive-item">
      <a href="<?php the_permalink(); ?>">
        <div class="top-archive-thumb">
          <div class="media-inner">
          <?php
            if (has_post_thumbnail()){
              the_post_thumbnail( 'large' );
            } else {
              /* アイキャッチ無い場合の画像 */
            }
          ?>
          </div>
        </div>
        <div class="top-archive-meta">
          <p class="title"><?php the_title(); ?></p>
          <p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php
  endif;
  wp_reset_postdata();
?>
  <div class="section-button _library">
    <a href="<?php bloginfo('url'); ?>/library/">特集記事一覧</a>
  </div>
</section>

<section class="top-section top-information">
  <div class="cat_name_heading _information">
    <a href="<?php bloginfo('url'); ?>/event-report/">
      <h1>Information</h1>
      <p>Marketicsからのお知らせ</p>
    </a>
  </div>

<?php
  $arg = array(
    'posts_per_page' => 2, // 表示する件数
    'orderby' => 'date', // 日付でソート
    'order' => 'DESC', // DESCで最新から表示、ASCで最古から表示
    'category_name' => 'information' // 表示したいカテゴリーのスラッグを指定
  );
  $posts = get_posts( $arg );
  if( $posts ):
?>

  <ul class="top-archive _information">
  <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>
    <li class="top-archive-item">
      <a href="<?php the_permalink(); ?>">
        <div class="top-archive-thumb">
          <div class="media-inner">
          <?php
            if (has_post_thumbnail()){
              the_post_thumbnail( 'large' );
            } else {
              /* アイキャッチ無い場合の画像 */
            }
          ?>
          </div>
        </div>
        <div class="top-archive-meta">
          <p class="title"><?php the_title(); ?></p>
          <p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
        </div>
      </a>
    </li>
  <?php endforeach; ?>
  </ul>
<?php
  endif;
  wp_reset_postdata();
?>
  <div class="section-button _information">
    <a href="<?php bloginfo('url'); ?>/category/information/">お知らせ記事一覧</a>
  </div>
</section>

<section class="top-section top-ebook">
  <div class="ebook-bg">
      <div class="ebook-bg-trim">
        <img class="ebook-bg-img" src="<?php bloginfo('template_directory'); ?>/images/common/ebook-bg.png" alt="" />
      </div>
  </div>
  <div class="cat_name_heading _ebook">
    <h1>Free Marketing ebooks</h1>
    <p>マーケティング関連の無料ebook</p>
  </div>
  <div class="archive-item _ebook" >
    <div class="ebook-content">
      <?php 
        $ebookurl = "https://bdash-marketing.com/downloadlist/";
        $ebookA   = $ebookurl ."marketing-trend/wpdl_spj_the-winning-method_apparel-ec/";
        $ebookB   = $ebookurl ."market_report/wpdl_mkt-measure-collection_sgit_e-shpg/";
        $ebookC   = $ebookurl ."market_report/wpdl_makaibo_new/";
        $ebookD   = $ebookurl ."market_report/wpdl_omni-channel_front-line_vol2/";
        $ebookE   = $ebookurl ."marketing-trend/wpdl_spj_the-winning-method_apparel-ec/";
        $ebookF   = $ebookurl ."market_report/wpdl_mkt-measure-collection_sgit_e-shpg/";
      ?>
      <div class="whitepaper _01">
        <a href="<?php echo $ebookA; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/common/Cover_ApparelEC-Winning-Method.png" alt="新・アパレルECの勝ち方" class="" /><br />
          <p>新・アパレルECの勝ち方</p>
        </a>
      </div>
      <div class="whitepaper _02">
        <a href="<?php echo $ebookB; ?>">
        <img src="<?php bloginfo('template_directory'); ?>/images/common/Cover_MA_tanpin_EC.png" alt="業界別MA施策31選「単品通販型ビジネス編」" class="" /><br />
          <p>業界別MA施策31選<br>単品通販型ビジネス編</p>
        </a>
      </div>
      <div class="whitepaper _03">
        <a href="<?php echo $ebookC; ?>">
          <img src="<?php bloginfo('template_directory'); ?>/images/common/Cover_MA-Kaibo.png" alt="マーケティングオートメーション徹底解剖" class="" /><br />
          <p>MA徹底解剖</p>
        </a>
      </div>
      <div class="whitepaper _04">
        <a href="<?php echo $ebookD; ?>">
          <img src="<?php bloginfo('template_directory'); ?>/images/common/Cover_Omni_ch_FrontLine_vol2.png" alt="本当は教えたくないオムニチャネル最前線 Vol.2" class="" /><br />
          <p>本当は教えたくない<br>オムニチャネル最前線 2</p>
        </a>
      </div>
      <div class="whitepaper _05">
        <a href="<?php echo $ebookE; ?>">
          <img src="<?php bloginfo('template_directory'); ?>/images/common/Cover_ApparelEC-Winning-Method.png" alt="新・アパレルECの勝ち方" class="" /><br />
          <P>新・アパレルECの勝ち方</P>
        </a>
      </div>
      <div class="whitepaper _06">
        <a href="<?php echo $ebookF; ?>">
          <img src="<?php bloginfo('template_directory'); ?>/images/common/Cover_MA_tanpin_EC.png" alt="業界別MA施策31選「単品通販型ビジネス編」" class="" /><br />
          <p>業界別MA施策31選<br>単品通販型ビジネス編</p>
        </a>
      </div>

    </div>
  </div>
  <div class="section-button _ebook">
    <a href="<?php echo $ebookurl; ?>">ebook一覧ページ</a>
  </div>

</section>

  </div><!-- /.contents -->
</div><!-- /.container -->
<?php get_footer(); ?>
