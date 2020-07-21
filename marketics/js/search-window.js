(function() {
	$('.js-search-window').on('click', function(){
		alert('クリックイベント開く');
		$(this).addClass('search-open');
		$('.js-header-navi').addClass('header-navi-hide');
	});
	$('.js-search-window').on('click', function(){
		alert('クリックイベント閉じる');
		$(this).addClass('search-open');
		$('.js-header-navi').addClass('header-navi-hide');
	});
});