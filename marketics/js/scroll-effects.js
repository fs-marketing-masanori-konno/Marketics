(function() {
  $(function() {
    var target, targetHeight, targetTop, relativePosition, atcMid, atcMidHeight, atcMidTop, atcMidCancel, sideRec, sideRecHeight, sideMidTop;
    //SNSシェアボタン
      target = $(".itemfixed");
      targetFix = $(".itemfixed.fixed");
      targetHeight = target.outerHeight(true);
      targetTop = target.offset().top;
    //固定元relative位置
      relativePosition = $(".article-content").offset().top;
    //記事全体の解除位置
      atcFull = $(".article-body");
      atcFullHeight = atcFull.outerHeight(true); 
      atcFullTop = atcFull.offset().top;
      atcFullCancel = atcFullTop + atcFullHeight;
    //最新記事
      sideRec = $(".article-ranking");
      sideRecHeight = sideRec.outerHeight(true);
      sideRecTop = sideRec.offset().top;

    return $(window).scroll(function() {
      var scrollTop, scrollHeight, scrollBottom, cancellation;
        scrollTop = $(this).scrollTop();
        scrollHeight = target.height(); 
        cancellation = $("#itemfixedcancel");
        scrollBottom = cancellation.offset().top;

    //SNSシェアボタン
      if (scrollTop > targetTop - 240 ) {  //targetの位置が固定位置よりも小さいとき
        if (scrollTop < scrollBottom - 240 ) {  //固定位置を超えたら
          target.addClass("fixed");
          target.css("position", "fixed");
          target.css("top", "40px");
          if (window.matchMedia( '(max-width: 480px)' ).matches) {　
          	target.fadeIn(650).queue(function(next) {
	          	targetFix.fadeOut(650);
					    next();
						});
	        }
        } else {
          if (window.matchMedia( '(max-width: 480px)' ).matches) {　
        		targetFix.fadeOut(650);
	          target.fadeIn(650).queue(function(next) {;
					    next();
						});
        	}
          target.removeClass("fixed");  //解除位置を超えたら
          target.css("position", "absolute");
          target.css("top", scrollBottom - relativePosition - 20);
        }
      } else { //targetの位置が固定位置よりも大きいとき
        target.removeClass("fixed");
        target.css("position", "static");
        target.css("top", "auto");
      }
    //サイドバー
      if (scrollTop > targetTop - 120 ) {
        if (scrollTop < scrollBottom - 120 ) {
          sideRec.css("position", "fixed");
          sideRec.css("top", "120px");
        } else {
          sideRec.css("position", "absolute");
          sideRec.css("top", scrollBottom - relativePosition - 80);
        }
      } else {
        sideRec.css("position", "static");
        sideRec.css("top", "auto");
        sideRec.css("width", "65px");
      }
    });
  });
}).call(this);

$(function(){
    var page, speed, href, target, scrolled, position, topBtn;
// スムーススクロール
  $('a[href^="#"]').click(function(){
    page = $('html,body');  // ページ包含要素（スムーススクロールさせる対象要素）
    speed = 500;
    href= $(this).attr("href");
    target = $(href == "#" || href == "" ? 'html' : href);
    scrolled = $('#pagetop').offset().top; // ページの包含要素のスクロール量を取得
    position = target.offset().top - scrolled;

    page.animate({scrollTop:position}, speed, "swing");
    return false;
    });

  $(window).scroll(function () {
    topBtn = $('a[href^="#"]');
      if ($(this).scrollTop() > 5000) { // スクロールしてフェードイン
          topBtn.fadeIn(650);
      } else {
          topBtn.fadeOut(650);
      }

  });
  
});