<div class="content-wrapper" style="min-height: 948px;">
        <section class="content-header">
          <h1>
            Quản lí Sản phẩm
          </h1>
		  <ol class="breadcrumb">
            <li><a href="admin/home"><i class="fa fa-dashboard"></i>Trang chủ</a></li>
            <li><a href="admin/product/view">Sản phẩm</a></li>
			<li class="active">Thêm sản phẩm</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-14">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><b>Thêm mới sản phẩm</b></h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
				<?php echo validation_errors(); ?>
				<div>
                  <div class="box-body">
				  <div class="form-group">
                      <!-- <label>Chọn ngôn ngữ</label></br>
							<select size="1" name="lang" id="lang" class= "form-control">
								<?php
								?>
							</select> -->
							<div></br></div>
							<label>Chọn danh mục sản phẩm</label>
							<div>
								<select size="1" class= "form-control" name = "getTitle" id= "getTitle">
									<?php
										if(isset($cateTitle)&&!empty($cateTitle)){
											foreach($cateTitle as $key => $val){
									?>
										<option value = "<?php echo $val['id'];?>"> <?php echo $val['title'];?> </option>
									<?php
											}
										}
									?>
								</select>
							</div>
                    </div>
						  
<link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />
					<script>
							$(document).ready(function () {
								$('#getTitle').select2();
								
							});
						</script>
					
                    <div class="form-group">
                      <label >Tên sản phẩm</label>
                      <input type="text" name = "title" class="form-control" value="<?php echo set_value('title','');?>"id="title" placeholder="tiêu đề...">
                    </div>
                    <div class="form-group">
                      <label >Giá sản phẩm hiện tại</label>
                      <input type="text" name = "price" class="form-control" value="<?php echo set_value('price','');?>"id="title" placeholder="Giá sản phẩm">
                    </div>
                    <div class="form-group">
                      <label >Giá cũ</label>
                      <input type="text" name = "price_old" class="form-control" value="<?php echo set_value('price_old','');?>"id="title" placeholder="Giá cũ">
                    </div>
                    <!-- <div class="form-group">
                      <label >Mô tả</label>
					  <textarea class="form-control" rows="3" name="description" placeholder="Mô tả ..." value="<?php echo set_value('description','');?>"></textarea>
                    </div> -->
                    <div class="form-group">
                      <label >Thông tin chi tiết</label>
                      <textarea class="form-control ckeditor" style="height: 500px;"rows="20" name="detail" id="detail" placeholder="Mô tả ..." value="<?php echo set_value('detail','');?>"></textarea>
                    </div>
                    
					<div class="form-group">
                        <label>Tình trạng còn hàng</label></br>
                        <select size="1" name="is_top" class= "form-control">
                            <option value="1" selected>Còn hàng</option>
                            <option value="2">Hết hàng</option>
                        </select>
					</div>
                    
                    <div class="form-group">
                        <label>Ngày Đăng</label>
                        <input type="date" class="form-control" id="datepost" name="datepost" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?=date("Y-m-d")?>">
                    </div>
                    <span class="label label-warning">Vui lòng up ảnh dạng hình chữ nhật để hiển thị đc tốt nhất. Ví dụ: 1000x600px</span>

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
                    <span class="label label-warning">Vui lòng up ảnh dạng hình vuông để hiển thị đc tốt nhất. Ví dụ: 500x500 px</span>
					<div id="myfileupload">
						<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />
					</div>
					<div id="thumbbox">
						<img height="100" width="100" alt="File không đúng" src="./uploads/images/news/no-images.png"id="thumbimage" style="display: none" />
						<a class="removeimg" href="javascript:" ></a>
					 </div>
					 <div id="boxchoice">
						<a href="javascript:" class="Choicefile">Ảnh minh họa</a>
						<p style="clear:both"></p>
					 </div>
					  <label class="filename"></label>
					</div>
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
            $('.filename').text($("#user_profile_pic").val());
            $('.Choicefile').css('background', '#C4C4C4');
            $('.Choicefile').css('cursor', 'default');
            $(".Choicefile").unbind('click');
            $(".removeimg").show();
        }
		
        $(document).ready(function () {
            $(".Choicefile").bind('click', function () {
                $("#user_profile_pic").click();
                
            });
            $(".removeimg").click(function () {
                $("#thumbimage").attr('src', '').hide();
                $("#myfileupload").html('<input type="file" id="user_profile_pic" onchange="readURL(this);" />');
                $(".removeimg").hide();
                $(".Choicefile").bind('click', function () {
                    $("#user_profile_pic").click();
                });
                $('.Choicefile').css('background','#0877D8');
                $('.Choicefile').css('cursor', 'pointer');
                $(".filename").text("");
            });
			$("#user_profile_pic").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':
            break;
        default:
            $(this).val('');
            // error message here
            alert("Vui lòng chọn ảnh để đăng!");
            break;
    }
});
$('#submit').click( function() {
   //kiem tra trinh duyet co ho tro File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
      // lay dung luong va kieu file tu the input file
        var fsize = $('#user_profile_pic')[0].files[0].size;
        var ftype = $('#user_profile_pic')[0].files[0].type;
        var fname = $('#user_profile_pic')[0].files[0].name;
 
       switch(ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
                break;
            default:
                alert('Unsupported File!');
        }
 
    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
});
        })
    </script>
    <style type="text/css">
    .Choicefile
    {
        display:block;
        background:#0877D8;
        border:1px solid #fff;
        color:#fff;
        width:100px;
        text-align:center;
        text-decoration:none;
        cursor:pointer;
        padding:5px 0px;
    }
    #user_profile_pic,.removeimg
    {
       display:none;
    }
    #thumbbox
    {
      position:relative;
      width:100px;
    }
    .removeimg
    {
      background: url("http://png-3.findicons.com/files/icons/2181/34al_volume_3_2_se/24/001_05.png") repeat scroll 0 0 transparent;

    height: 24px;
    position: absolute;
    right: 5px;
    top: 5px;
    width: 24px;

    }
    </style>
					<label>Trạng thái hiển thị</label></br>
					<select size="1" name="status" class= "form-control">
						<option value="1" selected>Hiện</option>
						<option value="2">Ẩn</option>
					</select><br />
                  </div>
                  <div class="box-footer">
                    <button id = "submit" type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
					<!--<input id="submit" type="button" value="Submit" />-->
                  </div>
                </form>
              </div>
            </div>
			</div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
	  </div>