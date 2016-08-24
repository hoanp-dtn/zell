<div class="content-wrapper" style="min-height: 918px;">
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
            <h3 class="box-title" style="font-weight:bold;"><b>Sửa quảng cáo</b></h3>
          </div>	
        <!-- form start -->
       <form action="" method="post" enctype="multipart/form-data">
		<div class="box-body">
		<label>Lựa chọn kiểu thêm quảng cáo</label></br>
				<select size="1" name="type" id="type" class= "form-control">
					<option value="1" id ="up" <?php echo (isset($ads['image'])&&!empty($ads['image']))?'selected=selected':''; ?>>Upload file ảnh</option>
					<option value="2" id="txt" <?php echo (isset($ads['javascript'])&&!empty($ads['javascript']))?'selected=selected':''; ?> >Đoạn mã script</option>
				</select><br />
				<div class="form-group upload_img" style="display:none;">
				<div id="myfileupload">
					<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />
				</div>
				<div id="thumbbox">
					<img height="100" width="100" alt="Quảng cáo chưa có ảnh" src="./uploads/images/ads/<?php echo isset($ads['image'])?$ads['image']:'';?>" id="thumbimage" style="display: block;" />
					<a class="removeimg" href="javascript:" ></a>
				 </div>
				 <div id="boxchoice">
					<a href="javascript:" class="Choicefile">Ảnh quảng cáo</a>
					<p style="clear:both"></p>
					<label class="filename"></label>
					  <input id = 'is_change_image' name ='is_change_image' value='0' type="text" style='display:none;visibility:hidden;'></input>
				 </div>
					  
				</div>
				<div class="form-group link" style="display:none;">
					<?php echo form_error('url'); ?>
					<label>Đường dẫn</label>
					<input type="text" value="<?php echo set_value('url',isset($ads['link'])?$ads['link']:'');?>" name="url" class="form-control" placeholder="Nhập đường dẫn"/>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
			<div class="for-group js" style="display:none;">
				<label>Nhập đoạn mã javascript:</label>
			  <textarea  name ="javascript" class="form-control" rows="7" placeholder="Nhập đoạn mã javascript ..."><?php echo set_value('javascript',isset($ads['javascript'])?$ads['javascript']:'');?></textarea>
			</div>
					<script type="text/javascript">
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
        function readURL(input,thumbimage) {
			$("#is_change_image").val('1');
$("#submit").removeAttr('disabled');
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
            $(".Choicefile").bind('click', function () {
                $("#user_profile_pic").click();
                
            });
            $(".removeimg").click(function () {
				
$("#submit").attr('disabled','disabled');
                $("#thumbimage").attr('src', '').hide();
                $("#myfileupload").html('<input type="file" id="user_profile_pic" onchange="readURL(this);" />');
                $(".removeimg").hide();
				$(".Choicefile").unbind('click');
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
			<div class="form-group">
			  <label>Mô tả</label>
			  <textarea  name ="description"class="form-control" rows="3" placeholder="Enter ..."><?php echo set_value('description',$ads['description']);?></textarea>
			</div>
			<div class="form-group">
			<?php echo form_error('adzone');?>
				<label>Vùng hiển thị</label></br>
				<?php 
					$js = 'id="adzone" class="form-control"';
					echo form_dropdown('adzone', $list_adzone, isset($current_adzone)?$current_adzone:$ads['adzone'], $js);
				?>
			</div>	
			<div class="form-group">
			<?php echo form_error('status'); ?>
				<label>Hiển thị</label></br>
				<?php 
					$js = 'id="status" class="form-control"';
					echo form_dropdown('status', array(2=>'Không',1=>'Có'), isset($current_status)?$current_status:$ads['status'], $js);
				?>
			</div>
			</div>
			<div class="row">   
				<div class="col-xs-12">
					<button id="submit"  type="submit"class="btn btn-primary">Sửa</button>
				</div><!-- /.col -->
			</div>
		</form> 
        </div>


        </section><!-- /.content -->
</div>
