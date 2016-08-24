<div id = "full_screen" style = "position: fixed; top: 0; left: 0; z-index: 9999;width: 100%; height: 100%; background-color: rgba(233, 249, 226, 0.44);display:none;">
	<div style = "position: fixed; top: 50%; left: 50%;">
		<img style = "width:70px; height:70px;" src = "<?php echo $this->config->base_url('assets/image_crud/images/loading_delete.gif');?>"/>
		<p style = "font-weight: bold; font-size: 19px; color: #C13016;">Đang xóa</p>
	</div>
</div>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<?php echo $output; ?>