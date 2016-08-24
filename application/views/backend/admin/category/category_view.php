<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí danh mục
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Danh Sách Danh Mục</b></h3>
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
              $msg_success = $this->session->flashdata('msg_success');
              if (isset($msg_success)&&!empty($msg_success))
                echo '<div id="msg_success" class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                      '.$msg_success.'
                      </div>
                      <script>setTimeout(function() {
                          $("#msg_success").fadeOut("fast");
                          }, 3000);</script>';
          ?>
          <div class="box-body">
		  
						<form method = "get" action = "">
							<div class="form-group col-xs-5">
								<label> <h5 class="box-title">Tìm kiếm</h5></label>
								<input value = "<?php echo (isset($current_search)?$current_search:"");?>" name = "s"type="text" class="form-control" placeholder="Nhập nội dung tìm kiếm ...">
							</div>
							<div class="form-group col-xs-2" style = "margin-top:40px;">
								<button class="btn btn-default">Tìm kiếm</button>
							</div>
						</form>
		  <!-- <div class="form-group col-xs-2">
                  <label>Ngôn ngữ :</label>
					<?php 
						$js = 'id="lang" class="form-control"';
						echo form_dropdown('lang', (isset($list_lang)&&count($list_lang))?$list_lang:array(),isset($current_lang)?$current_lang:'vn' , $js);?>
                </div>  -->
            <table id="table_category" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style = "width: 5px;">STT</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục cha</th>
                    <th>Ngôn ngữ</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                  <tbody>
                <?php 
					if (isset($category)&&!empty($category))
					{
                    foreach ($category as $key => $value) {
				?>
					<tr>
						<td class=""><?php echo ($key+1); ?></td>
						<td class=" "><?php echo $value['title']; ?></td>
						<td class=" "><?php echo (isset($value['parent_title']) && $value['parent_title']!="")?$value['parent_title']:'--'; ?></td>
						<td class=" "><?php echo $value['name']; ?></td>
						<td class=" ">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							  Thao tác <span class="caret"></span>
							  <span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
							<li><a href="admin/category/edit/<?php echo $value['id']; ?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Sửa</a></li>
							<li><a class = "delcate" href="admin/category/delete/<?php echo $value['id']; ?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Xóa</a></li>
							</ul>
							</div>
                        </td>
                    </tr>
				<?php
						}
					}
                ?>
                  </tbody>
              </table>
			   <?php
									echo isset($list_paginition)?$list_paginition:'';
								?>
          </div>
        </div>
        <script>
		  $("#lang").change(function(){
			  window.location.href = "admin/category/view/"+this.value;
		  });
            $(".delcate").click(function(){
            if(confirm('Bạn có muốn xóa không ?')){
              return true;
            }
            return false;
          });
        </script>

        </section><!-- /.content -->
</div>