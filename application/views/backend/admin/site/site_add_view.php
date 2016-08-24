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
            <h3 class="box-title"><b>Thêm site</b></h3>
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
                          <select class="form-control" id="site_template_id" name="site_template_id" required>
                          <option value="">--Chọn Template ID--</option>
                            <?php 
                              if(isset($template)&&!empty($template))
                                {
                                  foreach ($template as $key => $value) {
                                    echo '<option '.(($value['id']==set_value('site_template_id'))?'selected':null).' value="'.$value['id'].'" >'.$value['name'].'</option>';
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
                            echo form_dropdown('dept', (isset($list_department)&&count($list_department))?$list_department:array(),0, $js);
                        ?>
                    </div>
                 <div class="form-group">
                  <label>Tên hiển thị tiếng việt bên dưới logo :</label>
                  <input type="text" class="form-control" value="<?=set_value('name_vn');?>" id="name_vn" name="name_vn" placeholder="Nhập tên tiếng việt..." >
                </div>
                <div class="form-group">
                  <label>Tên hiển thị tiếng anh bên dưới logo :</label>
                  <input type="text" class="form-control" value="<?=set_value('name_en');?>" id="name_en" name="name_en" placeholder="Nhập tên tiếng anh..." >
                </div>
                <div class="form-group">
                  <label>Địa chỉ/URL của trang:</label>
                  <input type="text" class="form-control" value="<?=set_value('site_url_name');?>" id="site_url_name" name="site_url_name" placeholder="Nhập địa chỉ/URL trang..." required>
                </div>
                <div class="form-group">
                  <label>Tiêu đề:</label>
                  <input type="text" class="form-control" value="<?=set_value('site_title');?>" id="site_title" name="site_title" placeholder="Nhập tiêu đề trang..." required>
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
                  <label>Thông tin footer trang:</label>
                  <input type="text" class="form-control" value="<?=set_value('footer_info');?>" id="footer_info" name="footer_info" placeholder=""  />
                </div>
                 <div class="form-group">
                  <label>Mô tả:</label>
                  <input type="text" class="form-control" value="<?=set_value('site_desc');?>" id="site_desc" name="site_desc" placeholder="">
                </div>
                <div class="form-group">
                      <label >Từ khóa tìm kiếm</label>
                      <textarea class="form-control" rows="3" id = "keyword" name="site_keyword" placeholder="Từ khóa ..."><?php echo set_value('site_keyword',$keyword);?></textarea>
                    </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
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
			  var base_url = "<?php echo base_url(); ?>"
              $('#btn-setting').click(function() {
                  $('#setting-content').slideToggle(1000);
              });

              $('#site_template_id').change(function() {
                  var template_id = $(this).val();
                  var request = $.ajax({
                      url: base_url + "admin/get-setting-content/" + template_id
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
