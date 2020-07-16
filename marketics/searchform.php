<form method="get" class="searchform js-search search-open" action="/" autocomplete="off">
  <?php $search_query  = get_search_query(); ?>
	<div class="search-box">
        <span class="header-search-box-icon icon-search"></span>
		<input type="text" placeholder="記事やキーワードを検索" name="s" class="searchfield js-search-box-input" value="<?php echo $search_query; ?>" autocomplete="off" />
		<input type="submit" value="" alt="検索" title="検索" class="searchsubmit">
        <button class="header-search-box-submit" type="submit">
            <span class="icon-search">検索</span>
        </button>
        <div class="header-search-button">
          <div class="header-search-icon">
            <span class="icon-search"></span>
          </div>
          <div class="header-search-close js-header-search-btn">
            <span class="icon-close"></span>
          </div>
        </div>
    </div>
</form>

