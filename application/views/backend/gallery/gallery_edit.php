<div class="content-wrapper" style="min-height: 948px; width: 100%;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí album ảnh
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
                  <h3 class="box-title">Sửa album ảnh</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
				<?php echo validation_errors(); ?>
				<div>
                  <div class="box-body">
                    <div class="form-group">
                      <label >Tiêu đề</label>
                      <input type="text" name = "title" class="form-control" value="<?php echo set_value('title',htmlspecialchars($gallery[0]['title'])); ?>" id="title" placeholder="tiêu đề...">
                    </div>
                  </div>
                  <div class="box-footer">
                    <button id = "submit" type="submit" name="submit" class="btn btn-primary">Sửa album ảnh</button>
					<!--<input id="submit" type="button" value="Submit" />-->
                  </div>
                </form>
              </div>
            </div>
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>