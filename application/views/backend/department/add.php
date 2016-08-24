<div class="content-wrapper" style="min-height: 948px;">
        <section class="content-header">
          <h1>
            Quản lí đơn vị
          </h1>
        </section>
        <section class="content">
          <div class="row">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><b>Thêm mới đơn vị</b></h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
					<?php echo validation_errors(); ?>
					<div>
						<div class="box-body">
							<div class="form-group">
								<label>Kiểu đơn vị : </label></br>
								<select size="1" name="key" class="form-control">
									<?php
									foreach ($departTypeLst as $key => $value) {
										echo '<option value="'.$key.'" selected>'.$value.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="box-body">
							<div class="form-group">
							  <label >Tên tiếng việt : </label>
							  <input type="text" name = "name_vn" class="form-control" value="<?php echo set_value('name_vn','');?>"id="name_vn" placeholder="tên tiếng việt...">
							</div>
						</div>
						<div class="box-body">
							<div class="form-group">
							  <label >Tên tiếng anh : </label>
							  <input type="text" name = "name_en" class="form-control" value="<?php echo set_value('name_en','');?>"id="name_en" placeholder="tên tiếng anh...">
							</div>
						</div>
						<div class="box-footer">
							<button id = "submit" type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
						<!--<input id="submit" type="button" value="Submit" />-->
						</div>
					</div>
                </form>
              
            </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>