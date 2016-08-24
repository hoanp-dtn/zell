<!DOCTYPE html>
<html>
<head>
<title>UTT - Page Not Found</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<?php 
		if(ENVIRONMENT == 'development'){
		?>
		<div id="container">
			<h1><?php echo $heading; ?></h1>
			<?php echo $message; ?>
		</div>
		<?php
		}else{
		?>
   <link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url');?>publics/admin/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url');?>publics/teacher/css/style.css">
   <script>
       site_url = base_url = '<?php echo config_item('base_url');?>teacher.php';
   </script>
   <script type="text/javascript" src="<?php echo config_item('base_url');?>publics/admin/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<body id="top" class="home blog">
    <div class="wrapper-outer"> <div class="background-cover"></div>
  <div id="wrapper" class="boxed-all">
    <div class="inner-wrapper">
		<header id="theme-header" class="theme-header" style="margin-top:0;">
			<div class="header-content">
				<a id="slide-out-open" class="slide-out-open" href="#"><span></span></a>
				<div class="logo">
					<h1>
						<a title="Trường Đại Học Công Nghệ Giao Thông Vận Tải" href="<?php echo config_item('base_url');?>">
							<img src="<?php echo config_item('base_url');?>publics/teacher/css/images/logo.png" alt="Trường Đại Học Công Nghệ Giao Thông Vận Tải">
						</a>
					</h1>			
				</div><!-- .logo /-->
				<div class="e3lan e3lan-top">
				<!--
				<a href="<?php echo config_item('base_url');?>/vn"><img src="http://127.0.0.1/utt/publics/template/default/images/vietnamese.gif"></a><a style="color: #fff" href="http://127.0.0.1/utt/vn">Tiếng Việt</a><span style="color: #2685A7;"> | </span>
				<a href="<?php echo config_item('base_url');?>/en"><img src="http://127.0.0.1/utt/publics/template/default/images/english.gif"></a><a style="color: #fff" href="http://127.0.0.1/utt/en">English</a><span style="color: #2685A7;"> | </span>
                
				-->
				<a style="color: #fff" href="<?php echo config_item('base_url');?>">Trang Chủ</a><span style="color: #2685A7;"> | </span>
                <a style="color: #fff" href="<?php echo config_item('base_url');?>/utt/sitemap.html">Sơ đồ website</a>
				<!-- BHTA Head -->
					<!-- <center><strong><h3 class="effect-css">Giảng Viên: Nguyễn Tùng Dương</h3></strong></center> -->
				</div>
				<div class="clear"></div>
			</div><!--header-content-->
		</header>
		<div class="clear"></div>
<div id="main-content" class="container" style = "text-align:center;">
<h6 style = "line-height: 300px; font-size: 18px;"> Trang bạn truy cập không tồn tại. <a href = "<?php echo config_item('base_url').'teacher.php';?>"><span style = "color:red;">Bấm vào đây</span></a> để quay lại trang chủ.</h6>
<div class="clear"></div></div>
</div>
</div>
</div>
<div class="footer-bottom">
  <div class="container">
    <div class="alignright">
    </div>
    <div class="alignleft">
      <a href="<?php echo config_item('base_url');?>" style="color:#33FFFF">UTT </a> © Copyright 2015, All Rights Reserved - UTT Team    </div>
    <div class="clear"></div>
  </div><!-- .Container -->
</div>
<div id="topcontrol" class="fa fa-angle-up" title="Lên Đầu Trang" style="bottom: 10px; display: none;"></div>
<script>
  $(function(){$(window).scroll(function(){if($(this).scrollTop()!=0){$('#topcontrol').fadeIn();}else{$('#topcontrol').fadeOut();}});$('#topcontrol').click(function(){$('body,html').animate({scrollTop:0},800);});});
</script>

  

<script type="text/javascript">
    var jsonMsg = [];
    $.each( jsonMsg, function( key, value ) {
        genNoty(key, value, 'topRight');
    });
</script>
		<?php
		}
	;?>
</body>
</html>