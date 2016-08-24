<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí comment
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
		<?php $message_flashdata = $this->session->flashdata('message_flashdata');
				if(isset($message_flashdata)&&is_array($message_flashdata)) {
					?>	 
					<div class="alert alert-<?php echo ($message_flashdata['type'] == 'successful')?'info':'danger';?> alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
					<?php
				}
			?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="font-weight:bold;"><b>Danh Sách comment <?php echo isset($status)?$status:'';?><span style = "color:#398CDA;"><?php echo isset($post_title)?' : "'.$post_title.'"':'';?></span></b></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="table_category" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style ="width: 5px;">STT</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Comment</th>
					<?php
					if(isset($view_post_feild) && $view_post_feild == true){
					?>
					<th>Bài viết</th>
					<?php
					}
					?>
                    <th>Thời gian comment</th>
                    <th>Thời gian cập nhật</th>
                    <th>Trạng thái</th>
                    <?php 
                    	if(isset($page) && $page == 'active'){
                    	?>
               	 		<th>Người duyệt</th>
                    	<?php
                    	}
                     ?>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                  <tbody>
                  <?php 
				  
				  $error = '<div class="form-group has-error"> <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>Không có comment nào</label> </div>';
                  if (isset($comment)&&!empty($comment))
                  {
					  $stt = 0;
                    foreach ($comment as $key => $value){
						$stt++;
						$active = '<a title = "Đã phê duyệt" href = "admin/comment/changeStatus/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'"<button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button></a>';
						$pendding = '<a title = "Đang chờ phê duyệt" href = "admin/comment/changeStatus/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'"<button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button></a>';
						$button_html = '<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						  Thao tác <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
						<li><a target = "_blank" href="'.$this->config->base_url((isset($url_site)?$url_site.'/':'').$value['link'].slug($value['post_title']).'-a'.$value['post_id'].'.html').'">Xem bài viết</a></li><li><a href="admin/comment/edit/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'">Sửa</a></li>
						<li><a class ="del" href="admin/comment/del/'.$value['id'].'?redirect='.base64_encode(getCurrentUrl()).'">Xóa</a></li>
						</ul>
						</div>';
						?>
						<tr>
                              <td class=" "><?php echo $stt;?></td>
                              <td class=" "><?php echo truncate($value['name'],50);?></td>
                              <td class=" "><?php echo truncate($value['email'],50);?></td>
                              <td class=" "><p data-toggle="tooltip" title = "<?php echo getSaveSqlStr($value['detail']);?>"><?php echo truncate($value['detail'],50);?></p></td>
							  <?php
								if(isset($view_post_feild) && $view_post_feild == true){
								?>
								<td class=" "><?php echo truncate($value['post_title'],100);?> (<a href = "<?php echo site_url().'admin/comment/post_comment/'.$value['post_id'];?>"> <?php echo isset($value['count_comment'])?$value['count_comment']:'';?> Comment</a>)</td>
								<?php
								}
							  ?>
                              <td class=" "><?php echo (((int)$value['time_created']!=0)?date('H:i:s d/m/y',$value['time_created']):'------');?></td>
                              <td class=" "><?php echo (((int)$value['time_updated']!=0)?date('H:i:s d/m/y',$value['time_updated']):'------');?></td>
                              <td class=" "><?php echo (($value['status'] == 1)? $active : $pendding);?></td>
                              <?php 
		                    	if(isset($page) && $page == 'active'){
		                    	?>
							  	<td><?php echo $value['fullname'];?></td>
		                    	<?php
		                    	}
		                     ?>
							  <td><?php echo $button_html;?></td>
                            </tr>
						<?php
                    }
                  }else{
					?>
					<td colspan='9'><?php echo $error;?></td>
					<?php
				  }

                  ?>
                  </tbody>
              </table>
			  <?php echo "<span style = 'color:#1E7BC5;'>Có tổng số <span style = 'color:red;'>".(isset($total)?$total:'').' </span>comment '.(isset($status)?$status:'').'</span>';?>
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