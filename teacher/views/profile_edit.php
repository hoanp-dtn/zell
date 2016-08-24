</div>
<div class="col s12">
  <div class="main section" >
        <form action method='post' enctype="multipart/form-data">
        <div class='card-panel'>
        <div class='form-horizontal'>
        <?php
          if (isset($message_error)&&!empty($message_error))
          {
            echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa fa-warning"></i> Cảnh báo</b><br><ul>';
            foreach ($message_error as $key => $value) {
              echo '<li>'.$value.'</li>';
            } 
            echo '</ul></div>';
          }
          if (isset($message_success)&&!empty($message_success))
          {
            echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa fa-warning"></i> Thông báo</b><br>'.$message_success.'</div>';
          }
        ?>
        <div class="form-group">
              <div class="col1-sm-12"><center>
              <div style="margin-top:95px;margin-bottom:-105px;font-weight:bold;">Chọn Avatar</div>
                <img id="mavt" title="Thay đổi avatar. Nên chọn ảnh kích thước 180 x 180" style="height:180px;width:180px;cursor: pointer;" src="<?=imgExist(base_url().'uploads/images/avatar/'.$profile['avatar'])?>" class="img-thumbnail">
              <input type="file" accept='image/*' id="avatar" name="avatar" style="display:none">
              </center>
              </div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Giảng Viên: </label>
              <div class="col-sm-9"><input style="width: 100%" type="text" name="fullname" value="<?=isset($profile)?($profile['fullname']):(set_value('fullname'))?>"></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Tỉnh/Thành Phố: </label>
              <div class="col-sm-9"><input style="width: 100%" type="text" name="city" value="<?=isset($profile)?($profile['city']):(set_value('city'))?>"></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Địa Chỉ: </label>
              <div class="col-sm-9"><input style="width: 100%" type="text" name="address" value="<?=isset($profile)?($profile['address']):(set_value('address'))?>"></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Số Điện Thoại: </label>
              <div class="col-sm-9"><input style="width: 100%" type="text" name="phone" value="<?=isset($profile)?($profile['phone']):(set_value('phone'))?>"></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Giới thiệu: </label>
              <div class="col-sm-9"><textarea class="ckeditor" type="text" name="about"><?=isset($profile)?($profile['about']):(set_value('about'))?></textarea></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Cơ Sở: </label>
              <div class="col-sm-9"><input style="width: 100%"  disabled value="<?=isset($profile)?($profile['brch']):""?>"></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label">Khoa/Phòng Ban: </label>
              <div class="col-sm-9"><input style="width: 100%" disabled value="<?=isset($profile)?($profile['department']):""?>"></div></div>
        <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-9"><input type="submit" value="Cập Nhật" style="padding:4px 6px;border: 2px solid transparent; background-color:#B48CF1;color:#fff;border-radius:2px;" name="sedit"></div></div>
        </div></div>
        </form>
  </div>
</div>
<style>
.avt-hover{
    border: 3px solid #fff;-webkit-box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);-moz-box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);opacity: 0.4;
}
</style>
<script>
  $('#mavt').hover(function() {
    $('#mavt').attr('class', 'avt-hover');
  }, function() {
    $('#mavt').attr('class', 'img-thumbnail');
  });
  $('#mavt').click(function(event) {
    $("#avatar").trigger('click');
      $("#avatar").change(function(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function(){
          var dataURL = reader.result;
          var output = document.getElementById('mavt');
          output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
      });
  });
</script>
<div>