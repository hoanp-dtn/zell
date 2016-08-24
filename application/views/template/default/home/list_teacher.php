<div class="container">
<div class="row">

<!-- Here begin Main Content -->
<div class="col-md-8">
	<div class="row">

				<div class="col-md-12">
						<div class="list-event-item">
						<?php
						if(isset($listTeacher) && count($listTeacher)){
							foreach($listTeacher as $key => $val){
							?>
							<div class="box-content-inner clearfix">
								<div class="list-event-thumb">
									<a href="<?php echo $this->config->base_url().'teacher.php/'.slug($val['fullname']).'-gv'.$val['id'].'.html';?>">
										<img src="<?php echo ($val['avatar']!="")?$this->config->base_url('uploads/images/avatar').'/'.$val['avatar']:$this->config->base_url('publics/template/default/images').'/default-user.png';?>" alt="<?php echo $val['fullname'];?>">
									</a>
								</div>
								<h5 class="event-title" ><a style = "font-size: 26px;
    margin: 12px 0 10px 0;" href="<?php echo $this->config->base_url().'teacher.php/'.slug($val['fullname']).'-gv'.$val['id'].'.html';?>"><?php echo $val['fullname'];?></a></h5>
								<span><?php echo lang('role');?> : <?php echo (isset($val['role']) && $val['role'] !="")?$val['role']:'Giảng viên';?></span>
								<div class="list-event-header">
									<div class="view-details" style = "    margin: 42px 0px 0px 0px;
    float: left;"><a href="<?php echo $this->config->base_url().'teacher.php/'.slug($val['fullname']).'-gv'.$val['id'].'.html';?>" class="lightBtn"><?php echo lang('view_detail');?></a></div>
								</div>
							</div> <!-- /.box-content-inner -->
							<?php
							}
						?>
						
						<?php
						}else{
							echo lang('no_teacher');
						}
						?>
							
						</div> <!-- /.list-event-item -->
										</div> <!-- /.col-md-12 -->

			</div>

</div> <!-- /.col-md-8 -->

<!-- Here begin Sidebar -->
<div class="col-md-4">
	<div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title"><?php echo lang('news');?></h4>
        </div>
        <div class="widget-inner">
				<?php if(isset($getPostAndNew)&&count($getPostAndNew)) {
					foreach($getPostAndNew as $key => $value) {
				?>
            <div class="prof-list-item clearfix">
                           <div class="prof-thumb">
                                <?php $image = ($value['image'] != '') ? $value['image'] : 'no-image.jpg'; ?><a href="<?php echo lang_url($siteName.'/'.$value['link'].slug($value['title']).'-a'.$value['id'].'.html');?>"><img src="uploads/images/news/<?php echo $image; ?>" alt="<?php echo truncate(html_escape($value['title']), 120); ?>"></a>
                            </div> <!-- /.prof-thumb -->
                            <div class="prof-details">
                                <h5 class="prof-name-list"><a href="<?php echo lang_url($siteName.'/'.$value['link'].slug($value['title']).'-a'.$value['id'].'.html');?>"><?php echo truncate(html_escape($value['title']), 120); ?></a></h5>
                                <p class="small-text"><?php echo truncate(html_escape($value['description']), 250); ?></p>
                            </div> <!-- /.prof-details -->
            </div> <!-- /.prof-list-item -->
				<?php 
					}
				}
				?>
        </div> <!-- /.widget-inner -->
    </div> <!-- /.widget-main -->
    <div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title"><?php echo lang('gallery');?></h4>
        </div>
        <div class="widget-inner">
            <div class="gallery-small-thumbs clearfix">
                <?php
					$i = 0;
					foreach($dataGallery as $key => $val){
						$i++;
					?>
					<div class="thumb-small-gallery">
						<a class="fancybox" rel="gallery<?php echo $i;?>" href="uploads/images/gallery/<?php echo $val['image_default'];?>" title="<?php echo $val['title_default'];?>">
							<img src="uploads/images/gallery/<?php echo $val['image_default'];?>" alt="<?php echo $val['title_default'];?>">
						</a>
						<?php 
							foreach($val as $keyItem => $valItem){
							?>
							<a class="fancybox" rel="gallery<?php echo $i;?>" href="uploads/images/gallery/<?php echo isset($valItem['image'])?$valItem['image']:'';?>" title="	<?php echo isset($valItem['title'])?$valItem['title']:'';?>">
							</a>
							<?php
							}
						?>
					</div>
					<?php
					}
				?>
            </div> <!-- /.galler-small-thumbs -->
        </div> <!-- /.widget-inner -->
    </div> <!-- /.widget-main -->

</div>
</div>
</div>
<script>
$(".tv li:last-child").addClass('tvil');
</script>

