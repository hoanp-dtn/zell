<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí menu
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
									<div class="alert alert-<?php echo ($message_flashdata['type'] == 'successful')?'success':'warning';?> alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><h4><i class="icon fa fa-check"></i><?php echo $message_flashdata['message']; ?></h4></div></div>
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
                  <h3 class="box-title" style="font-weight:bold;"><b>Danh sách menu</b></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<!-- <div class="form-group col-xs-2">
                  <label>Ngôn ngữ :</label>
					
                </div>  -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style = "width: 5px;">STT</th>
                        <th>Tên menu</th>
                        <th>Danh mục</th>
                        <th>URL/Đường dẫn</th>	
                        <th>Link bài viết</th>	
                        <th>Menu cha</th>	
                        <th>Vị trí</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
						
                        <?php
                            if(isset($list_navigation) && count($list_navigation)){
                                $stt = 0;
                                foreach($list_navigation as $key => $val){
									$button_html = '<div class="btn-group"> <button type="button" class="btn btn-default">Thao tác</button> <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> <ul class="dropdown-menu" role="menu"> <li><a href="admin/navigation/edit/'.$val['id'].'">Sửa</a></li> <li><a class ="del" href="admin/navigation/del/'.$val['id'].'">Xóa</a></li> <li class="divider"></li> </ul> </div>';
                                    $stt = $stt + 1;
                                    ?>
                                     <tr>
                                        <td><?php echo $stt;?></td>
                                        <td><?php echo cutnchar($val['title'],40);?></td>
                                        <td><?php echo cutnchar($val['cattitle'],40);?></td>
                                        <td><?php echo $val['url'];?></td>
                                        <td><?php echo $val['post_title'];?></td>
                                        <td><?php echo $val['parenttitle'];?></td>
                                        <td><?php echo "Số ".$val['location'];?></td>
                                        <td><?php echo $button_html;?></td>
                                      </tr>
                                    <?php    
                                }
                            }
                        ?>
                    </tbody>
                  </table>
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

