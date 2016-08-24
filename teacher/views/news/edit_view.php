<section class="cat-box list-box">
  <div class="cat-box-content">
  	<article class="item-list tie_lightbox">
  	<h2 class="post-box-title">Sửa bài viết</h2>
  	<?php
      if (isset($message_error)&&!empty($message_error))
      {
        echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa fa-warning"></i> Cảnh báo</b><br>';
        foreach ($message_error as $key => $value) {
          echo '<p>'.$value.'</p>';
        } 
        echo '</div>';
      }
      if (isset($message_success)&&!empty($message_success))
      {
        echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa '.($message_success['type']=='successful'?'fa-check':'fa-warning').'"></i> Thông báo</b><br>'.$message_success['message'].'</div>';
      }
    ?>
  		<form action="" method="post" enctype="multipart/form-data">
            <p><label>Danh Mục Tin: </label>
				<select name="cate">
                  <option value="1" <?php echo ($post['cate_id'] == 998)?'selected':'';?>>Báo Cáo Khoa Học</option>
                  <option value="2" <?php echo ($post['cate_id'] == 999)?'selected':'';?>>Tài Liệu Sinh Viên</option>
                </select>
			</p>
			<p><label>Tiêu Đề: </label>
				<input class="form-control" type="text" name="title" id="title" value="<?=isset($post['title'])?$post['title']:null?>" required placeholder="Nhập tiêu đề tin...">
			</p>
			<p><label>Mô Tả: </label>
				<input class="form-control"  type="text" name="description" id="description" value="<?=isset($post['description'])?$post['description']:null?>" required placeholder="Nhập mô tả...">
			</p>
			<p><label>Nội Dung: </label>
				<textarea class="form-control ckeditor" name="detail" id="detail" required placeholder="Nhập nội dung ..." ><?=isset($post['detail'])?printText($post['detail']):null?></textarea>
			</p>
			
			<div class="form-group">
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
			</div>
			<div class="form-group">
				<div id="myfileupload">
						<input type="file" name="image_file" id="image_file" onchange="readURL(this);" />
				</div>
				<div id="thumbbox">
					<img height="100" width="100" alt="File không đúng" src="<?=imgExist(isset($post['image'])?base_url().'uploads/images/news/'.$post['image']:null)?>" id="thumbimage" style="display: block" />
					<a class="removeimg" href="javascript:" ></a>
				</div>
				<div id="boxchoice">
					<a href="javascript:" class="Choicefile" style = "text-decoration:none;">Ảnh minh họa</a>
					<p style="clear:both"></p>
				</div>
				<label class="filename"></label>
			</div>
			<p><label>Trạng Thái Hiển Thị: </label>
				<select size="1" name="status">
					<option value="1" <?php echo (isset($post['status']) && $post['status'] ==1)?'selected':'';?>>Hiện</option>
					<option value="2" <?php echo (isset($post['status']) && $post['status'] ==2)?'selected':'';?>>Ẩn</option>
				</select>
			</p>
			<p>
				<button id="submit" type="submit" name="submit" class="btn btn-primary">Đăng Bài Viết</button>
			</p>
		</form>
  	</article>
  </div>
</section>
<script type="text/javascript">
    function readURL(input,thumbimage) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#thumbimage").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#thumbimage").show();
        }
        else {
            $("#thumbimage").attr('src', input.value);
            $("#thumbimage").show();
        }
        $('.filename').text($("#image_file").val());
        $('.Choicefile').css('background', '#C4C4C4');
        $('.Choicefile').css('cursor', 'default');
        $(".Choicefile").unbind('click');
        $(".removeimg").show();
    }
    $(".Choicefile").bind('click', function () {
        $("#image_file").click();
    });
	$(".removeimg").click(function () {
	    $("#thumbimage").attr('src', '').hide();
	    $("#myfileupload").html('<input type="file" name="image_file" id="image_file" onchange="readURL(this);" />');
	    $(".removeimg").hide();
	    $(".Choicefile").bind('click', function () {
	        $("#image_file").click();
	    });
	    $('.Choicefile').css('background','#0877D8');
	    $('.Choicefile').css('cursor', 'pointer');
	    $(".filename").text("");
	});
	$("#image_file").change(function() {
    var val = $(this).val();
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':
            break;
        default:
            $(this).val('');
            // error message here
            alert("Vui lòng chọn ảnh để đăng!");
            break;
    }});
	$('#submit').click( function() {
	   //kiem tra trinh duyet co ho tro File API
	    if (window.File && window.FileReader && window.FileList && window.Blob)
	    {
	      // lay dung luong va kieu file tu the input file
	        var fsize = $('#image_file')[0].files[0].size;
	        var ftype = $('#image_file')[0].files[0].type;
	        var fname = $('#image_file')[0].files[0].name;
	 
	       switch(ftype)
	        {
	            case 'image/png':
	            case 'image/gif':
	            case 'image/jpeg':
	            case 'image/pjpeg':
	                break;
	            default:
	                alert('Định dạng file không đúng!');
	        }
	 
	    }else{
	        alert("Trình duyệt của bạn không được hỗ trợ!");
	    }
	});
</script>
<style type="text/css">
.Choicefile{
    display:block;
    background:#0877D8;
    border:1px solid #fff;
    color:#fff;
    width:100px;
    text-align:center;
    text-decoration:none;
    cursor:pointer;
    padding:5px 0px;}
#image_file,.removeimg {
    display:none;}
#thumbbox{
    position:relative;
    width:100px; }
.removeimg{
    background: url("http://png-3.findicons.com/files/icons/2181/34al_volume_3_2_se/24/001_05.png") repeat scroll 0 0 transparent;
    height: 24px;
    position: absolute;
    right: 5px;
    top: 5px;
    width: 24px;}
</style>