<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí danh mục
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Sửa danh mục</b></h3>
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
                    if(isset($message_error)&&!empty($message_error))
                    {
                        echo '<div class="alert alert-warning alert-dismissable">
                              <h4><i class="icon fa fa-warning"></i>Lỗi!</h4><ul>';

                        foreach ($message_error as $key => $value) {
                          echo '<li>'.$value.'</li>';
                        }

                        echo '<ul></div>';
                    }
                ?>

                <div class="form-group">
                  <label>Tiêu đề:</label>
                  <input type="text" value="<?=(isset($category)?$category['title']:NULL)?>" class="form-control" id="cate_title" name="cate_title" placeholder="Enter title..." required>
                </div>

                <div class="form-group">
                  <label>Danh mục cha:</label>
                  <select class="form-control" id="cate_parent_id" name="cate_parent_id">
                    <option value="0">--Chọn danh mục cha--</option>
                    <?php 

                    if(isset($cate_parent)&&!empty($cate_parent))
                    {
                        foreach ($cate_parent as $key => $value) {
                          if ($value['id'] == (isset($category)?$category['parent_id']:NULL) ){ 
                            echo '<option value="'.$value['id'].'" selected>'.$value['title'].'</option>';
                          } else echo '<option value="'.$value['id'].'" >'.$value['title'].'</option>';
                        }
                    }

                    ?>
                  </select>
                </div>
				
			<script>
			$(document).ready(function(){
				$('#cate_parent_id').select2();
			});
			</script>
			
<script src="publics/admin/plugins/select2/distfd/js/select2.min.js" type="text/javascript"></script>
<link href="publics/admin/plugins/select2/distfd/css/select2.min.css" rel="stylesheet" />
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
        </div>


        </section><!-- /.content -->
</div>
