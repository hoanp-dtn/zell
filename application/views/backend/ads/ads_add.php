<div class="content-wrapper" style="min-height: 858px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí quảng cáo
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="" style="font-weight:bold;"><b>Thêm quảng cáo</b></h3>
          </div>	
        <!-- form start -->
       <form action="" method="post" enctype="multipart/form-data">
		<div class="box-body">
			<label>Lựa chọn kiểu thêm quảng cáo</label></br>
				<select size="1" name="type" id="type" class= "form-control">
					<option value="1" id ="up" selected>Upload file ảnh</option>
					<option value="2" id="txt">Đoạn mã script</option>
				</select><br />
			<div class="form-group upload_img" >
				<div id="myfileupload">
					<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />
				</div>
				<div id="thumbbox">
					<img height="100" width="100" alt="File không đúng" src="./uploads/images/news/no-images.png"id="thumbimage" style="display: none" />
					<a class="removeimg" href="javascript:" ></a>
				 </div>
				 <div id="boxchoice">
					<a href="javascript:" class="Choicefile">Ảnh quảng cáo</a>
					<p style="clear:both"></p>
				 </div>
					  
			</div>
			<div class="form-group link">
				<?php echo form_error('url'); ?>
				<label>Đường dẫn</label>
				<input type="text" value="<?php echo set_value('url','');?>" name="url" class="form-control" placeholder="Nhập đường dẫn"/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="for-group js" style="display:none;">
				<label>Nhập đoạn mã javascript:</label>
			  <textarea  name ="javascript" class="form-control" rows="7" placeholder="Nhập đoạn mã javascript ..."><?php echo set_value('javascript','');?></textarea>
			</div>		
			<div class="form-group">
			  <label>Mô tả</label>
			  <textarea  name ="description"class="form-control" rows="3" placeholder="Nhập mô tả của ảnh ..."><?php echo set_value('description','');?></textarea>
			</div>
			<script>
				$('#type').click(function(){
					if($('#type').val()==1){
						$('.upload_img').css("display","block");
						$('.link').css("display","block");
						$('.js').css("display","none");
					}
					if($('#type').val()==2){
						$('.upload_img').css("display","none");
						$('.link').css("display","none");
						$('.js').css("display","block");
					}
				});
				
			</script>
			<div class="form-group">
			<?php echo form_error('adzone'); ?>
				<label>Vùng hiển thị</label></br>
				<?php 
					$js = 'id="adzone" class="form-control"';
					echo form_dropdown('adzone', $list_adzone, isset($current_adzone)?$current_adzone:'0', $js);
				?>
			</div>
			<div class="form-group">
			<?php echo form_error('status'); ?>
				<label>Hiển thị</label></br>
				<?php 
					$js = 'id="status" class="form-control"';
					echo form_dropdown('status', array(2=>'Không',1=>'Có'), isset($current_status)?$current_status:1, $js);
				?>
			</div>
			</div>
			<div class="row">   
				<div class="col-xs-12">
					<button id="submit"  type="submit"class="btn btn-primary">Thêm</button>
				</div><!-- /.col -->
			</div>
		</form> 
        </div>


        </section><!-- /.content -->
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
