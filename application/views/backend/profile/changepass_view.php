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
            <h3 class="box-title"><b>Thay đổi mật khẩu</b></h3>
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
                    if(isset($message_error)&&!empty($message_error))
                    {
                      echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4><ul>';
                      foreach ($message_error as $key => $value) {
                          echo '<li>'.$value.'</li>';
                      }
                      echo "</ul></div>";
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Mật khẩu cũ:</label>
                      <?php 
                        if(isset($error_pass)&&!empty($error_pass))
                        {
                            echo '<p><i class="fa fa-times-circle-o"></i> '.$error_pass.'</p>';
                        }
                      ?>
                      <input type="password" class="form-control" id="oldpass" name="oldpass"  />
                    </div>
                    <div class="form-group">
                          <label>Mật khẩu mới:</label>
                          <input type="password" class="form-control" id="newpass" name="newpass"  />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu:</label>
                          <?php 
                            if(isset($error_repass)&&!empty($error_repass))
                            {
                                echo '<p><i class="fa fa-times-circle-o"></i> '.$error_repass.'</p>';
                            }
                          ?>
                        <input type="password" class="form-control" id="renewpass" name="renewpass"  />
                    </div>
            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Thay đổi</button>
            </div>
        </form>
            </div><!--View end-->

        </div>
        </section><!-- /.content -->
</div>
