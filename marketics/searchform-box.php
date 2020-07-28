<form method="get" class="searchform js-search-window" action="/" autocomplete="off">
  <?php $search_query  = get_search_query(); ?>
  <div class="func-search-icon"><img src="<?php bloginfo('template_directory'); ?>/images/common/search-icon.svg"></div>
  <div class="search-window" style="display: none;">
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
        <img src="<?php bloginfo('template_directory'); ?>/images/common/close-icon.svg">
      </div>
    </div>
  </div>
</form>
