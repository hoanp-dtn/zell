<div class="container">
<div class="row">

<!-- Here begin Main Content -->
<div class="col-md-8">
	 <div class="row">

		<div class="col-md-12">
			<div class="widget-main">
			<div class="widget-main-title">
				<h4 class="widget-title"><?php echo lang('gallery');?></h4>
			</div>
			<div class="row" style = "    background-color: #EFEFEF;">
                    <?php
						if(isset($dataGallery) && count($dataGallery)){
					?>
                    <div id = "grid">
                        
                    <?php
					$i = 0;
					foreach($dataGallery as $key => $val){
						$i++;
					?>
                    <div class="col-md-4 mix students">
                        <div class="gallery-item">
                            <a class="fancybox" rel="gallery_page<?php echo $i;?>" href="uploads/images/gallery/<?php echo $val['image_default'];?>" title = "<?php echo $val['title_default'];?>">
                                <div class="gallery-thumb">
                                    <img src="uploads/images/gallery/<?php echo $val['image_default'];?>" alt="<?php echo $val['title_default'];?>">
                                </div>
                                <div class="gallery-content">
                                    <h4 class="gallery-title"><?php echo truncate($key,60);?></h4>
                                </div>
                            </a>
							<?php 
							foreach($val as $keyItem => $valItem){
							?>
                            <a class="fancybox" rel="gallery_page<?php echo $i;?>" href="uploads/images/gallery/<?php echo isset($valItem['image'])?$valItem['image']:'';?>" title = "<?php echo isset($valItem['title'])?$valItem['title']:'';?>">
                            </a>
							<?php
							}
						?>
                        </div> <!-- /.gallery-item -->
                    </div> <!-- /.col-md-4 -->
						<?php
						}
					?>
                    </div> <!-- /#Grid -->
					<?php
						}else{
						?>
						<div class="widget-inner">
						<p><?php echo lang('no_gallery');?></p>
						</div>
						<?php
						}
					?>
                </div>
			</div> <!-- /.widget-main -->
		</div> <!-- /.col-md-12 -->

	</div> <!-- /.row -->

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

