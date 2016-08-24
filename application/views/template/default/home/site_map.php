<div class="container">
<div class="row">

<!-- Here begin Main Content -->
<div class="col-md-8">
	 <div class="row">

		<div class="col-md-12">
			<div class="widget-main">
			<div class="widget-main-title">
				<h4 class="widget-title"><?php echo lang('sitemap');?></h4>
			</div>
				<div class="widget-inner">
					<div class="smapcontent" style="border-radius: 8px;">
		<div id="smhome" class="smaptitle">
				<?php echo lang('home');?>
		</div>
		<ul class="tv">
					
					<?php 
					// print_r($dataMenu);die;
						function displaySitemap($dataMenu,$siteName){
							$href = ($dataMenu['url']!="")?$dataMenu['url']:(((int)$dataMenu['cate_id'] !=0)?lang_url($siteName.'/'.$dataMenu['link'].'-n'.$dataMenu['id'].'.html'):'javascript:(void(0))');
						?>
							
							<li><a style="font-size:13px;font-weight:bold" href="<?php echo $href;?>"><?php echo $dataMenu['title'];?></a>
								<?php
									if(isset($dataMenu['children'])){
										?>
										<ul>
										<?php
										foreach($dataMenu['children'] as $key => $val){
											displaySitemap($val,$siteName);
										}
										?>
										</ul>
										<?php
									}
								?>
							</li>
						<?php
						}
						if(!empty($dataMenu)){
							foreach($dataMenu as $key => $val){
							displaySitemap($val,$siteName);
						}
						}
					?>
		</ul>
		<?php
		if(isset($dataDepartment['phong-ban'])&&count($dataDepartment['phong-ban'])){
		?>
		<div id="smhome" class="smaptitle">
			<?php echo lang('phong-ban');?>
		</div>
		<ul class="tv">
					
			<?php 
				foreach($dataDepartment['phong-ban'] as $key => $value){
			?>
					<li><a  style="font-size:13px;font-weight:bold" href="<?php echo $value['url_name'] ;?>">
							<?php
								if($langCode=='vn') {
									echo $value['name_vn'];
								}
								if($langCode=='en') {
									echo $value['name_en'];
								}
							?>
						</a>
					</li>
				<?php
				}
			?>
		</ul>
		<?php
		}
		?>
		<?php
		if(isset($dataDepartment['khoa'])&&count($dataDepartment['khoa'])){
		?>
		<div id="smhome" class="smaptitle">
			<?php echo lang('khoa');?>
		</div>
		<ul class="tv">
					
			<?php 
				foreach($dataDepartment['khoa'] as $key => $value){
			?>
					<li><a  style="font-size:13px;font-weight:bold" href="<?php echo $value['url_name'] ;?>">
							<?php
								if($langCode=='vn') {
									echo $value['name_vn'];
								}
								if($langCode=='en') {
									echo $value['name_en'];
								}
							?>
						</a>
					</li>
				<?php
				}
			?>
		</ul>
		<?php
		}
		?>
		<?php
		if(isset($dataDepartment['bomon'])&&count($dataDepartment['bomon'])){
		?>
		<div id="smhome" class="smaptitle">
			<?php echo lang('bomon');?>
		</div>
		<ul class="tv">
					
			<?php 
				foreach($dataDepartment['bomon'] as $key => $value){
			?>
					<li><a style="font-size:13px;font-weight:bold"  href="<?php echo $value['url_name'] ;?>">
							<?php
								if($langCode=='vn') {
									echo $value['name_vn'];
								}
								if($langCode=='en') {
									echo $value['name_en'];
								}
							?>
						</a>
					</li>
				<?php
				}
			?>
		</ul>
		<?php
		}
		?>
		
	</div>
				</div> <!-- /.widget-inner -->
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

