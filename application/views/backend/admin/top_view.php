<header class="main-header">
        <b class="logo">Admin</b>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
<?php
//Site
    // echo '<li><form class="navbar-form navbar-right" method="post" action="">
    // <div class="input-group input-group-sm"><div class="input-group-btn">
    //   <select class="form-control" name="lang_select"><optgroup label="Chọn ngôn ngữ">';
    //       foreach ((isset($language)?$language:array()) as $k => $val)
    //       {
    //         if ((isset($lang_selected)?$lang_selected:null) == $val['code'])
    //         {
    //           echo '<option selected value="'.$val['code'].'">'.$val['name'].'</option>';
    //         } else echo '<option value="'.$val['code'].'">'.$val['name'].'</option>';
    //       }
    //     echo '</select></div><div class="input-group-btn">';
      
    //   echo '</select></div><div class="input-group-btn">
    //        <button type="submit" class="btn btn-danger">Select</button>
    //         </div></div></form></li>';
?> 
			  <li class="">
                <a href="<?php echo (isset($total_comment_pending) && (int)$total_comment_pending >0)?site_url().'admin/comment/view_pending':site_url().'admin/comment/view_active';?>" class="dropdown-toggle">
                  <i class="fa fa-fw fa-comment-o"></i>
				  <?php
					if(isset($total_comment_pending) && (int)$total_comment_pending >0){
					?>
					<span class="label label-danger"><?php echo $total_comment_pending;?></span>
					<?php
					}
				  ?>
                </a>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=imgExist(isset($showuserinfo['avatar'])?('uploads/images/avatar/'.$showuserinfo['avatar']):null)?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?=(isset($showuserinfo['fullname'])?$showuserinfo['fullname']:null)?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?=imgExist(isset($showuserinfo['avatar'])?('uploads/images/avatar/'.$showuserinfo['avatar']):null)?>" class="img-circle" alt="User Image">
                    <p>
                      <?=(isset($showuserinfo['fullname'])?$showuserinfo['fullname']:null)?> - <?=(isset($showuserinfo['permit'])?(($showuserinfo['permit']==-1)?"Super Adminstator":($showuserinfo['permit']==1?"Admin":($showuserinfo['permit']==2?"Manager":($showuserinfo['permit']==0?"Member":"")))):null)?>
                      <small><?=(isset($showuserinfo['time_create'])?('Member since: '.date("d-m-Y", $showuserinfo['time_create'])):null)?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="admin/profile" class="btn btn-default btn-flat">Thông tin cá nhân</a>
                    </div>
                    <div class="pull-right">
                      <a href="admin/authentication/logout" class="btn btn-default btn-flat">Đăng xuất</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>