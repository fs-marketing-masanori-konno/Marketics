<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/marketics.css?<?php echo date('YmdHi'); ?>" media="screen,print">
<?php if(is_front_page()){ ?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/front-page.css?<?php echo date('YmdHi'); ?>" media="screen,print">
<?php }elseif(is_single()){ ?>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/single.css?<?php echo date('YmdHi'); ?>" media="screen,print">
<?php }elseif(is_category()){ ?>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/category.css?<?php echo date('YmdHi'); ?>" media="screen,print">
<link href="https://fonts.googleapis.com/css?family=Quicksand:700&display=swap" rel="stylesheet">
<?php } ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="https://use.typekit.net/uau4isq.css">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-2.2.4.min.js"></script>
<?php if(!is_front_page()){ ?>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/themes/marketics/js/scroll-effects.js"></script>
<script type="text/javascript" src="<?php bloginfo('url'); ?>/wp-content/themes/marketics/js/common.js"></script>
<?php } ?>
<script>
	(function(d) {
		var config = {
			kitId: 'oyw1trt',
			scriptTimeout: 3000,
			async: true
		},
		h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
	})(document);
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-58579585-4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-58579585-4');
</script>

<!-- <script>
(function(){

		//var menuHeight = $(".intro-header").height() + 15;
		var menuHeight = 85;
		var vw = $(window).width();
		$(window).resize(function(){
			var vw = $(window).width();
		});
		var mvend = vw*0.2;
		var startPos = 0;
		$(window).scroll(function(){
			var currentPos = $(this).scrollTop();
			if (currentPos > startPos) {
				if($(window).scrollTop() >= mvend) {
					// $(".intro-header").css("top", "-" + menuHeight + "px");
					$(".header-inner").addClass('hide');
				}
			} else if(currentPos < startPos) {
				//$(".intro-header").css("top", 0 + "px");
				// $(".intro-header").css("top", 2 + "vw");
				$(".header-inner").removeClass('hide');
			}
			startPos = currentPos;
		});
	})();
</script> -->

<link type="image/ico" rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/common/favicon.ico">
</head>
<body <?php body_class(); ?>>
<header>
	<div class="header-inner">
		<div class="l-header-inner">
			<div class="l-header-content">
				<div class="header-logo" id="pagetop"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/common/logo.png" alt="<?php bloginfo('name'); ?>" class="logo" /></a></div>
				<nav class="global-nav global-nav__list"　id="glonav">
					<div class="l-left">
						<ul class="glonav">
							<li class="global-nav__item" itemprop="hasPart" itemscope ><a itemprop="url" href="<?php bloginfo('url'); ?>/interview/">
								<span class="nav-txt-en" itemprop="name">Interview</span><span class="nav-txt-jp">インタビュー</span></a></li>
							<li class="global-nav__item" itemprop="hasPart" itemscope ><a itemprop="url" href="<?php bloginfo('url'); ?>/event-report/">
								<span class="nav-txt-en" itemprop="name">Event report</span><span class="nav-txt-jp">イベントレポート</span></a></li>
							<li class="global-nav__item" itemprop="hasPart" itemscope ><a itemprop="url" href="<?php bloginfo('url'); ?>/library/">
								<span class="nav-txt-en" itemprop="name">Library</span><span class="nav-txt-jp">ライブラリ</span></a></li>
							<li class="global-nav__item" itemprop="hasPart" itemscope ><a itemprop="url" href="<?php bloginfo('url'); ?>/marketing/">
								<span class="nav-txt-en" itemprop="name">Marketing</span><span class="nav-txt-jp">マーケティング</span></a></li>
							<li class="global-nav__item" itemprop="hasPart" itemscope ><a itemprop="url" href="<?php bloginfo('url'); ?>/information/">
								<span class="nav-txt-en" itemprop="name">Information</span><span class="nav-txt-jp">インフォメーション</span></a></li>
						</ul>
						<div class="searchform-box"><?php get_search_form(); ?></div>
					</div>
					<div class="l-right _nav">
						<div class="subnav l-right">
							<div class="intro-nav-btn intro-nav-btn-mailmz" itemprop="hasPart" itemscope itemtype="http://schema.org/ContactPage">
								<a itemprop="url" href="https://bdash-marketing.com/mailmz/"><img class="txt_img" src="<?php bloginfo('template_directory'); ?>/images/common/nav_mailmz_txt.png" alt="メルマガ登録"><span class="txt_html" itemprop="name">メルマガ登録</span></a>
							</div>
							<div class="intro-nav-btn intro-nav-btn-contact" itemprop="hasPart" itemscope itemtype="http://schema.org/ContactPage">
								<a itemprop="url" href="https://bdash-marketing.com/req_material/"><img class="txt_img" src="<?php bloginfo('template_directory'); ?>/images/common/nav_contact_txt.png" alt="お問い合わせ"><span class="txt_html" itemprop="name">お問い合わせ</span></a>
							</div>
						</div>
					</div>
				</nav>
			</div>
			<div class="hamburger" id="js-hamburger">
				<span class="hamburger__line hamburger__line--1"></span>
				<span class="hamburger__line hamburger__line--2"></span>
				<span class="hamburger__line hamburger__line--3"></span>
			</div>
			<div class="black-bg" id="js-black-bg"></div>
		</div>
	</div><!--end header-inner-->
</header>

<script>
function toggleNav() {
	var body = document.body;
	var hamburger = document.getElementById('js-hamburger');
	var blackBg = document.getElementById('js-black-bg');

	hamburger.addEventListener('click', function() {
		body.classList.toggle('nav-open');
	});
	blackBg.addEventListener('click', function() {
		body.classList.remove('nav-open');
	});
}
toggleNav();
</script>
<!-- nav color -->
<script>
	    $('.glonav li a').each(function(){
				    var $currentURL = location.pathname.split("/")[1];
						var $href   = $(this).attr("href").split("/")[3];
						if( $currentURL == $href ){
				      $(this).addClass("active");
						} else {
                $(this).removeClass('active');
            }
		  });
</script>


