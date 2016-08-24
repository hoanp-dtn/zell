<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản trị viên
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Thêm tài khoản<b></h3>
            <h5 style="color:red">Lưu ý: Tài Khoản mới sẽ có mật khẩu mặc định là <i>password</i></h5>
          </div>
          <!-- View -->
            <div class="box-body">
            <?php
                    if(isset($message_success)&&!empty($message_success))
                    {
                        
                        echo '<div class="alert alert-success alert-dismissable">
                              <h4><i class="icon fa fa-check"></i>Thông báo!</h4>';
                        echo $message_success;
                        echo '</div>';
                    }
                    if(isset($message_add_error)&&!empty($message_add_error))
                    {
                        
                        echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4>';
                        echo $message_add_error;
                        echo '</div>';
                    }
                    if(isset($message_error)&&!empty($message_error))
                    {
                        echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4><ul>';

                        foreach ($message_error as $key => $value) {
                          echo '<li>'.$value.'</li>';
                        }

                        echo '</ul></div>';
                        
                    }
            ?>
            <hr>
            <form class="form-horizontal" method="post" action>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tên Tài Khoản:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=set_value('username');?>" class="form-control" id="username" name="username" placeholder="" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Địa Chỉ Email:</label>
                <div class="col-sm-9">
                  <input type="email" value="<?=set_value('email');?>" class="form-control" id="email" name="email" placeholder="" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Họ và Tên:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=set_value('fullname');?>" class="form-control" id="fullname" name="fullname" placeholder="" required> 
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tỉnh/Thành Phố:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=set_value('city');?>" class="form-control" id="city" name="city" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Địa Chỉ:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=set_value('address');?>" class="form-control" id="address" name="address" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Số Điện Thoại:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=set_value('phone');?>" class="form-control" id="phone" name="phone" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Chức vụ:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=set_value('role');?>" class="form-control" id="address" name="role" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Phân quyền:</label>
                <div class="col-sm-9">
                  <select class="form-control" id="permit" name="permit" required>
                    <option value="">---Chọn quyền---</option>
                    <option <?=((set_value('permit')==1)?'selected':null);?> value="1">Super Adminstrator</option>
                    <option <?=((set_value('permit')==2)?'selected':null);?> value="2">Admin</option>
                    <option <?=((set_value('permit')==3)?'selected':null);?> value="3">Manager</option>
                    <option <?=((set_value('permit')==4)?'selected':null);?> value="4">Member</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="submit" class="btn btn-primary">Thêm Tài Khoản</button>
                </div>
              </div>
            </form>
            </div><!--View end-->
        </div>
        </section><!-- /.content -->
</div>