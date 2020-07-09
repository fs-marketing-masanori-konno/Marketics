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