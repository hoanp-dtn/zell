</div>
<article class="post-listing post">
	<div class="single-post-thumb"></div>
	<div class="post-inner">
	<?php
		$msg = $this->session->flashdata('notification');
		if (!empty($msg)) {
			echo '<div class="alert alert-warning alert-dismissable"><b><i class="icon fa fa-'.(isset($msg['type'])?$msg['type']:null).'"></i>Thông báo</b><br>'.(isset($msg['message'])?$msg['message']:null).'</div>';
		}
	?>
	<h1 class="post-title">Danh Sách Giảng Viên</h1><p class="post-meta"></p>
	<div class="clear"></div>
		<div class="entry">
		<ul class="row">
		<?php
			if (isset($listGV)&&!empty($listGV)) {
				foreach ($listGV as $key => $value) {
					echo '<li class="col-md-6">
							<div class="author-bio">
								<div class="author-avatar">
									<img class="avatar avatar-90 photo img-thumbnail" src="'.imgExist(base_url().'uploads/images/avatar/'.$value['avatar']).'"  height="90" width="90">
								</div>
								<div class="author-description">
									<h3><a href="teacher.php/'.slug($value['fullname']).'-gv'.$value['id'].'.html'.'">'.$value['fullname'].'</a></h3>
									'.(isset($value['khoa'])?(' - '.$value['khoa']):null).'<br>'.(isset($value['coso'])?(' - '.$value['coso']):null).'
								</div>
								<div>
									<a class="more-link" href="teacher.php/'.slug($value['fullname']).'-gv'.$value['id'].'.html'.'">Xem Chi Tiết »</a>
								</div>
								<div class="clear"></div>
							</div>
						</li>';
				}
			}
		?>
		</ul>
		</div>
	</div>
</article>