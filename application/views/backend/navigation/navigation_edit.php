<div class="content-wrapper" style="min-height: 858px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí menu
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="font-weight:bold;"><b>Thêm menu</b></h3>
          </div>
        <!-- form start -->
        <form action="" method="post">
				<?php echo validation_errors();?>
				 
            <div class="box-body"> 
            <div class="form-group">
	              <label>Kiểu Menu :</label>
						<select class="form-control" id="menu_type" name="menu_type">
							<option value="0" <?php echo set_value('menu_type', '') == 0?"selected":"";?>>Mặc định</option>
							<option value="1" <?php echo set_value('menu_type', '') == 1?"selected":"";?>>Product</option>
						</select>
	            </div>  
				<div class="form-group">
                  <label>Tên menu :</label>
					<input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title',$navigation['title']);?>" placeholder="Mời bạn nhập tên menu vào đây ">
                </div>
                <div class="form-group">
                  <label>Danh mục :</label>
						<?php 
						$js = 'id="cate_id" class="form-control"';
						echo form_dropdown('cate_id', (isset($list_category)&&count($list_category))?$list_category:array(), isset($current_cate)?$current_cate:$navigation['cate_id'], $js);
						?>
                </div>  
				<div class="form-group">
				  <label>Đường dẫn :</label>
					<input type="text" class="form-control" id="url" name="url" value="<?php echo set_value('url',$navigation['url']);?>" placeholder="Mời bạn nhập đường dẫn vào đây " requied="">
				</div>
			<div class="form-group">
				<label>Link bài viết</label>
				<select name = "post_id" id = "post_id" style = "width:100%;">
					<?php
						if(isset($current_post) && is_array($current_post) && count($current_post)){
						?>
						<option selected value = "<?php echo $current_post['id'];?>"><?php echo $current_post['title'];?></option>
						<?php
						}elseif($navigation['post_id'] !=0 && isset($navigation['post_title']) && $navigation['post_title']!=""){
						?>
						<option selected value = "<?php echo $navigation['post_id'];?>"><?php echo $navigation['post_title'];?></option>
						<?php
						}
					?>
				</select>
			</div>
			<script>
			$(document).ready(function(){
			$("#post_id").change(function(){
				if(this.value !=0){
					$("#url").val("");
					 $("#cate_id").val("0");
				}else{
					$("#url").removeAttr('disabled');
				}
			});
			$("#url").keyup(function(){
				if($("#url").val() !=""){
					 $("#post_id").prop("disabled", true);
					 $("#post_id").val("0");
					 $("#cate_id").val("0");
				}else{
					$("#post_id").prop("disabled", false);
				}
			});
			$("#cate_id").change(function(){
				if(this.value !=0){
					$("#url").val("");
					 $("#post_id").prop("disabled", true);
				}else{
					$("#url").removeAttr('disabled');
					$("#post_id").prop("disabled", false);
				}
			});
				$('#post_id').select2({
				placeholder: "Chọn bài viết",
				minimumInputLength: 2,
				ajax: {
					url: base_url+"admin/slide/getListPosts",
					dataType: 'json',
					data: function (params) {
					  return {
						q: params.term, // search term
					  };
					},
					processResults: function (data) {
					  return {
						results: data.items
					  }
					},
					cache: true
			    }});
			});
			</script>
			
			<script>
			$(document).ready(function(){
				$('#cate_id').select2();
				$('#parent_id').select2();
				$('#location').select2();
			});
			</script>
<script src="publics/admin/plugins/select2/distfd/js/select2.min.js" type="text/javascript"></script>
<link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />
                <div class="form-group">
                  <label>Menu cha :</label>
						<?php 
						$js = 'id="parent_id" class="form-control"';
						echo form_dropdown('parent_id', (isset($list_navigation)&&count($list_navigation))?$list_navigation:array(), isset($current_nav)?$current_nav:$navigation['parent_id'], $js);
						?>
                </div>  
                <div class="form-group">
                  <label>Vị trí :</label>
						<?php 
						$js = 'id="location" class="form-control"';
						echo form_dropdown('location', (isset($list_location)&&count($list_location))?$list_location:array(), isset($current_location)?$current_location:$navigation['location'], $js);
						?>
                </div>  
				<div class="form-group">
                  <label>Cho phép thêm danh mục con :</label>
						<?php 
						$array = array(
							1=> "Có",
							0=> "Không"
						);
						$js = 'id="sub_nav" class="form-control"';
						echo form_dropdown('sub_nav',$array, isset($current_sub_nav)?$current_sub_nav:$navigation['sub_nav'], $js);
						?>
                </div>  
            </div>
			
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
        </div>
        </section><!-- /.content -->
</div>

<script>
	$(document).ready(function(){
		var parent_id_current = $("#parent_id").val();
		$("#parent_id").change(function(){
			var parent_id = this.value;
			$.post(base_url+'admin/navigation/getLocation', {parent_id:parent_id}, function(data){
				$("#location").html(data.list_location);
				if(parent_id == parent_id_current){
					$("#location > option:last-child").remove();
				}
			},"JSON"
			);
		});
		$("#menu_type").change(function () {
			$.ajax({
				type : "post",
				data : {menu_type : $("#menu_type").val()},
				url : base_url+"admin/navigation/getListCates",
				success : function (data) {
					$("#cate_id").html(data);
				}
			});
		});
	});
</script>