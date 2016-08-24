</div>
<article class="post-listing post" id="the-post">
	<div class="post-inner">
  		<div class="entry">
			<?php
				if(isset($profile)&&!empty($profile))
				{
					echo "<div class='form-horizontal'>";
					if (isset($checklog)&&!empty($checklog)&&($checklog->id==$profile['id']))
					{ 
						echo "<div class='pull-right'><a href='teacher.php/thay-doi-thong-tin.html'><i class='fa fa-edit'></i> Chỉnh Sửa</a></div>"; 
					}
					echo "<div class=\"form-group\">
						  	<div class=\"col-sm-12\"><center>
							<img class='img-thumbnail' style='width:180px;height:180px;-webkit-box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);-moz-box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)' src='".imgExist(base_url().'uploads/images/avatar/'.$profile['avatar'])."' class='avt-fix'>
						  	</center>
						  	</div></div>";

					echo '<div class="box info" style="margin-bottom:2px;padding:4px;"><i><b>Họ Tên: </b></i> 
						  	&nbsp;'.$profile['fullname'].'</div>';
					echo '<div class="box info" style="margin-bottom:2px;padding:4px;">
						  	<i><b>Tỉnh/Thành Phố: </b></i> 
						  	&nbsp;'.$profile['city'].'</div>';
					echo '<div class="box info" style="margin-bottom:2px;padding:4px;">
						  	<i><b>Địa Chỉ: </b></i> 
						  	&nbsp;'.$profile['address'].'</div>';
					echo '<div class="box info" style="margin-bottom:2px;padding:4px;">
						  	<i><b>Số Điện Thoại: </b></i> 
						  	&nbsp;'.$profile['phone'].'</div>';
					echo '<div class="box info" style="margin-bottom:2px;padding:4px;">
						  	<i><b>Giới thiệu: </b></i> 
						  	&nbsp;'.$profile['about'].'</div>';
					echo '<div class="box info" style="margin-bottom:2px;padding:4px;">
						  	<i><b>Cơ Sở: </b></i> 
						  	&nbsp;'.$profile['brch'].'</div>';
					echo '<div class="box info" style="margin-bottom:2px;padding:4px;">
						  	<i><b>Khoa/Phòng Ban: </b></i> 
						  	&nbsp;'.$profile['department'].'</div>';
					echo "</div></div>";
				}
			?>
		</div>
	</div>
</article>
<div>