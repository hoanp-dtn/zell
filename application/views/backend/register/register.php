<div class="register-box">
      <div class="register-logo">
        <a href="">Quản trị viên</a>
      </div>
      <div class="register-box-body">
        <p class="login-box-msg">Thêm quản trị viên mới</p>
        <form action="" method="post">
			<?php echo validation_errors(); ?>
			<div class="form-group has-feedback">
				<input type="text" value="<?php echo set_value('username','');?>" name="username"class="form-control" placeholder="Tên tài khoản"/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" value="<?php echo set_value('password','');?>" name="password"class="form-control" placeholder="Mật khẩu"/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="passconf"class="form-control" placeholder="Xác nhận mật khẩu"/>
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="text" value="<?php echo set_value('fullname','');?>" name="fullname" class="form-control" placeholder="Họ tên"/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="text" value="<?php echo set_value('email','');?>" name="email"class="form-control" placeholder="Địa chỉ email"/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="text" value="<?php echo set_value('telephone','');?>" name="telephone"class="form-control" placeholder="Số điện thoại"/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="text" value="<?php echo set_value('address','');?>" name="address"class="form-control" placeholder="Địa chỉ"/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<label>Quyền truy cập của admin mới : </label>
				<select name="permit" class="form-control">
					<option value="0" selected>---Chọn quyền---</option>
					<option value="-1"> Super admin </option>
					<option value="1"> Quản trị viên </option>
					<option value="2"> Cộng tác viên </option>
				</select>
			</div>
			<div class="form-group has-feedback">
				</br><label>Trang công tác : </label>
				<?php echo form_dropdown('utt_site',$dropdown_site,0,' class="form-control"')?>
			</div>
			<div class="row">   
				<div class="col-xs-6">
					<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Thêm quản trị viên</button>
				</div><!-- /.col -->
			</div>
		</form> 
	</div><!-- /.form-box -->
</div><!-- /.register-box -->
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
