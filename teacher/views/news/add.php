<div class="col s12 m8 l8"><!--1-->
  <div class="main section"><!--2-->
    <div class="widget Blog"><!--3-->
      <div class="blog-posts hfeed"><!--4-->
        <div class="date-outer"><!--5-->                   
            <h2 class="date-header">
              <span>
              </span>
            </h2>
          <div class="date-posts"><!--6-->                  
            <div class="post-outer"><!--7-->
              <div class="post-single-outer card-panel"><!--8-->
                <div class="content-wrapper" style="min-height: 948px; width: 100%;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style = "font-size : 25px;">
            Quản lí bài viết
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
		 
            <!-- left column -->
            <div class="col-md-14">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title" style = "font-size : 28px;"><b>Thêm mới bài viết</b></h3>
                </div>
				 <?php $message_flashdata = $this->session->flashdata('message_flashdata');
							if(isset($message_flashdata)&&count($message_flashdata)) {
								if($message_flashdata['type']=='successful') {
								?>	 
									<div class="alert alert-<?php echo ($message_flashdata['type'] == 'successful')?'success':'warning';?> alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
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
                <form action="" method="post" enctype="multipart/form-data">
				<div>
                  <div class="box-body">
                  <div class="form-group">
            <div style = 'color: red;'><?php echo isset($message_title)?$message_title:'';?></div>
                      <label >Danh Mục Tin</label>
                        <select name="cate">
                          <option value="1">Báo Cáo Khoa Học</option>
                          <option value="2">Tài Liệu Sinh Viên</option>
                        </select>
                    </div>
                    <div class="form-group">
					  <div style = 'color: red;'><?php echo isset($message_title)?$message_title:'';?></div>
                      <label >Tiêu đề</label>
                      <input style = "padding-left:5px;" type="text" name = "title" class="form-control" value="<?php echo isset($title)?$title:'';?>"id="title" placeholder="tiêu đề...">
                    </div>
                    <div class="form-group">
					  <div style = 'color: red;'><?php echo isset($message_description)?$message_description:'';?></div>
                      <label >Mô tả</label>
					  <textarea class="form-control" rows="3" name="description" placeholder="Mô tả ..." value=""><?php echo isset($description)?$description:'';?></textarea>
                    </div>
					<div class="form-group">
						<div style = 'color: red;'><?php echo isset($message_detail)?$message_detail:'';?></div>
                      <label >Nội dung</label>
					  <textarea class="form-control ckeditor" style="height: 500px;"rows="20" name="detail" id="detail" placeholder="Nhập nội dung ..." ><?php echo isset($description)?$description:'';?></textarea>
					</div>
				<div class="form-group">
					<div id="myfileupload">
						<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />
					</div>
					<div id="thumbbox">
						<img height="100" width="100" alt="File không đúng" src="./uploads/images/news/no-images.png"id="thumbimage" style="display: none" />
						<a class="removeimg" href="javascript:" ></a>
					 </div>
					 <div id="boxchoice">
						<a href="javascript:" class="Choicefile" style = "text-decoration:none;">Ảnh minh họa</a>
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
    </style><div class="form-group">
					  <div style = 'color: red;'><?php echo isset($message_status)?$message_status:'';?></div>
					<label>Trạng thái hiển thị</label></br>
					<select size="1" name="status">
						<option value="1" <?php echo (isset($status) && $status ==1)?'selected':'';?>>Hiện</option>
						<option value="2" <?php echo (isset($status) && $status ==2)?'selected':'';?>>Ẩn</option>
					</select>
					
                  </div><div class="form-group">
                  <div class="box-footer">
                    <button id = "submit" type="submit" name="submit" class="btn btn-primary">Đăng bài viết</button>
					<!--<input id="submit" type="button" value="Submit" />-->
                  </div>
				  </div>
                </form>
              </div>
            </div>
			</div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
	  </div>
              </div><!--8-->
              <!-- <div class="comments card-panel" id="comments">
              </div> -->
            </div><!--7-->
          </div><!--6-->
        </div><!--5-->
      </div><!--4-->
    </div><!--3-->
  </div><!--2-->
</div><!--1-->