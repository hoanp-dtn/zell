<div class="login-box">
    <div class="login-logo">
		<a href="#">Đăng nhập hệ thống</a>
	</div><!-- /.login-logo -->
    <div class="login-box-body">
        <form action="" method="post">
			<?php echo validation_errors(); ?>
			<div class="form-group has-feedback">
				<input type="text" name="email" value="<?php echo set_value('email','');?>" class="form-control" placeholder="Email"/>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" value="<?php echo set_value('password','');?>" class="form-control" placeholder="Password"/>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">    
					<div class="checkbox icheck">
						<label>
						  <input type="checkbox">Duy trì đăng nhập
						</label>
					</div>                        
				</div><!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
				</div><!-- /.col -->
			</div>
        </form>
        <a href="#">Quên mật khẩu</a><br>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
