<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en">
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
   <script>
       site_url = base_url = '<?php echo $this->config->base_url();?>';
   </script>
    <meta charset="UTF-8">
    <title><?php echo isset($title_for_layout) ? $title_for_layout : ''; ?></title>
    <meta name="description" content="<?php echo isset($desc_for_layout) ? $desc_for_layout : ''; ?>" />
    <meta name="keywords" content="<?php echo isset($keyword_for_layout) ? $keyword_for_layout : ''; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Zell V Việt Nam">

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo isset($title_for_layout) ? $title_for_layout : ''; ?>" />
    <meta property="og:description" content="<?php echo isset($desc_for_layout) ? $desc_for_layout : ''; ?>" />
    <meta property="og:url" content="<?php echo curPageURL();?>" />
    <meta property="og:site_name" content="Zell V Việt Nam" />


	<base href= "<?php echo $this->config->base_url()?>"/>
    <!-- CSS Bootstrap & Custom -->
    <?php

        assets_css(
            array(
                "css/mCustomScrollbar.min.css",
                "css/bootstrap.css",
                "css/form.css",
                "css/sprite.css",
                "css/owl.carousel.css",
                "css/animate.css",
                "css/content.css",
                "css/responsive.css",
                "css/flexslider.css",
                "lib/fancybox/source/jquery.fancybox.css?v=2.1.5"
            ),
            array('media' => 'screen')
        );
    ?>

    <!-- Favicons -->

    <link rel="shortcut icon" href="<?php assets_base_url('images/ico/favicon.png')?>"/>
    <link rel="apple-touch-icon" href="<?php assets_base_url('images/ico/apple-touch-icon.png.png')?>"/>

    


    <!-- JavaScripts -->
    <?php
        assets_js(
            array(
                "js/jquery.js",
                "js/jquery-ui.min.js",
                "js/jquery.js",
                "js/bootstrap.js",
                "js/slimscroll.js",
                "js/aw-showcase.js",
                "js/owl.carousel.js",
                "js/style.js",
                "js/mCustomScrollbar.min.js",
                "js/jquery.flexslider.js",
                "lib/fancybox/source/jquery.fancybox.js?v=2.1.5",
                "lib/fancybox/source/jquery.fancybox.pack.js?v=2.1.5",
            ),
            array()

        );
    ?>
    <?php echo isset($css_for_layout) ? $css_for_layout : '';?>
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
    </div>
    <![endif]-->
	
    <?php echo isset($js_for_layout) ? $js_for_layout : '';?>
	<?php echo isset($js_for_layout1) ? $js_for_layout1 : '';?>
	<?php echo isset($js_for_layout2) ? $js_for_layout2 : '';?>
	<?php echo isset($js_for_layout3) ? $js_for_layout3 : '';?>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=864593606900071";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


    <?php echo isset($content_for_layout) ? $content_for_layout : ''; ?>

<script>
$(document).ready(function(){
	$(window).scroll(function(){
		el = $('.go-top');
		if($(window).scrollTop() == 0){
			el.stop().animate({right:-70},400);
		}else{
			el.stop().animate({right:20},400);
		}
	});

	$('.go-top').mousedown(function(){
		$(this).css({"width":"55px","height":"55px"});
	});
	$('.go-top').mouseup(function(){
		$(this).css({"width":"60px","height":"60px"});
		$('body,html').animate({scrollTop:0},500);
	});
});
</script>
<style>
.go-top{
	outline:none;
	border-radius: 3px;
    box-shadow: 0 0 3px rgba(0,0,0,0.2);
    width: 60px;
    height: 60px;
    background: url(publics/template/default/images/go_top.png) no-repeat center center #1871BB;
    display: block;
    position: fixed;
    bottom: 20px;
    right: -70px;
    z-index: 20;
    cursor: pointer;
    border: none;
}
</style>
<button class="go-top" id = "back-top"></button>
</body>
<?php echo isset($js_for_footer) ? $js_for_footer : '';?>

</html>