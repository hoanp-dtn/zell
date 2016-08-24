<!DOCTYPE html>
<html lang="en">
<head>
<title>UTT - Lỗi</title>
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
		<link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url');?>publics/template/default/bootstrap/css/bootstrap.css"><link rel="stylesheet" type="text/css" href="<?php echo config_item('base_url');?>publics/template/default/style.css">
<header class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-md-4 header-left">
                <div class="logo">
                    <a href="<?php echo config_item('base_url');?>" title="Trường Đại Học Công Nghệ Giao Thông Vận Tải" rel="home">
                        						<img style="width:100%;" src="<?php echo config_item('base_url');?>publics/template/default/images/logo.png" alt="Trường Đại Học Công Nghệ Giao Thông Vận Tải">
                    </a>
                </div> <!-- /.logo -->
            </div> <!-- /.header-left -->
            <div class="col-md-3">
                <h3 style="color: white; font-size: 28px; text-align: center; font-weight: bold;">
									</h3>
			</div> <!-- /.col-md-4 -->

            <div class="col-md-5 header-right">

                <ul class="small-links">

                    <li><a href="<?php echo config_item('base_url');?>vinhyenutteduvn">Cở sở đào tạo Vĩnh Yên</a></li><li><a href="<?php echo config_item('base_url');?>thainguyenutteduvn">Cở sở đào tại Thái Nguyên</a></li>                   
                        
                </ul>

                <ul class="small-links">
                    <li>
						<a href="<?php echo config_item('base_url');?>vn"><img src="<?php echo config_item('base_url');?>publics/template/default/images/vietnamese.gif"></a>						<a href="<?php echo config_item('base_url');?>vn">Tiếng Việt</a>					</li>
                    <li>
						<a href="<?php echo config_item('base_url');?>en"><img src="<?php echo config_item('base_url');?>publics/template/default/images/english.gif"></a>						<a href="<?php echo config_item('base_url');?>en">English</a></li>
                    <li><a href="<?php echo config_item('base_url');?>teacher.php/login">Cổng thông tin giảng viên</a>
                    </li><li><a href="<?php echo config_item('base_url');?>sitemap.html">Sơ đồ website</a>
                        
                    </li>
                </ul>
                <div class="search-form">
                    <form name="search_form" method="get" action="<?php echo config_item('base_url');?>utt/search" class="search_form">
                        <input style="color: white;" type="text" value="" name="s" placeholder="Tìm kiếm bài viết..." title="Search the site..." class="field_search">
                    </form>
                </div>
            </div> <!-- /.header-right -->
        </div>
    </div> <!-- /.container -->
	<script>
		$(document).ready(function(){
			$(".nav-bar-main").hover(function(){
				$(".nav-bar-main").css({"overflow":"visible"});
			});
		});
	</script>
     <!-- /.nav-bar-main -->
	
</header> <!-- /.site-header --><script>
	site_id = 1;
	post_id = 20;
</script>

<div class="container">
		<div class="row" style ="height: 300px; text-align: center;background-color: white; margin-top: 10px;">
			<div class="col-md-12">
				<h6 style = "line-height: 300px; font-size: 18px;"> Có lỗi xảy ra vui lòng thử lại sau. <a href = "<?php echo config_item('base_url');?>"><span style = "color:red;">Bấm vào đây</span></a> để quay lại trang chủ.</h6>
			</div>
		</div>
	</div>

<!-- begin The Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-widget">
                    <h1 class="footer-widget-title" style="font-size: 18px;">Thông tin liên hệ</h1>
					<h4 class="footer-widget-title">Cơ sở đào tạo Hà Nội</h4>
                    <p>Địa chỉ: Số 54 Phố Triều Khúc, Q.Thanh Xuân, Hà Nội.<br>Điện thoại: 043.854.4264 - Fax: 043.854.7695<br> Email: infohn@utt.edu.vn - Website: utt.edu.vn</p>
					<h4 class="footer-widget-title">Cơ sở đào tạo Vĩnh Yên</h4>
                    <p>Địa chỉ: 278 Lam Sơn, Đồng Tâm, TP. Vĩnh Yên, Vĩnh Phúc.<br>Điện thoại: 0211.386.7405 - Fax : 0211.386.7391<br> Điện thoại: 0211.386.7405 - Fax : 0211.386.7391</p>
					<h4 class="footer-widget-title">Cơ sở đào tạo Thái Nguyên</h4>
                    <p>Địa chỉ: Phú Thái, Tân Thịnh, TP.Thái Nguyên, Thái Nguyên.<br>Điện thoại: 0280.385.6545 - Fax : 0280.374.6975<br> Email: infotn@utt.edu.vn - Website: thainguyen.utt.edu.vn</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-widget">
                    <h1 class="footer-widget-title" style="font-size: 18px;">Thông tin tuyển sinh</h1>
                    <ul class="list-links">
                        <li><a href="http://utt.edu.vn/home/tuyen-sinh-2015">Thông tin tuyển sinh 2015</a></li>
						<li><a href="http://utt.edu.vn/home/dao-tao-ngan-han">Đào tạo ngắn hạn</a></li>
						<li><a href="http://diemthi.utt.edu.vn/">Tra cứu điểm thi</a></li>
                    </ul>
					<h1 class="footer-widget-title" style="font-size: 18px;">Sinh viên</h1>
                    <ul class="list-links">
                        <li><a href="http://utt.edu.vn/home/lich-thi-lich-hoc">Lịch học - Lịch thi</a></li>
						<li><a href="http://utt.edu.vn/home/noi-quy-quy-che">Nội quy - Quy chế</a></li>
						<li><a href="http://utt.edu.vn/home/hoc-bong-chinh-sach">Học bổng - Chính sách</a></li>
						<li><a href="http://utt.edu.vn/home/cuu-sinh-vien">Cựu học sinh</a></li>
                    </ul>
                </div>
            </div>
            
            <!--<div class="col-md-3">
                <div class="footer-widget">
                    <ul class="footer-media-icons">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-google-plus"></a></li>
                        <li><a href="#" class="fa fa-youtube"></a></li>
                        <li><a href="#" class="fa fa-linkedin"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                        <li><a href="#" class="fa fa-apple"></a></li>
                        <li><a href="#" class="fa fa-rss"></a></li>
                    </ul>
                </div>
			-->
            </div>
        </div> <!-- /.row -->
     <!-- /.container -->
</footer> <!-- /.site-footer --><script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/bootstrap/js/bootstrap.min.js"></script><script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/js/plugins.js"></script><script type="text/javascript" src="<?php echo config_item('base_url');?>publics/template/default/js/custom.js"></script>

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
    background: url(<?php echo config_item('base_url');?>publics/template/default/images/go_top.png) no-repeat center center #fff;
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
		<?php
		}
	?>
</body>
</html>