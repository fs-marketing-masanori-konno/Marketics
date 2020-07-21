<form method="get" class="searchform js-search-window" action="/" autocomplete="off">
  <?php $search_query  = get_search_query(); ?>
  <div class="func-search-icon"><img src="<?php bloginfo('template_directory'); ?>/images/common/search-icon.svg"></div>
  <div class="search-window">
  	<div class="search-box">
      <span class="header-search-box-icon icon-search">
        <img src="<?php bloginfo('template_directory'); ?>/images/common/search-icon.svg">
      </span>
  		<input type="text" placeholder="記事やキーワードを検索" name="s" class="searchfield js-search-box-input" value="<?php echo $search_query; ?>" autocomplete="off" />
  		<input type="submit" value="" alt="検索" title="検索" class="searchsubmit">
      <button class="header-search-box-submit" type="submit">
          <span class="icon-search">検索</span>
      </button>
    </div>
    <div class="header-search-close js-header-search-btn">
      <div class="icon-close">
        <img src="<?php bloginfo('template_directory'); ?>/images/common/search-icon.svg">
      </div>
    </div>
  </div>
</form>
<script>
  $('.l-left .func-search-icon').on("click", function(){
    $('.js-search-window').addClass('search-open');
    $('.js-header-navi').addClass('header-navi-hide');
    $(this).css('display', 'none');
    $('.gloval-menu .header-search-close').css('display', 'block').css('opacity', '1');
  });
  $('.gloval-menu .header-search-close').on('click', function(){
    $('.js-search-window').removeClass('search-open');
    $('.js-header-navi').removeClass('header-navi-hide');
    $('.l-left .func-search-icon').css('display', 'block');
    $(this).css('display', 'none').css('opacity', '0');
  });
</script>