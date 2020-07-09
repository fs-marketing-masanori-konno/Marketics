(function() {
	$(function() {
		var target, targetHeight, targetTop, relativePosition, atcMid, atcMidHeight, atcMidTop, atcMidCancel, sideRec, sideRecHeight, sideMidTop;
    //SNSシェアボタン
  		target = $(".itemfixed");
  		targetHeight = target.outerHeight(true);
  		targetTop = target.offset().top;
    //固定元relative位置
      relativePosition = $(".article-content").offset().top;
    //記事中盤の解除位置
    // atcMid = $(".article-body");
    // atcMidHeight = atcMid.outerHeight(true) / 2; //中盤
    //記事全体の解除位置
      atcFull = $(".article-body");
      atcFullHeight = atcFull.outerHeight(true); 
      atcFullTop = atcFull.offset().top;
      atcFullCancel = atcFullTop + atcFullHeight;
    //最新記事
      sideRec = $("._article-ranking");
      sideRecHeight = sideRec.outerHeight(true);
      sideRecTop = sideRec.offset().top;
    //POPULAR
    // sidePop = $(".article-popular");
    // sidePopHeight = sidePop.outerHeight(true);
    // sidePopTop = sidePop.offset().top;

		return $(window).scroll(function() {
			var scrollTop, scrollHeight, scrollBottom, cancellation;
		    scrollTop = $(this).scrollTop();
        scrollHeight = target.height(); 
        cancellation = $("#itemfixedcancel");
        scrollBottom = cancellation.offset().top;


			//SNSシェアボタン
      //targetTopの位置がscrollTop(固定位置)よりも小さいとき
			if (scrollTop > targetTop - 240 ) {
        if (scrollTop < scrollBottom - 240 ) {
          target.addClass("fixed");
          target.css("position", "fixed");
          target.css("top", "240px");
        } else {
          //scrollTopの位置がscrollBottom(解除位置)を超えたら
          target.removeClass("fixed");
          target.css("position", "absolute");
          target.css("top", scrollBottom - relativePosition - 1);
        }
			} else {
				target.removeClass("fixed");
				target.css("position", "static");
				target.css("top", "auto");
			}
      //サイドバー
      if (scrollTop > targetTop - 220 ) {
        if (scrollTop < scrollBottom - 220 ) {
          //sideRec
          sideRec.css("position", "fixed");
          sideRec.css("top", "120px");

          //sidePop
          // sidePop.css("position", "fixed");
          // sidePop.css("top", sideRecHeight + 100);

      // } else if (scrollTop >= atcMidCancel 
      //            && scrollTop < atcMidCancel + sideRecHeight ) {
      //   //sideRec
      //   sideRec.css("position", "absolute");
      //   sideRec.css("top", atcMidCancel + 100);
          //sidePop
          // sidePop.css("position", "absolute");
          // sidePop.css("top", atcMidCancel + sideRecHeight + 100);
      // } else if (scrollTop >= atcMidCancel + sideRecHeight 
      //           && scrollTop < scrollBottom - 120 ) {
      //   //sideRec
      //   sideRec.css("position", "fixed");
      //   sideRec.css("top", 100 - sideRecHeight);
          //sidePop
          // sidePop.css("position", "fixed");
          // sidePop.css("top", "100px");
        } else {
          //sideRec
          sideRec.css("position", "absolute");
          sideRec.css("top", scrollBottom - relativePosition - 86);
          //sidePop
          // sidePop.css("position", "absolute");
          // sidePop.css("top", scrollBottom -20);
        }
			} else {
				//sideRec
				sideRec.css("position", "static");
				sideRec.css("top", "auto");
        sideRec.css("width", "65px");
        //sidePop
				// sidePop.css("position", "static");
				// sidePop.css("top", "auto");
        // sidePop.css("width", "270px");
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