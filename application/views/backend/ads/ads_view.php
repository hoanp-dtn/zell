<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí quảng cáo
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<?php $message_flashdata = $this->session->flashdata('message_flashdata');
							if(isset($message_flashdata)&&count($message_flashdata)) {
								if($message_flashdata['type']=='successful') {
								?>	
									<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
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
                  <h3 class="box-title" style="font-weight:bold;"><b>Danh sách quảng cáo</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 5px;">STT</th>
                        <th>Logo</th>
                        <th>Liên kết</th>
						<th>Vùng hiển thị</th>
						<th>Mô tả</th>
						<th>Trạng thái</th>
						<th>Ngày tạo</th>
						<th>Cập nhật</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
					
                    <tbody>
						<?php 
						if(isset($list_ads) && count($list_ads)){
							$stt = 0;
							foreach($list_ads as $key => $val){
							$stt = $stt + 1;
							$active = '<a href = "admin/ads/changeStatus/'.$key.'?redirect='.curPageURL().'"><button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button></a>';
							$pendding = '<a href = "admin/ads/changeStatus/'.$key.'?redirect='.curPageURL().'"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button></a>';

						?>
							<tr>
								<td><?php echo $stt ;?></td>
								<td><?php echo ($val['image']!='')?'<img width="100px" height ="130px" src="uploads/images/ads/'.$val['image'].'"/>':'' ;?></td>
								<td><?php echo isset($val['link'])?$val['link']:'';?></td>
								<td><?php echo isset($val['adzone_title'])?$val['adzone_title']:'' ;?></td>
								<td><?php echo isset($val['description'])?$val['description']:'' ;?></td><td><?php echo ($val['status'] == 1)? $active : $pendding;?></td>
								<td><?php echo isset($val['time_create'])?date('H:i:s d/m/y',$val['time_create']):'---' ;?></td>
								<td><?php echo isset($val['time_update'])?date('H:i:s d/m/y',$val['time_update']):'---' ;?></td>
								<td>
									<div class="btn-group"> <button type="button" class="btn btn-default">Thao tác</button> <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> <ul class="dropdown-menu" role="menu"> <li><a href="admin/ads/edit/<?php echo $key?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Sửa</a></li>
									<li><a class ="del" href="admin/ads/del/<?php echo $key;?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Xóa</a></li> <li class="divider"></li> </ul> </div>
								</td>
							</tr>
						<?php
						}
						}else {
								echo '<tr><td colspan="9">Không có dữ liệu</td></tr>';
						}
						?>
							</tbody>
                  </table>
				  <?php
									echo isset($list_paginition)?$list_paginition:'';
								?>
							<div class="clear"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script type="text/javascript">
	  $(".del").click(function(){
		  if(confirm('Bạn có muốn xóa không ?')){
			  return true;
		  }
		  return false;
	  });
    </script>

