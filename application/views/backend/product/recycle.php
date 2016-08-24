<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí sản phẩm
          </h1>
		  <ol class="breadcrumb">
            <li><a href="admin/home"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
            <li><a href="admin/product/view">sản phẩm</a></li>
			<li class="active">Thùng rác</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<?php $message_flashdata = $this->session->flashdata('message_flashdata');
							if(isset($message_flashdata)&&count($message_flashdata)) {
								if($message_flashdata['type']=='successful') {
								?>	
									<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div></div>
								<?php
								}
								else if($message_flashdata['type']=='error'){
								?>
									<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div></div>
							<?php
								}
							}
						?>
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><b>Danh sách tin rác</b></h3>
                </div><!-- /.box-header -->
				<div class="box-footer clearfix">
					<form method="get" action="<?php echo $this->config->base_url().'admin/product/recycle';?>">
						<input type="text" class="form-control" value="<?php echo (isset($search)&&!empty($search))?$search:'' ;?>" name="s" placeholder="Tìm kiếm sản phẩm ...">
						<br />
						<label>Tìm kiếm theo thể loại tin: </label>
						<select size="1" class= "form-control" name = "cate" id= "getTitle">
										<option value="">---Chọn thể loại tin---</option>
									<?php
										if(isset($cateTitle)&&!empty($cateTitle)){
										?>
										<?php
											foreach($cateTitle as $key => $val){
									?>
										<option value = "<?php echo $val['id'];?>" <?php echo (isset($cate)&&!empty($cate)&&($cate == $val['id']))?'selected=selected':'' ;?>> <?php echo $val['title'];?> </option>
									<?php
											}
										}
									?>
								</select>
						<link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />
					<script>
							$(document).ready(function () {
								$('#getTitle').select2();
							});
						</script>
						<button class="pull-right btn btn-default"><a href="admin/product/view">Xem toàn bộ sản phẩm  </a><i class="fa fa-arrow-circle-right"></i></button>
						<button class="pull-right btn btn-default" type="submit" style="margin-right:10px;">Tìm kiếm  </button>
					</form>
				</div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Ảnh minh họa</th>
                        <th>Tiêu đề</th>
                        <th>Description</th>
                        <th>Thể loại</th>
						<th>Ngày đăng</th>
						<th>Cập nhật</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
						if(isset($list_posts) && count($list_posts)){
                                foreach($list_posts as $key => $val){
									$button_html = '<div class="btn-group"> <button type="button" class="btn btn-default">Action</button> <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> <ul class="dropdown-menu" role="menu"> <li><a href="admin/product/changeStatus/'.$val['id'].'">Đăng lại</a></li> <li><a class = "del" href="admin/product/del/'.$val['id'].'">Xóa</a></li> <li class="divider"></li> </ul> </div>';
						?>
						<tr>
							<td><?php echo ($val['image']!="")?'<img width="80" height ="100" src="uploads/images/news/'.$val['image'].'" />':'';?></td>
							<td><?php echo cutnchar($val['title'],30);?></td>
                            <td><?php echo cutnchar($val['description'],40);?></td>
							<td><?php echo ($val['catetitle'] != "")?$val['catetitle']:'<span style = "color:red;">Chưa có thể loại</span>';?></td>
							<td><?php echo date('H:i:s d/m/y',$val['time_create']);?></td>
							<td><?php echo ($val['time_update']!='')?date('H:i:s d/m/y',$val['time_update']):'------';?></td>
							<td><?php echo $button_html;?></td>
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
							<div class="clear"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <script src="publics/admin/plugins/select2/distfd/js/select2.min.js" type="text/javascript"></script>
	  <link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />
      <script type="text/javascript">
	  $(".del").click(function(){
		  if(confirm('Bạn có muốn xóa không ?')){
			  return true;
		  }
		  return false;
	  });
    </script>

