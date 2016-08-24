<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lý site
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Sửa Site</b></h3>
          </div>
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <?php
                    if(isset($site_message)&&!empty($site_message))
                    {
                        
                        echo '<div class="alert alert-success alert-dismissable">
                              <h4><i class="icon fa fa-check"></i>Thông báo!</h4>';
                        echo $site_message;
                        echo '</div>';
                    }
                    if(isset($message_error)&&!empty($message_error))
                    {
                        echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4><ul>';

                        foreach ($message_error as $key => $value) {
                          echo '<li>'.$value.'</li>';
                        }

                        echo '<ul></div>';
                    }
                ?>
                 <div class="form-group">
                    <label>Mẫu Template:</label>
                        <select class="form-control" id="site_template_id" name="site_template_id">
                        <option value="">--Chọn Template--</option>
                          <?php 
                            if(isset($template)&&!empty($template))
                              {
                                foreach ($template as $key => $value) {
                                  if (($value['id'])==(isset($site)?$site['template_id']:null))
                                  {
                                   echo '<option value="'.$value['id'].'" selected>'.$value['name'].'</option>';
                                 } else  echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                }
                              }
                          ?>
                        </select>
                </div>

                <!--Start Custom layout display home page-->
                <div class="form-group">
                    <button type="button" id="btn-setting" name="submit" class="btn btn-primary" >Cài đặt nội dung hiển thị trang chủ</button>
                </div>
                <div class="form-group" id="setting-content" style="display: none;">
                    <label>Nội Dung Hiển Thị Trang Chủ :</label>
                    <div id="layout-template">
                        [:layout_setting_home_page:]
                    </div>
                </div>
                <!--End Custom layout display home page-->

                <div class="form-group">
                        <label>Đơn vị trực thuộc :</label>
                        <?php
                            $js = 'id="dept" class="form-control"';
                            echo form_dropdown('dept', (isset($list_department)&&count($list_department))?$list_department:array(),$site['department_id'], $js);
                        ?>
                    </div>
                <div class="form-group">
                  <label>Tên hiển thị tiếng việt bên dưới logo :</label>
                  <input type="text" value="<?=(isset($site)?$site['name_header_vn']:set_value('name_header_vn'))?>" class="form-control" id="name_header_vn" name="name_header_vn" placeholder="Tên tiếng việt..." >
                </div>
                <div class="form-group">
                  <label>Tên hiển thị tiếng anh bên dưới logo :</label>
                  <input type="text" value="<?=(isset($site)?$site['name_header_en']:set_value('name_header_en'))?>" class="form-control" id="name_header_en" name="name_header_en" placeholder="Tên tiếng anh...">
                </div>
                <div class="form-group">
                  <label>Địa Chỉ/URL của trang:</label>
                  <input type="text" value="<?=(isset($site)?$site['url_name']:set_value('site_url_name'))?>" class="form-control" id="site_url_name" name="site_url_name" placeholder="Enter text..." required>
                </div>
                <div class="form-group">
                  <label>Tiêu đề:</label>
                  <input type="text" class="form-control" value="<?=(isset($site)?$site['title']:set_value('site_title'))?>" id="site_title" name="site_title" placeholder="Nhập tiêu đề trang..." required>
                </div>
                <div class="form-group">
                  <label>Logo:</label>
                  <div id="logo_view"><img style="" id="logo_img" height="200" width="200" src="<?=(isset($site['logo'])?(base_url()."uploads/images/site/".$site['logo']):NULL)?>"></div>
                  <a id="logo_upload" class="btn btn-default">Chọn Logo</a>
                  <input type="file" accept='image/*' style="display:none" class="form-control" id="file_logo" name="file_logo"  />
                </div>
                 <div class="form-group">
                  <label>Banner:</label>
                  <div id="banner_view"><img  id="banner_img" height="200" width="200" src="<?=(isset($site['banner'])?(base_url()."uploads/images/site/".$site['banner']):NULL)?>"></div>
                  <a id="banner_upload" class="btn btn-default">Chọn Banner</a>
                  <input type="file" accept='image/*' style="display:none" class="form-control" id="file_banner" name="file_banner"  />
                </div>
                <div class="form-group">
                  <label>Thông tin footer của trang:</label>
                  <input type="text" value="<?=(isset($site)?$site['footer_info']:NULL)?>" class="form-control" id="footer_info" name="footer_info" />
                </div>
                <div class="form-group">
                  <label>Mô tả:</label>
                  <input type="text" value="<?=(isset($site)?$site['desc']:NULL)?>" class="form-control" id="site_desc" name="site_desc" placeholder="Enter text..." >
                </div>
                <div class="form-group">
                      <label >Từ khóa tìm kiếm</label>
                      <textarea class="form-control" rows="3" name="keyword" placeholder="Từ khóa ..."><?php echo set_value('keyword',$site['keyword']); ?></textarea>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
        </div>
        </section><!-- /.content -->
         <script type="text/javascript"> 
          $("#logo_upload").click(function () {
              $("#file_logo").trigger('click');
              $("#file_logo").change(function(event) {
                var input = event.target;
                var reader = new FileReader();
                reader.onload = function(){
                  var dataURL = reader.result;
                  var output = document.getElementById('logo_img');
                  output.src = dataURL;
                };
                reader.readAsDataURL(input.files[0]);
              });
          });
          $("#banner_upload").click(function () {
              $("#file_banner").trigger('click');
              $("#file_banner").change(function(event) {
                var input = event.target;
                var reader = new FileReader();
                reader.onload = function(){
                  var dataURL = reader.result;
                  var output = document.getElementById('banner_img');
                  output.src = dataURL;
                };
                reader.readAsDataURL(input.files[0]);
              });
          });
          $(function() {
			  var url_base = "<?php echo base_url();?>";
              $('#btn-setting').click(function() {
                  $('#setting-content').slideToggle(1000);
              });

              $('#site_template_id').change(function() {
                  var template_id = $(this).val();
                  var request = $.ajax({
                      url: url_base + "admin/get-setting-content/" + template_id + "/" + <?php echo (isset($site)) ? $site['id'] : 0; ?>
                  });

                  request.done(function( result ) {
                      if(result.status == "SUCCESS") {
                          $('#layout-template').html(result.data);
                      } else {
                          alert(result.data);
                      }
                  });

                  request.fail(function( jqXHR, textStatus ) {
                      alert( "Request failed: " + textStatus );
                  });
              });
          });
        </script>
</div>
