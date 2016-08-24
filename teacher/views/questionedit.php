<div class="col s12 m8 l8">
	<div class="main section" >
		<div class="widget Blog">
			<div class="post-single-outer card-panel">

				<?php
					if (isset($notification)&&!empty($notification))
					{
						if (isset($notification['success']) && !empty($notification['success'])) 
						{
							echo '<div class="alert alert-success">'.$notification['success'].'</div>';
						} else echo '<div class="alert alert-warning">'.(isset($notification['error'])?$notification['error']:null).'</div>';
					}
					$listerror = $this->session->flashdata('listerror');
					if (isset($listerror)&&!empty($listerror))
					{
						echo '<div class="alert alert-warning"><ul>';
						foreach ($listerror as $key => $value) {
						   echo '<li>'.$value.'</li>';
						} 
						echo '</ul></div>';
					}
				?>
				<form class="form-horizontal" method="post">
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Họ Tên:</label>
				    <div class="col-sm-10">
				      <input id="qname" name="qname" type="text" class="form-control" value="<?=isset($cmt['name'])?$cmt['name']:null?>" placeholder="Nhập họ tên...">
				    </div>
				  </div>
				  <div class="form-group">
				    <label  class="col-sm-2 control-label">Email:</label>
				    <div class="col-sm-10">
				      <input id="qemail" name="qemail"type="email" class="form-control" value="<?=isset($cmt['email'])?$cmt['email']:null?>" placeholder="Nhập email...">
				    </div>
				  </div>
				  <div class="form-group">
				    <label  class="col-sm-2 control-label">Nội dung:</label>
				    <div class="col-sm-10">
				      <textarea id="qvalue" name="qvalue" class="form-control" rows="4" placeholder="Nhập câu hỏi..."><?=isset($cmt['value'])?$cmt['value']:null?></textarea>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button id="btnQuestion" type="submit" data-loading-text="Xin chờ..." class="btn btn-default">Cập nhật</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>