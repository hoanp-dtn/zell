<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
				Quản lí đối tác
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
				<?php $message_flashdata = $this->session->flashdata('message_flashdata');
					if(isset($message_flashdata)&&count($message_flashdata)) {
						if($message_flashdata['type']=='successful') {
						?>	
							<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div>
							
						<?php
						}
						else if($message_flashdata['type']=='error'){
						?>
							<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div>
					<?php
						}
					}
				?>
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title"><b>Danh sách đối tác</b></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						  <tr>
							<th style = "width: 5px;">STT</th>
							<th>Tên</th>
							<th>Logo đối tác</th>
							<th>Trang liên kết</th>
							<th>Số điện thoại</th>
							<th>Email</th>
							<th>Ngày tạo</th>
							<th>Cập nhật</th>
							<th>Thao tác</th>
						  </tr>
						</thead>
					
                    <tbody>
						<?php 
						if(isset($list_partner) && count($list_partner)){
							$stt = 0;
							foreach($list_partner as $key => $val){
							$stt = $stt + 1;
						?>
							<tr>
								<td><?php echo $stt ;?></td>
								<td><?php echo ($val['title']!='')?$val['title']:'' ;?></td>
								<td><?php echo ($val['image']!='')?'<img width="100px" height ="130px" src="uploads/images/partner/'.$val['image'].'"/>':'---' ;?></td>
								<td><?php echo isset($val['link'])?$val['link']:'' ;?></td>
								<td><?php echo isset($val['phonenumber'])?$val['phonenumber']:'' ;?></td>
								<td><?php echo isset($val['email'])?$val['email']:'' ;?></td>
								<td><?php echo date('H:i:s d/m/y',$val['time_create']); ;?></td>
								<td><?php echo ($val['time_update']!='')?date('H:i:s d/m/y',$val['time_update']):'------';?></td>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										  Thao tác<span class="caret"></span>
										  <span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu"> <li><a href="admin/partner/edit/<?php echo $key;?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Sửa</a></li> 
									<li><a class ="del" href="admin/partner/del/<?php echo $key;?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Xóa</a></li> <li class="divider"></li> </ul> </div>
								
								</td>
							</tr>
						<?php
							}
						}
							else {
								echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
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

