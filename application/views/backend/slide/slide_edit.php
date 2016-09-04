<div class="content-wrapper" style="min-height: 918px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Quản lí slide

          </h1>

        </section>



        <!-- Main content -->

        <section class="content">

        <div class="box">

          <div class="box-header">

            <h3 class="box-title" style="font-weight:bold;"><b>Sửa slide</b></h3>

          </div>

        <!-- form start -->

       <form action="" method="post" enctype="multipart/form-data">

		<div class="box-body">

			<div class="form-group">

				<div id="myfileupload">

					<input type="file" name="userfile" id="user_profile_pic" onchange="readURL(this);" />

				</div>

				<div id="thumbbox">

				<?php echo isset($slide['img'])?'<img height="100" width="100" alt="Không có ảnh đại diện" src="./uploads/images/slide/'.$slide['img'].'"id="thumbimage" style="display: inline" />':'';?>

					<a class="removeimg" href="javascript:" ></a>

				 </div>

				 <div id="boxchoice">

					<a href="javascript:" class="Choicefile">Ảnh slide</a>

					<p style="clear:both"></p>

				 </div>

					  

			</div>

			

			<div class="form-group">

			<?php echo form_error('title'); ?>

			  <label>Tiêu đề</label>

			  <input name = "title" class="form-control" rows="3" placeholder="Enter ..." value = "<?php echo set_value('title',$slide['title']);?>">

			</div>

			<div class="form-group">

			<?php echo form_error('description'); ?>

			  <label>Mô tả</label>

			  <textarea name = "description" class="form-control" rows="3" placeholder="Enter ..." ><?php echo set_value('description',$slide['description']);?></textarea>

			</div>

			<div class="form-group">

				<?php echo form_error('url'); ?>

				<label>Đường dẫn</label>

				<input id ="url" type="text" value="<?php echo set_value('url',$slide['url']);?>" name="url" class="form-control" placeholder="Nhập tiêu đề"/>

				<span class="glyphicon glyphicon-user form-control-feedback"></span>

			</div>

			<div class="form-group">

				<?php echo form_error('post_id');?>

				<label>Link bài viết</label>

				<select name = "post_id" id = "post_id" style = "width:100%;">

					<?php

						if(isset($current_post) && is_array($current_post) && count($current_post)){

						?>

						<option selected value = "<?php echo $current_post['id'];?>"><?php echo $current_post['title'];?></option>

						<?php

						}elseif($slide['post_id'] !=0 && isset($slide['post_title']) && $slide['post_title']!=""){

						?>

						<option selected value = "<?php echo $slide['post_id'];?>"><?php echo $slide['post_title'];?></option>

						<?php

						}

					?>

				</select>

			</div>

			<script>

			$(document).ready(function(){

				$('#location').select2();

			$("#post_id").change(function(){

				if(this.value !=0){

					$("#url").val("");

				}else{

					$("#url").removeAttr('disabled');

				}

			});

			// if($("#post_id").val() !=0){

				// $("#url").val("");

				// $("#url").attr('disabled','disabled');

			// }else{

				// $("#url").removeAttr('disabled');

			// }

			// if($("#url").val() !=""){

					// $("#post_id").val("0");

				// }

			$("#url").keyup(function(){

				if($("#url").val() !=""){

					 $("#post_id").prop("disabled", true);

					 $("#post_id").val("0");

				}else{

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

			

<script src="publics/admin/plugins/select2/distfd/js/select2.min.js" type="text/javascript"></script>

<link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />

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

			<?php echo form_error('location'); ?>

				<label>Vị trí</label></br>

				<?php 

					$js = 'id="location" class="form-control"';

					echo form_dropdown('location', $list_location, isset($current_location)?$current_location:$slide['location'], $js);

				?>

			</div>	

			<div class="form-group">

			<?php echo form_error('status'); ?>

				<label>Hiển thị</label></br>

				<?php 

					$js = 'id="status" class="form-control"';

					echo form_dropdown('status', array(0=>'Không',1=>'Có'), isset($current_status)?$current_status:$slide['status'], $js);

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

