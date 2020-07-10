<div id="" class="sidebar-fixed">
<aside id="sidebar" class="sidebar">
  <div class="sidebar-inner">

    
  <div class="sidebar-list article-ranking">
    <div class="side-heading">Latest Articles <p>- 最新記事</p></div>
      <div class="side-wrap">
      <?php
        $the_query = new WP_Query( array(
            //'post_type' => $post_type,
            'post_type' => 'post',
            'tax_query' => array( // interviewは除外
            array(
              'taxonomy' => 'category',
              'field' => 'slug',
              'terms' => array('interview','b-academy','words'),
              'operator'  => 'NOT IN'
            )
          ),
          'posts_per_page' => 5
        ));
        if ($the_query->have_posts()) :
      ?>
      <ul class="side-list">
        <?php
        while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <li class="side-item cf">
          <div class="side-thumb">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'article-thumb' ); ?></a>
          </div>
          <div class="side-content">
            <p class="archive-date"><time datetime="<?php echo get_the_time( 'Y-m-d' ); ?>"><?php echo the_date( 'Y/m/d' ); ?></time></p>
            <h3 class="side-title">
              <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
              </a>
            </h3>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php else: ?>
      <p>記事がありません</p>
      <?php endif; ?>
      <?php wp_reset_postdata();?>
    </div>
  </div>

  </div><!-- /.sidebar-inner -->
</aside>
</div>
