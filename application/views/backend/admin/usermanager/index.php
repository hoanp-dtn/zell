<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản Trị Viên
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Quản Lý Tài Khoản</b></h3>
          </div>
        	<!-- View -->
            <div class="box-body">
            <?php
                $msg_error = $this->session->flashdata('msg_error');
                if (isset($msg_error)&&!empty($msg_error))
                    echo '<div id="msg_error" class="alert alert-warning alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-warning"></i> Lỗi!</h4>
                          '.$msg_error.'
                          </div>
                          <script>setTimeout(function() {
                              $("#msg_error").fadeOut("fast");
                              }, 3000);</script>';

            ?>
            <?php
                $msg_success = $this->session->flashdata('msg_success');
                if (isset($msg_success)&&!empty($msg_success))
                    echo '<div id="msg_success" class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-check"></i> Thành công!</h4>
                          '.$msg_success.'
                          </div>';

            ?>
                <table id="user" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style ="width: 5px;">STT</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Họ Tên</th>
                      <th>Quyền</th>
                      <th>Địa chỉ</th>
                      <th>SĐT</th>
                      <th>Trạng thái</th>
                      <th>Đổi mật khẩu</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php 
                    if (isset($usermanager)&&!empty($usermanager))
                    {
                      foreach ($usermanager as $key => $value) {
                        echo '<tr>
                                <td class=" sorting_1">'.($key+1).'</td>
                                <td class=" ">'.$value['username'].'</td>
                                <td class=" ">'.$value['email'].'</td>
                                <td class=" ">'.$value['fullname'].'</td>
                                <td class=" ">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default">'.(($value['permit']==-1)?"Super Adminstator":($value['permit']==1?"Admin":($value['permit']==2?"Manager":($value['permit']==0?"Member":"Unknown")))).'</button>
                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="admin/usermanager/permit?id='.$value['id'].'&stt=1&redirect='.base64_encode(getCurrentUrl()).'">Super Adminstator</a></li>
                                        <li><a href="admin/usermanager/permit?id='.$value['id'].'&stt=2&redirect='.base64_encode(getCurrentUrl()).'">Admin</a></li>
                                        <li><a href="admin/usermanager/permit?id='.$value['id'].'&stt=3&redirect='.base64_encode(getCurrentUrl()).'">Manager</a></li>
                                        <li><a href="admin/usermanager/permit?id='.$value['id'].'&stt=4&redirect='.base64_encode(getCurrentUrl()).'">Member</a></li>
                                      </ul>
                                    </div>
                                </td>
                                <td class=" ">'.$value['address'].'</td>
                                <td class=" ">'.$value['phone'].'</td>
                                <td class=" ">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default"> '.(($value['status']==1)?"Active":($value['status']==2?"Pendding":($value['status']==3?"Deleted":"Unknown"))).'</button>
                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="admin/usermanager/status?id='.$value['id'].'&stt=1&redirect='.base64_encode(getCurrentUrl()).'">Active</a></li>
                                        <li><a href="admin/usermanager/status?id='.$value['id'].'&stt=2&redirect='.base64_encode(getCurrentUrl()).'">Pendding</a></li>
                                        <li><a href="admin/usermanager/status?id='.$value['id'].'&stt=3&redirect='.base64_encode(getCurrentUrl()).'">Deleted</a></li>
                                      </ul>
                                    </div>
                                </td>
                                <td class=" "><a href="admin/usermanager/resetpass/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'" class="btn btn-default">Thay đổi</a></td>
                              </tr>';
                      }
                    } else echo "<tr><td colspan='10'>Chưa có dữ liệu!</td></tr>";

                    ?>
                    </tbody>
                </table>
                <?php 
                      if(isset($num_row)&&!empty($num_row)){
                        echo '<div class="row"><div class="col-xs-6"></div><div class="col-xs-6">
                                    <ul class="pagination pull-right">
                                      <li '.(($page<=1)?'class="disabled"':"").'>
                                      <a '.(($page<=1)?"":('href="admin/usermanager?page='.($page-1))).'">← Prev</a>
                                      </li>';

                                      $start = (($page-2)<1)?(1):($page-2);
                                      $end = (($page+2)>$maxpage)?($maxpage):($page+2);
                                      for ($i=$start; $i <= $end; $i++) { 
                                        if ($i==$page) {echo '<li class="active"><a href="admin/usermanager?page='.$i.'">'.$i.'</a></li>';}
                                        else echo '<li><a href="admin/usermanager?page='.$i.'">'.$i.'</a></li>';
                                      }

                                echo '<li '.(($page>=($maxpage))?'class="disabled"':"").'>
                                        <a '.(($page>=($maxpage))?"":('href="admin/usermanager?page='.($page+1))).'">Next →</a>
                                      </li>
                                    </ul></div></div>';
                      }
                ?>
            </div><!--View end-->

        </div>
        </section><!-- /.content -->
</div>
