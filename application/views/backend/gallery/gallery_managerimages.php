<div id = "full_screen" style = "position: fixed; top: 0; left: 0; z-index: 9999;width: 100%; height: 100%; background-color: rgba(233, 249, 226, 0.44);display:none;">
	<div style = "position: fixed; top: 50%; left: 50%;">
		<img style = "width:70px; height:70px;" src = "<?php echo $this->config->base_url('assets/image_crud/images/loading_delete.gif');?>"/>
		<p style = "font-weight: bold; font-size: 19px; color: #C13016;">Đang xóa</p>
	</div>
</div>
<div class="content-wrapper" style="min-height: 948px;">
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
        <section class="content-header">
          <h1 class="box-title"><b><?php echo $gallery[0]['title'];?></b></h1>
        </section>
		<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-14">
              <!-- general form elements -->
				<div class="box box-primary" style = "padding :12px;">
					<?php 
					foreach($css_files as $file): ?>
						<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
					<?php endforeach; ?>
					<?php foreach($js_files as $file): ?>
						<script src="<?php echo $file; ?>"></script>
					<?php endforeach; ?>
					<?php echo $output; ?>
				</div>
            </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>