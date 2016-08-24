<div class="wrapper-outer"> <div class="background-cover"></div>
<aside id="slide-out">
	<div id="mobile-menu">
		<div class="main-menu">
			<ul id="menu-main-menu" class="menu">
			<li class="menu-item  menu-item-type-custom  menu-item-object-custom  current-menu-item  current_page_item  menu-item-home"><a href="teacher.php/home/<?=isset($checklog)?$checklog:null?>">Home</a></li>
			<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/home/<?=(isset($teacher['id'])?$teacher['id']:null)?>">Báo Cáo Khoa Học</a></li>
			<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/home/<?=(isset($teacher['id'])?$teacher['id']:null)?>">Tài Liệu Sinh Viên</a></li>
			<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/question/index/<?=(isset($teacher['id'])?$teacher['id']:null)?>">Hỏi - Đáp</a></li>
			<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/profile/<?=(isset($teacher['id'])?$teacher['id']:null)?>">Thông Tin Giảng Viên</a></li>
		 	</ul>
		</div>
	</div>
</aside>
  <div id="wrapper" class="boxed-all">
    <div class="inner-wrapper">
		<header id="theme-header" class="theme-header" style="margin-top:0;">
			<div class="top-nav">
				<span class="today-date">
				<?php
					$time = time();
					echo DayVN(date('N',$time)).' ,'.MonthVN(date('m',$time)).' '.date('d',$time).', '.date('Y', $time);
					function DayVN($day)
					{
						$day = preg_replace('/1/', 'Thứ Hai', $day);
						$day = preg_replace('/2/', 'Thứ Ba', $day);
						$day = preg_replace('/3/', 'Thứ Tư', $day);
						$day = preg_replace('/4/', 'Thứ Năm', $day);
						$day = preg_replace('/5/', 'Thứ Sáu', $day);
						$day = preg_replace('/6/', 'Thứ Bảy', $day);
						$day = preg_replace('/7/', 'Chủ Nhật', $day);
						return $day;
					}
					function MonthVN($month)
					{
						$month = preg_replace('/01/', 'Tháng Một', $month);
						$month = preg_replace('/02/', 'Tháng Hai', $month);
						$month = preg_replace('/03/', 'Tháng Ba', $month);
						$month = preg_replace('/04/', 'Tháng Tư', $month);
						$month = preg_replace('/05/', 'Tháng Năm', $month);
						$month = preg_replace('/06/', 'Tháng Sáu', $month);
						$month = preg_replace('/07/', 'Tháng Bảy', $month);
						$month = preg_replace('/08/', 'Tháng Tám', $month);
						$month = preg_replace('/09/', 'Tháng Chín', $month);
						$month = preg_replace('/10/', 'Tháng Mười', $month);
						$month = preg_replace('/11/', 'Tháng Mười Một', $month);
						$month = preg_replace('/12/', 'Tháng Mười Hai', $month);
						return $month;
					}
				?>
				</span>					
				<div class="top-menu">
					<ul id="menu-top-menu" class="menu">
							<?=((isset($checklog)&&($checklog))?'<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="teacher.php/profile.html">Thông tin TK</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="teacher.php/questionmanager">Quản Lý Hỏi Đáp</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="teacher.php/'.slug($checklog->fullname).'-gv'.$checklog->id.'.html">Danh sách bài viết</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="teacher.php/post/add">Thêm bài viết</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="teacher.php/logout">Đăng Xuất</a></li>':'<li class="menu-item menu-item-type-post_type menu-item-object-page page_item"><a href="teacher.php/login">Đăng Nhập</a></li>')?>
					</ul>
				</div>
				<!-- <div class="search-block">
					<form method="get" id="searchform-header" action="">
						<button class="search-button" type="submit" value="Search"></button>	
						<input type="text" id="s" name="s" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}">
					</form>
				</div> --><!-- .search-block /-->
			</div><!-- .top-menu /-->
					
			<div class="header-content">
				<a id="slide-out-open" class="slide-out-open" href="#"><span></span></a>
				<div class="logo">
					<h1>
						<a title="Trường Đại Học Công Nghệ Giao Thông Vận Tải" href="<?=base_url()?>">
							<img src="publics/teacher/css/images/logo.png" alt="Trường Đại Học Công Nghệ Giao Thông Vận Tải">
						</a>
					</h1>			
				</div><!-- .logo /-->
				<div class="e3lan e3lan-top">
				<!--
				<a href="<?=base_url()?>/vn"><img src="http://127.0.0.1/utt/publics/template/default/images/vietnamese.gif"></a><a style="color: #fff" href="http://127.0.0.1/utt/vn">Tiếng Việt</a><span style="color: #2685A7;"> | </span>
				<a href="<?=base_url()?>/en"><img src="http://127.0.0.1/utt/publics/template/default/images/english.gif"></a><a style="color: #fff" href="http://127.0.0.1/utt/en">English</a><span style="color: #2685A7;"> | </span>
                
				-->
				<a style="color: #fff" href="<?=base_url()?>">Trang Chủ</a><span style="color: #2685A7;"> | </span>
                <a style="color: #fff" href="<?=base_url()?>/utt/sitemap.html">Sơ đồ website</a>
				<!-- BHTA Head -->
					<!-- <center><strong><?=isset($teacher['fullname'])?('<h3 class="effect-css">Giảng Viên: '.$teacher['fullname'].'</h3>'):null?></strong></center> -->
				</div>
				<div class="clear"></div>
			</div><!--header-content-->
			<nav id="main-nav" class="fixed-enabled">
				<div class="container">
					<div class="main-menu">
					<ul id="menu-menu-2014" class="menu">
						<li class="menu-item  menu-item-type-custom  menu-item-object-custom  current-menu-item  current_page_item  menu-item-home"><a href="teacher.php/<?=isset($teacher['fullname'])?(slug($teacher['fullname']).'-gv'.$teacher['id'].'.html'):null?>">Home</a></li>
						<?=(isset($teacher['id'])?'<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/'.slug($teacher['fullname']).'-gv'.$teacher['id'].'/bao-cao-khoa-hoc.html">Báo Cáo Khoa Học</a></li>':'<li><a>Báo Cáo Khoa Học</a></li>')?>
						<?=(isset($teacher['id'])?'<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/'.slug($teacher['fullname']).'-gv'.$teacher['id'].'/tai-lieu-sinh-vien.html">Tài Liệu Sinh Viên</a></li>':'<li><a>Tài Liệu Sinh Viên</a></li>')?>
						<?=(isset($teacher['id'])?'<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/'.slug($teacher['fullname']).'-gv'.$teacher['id'].'/hoi-dap.html">Hỏi - Đáp</a></li>':'<li><a>Hỏi - Đáp</a></li>')?>
						<?=(isset($teacher['id'])?'<li class="menu-item  menu-item-type-taxonomy  menu-item-object-category"><a href="teacher.php/'.slug($teacher['fullname']).'-gv'.$teacher['id'].'/profile.html">Thông Tin Giảng Viên</a></li>':'')?>
					</ul>
					</div><!--main-menu-->
				</div><!--container-->
			</nav><!-- .main-nav /-->
		</header>
		<div class="clear"></div>
		<div id="breaking-news" class="breaking-news"><?=isset($teacher['fullname'])?('<h3 style="margin-top: 10px;">Giảng Viên: <b>'.$teacher['fullname'].'</b> - '.$teacher['department'].'</h3>'):null?></div>
<div id="main-content" class="container">
	<div class="content">