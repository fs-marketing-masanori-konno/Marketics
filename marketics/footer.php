<footer id="footer" class="footer">
<?php if ( !is_page_template( array() ) ) { ?><?php } ?>
  <div class="footer-nav">
    <ul>
      <li><a href="<?php bloginfo('url'); ?>/interview/">
        <span class="nav-txt-en">Interview</span><span class="nav-txt-jp">インタビュー</span></a></li>

      <li><a href="<?php bloginfo('url'); ?>/event-report/">
        <span class="nav-txt-en">Event report</span><span class="nav-txt-jp">イベントレポート</span></a></li>

      <li><a href="<?php bloginfo('url'); ?>/library/">
        <span class="nav-txt-en">Library</span><span class="nav-txt-jp">ライブラリ</span></a></li>

      <li><a href="<?php bloginfo('url'); ?>/marketing/">
        <span class="nav-txt-en">Marketing</span><span class="nav-txt-jp">マーケティング</span></a></li>

      <li><a href="<?php bloginfo('url'); ?>/information/">
        <span class="nav-txt-en">Information</span><span class="nav-txt-jp">インフォメーション</span></a></li>

      <!-- <li><a href="<?php bloginfo('url'); ?>/security/">Research</a></li> -->
    </ul>
  </div><!-- /.footer-nav -->
  <div class="footer-credit">
    <div class="footer-logo">
      <div class="footer-siteid">
        <a class="footer-siteid-logo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/common/logo_bl.png" alt="b→dash"></a> presented by <a class="footer-siteid-textlink" href="https://f-scratch.co.jp/" target="_blank">from scratch</a>
      </div>
    </div>
    <p class="copyright">&copy;<?php echo the_date('Y'); ?> from scratch Co.Ltd.</p>
  </div><!-- /.footer-credit -->
</footer>

<script>
$('li,label,.section-button,.archive-item',).bind({
    /* タッチの開始、マウスボタンを押したとき */
    'touchstart': function(e) {
    $(this).addClass( 'is-touch' );
    },
    /* タッチの終了、マウスのドラッグの終了 */
    'touchend': function(e) {
    $(this).removeClass( 'is-touch' );
    }
});
</script>
<!-- nav color -->
<script>
      $('.footer-nav ul li a').each(function(){
            var $currentURL = location.pathname.split("/")[1];
            var $href   = $(this).attr("href").split("/")[3];
            if( $currentURL == $href ){
              $(this).addClass("active");
            } else {
                $(this).removeClass('active');
            }
      });
</script>

<?php wp_footer(); ?>

<?php if(is_front_page()){ ?>
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/themes/marketics/js/marketics-slick.js"></script>
<script type="text/javascript">
jQuery(function() {
   jQuery('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.top-slide'
  });
  jQuery('.top-slide').slick({
    autoplay: true,
    autoplaySpeed: 5900,
    centerMode: true,
    speed: 500,
    dots: true,
    variableWidth: true,
    slidesToShow: 3,
    asNavFor: '.slider-for',
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: true,
          pauseOnHover: false,
          pauseOnFocus: false,
          swipe: true,
          swipeToSlide: true,
          pauseOnDotsHover: false,
          centerMode: true,
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: true,
          centerMode: true,
          mobileFirst: false,
          infinite: true,
          slidesToShow: 1
        }
      }
    ]
  });
});
</script>
<?php } ?>
<?php if(!is_home()) { ?>
<div id="fb-root"></div>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v5.0"></script> -->

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.async = true;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8&appId=402529410110731";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>
</body>
</html>
