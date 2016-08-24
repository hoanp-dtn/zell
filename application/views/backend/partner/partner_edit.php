<div class="content-wrapper" style="min-height: 948px; width: 100%;">
        <section class="content-header">
          <h1>
            Quản lí đối tác
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
                  <h3 class="box-title"><b>Thêm mới đối tác</b></h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
				<?php echo validation_errors(); ?>
				<div>
                  <div class="box-body">
                    <div class="form-group">
                      <label >Tên đối tác</label>
                      <input type="text" name = "name" class="form-control" value="<?php echo set_value('name',$list_partner['title']);?>"id="name" placeholder="tên đối tác...">
                    </div>
					<div class="form-group">
                      <label >Trang chủ đối tác</label>
                      <input type="text" name = "link" class="form-control" value="<?php echo set_value('link',$list_partner['link']);?>"id="link" placeholder="trang chủ đối tác...">
                    </div>
					<div class="form-group">
                      <label >Số điện thoại</label>
                      <input type="text" name = "phonenumber" class="form-control" value="<?php echo set_value('phonenumber',$list_partner['phonenumber']);?>"id="phonenumber" placeholder="Số điện thoại...">
                    </div>
					<div class="form-group">
                      <label >Email</label>
                      <input type="text" name = "email" class="form-control" value="<?php echo set_value('email',$list_partner['email']);?>"id="email" placeholder="email...">
                    </div>
				<div class="form-group">
					<div id="myfileupload">
						<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />
					</div>
					
					<div id="thumbbox">
						<img height="100" width="100" alt="Đối tác chưa có logo" src="./uploads/images/partner/<?php echo isset($list_partner['image'])?$list_partner['image']:'';?>" id="thumbimage" style="display: block" />
						<a class="removeimg" href="javascript:" ></a>
					 </div>
					 <div id="boxchoice">
						<a href="javascript:" class="Choicefile">Logo đối tác</a>
						<p style="clear:both"></p>
					 </div>
					  <label class="filename"></label>
					  <input id = 'is_change_image' name ='is_change_image' value='0' type="text" style='display:none;visibility:hidden;'></input>
					</div>
					<script type="text/javascript">
        function readURL(input,thumbimage) {
			$("#is_change_image").val('1');
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
                  </div>
                  <div class="box-footer">
                    <button id = "submit" type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
					<!--<input id="submit" type="button" value="Submit" />-->
                  </div>
                </form>
              </div>
            </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>