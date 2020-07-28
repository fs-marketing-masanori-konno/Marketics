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
          <span class="icon-search">検 索</span>
      </button>
    </div>
    <div class="header-search-close js-header-search-btn">
      <div class="icon-close">
        <img src="<?php bloginfo('template_directory'); ?>/images/common/close-icon.svg">
      </div>
    </div>
  </div>
</form>
<script>
  $('.l-left .func-search-icon').on("click", function(){
    $('.js-search-window').addClass('search-open');
    $('.header-logo').addClass('logo-hide');
    $('.hamburger').addClass('logo-hide');
    $('.js-header-navi').addClass('header-navi-hide').delay(300).css('display', 'none');
    $('.gloval-menu .func-search-icon').delay(300).css('display', 'none');
    $('.gloval-menu .search-box').delay(300).css('display', 'block')
    $('.gloval-menu .search-window').delay(1000).css('display', 'flex');
  });
  $('.gloval-menu .header-search-close').on('click', function(){
    $('.js-search-window').removeClass('search-open');
    $('.header-logo').removeClass('logo-hide');
    $('.hamburger').removeClass('logo-hide');
    $('.js-header-navi').removeClass('header-navi-hide').delay(300).css('display', 'block');
    $('.gloval-menu .func-search-icon').delay(300).css('display', 'block');
    $('.gloval-menu .search-box').delay(300).css('display', 'none');
    $('.gloval-menu .search-window').delay(1000).css('display', 'none');
  });
</script>