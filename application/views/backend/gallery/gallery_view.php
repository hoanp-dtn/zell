<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí album ảnh
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
		<?php $message_flashdata = $this->session->flashdata('message_flashdata');
							if(isset($message_flashdata)&&count($message_flashdata)) {
								if($message_flashdata['type']=='successful') {
								?>	
									<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
									<!--<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i> Cảnh báo</h4>'-->
								<?php
								}
								else if($message_flashdata['type']=='error'){
								?>
									<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
							<?php
								}
							}
						?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style = "font-weight:bold;">Danh Sách album ảnh</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="table_gallery" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#STT</th>
                    <th>Tên album</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php 
                  if (isset($gallery)&&!empty($gallery)&&count($gallery))
                  {
                    foreach ($gallery as $key => $value) {
                      
                      echo '<tr>
                              <td class=" sorting_1">'.($key+1).'</td>
                              <td class=" ">'.$value['title'].'</td>
                              <td class=" ">
                                <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                  Action <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a href="admin/gallery/managerimages/'.$value['id'].'">Quản lí ảnh</a></li>
                                <li><a href="admin/gallery/edit/'.$value['id'].'" class="">Sửa tên album</a></li>
                                <li><a href="admin/gallery/delete/'.$value['id'].'" class="delcate">Xóa</a></li>
                                </ul>
                                </div>
                              </td>
                            </tr>';
                    }
                  }else{
					  echo '<tr><td colspan="3">Không có dữ liệu</td></tr>';
				  }

                  ?>
                  </tbody>
              </table> <?php
									echo isset($list_paginition)?$list_paginition:'';
								?>
          </div>
        </div>
        <script>
            $(".delcate").click(function(){
            if(confirm('Bạn có muốn xóa không ?')){
              return true;
            }
            return false;
          });
        </script>

        </section><!-- /.content -->
</div>