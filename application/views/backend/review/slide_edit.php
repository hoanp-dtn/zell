<div class="content-wrapper" style="min-height: 918px;">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Quản lí đánh giá

          </h1>

        </section>



        <!-- Main content -->

        <section class="content">

        <div class="box">

          <div class="box-header">

            <h3 class="box-title" style="font-weight:bold;"><b>Sửa đánh giá</b></h3>

          </div>

        <!-- form start -->

       <form action="" method="post" enctype="multipart/form-data">

		<div class="box-body">
			

			

			<div class="form-group">

			<?php echo form_error('description'); ?>

			  <label>Đánh giá</label>
			  <input class="form-control" type="" name="location" value="<?php echo set_value('location',$review['location']);?>">

			</div>
			<div class="form-group">

			<?php echo form_error('description'); ?>

			  <label>Nội dung đánh giá</label>

			  <textarea name = "description" class="form-control" rows="3" placeholder="Enter ..." ><?php echo set_value('description',$review['description']);?></textarea>

			</div>

			

		


			<div class="form-group">

			<?php echo form_error('status'); ?>

				<label>Hiển thị</label></br>

				<?php 

					$js = 'id="status" class="form-control"';

					echo form_dropdown('status', array(0=>'Không',1=>'Có'), isset($current_status)?$current_status:$review['status'], $js);

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

