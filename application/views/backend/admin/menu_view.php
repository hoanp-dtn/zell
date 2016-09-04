  
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=imgExist(isset($showuserinfo['avatar'])?('uploads/images/avatar/'.$showuserinfo['avatar']):null)?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?=(isset($showuserinfo['fullname'])?$showuserinfo['fullname']:null)?></p>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("category",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Danh mục bài viết</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("category/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/category/view'?>"><i class="fa fa-circle-o"></i> Danh sách danh mục</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("category/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/category/add'?>"><i class="fa fa-circle-o"></i> Thêm danh mục</a></li>
              </ul>
            </li>
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("category_product",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Danh mục sản phẩm</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("category_product/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/category_product/view'?>"><i class="fa fa-circle-o"></i> Danh sách</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("category_product/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/category_product/add'?>"><i class="fa fa-circle-o"></i> Thêm</a></li>
              </ul>
            </li>
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("post",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Quản lí bài viết</span>
        <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("post/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/posts/view'?>"><i class="fa fa-circle-o"></i>Danh sách bài viết</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("post/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/posts/add'?>"><i class="fa fa-circle-o"></i>Thêm bài viết</a></li>
        <li class = "<?php if(isset($active) && count($active)){echo (in_array("post/recycle",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/posts/recycle'?>"><i class="fa fa-circle-o"></i>Thùng rác</a></li>
              </ul>
            </li>
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("product",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Quản lí sản phẩm</span>
        <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("product/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/product/view'?>"><i class="fa fa-circle-o"></i>Danh sách</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("product/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/product/add'?>"><i class="fa fa-circle-o"></i>Thêm</a></li>
        <li class = "<?php if(isset($active) && count($active)){echo (in_array("product/recycle",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/product/recycle'?>"><i class="fa fa-circle-o"></i>Thùng rác</a></li>
              </ul>
            </li>
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("order",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Quản lí đơn hàng</span>
        <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("order/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/order/view'?>"><i class="fa fa-circle-o"></i>Danh sách đơn hàng</a></li>
              </ul>
            </li>
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("review",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Quản lí đánh giá sản phẩm</span>
				<i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("review/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/review/view'?>"><i class="fa fa-circle-o"></i>Danh sách đánh giá</a></li>
              </ul>
            </li>
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("slide",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản lí slide</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("slide/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/slide/view'?>"><i class="fa fa-circle-o"></i>Danh sách slide</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("slide/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/slide/add'?>"><i class="fa fa-circle-o"></i>Thêm slide</a></li>
              </ul>
            </li> 
            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("contact",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản lí liên hệ</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("contact/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/contact/view'?>"><i class="fa fa-circle-o"></i>Danh sách</a></li>
               
              </ul>
            </li>
            <li class="treeview  <?php if(isset($active) && count($active)){echo (in_array("navigation",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản lí menu</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("navigation/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/navigation/view'?>"><i class="fa fa-circle-o"></i>Danh sách menu</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("navigation/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/navigation/add'?>"><i class="fa fa-circle-o"></i>Thêm menu</a></li>
              </ul>
            </li>
			<li class="treeview  <?php if(isset($active) && count($active)){echo (in_array("partner",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Đối tác</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("partner/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/partner/view'?>"><i class="fa fa-circle-o"></i>Danh sách đối tác</a></li>
                <li <?php if(isset($active) && count($active)){echo (in_array("partner/add",$active))?" active":"";}?>><a href="<?php echo site_url().'admin/partner/add'?>"><i class="fa fa-circle-o"></i>Thêm đối tác</a></li>
              </ul>
            </li>
			<li class="treeview <?php if(isset($active) && count($active)){echo (in_array("ads",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản lí quảng cáo</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("ads/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/ads/view'?>"><i class="fa fa-circle-o"></i>Danh sách quảng cáo</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("ads/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/ads/add'?>"><i class="fa fa-circle-o"></i>Thêm quảng cáo</a></li>
              </ul>
            </li>
			<li class="treeview <?php if(isset($active) && count($active)){echo (in_array("admin",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản trị viên</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("admin/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/usermanager'?>"><i class="fa fa-circle-o"></i>Quản lý tài khoản</a></li>		
                <li	class = "<?php if(isset($active) && count($active)){echo (in_array("admin/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/usermanager/addaccount'?>"><i class="fa fa-circle-o"></i>Thêm tài khoản</a></li>
              </ul>
            </li>
			<li class="treeview <?php if(isset($active) && count($active)){echo (in_array("gallery",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản lí album ảnh</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("gallery/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/gallery/view'?>"><i class="fa fa-circle-o"></i>Danh sách album ảnh</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("gallery/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/gallery/add'?>"><i class="fa fa-circle-o"></i>Thêm album ảnh</a></li>
              </ul>
            </li>

            <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("video",$active))?" active":"";}?>">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Quản lí video</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("video/view",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/video/view'?>"><i class="fa fa-circle-o"></i>Danh sách video</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("video/add",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/video/add'?>"><i class="fa fa-circle-o"></i>Thêm video</a></li>
              </ul>
            </li>
			<li class="treeview <?php if(isset($active) && count($active)){echo (in_array("comment",$active))?" active":"";}?>">
              <a href="<?php echo site_url().'admin/comment/view_pending'?>">
                <i class="fa fa-edit"></i> <span>Quản lí Comment</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("comment/view_pending",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/comment/view_pending'?>"><i class="fa fa-circle-o"></i>Comment chưa được duyệt</a></li>
                <li class = "<?php if(isset($active) && count($active)){echo (in_array("comment/view_active",$active))?" active":"";}?>"><a href="<?php echo site_url().'admin/comment/view_active'?>"><i class="fa fa-circle-o"></i>Comment đã duyệt</a></li>
              </ul>
            </li>
              <?php if ($this->session->userdata('site_select') == 25) { ?>
                <li class="treeview <?php if(isset($active) && count($active)){echo (in_array("examiner",$active))?" active":"";}?>">
                  <a href="<?php echo site_url().'admin/examiner/view'?>">
                    <i class="fa fa-edit"></i> <span>Quản lí chấm thi</span>
                  </a>
                </li>
              <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>