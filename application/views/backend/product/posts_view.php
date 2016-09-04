<div class="content-wrapper">
        <section class="content-header">
          <h1>
            Quản lí sản phẩm
          </h1>
		  <ol class="breadcrumb">
            <li><a href="admin/home"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
            <li><a href="admin/product/view">Sản phẩm</a></li>
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
									<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div>
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
                  <h3 class="box-title"><b>Danh sách sản phẩm</b></h3>
                </div><!-- /.box-header -->
				<div class="box-footer clearfix">
					<form method="get" action="<?php echo $this->config->base_url().'admin/product/view';?>">
						<input type="text" class="form-control" value="<?php echo (isset($search)&&!empty($search))?$search:'' ;?>" name="s" placeholder="Tìm kiếm sản phẩm ...">
						<br />
						<label>Tìm kiếm theo danh sản phẩm : </label>
						<select size="1" class= "form-control" name = "cate" id= "getTitle">
										<option value="">---Chọn danh mục sản phẩm---</option>
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
                        <th style="width: 3px;">Ảnh minh họa</th>
                        <th>Tên sản phẩm</th>
                        <!-- <th>Description</th> -->
                        <th>Danh mục</th>
						<th>Ngày đăng</th>
						<th>Cập nhật</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
						if(isset($list_posts) && count($list_posts)){
							$link = base64_encode(getCurrentUrl());
                                foreach($list_posts as $key => $val){
									$active = '<a href = "admin/product/changeStatus/'.$val['id'].'?redirect='.$link.'"><button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button></a>';
									$pendding = '<a href = "admin/product/changeStatus/'.$val['id'].'?redirect='.$link.'"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button></a>';
						?>
						<tr>
							<td><?php echo ($val['image']!="")?'<img width="100" height ="100" src="uploads/images/news/'.$val['image'].'" />':'';?></td>
							<td><?php echo cutnchar($val['title'],30);?></td>
                            <!--<td><?php echo cutnchar($val['description'],40);?></td>-->
							<td><?php echo ($val['catetitle'] != "")?$val['catetitle']:'<span style = "color:red;">Chưa có thể loại</span>';?></td>
							<td><?php echo date('H:i:s d/m/y',$val['time_create']);?></td>
							<td><?php echo ($val['time_update']!='')?date('H:i:s d/m/y',$val['time_update']):'------';?></td>
							<td><?php echo ($val['status'] == 1)? $active : $pendding;?></td>
							<td>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										  Thao tác<span class="caret"></span>
										  <span class="sr-only">Toggle Dropdown</span>
										</button>
									<ul class="dropdown-menu" role="menu"> <li><a href="admin/product/edit/<?php echo $val['id'];?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Sửa</a></li> 
									<li><a class ="del" href="admin/product/recyle/<?php echo $val['id'];?>?redirect=<?php echo base64_encode(getCurrentUrl()); ?>">Xóa</a></li>  </ul> </div>
								
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
									echo (isset($list_paginition)&&count($list_paginition))?$list_paginition:'';
								?>
							<div class="clear"></div>
		<div id="modalemail" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Gửi sản phẩm</h4>
              </div>
              <div class="modal-body">
              <label>Chọn các Khoa/Phòng Ban</label>
              	<select id="selectgroup" name="" multiple class="form-control" width="100%">
                <optgroup label="Chọn Khoa/Phòng Ban">Chọn Khoa/Phòng Ban nhận mail</optgroup>
                <?php
                	if (isset($department_mail)&&!empty($department_mail))
                	{
                		foreach ($department_mail as $key => $value) {
                			echo '<option value="'.$value['id'].'" >'.$value['name_vn'].'</option>';
                		}
                	} else echo "<option>ERROR: Chưa có Khoa/Phòng Ban nào</option>";
                ?>
                </select>
                <label>Nhập email người nhận(Tùy chọn)</label>
                <select id="selectmail" name="" multiple class="form-control" width="100%">
                <optgroup label="Nhập Email(tùy chọn)">Nhập Email người nhận</optgroup>
                </select>
              </div>
              <div class="modal-footer"><button type="button" class="btn btn-primary" id="sendmail">Gửi sản phẩm</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
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
	  var postid;
	  $("#sendmail").click(function(){
	  	toastr.info('Xin chờ giây lát!');
	    var mailoption = [];    
	    $("#selectmail :selected").each(function(i){
	          mailoption[i] = $(this).val(); 
	    });
	    var mailgroup = [];
	    $("#selectgroup :selected").each(function(i){
	          mailgroup[i] = $(this).val(); 
	    });
	    mailsend = [];
	    mailsend[0] = mailgroup;
	    mailsend[1] = mailoption;
    
    	data = JSON.stringify(mailsend);
    	$.ajax({
            type:           'post',
            cache:          false,
            url:            '<?=base_url()?>'+'admin/product/send',
            data:           {mailsend:  data, postid: postid},
            success: function(res) {
              if (res)
              {
                  var result = $.parseJSON(res);
              	  if (result.error){
				      toastr.warning(result.error);
              	  }
              	  if (result.success){
				      toastr.success(result.success);
	                  //code
              	  }
              	  if (!result.error&&!result.success) toastr.warning(res);
              }
          	}
        });
      });

      $('.sendpost').click(function(event) {
      	postid = $(this).attr('post-id-mail');
      	$('#modalemail').modal('show');
      });
      $("select#selectmail").select2({
		  tags: true,
		  placeholder: "Nhập địa chỉ email nhận",
		  width: '100%',
		  tokenSeparators: [',', ' ']
		})
      $("select#selectgroup").select2({
		  tags: false,
		  placeholder: "Chọn Khoa/Phòng Ban nhận mail",
		  width: '100%',
		  tokenSeparators: [',', ' ']
		})
    </script>

