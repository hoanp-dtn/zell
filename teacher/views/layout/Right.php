</div>
<aside id="sidebar">
	<div class="widget" id="tabbed-widget">
		<div class="widget-container">
			<div class="widget-top">
				<ul class="tabs posts-taps">
						<li class="tabs active"><a style="cursor: context-menu;">Thông Tin Giảng Viên</a></li>
				</ul>
			</div>
			<div class="tabs-wrap" style="display: block;">
				<ul>
					<li>
						<center><img style="width:180px;height:180px;border: 3px solid #fff;-webkit-box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);-moz-box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);" src="<?=imgExist('uploads/images/avatar/'.(isset($teacher['avatar'])?$teacher['avatar']:null));?>" alt="Ảnh đại diện" class="img-thumbnail">
						</center></li>
					<li><center><b><a <?=isset($teacher['id'])?'href="teacher.php/profile/'.$teacher['id'].'"':null?> ><?=isset($teacher['fullname'])?$teacher['fullname']:''?></a></b></center> </li>
					<li><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;<b> SĐT:</b>&nbsp;&nbsp;&nbsp;<?=isset($teacher['phone'])?$teacher['phone']:''?></li>
					<li><span class="glyphicon glyphicon-home"></span>&nbsp;<b> Địa Chỉ:</b>&nbsp;&nbsp;<?=isset($teacher['address'])?$teacher['address']:''?></li>
					<li><span class="glyphicon glyphicon-education"></span>&nbsp;<b> Cơ Sở:</b>&nbsp;&nbsp;<?=isset($teacher['brch'])?$teacher['brch']:''?></li>
					<li><span class="glyphicon glyphicon-briefcase"></span>&nbsp;<b> Khoa/Phòng Ban:</b>&nbsp;<?=isset($teacher['department'])?$teacher['department']:''?></li>
				</ul>
			</div>
		</div>
	</div><!-- .widget /-->
</aside>
<div class="clear"></div>