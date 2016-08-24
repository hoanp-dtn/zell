<!--<div class="container">
	<div class="page-title clearfix">
		<div class="row">
			<div class="col-md-12">
				<h6><a href="<?php echo $this->config->base_url($siteName);?>"><?php echo lang('home');?></a></h6>
				<h6><span class="page-active"><?php echo lang('search_article');?></span></h6>
			</div>
		</div>
	</div>
</div>
-->

<div class="container">
	<div class="row">

		<!-- Here begin Main Content -->
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<?php
						if(isset($list_posts_search) && is_array($list_posts_search) && count($list_posts_search)){
							foreach($list_posts_search as $key => $val){
								$image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg';
					?>
						<div class="list-event-item">
							<div class="box-content-inner clearfix">
								<div class="list-event-thumb">
									<a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>">
										<img src="uploads/images/news/<?php echo $image;?>" title = "<?php echo html_escape($val['title']);?>" alt="<?php echo html_escape($val['title']);?>">
									</a>
								</div>
								<div class="list-event-header">
									<span class="event-date small-text"><i class="fa fa-calendar-o"></i><?php echo lang('date_created').' : '.date('d/m/y',$val['time_create'])?></span>
									<div class="view-details"><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>" class="lightBtn"><?php echo lang('view_detail');?></a></div>
								</div>
								<?php
									$title_current = truncate(html_escape($val['title']),120);
									$title_highlight = str_replace($key_search,'<span style ="color:red; background:yellow;" >'.$key_search.'</span>',$title_current);	
								?>
								<h5 class="event-title"><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo $title_highlight; ?></a></h5>
								<p><?php echo truncate(html_escape($val['description']), 250); ?></p>
							</div> <!-- /.box-content-inner -->
						</div> <!-- /.list-event-item -->
						<?php
							}
						}else{
						?>
						<div class="list-event-item">
							<div class="box-content-inner clearfix">
								<h5 class="event-title"><?php echo lang('notfound_article');?></h5>
							</div> <!-- /.box-content-inner -->
						</div> <!-- /.list-event-item -->
						<?php
						}
					?>
				</div> <!-- /.col-md-12 -->

			</div> <!-- /.row -->

			<div class="row">
				<div class="col-md-12">
					<?php echo $list_paginition; ?>
				</div> <!-- /.col-md-12 -->
			</div> <!-- /.row -->

		</div> <!-- /.col-md-8 -->


<!-- Here begin Sidebar -->
<div class="col-md-4">
	<?php
		if(isset($getPostAndNew)&&count($getPostAndNew)) {
	?>
	<div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title"><?php echo lang('news');?></h4>
        </div>
        <div class="widget-inner">
            
				<?php
					foreach($getPostAndNew as $key => $value) {
				?><div class="prof-list-item clearfix">
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
				?>
        </div> <!-- /.widget-inner -->
    </div> <!-- /.widget-main -->
	<?php
		}
	?>
	<?php
		if(isset($dataGallery)&&count($dataGallery)) {
	?>
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
							if(count($val)){
								foreach($val as $keyItem => $valItem){
								?>
								<a class="fancybox" rel="gallery<?php echo $i;?>" href="uploads/images/gallery/<?php echo isset($valItem['image'])?$valItem['image']:'';?>" title="	<?php isset($valItem['title'])?$valItem['title']:'';?>">
								</a>
								<?php
								}
							}
						?>
					</div>
					<?php
					}
				?>
            </div> <!-- /.galler-small-thumbs -->
        </div> <!-- /.widget-inner -->
    </div> <!-- /.widget-main -->
	<?php
		}
	?>

</div>

	</div> <!-- /.row -->
</div>
