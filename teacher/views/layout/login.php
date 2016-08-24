<style>
	.box-login{
	    width: 360px;
	    margin: 7% auto;
	    padding: 20px;
	    background-color: #FFF;
	    border: 1px solid transparent;
	    border-radius: 4px;
	    box-shadow: 0 0 3px rgba(0, 0, 0, 0.07);
	}
</style>
<div class="box-login">
	<center><h4>Đăng nhập</h4></center>
	<?php
		$message_fl = $this->session->flashdata('message_error_login');
		if (isset($message_fl)&&!empty($message_fl))
		{
			echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa fa-warning"></i> Cảnh báo</b><br>'.$message_fl.'</div>';
		}
	?>
	<form action="" method="post">
	<p class="comment-form-author"><label for="account">Tài Khoản <span class="required">*</span></label>
		<input type="text" name="user" class="form-control" placeholder="Nhập tên tài khoản/Email..." required="required">
	</p>
	<p class="comment-form-author"><label for="password">Mật Khẩu <span class="required">*</span></label>
		<input type="password" name="pwd" class="form-control" placeholder="Nhập mật khẩu..." required="required">
	</p>
	<input type="submit" class="submit" name="slogin" value="Đăng Nhập">
	</form>
</div>