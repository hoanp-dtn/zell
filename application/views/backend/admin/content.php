<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Hệ thống quản trị Cổng thông tin Trường Đại học Công nghệ Giao thông vận tải
          </h1>
		  <?php $message_flashdata = $this->session->flashdata('message_flashdata');
							if(isset($message_flashdata)&&count($message_flashdata)) {
								if($message_flashdata['type']=='successful') {
								?>	
									<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
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
        </section>
      </div>