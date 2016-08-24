<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí tài khoản
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Thay đổi thông tin cá nhân</b></h3>
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
                    if(isset($message_error['email'])&&!empty($message_error['email']))
                    {
                        
                        echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4>';
                        echo $message_error['email'];
                        echo '</div>';
                    }
                    if(isset($message_error['name'])&&!empty($message_error['name']))
                    {
                        
                        echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4>';
                        echo $message_error['name'];
                        echo '</div>';
                    }
            ?>
            <hr>
            <form class="form-horizontal" method="post" action>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tên Tài Khoản:</label>
                <div class="col-sm-9">
                  <div disabled class="form-control"><?=isset($profile)?($profile['username']):""?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Địa Chỉ Email:</label>
                <div class="col-sm-9">
                  <input type="email" value="<?=isset($profile)?($profile['email']):""?>" class="form-control" id="email" name="email" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Họ và Tên:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=isset($profile)?($profile['fullname']):""?>" class="form-control" id="fullname" name="fullname" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tỉnh/Thành Phố:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=isset($profile)?($profile['city']):""?>" class="form-control" id="city" name="city" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Địa Chỉ:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=isset($profile)?($profile['address']):""?>" class="form-control" id="address" name="address" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Số Điện Thoại:</label>
                <div class="col-sm-9">
                  <input type="text" value="<?=isset($profile)?($profile['phone']):""?>" class="form-control" id="phone" name="phone" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Cơ sở:</label>
                <div class="col-sm-9">
                  <div disabled class="form-control"><?=isset($profile)?($profile['brch']):""?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Khoa/Phòng Ban:</label>
                <div class="col-sm-9">
                  <div disabled class="form-control"><?=isset($profile)?($profile['department']):""?></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                </div>
              </div>
            </form>
            </div><!--View end-->
        </div>
        </section><!-- /.content -->
</div>