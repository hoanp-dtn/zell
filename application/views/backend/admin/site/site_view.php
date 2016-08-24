<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản Lý Site
          </h1>
        </section>

        <!--Modal Show-->
        <div id="modalshow" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Phân Quyền Quản Lý Site</h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Danh Sách Site </b></h3>
          </div><!-- /.box-header -->
          <?php 
              $msg_error = $this->session->flashdata('msg_id_error');
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
          <div class="box-body">
            <table id="table_sitemanager" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style ="width : 5px;">STT</th>
                    <th>Tên trang</th>
                    <th>Địa Chỉ/URL trang</th>
                    <th>Tiêu đề trang</th>
                    <th>Logo</th>
                    <th>Banner</th>
                    <th>Thông tin cuối trang</th>
                    <th>Mô tả</th>
                    <th>Đơn vị</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php 
                  if (isset($site)&&!empty($site))
                  {
                    foreach ($site as $key => $value) {
                      
                      echo '<tr>
                              <td class=" sorting_1">'.($key+1).'</td>
                              <td class=" ">'.$value['name'].'</td>
                              <td class=" ">'.$value['url_name'].'</td>
                              <td class=" ">'.truncate($value['title'], 20).'</td>
                              <td>'.(isset($value['logo'])?('<img width="auto" height ="50" src="uploads/images/site/'.$value['logo']).'">':'<i>Chưa có logo</i>').'</td>
                              <td>'.(isset($value['banner'])?('<img width="auto" height ="50" src="uploads/images/site/'.$value['banner']).'">':'<i>Chưa có banner</i>').'</td>
                              <td>'.truncate($value['footer_info'], 80).'</td>
                              <td class=" ">'.truncate($value['desc'], 80).'</td>
                              <td class=" ">'.truncate($value['department_name'], 80).'</td>
                              <td class=" ">
                                <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  Thao tác &nbsp;<span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a href="admin/sitemanager/edit/'.$value['id'].'">Sửa</a></li>';
                                if (isset($permit)&&$permit==-1) echo '<li><a href="#" value="'.$value['id'].'" class="modal_auth">Phân quyền</a></li>';
                            echo '</ul> </div>
                              </td>
                            </tr>';
                    }
                  }

                  ?>
                  </tbody>
              </table>
          </div>
        </div>
        </section><!-- /.content -->
</div>

<script src="publics/admin/plugins/select2/distfd/js/select2.min.js" type="text/javascript"></script>
<link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />
<script>
  $(function () {
            $('#table_sitemanager').dataTable({
              "bPaginate": true,
              "bLengthChange": false,
              "bFilter": false,
              "bSort": true,
              "bInfo": true,
              "bAutoWidth": false
            });
          });
  // $(document).ready(function() {
      $("a.modal_auth").click(function(event) {
      event.preventDefault();
      var site_id = $(this).attr('value');
      $.ajax({
          type: "POST",
          url: "admin/ajax/suShow",
          dataType: 'text',
          data: {id : site_id},
          success: function(res) {
              if (res)
              {
                  $("#modalshow").modal('show');
                  $('.modal-body').html(res);
              }
          }
          });
      });
  // });
</script>