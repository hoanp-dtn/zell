<div class="content-wrapper" style="min-height: 918px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Quản lí tài khoản
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><b>Thông tin cá nhân</b></h3>
          </div>
        	<!-- View -->
            <div class="box-body">
            <ul class="todo-list ui-sortable">
            <li><strong>Username:&nbsp;&nbsp;</strong><?=isset($profile['username'])?$profile['username']:""?></li>
            <li><strong>Email:&nbsp;&nbsp;</strong><?=isset($profile['email'])?$profile['email']:""?></li>
            <li><strong>Họ tên:&nbsp;&nbsp;</strong><?=isset($profile['fullname'])?$profile['fullname']:""?></li>
            <li><strong>Loại TK:&nbsp;&nbsp;</strong><?=(isset($profile['permit'])?(($profile['permit']==-1)?'Super Adminstrator':(($profile['permit']==1)?'Admin':(($profile['permit']==2)?'Manager':'Member'))):null)?></li>
            <li><strong>Tỉnh/Thành phố:&nbsp;&nbsp;</strong><?=isset($profile['city'])?$profile['city']:""?></li>
            <li><strong>Địa chỉ:&nbsp;&nbsp;</strong><?=isset($profile['address'])?$profile['address']:""?></li>
            <li><strong>SĐT:&nbsp;&nbsp;</strong><?=isset($profile['phone'])?$profile['phone']:""?></li>
            <li><strong>Chi nhánh:&nbsp;&nbsp;</strong><?=isset($profile['brch'])?$profile['brch']:""?></li>
            <li><strong>Khoa, phòng:&nbsp;&nbsp;</strong><?=isset($profile['department'])?$profile['department']:""?></li>
			</ul>
			<hr>
			<a class="btn btn-default" href="admin/profile/edit">Thay đổi thông tin</a>
			<a class="btn btn-default" href="admin/profile/changepass">Đổi mật khẩu</a>
            </div><!--View end-->

        </div>
        </section><!-- /.content -->
</div>
