<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí đánh giá 
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
		<?php $message_flashdata = $this->session->flashdata('message_flashdata');
				if(isset($message_flashdata)&&is_array($message_flashdata)) {
					?>	 
					<div class="alert alert-<?php echo ($message_flashdata['type'] == 'successful')?'success':'warning';?> alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div>
					<?php
				}
			?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="font-weight:bold;"><b>Danh Sách slide</b></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
				<!-- <div class="form-group col-xs-2">
                  <label>Ngôn ngữ :</label>
					
                </div>  -->
            <table id="table_category" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style ="width: 5px;">STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đánh giá</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php 
				  
				  $error = '<div class="form-group has-error"> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Không có đánh giá nào</label> </div>';
                  if (isset($review)&&!empty($review))
                  {
                    foreach ($review as $key => $value){
						$active = '<a href = "admin/review/changeStatus/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'"<button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button></a>';
						$pendding = '<a href = "admin/review/changeStatus/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'"<button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button></a>';
						$button_html = '<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						  Thao tác <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
						<li><a href="admin/review/edit/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'">Sửa</a></li>
						<li><a class ="del" href="admin/review/del/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'">Xóa</a></li>
            <li><a href="admin/product/edit/'.$value['post_id'].'?redirect='.base64_encode(getCurrentUrl()).'">Xem sản phẩm</a></li>
						</ul>
						</div>';
                      echo '<tr>
                              <td class=" ">'.($key+1).'</td>
                              <td class=" ">'.truncate($value['post_title'],50).'</td>
                              <td class=" ">'.truncate($value['location'],50).'</td>
                              <td class=" ">'.truncate($value['description'],50).'</td>
                              <td class=" ">'.(($value['status'] == 1)? $active : $pendding).'</td>
							  <td>'.$button_html.'</td>
                            </tr>';
							
							
                    }
                  }else{
					?>
					<td colspan='7'><?php echo $error;?></td>
					<?php
				  }

                  ?>
                  </tbody>
              </table>
			   <?php
									echo isset($list_paginition)?$list_paginition:'';
								?>
          </div>
        </div>
        <script type="text/javascript">
		
		  
		  $(".del").click(function(){
			  if(confirm('Bạn có muốn xóa không ?')){
				  return true;
			  }
			  return false;
		  });
		</script>

        </section><!-- /.content -->
</div>