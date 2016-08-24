<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Quản lí comment
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="font-weight:bold;"><b>Sửa comment</b></h3>
          </div>
        <!-- form start -->
       <form action="" method="post" enctype="multipart/form-data">
		<div class="box-body">
			<div class="form-group">
				<?php echo form_error('name'); ?>
				<label>Họ tên</label>
				<input type="text" value="<?php echo set_value('name',$comment['name']);?>" name="name" class="form-control" placeholder="Nhập họ tên"/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group">
				<?php echo form_error('email'); ?>
				<label>Email</label>
				<input type="text" value="<?php echo set_value('email',$comment['email']);?>" name="email" class="form-control" placeholder="Nhập họ tên"/>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group">
			<?php echo form_error('detail'); ?>
			  <label>Nội dung bình luận</label>
			  <textarea name = "detail" class="form-control" rows="3" placeholder="Enter ..." ><?php echo set_value('detail',$comment['detail']);?></textarea>
			</div>
			<div class="form-group">
			<?php echo form_error('status'); ?>
				<label>Trạng thái</label></br>
				<?php 
					$js = 'id="status" class="form-control"';
					echo form_dropdown('status', array(0=>'Chờ duyệt',1=>'Duyệt'), isset($current_status)?$current_status:$comment['status'], $js);
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
