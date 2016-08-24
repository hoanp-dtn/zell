<script src="publics/admin/myJs/SiteJs.js" type="text/javascript"></script>
<script>
$('select#user_select').select2();
</script>
<div id="mypopup" >
<div class="input-group">
  <select id="user_select" style="width: 50%;">
    <?php
      if (isset($userdata) && !empty($userdata))
      {
        
        foreach ($userdata as $key => $value) {
          echo '<option value="'.$value['id'].'">'.$value['username'].' | '.$value['fullname'].'</option>';
        }
      }
    ?>
  </select>
    <span class="input-group-btn">
      <button id="select_manager" value="<?=isset($site_id)?$site_id:null?>" class="btn btn-info btn-flat" type="button">Chọn làm quản lý site</button>
    </span>
</div>
<div class="box-body">
<?php
        if(isset($message)&&!empty($message))
        {
            
            echo '<div id="notification" class="alert alert-success alert-dismissable">
                  <h4><i class="icon fa fa-check"></i>Thông báo!</h4>';
            echo $message;
            echo '</div>';
        }
    ?>
  <table id="table_manager" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Email</th>
          <th>Full name</th>
          <th>Phone</th>
        </tr>
      </thead>
        <tbody>
        <?php 
        if (isset($site_user)&&!empty($site_user))
        {
          foreach ($site_user as $key => $value) {
            echo '<tr>
                    <td class=" sorting_1">'.($key+1).'</td>
                    <td class=" ">'.$value['username'].'</td>
                    <td class=" ">'.$value['email'].'</td>
                    <td class=" ">'.$value['fullname'].'</td>
                    <td class=""><button type="button" class="close" value="'.$value['id'].'">×</button>'.$value['phone'].'</td>
                  </tr>';
          }
        }

        ?>
        </tbody>
    </table>
</div>
</div>