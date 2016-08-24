<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí album ảnh
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style = "font-weight:bold;">Thêm album ảnh</h3>
          </div>
        <!-- form start -->
        <form action="" method="post">
            <div class="box-body">
                <?php
                    if(isset($cate_message)&&!empty($cate_message))
                    {
                        
                        echo '<div class="alert alert-success alert-dismissable">
                              <h4><i class="icon fa fa-check"></i>Thông báo!</h4>';
                        echo $cate_message;
                        echo '</div>';
                    }
                ?>
				<?php echo form_error('title'); ?>
                <div class="form-group">
                  <label>Tên album ảnh :</label>
                  <?php
                      if(isset($title_error)&&!empty($title_error))
                      {
                          echo '<br>
                          <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>';
                          echo $title_error;
                          echo '</label>';
                      }
                  ?>
                  <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title');?>" placeholder="Enter title...">
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
        </div>


        </section><!-- /.content -->
</div>
