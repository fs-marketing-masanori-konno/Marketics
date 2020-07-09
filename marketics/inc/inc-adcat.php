<?php
  //広告カテゴリの読み込み
  $terms = get_the_terms($post->ID,'adcat');
  foreach( $terms as $term ) {
    $adcaturl = get_field('adcat-url','adcat_'.$term->term_id);
    $adcatimg = get_field('adcat-img','adcat_'.$term->term_id);
  }
?>
<?php if( !empty($adcatimg) ): ?>
<div class="adcat-area"><a href="<?php echo $adcaturl; ?>" target="_blank"><div class="imgads-wrap"><img class="size-full _ads" src="<?php echo $adcatimg['url']; ?>" alt="<?php echo $image['alt']; ?>" /><span class="txt-normal">【Ads by b→dash】<i class="fas fa-external-link-alt"></i></span><span class="txt-hover">【Read more】<i class="fas fa-external-link-alt"></i></span></div></a></div>
<?php endif; ?>
