<div class="content-wrapper" style="min-height: 918px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Quản lí video

          </h1>

        </section>



        <!-- Main content -->

        <section class="content">

        <div class="box">

          <div class="box-header">

            <h3 class="box-title" style="font-weight:bold;"><b>Sửa video</b></h3>

          </div>

        <!-- form start -->

       <form action="" method="post" enctype="multipart/form-data">

		<div class="box-body">

			<div class="form-group">

				<div id="myfileupload">

					<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />

				</div>

				<div id="thumbbox">

				<?php echo isset($video['img'])?'<img height="100" width="100" alt="Không có ảnh đại diện" src="./uploads/images/video/'.$video['img'].'"id="thumbimage" style="display: inline" />':'';?>

					<a class="removeimg" href="javascript:" ></a>

				 </div>

				 <div id="boxchoice">

					<a href="javascript:" class="Choicefile">Ảnh video</a>

					<p style="clear:both"></p>

				 </div>

					  

			</div>

			

			<div class="form-group">

			<?php echo form_error('title'); ?>

			  <label>Tiêu đề</label>

			  <input name = "title" class="form-control" rows="3" placeholder="Enter ..." value = "<?php echo set_value('title',$video['title']);?>">

			</div>

			

			<div class="form-group">

				<?php echo form_error('url'); ?>

				<label>Đường dẫn</label>

				<input id ="url" type="text" value="<?php echo set_value('url',$video['url']);?>" name="url" class="form-control" placeholder="Nhập tiêu đề"/>

				<span class="glyphicon glyphicon-user form-control-feedback"></span>

			</div>

		

			<input id = 'is_change_image' name ='is_change_image' value='0' type="text" style='display:none;visibility:hidden;'></input>

					<script type="text/javascript">

        function readURL(input,thumbimage) {

$("#submit").removeAttr('disabled');

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

			$("#location>option:last-child").remove();

            $(".removeimg").click(function () {

				

$("#submit").attr('disabled','disabled');

                $("#is_change_image").val('1');

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

            alert("Chỉ hỗ trợ định dạng ảnh .gif, .jpg, .png!");

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

			<?php echo form_error('status'); ?>

				<label>Hiển thị</label></br>

				<?php 

					$js = 'id="status" class="form-control"';

					echo form_dropdown('status', array(0=>'Không',1=>'Có'), isset($current_status)?$current_status:$video['status'], $js);

				?>

			</div>

			</div>

			<div class="row">   

				<div class="col-xs-12">

					<button id="submit"  type="submit"class="btn btn-primary">Cập nhật</button>

				</div><!-- /.col -->

			</div>

		</form> 

        </div>





        </section><!-- /.content -->

</div>

