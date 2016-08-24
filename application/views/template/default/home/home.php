<div class="container" >
    <div class="row">
        <div class="col-md-8">
            <div class="main-slideshow">
                <div class="flexslider">
                    <ul class="slides">
                        <?php 
                        foreach($dataSlider as $k => $v) { ?>
                        <li>
                            <img src="uploads/images/slide/<?= $v['img']?>" />
                            <div class="slider-caption PC">
                                <h2><a href="<?= $v['link']?>"><?php echo truncate(html_escape($v['title']), 100); ?></a></h2>
                                <p><?php echo truncate(html_escape($v['description']), 200); ?></p>
                            </div>
                            <div class="slider-caption SP">
                                <h2><a href="<?= $v['link']?>"><?php echo truncate(html_escape($v['title']), 60); ?></a></h2>
                            </div>
                        </li>
                        <?php } ?>
                    </ul> <!-- /.slides -->
                </div> <!-- /.flexslider -->
            </div> <!-- /.main-slideshow -->
        </div> <!-- /.col-md-12 -->
        <div class="col-md-4">
            <div class="widget-item list-depart" style="min-height:404px;max-height:404px;">
            <h4 class="widget-title" style = "color: #EB5705; font-size: 16px;"><?php echo lang('subordinate_units');?></h4>
                <div class="request-information" style = "margin-top: 10px;">
                <?php
                foreach ($departTypeLst as $type => $value) {
                    if($type == 'csdt') continue;
                    if(isset($dataDepartment[$type])&&count($dataDepartment[$type])){
                ?>
                    <label>
                        <?php
                            echo lang($type);
                        ?>
                    </label>
                    <div class="request-info clearfix">
                        <div class="full-row">
                            <div class="input-select">
                                <ul>
                                <?php
                                    foreach($dataDepartment[$type] as $key => $value){
                                        $k = 'name_'.$langCode;
                                        if(isset($value[$k]) && $value[$k] != '')
                                            echo '<li><a href="'.site_url($value['url_name']).'">'.$value[$k].'</a></li>';
                                    }
                                ?>
                                </ul>
                            </div> <!-- /.input-select -->
                        </div> <!-- /.full-row -->
                        </div>
                <?php } } ?>


            </div> <!-- /.widget-item -->
        </div> <!-- /.col-md-4 -->
        <script>
            (function($){
                $(window).load(function(){
                    $(".list-depart").mCustomScrollbar({theme:"minimal-dark"});
                });
            })(jQuery);
        </script>
    </div>
</div>
</div>

<div class="container">
<div class="row">

<!-- Here begin Main Content -->
<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
            <div class="widget-main">
            <div class="widget-main-title">
                <h4 class="welcome-text"><?php echo (isset($content_01['cate_name'])) ? $content_01['cate_name'] : ''; ?></h4>
                </div>
                <div class="widget-inner">
                    <?php foreach($content_01 as $key => $val) {
						if($key ==='cate_name'){
							continue;
						}
                        if($key > 1) {
                            break;
                        }
                    ?>
                        <div class="prof-list-item clearfix">
                            <div class="prof-thumb250x170">
                                <?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?><a href="<?php echo lang_url($siteName.'/'.$val['link'].$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><img style = "width:250px;height:170px;" src="uploads/images/news/<?php echo $image; ?>" alt="<?php echo truncate(html_escape($val['title']), 120); ?>"></a>
                            </div> <!-- /.prof-thumb -->
                            <div class="prof-details">
                                <h5 class="prof-name-list"><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></h5>
                                <p class="small-text"><?php echo truncate(html_escape($val['description']), 250); ?></p>
                            </div> <!-- /.prof-details -->
                        </div> <!-- /.prof-list-item -->
                    <?php } ?>
                    <div class="prof-list-item clearfix list-news">
                        <ul>
                            <?php foreach($content_01 as $key => $val) {
							if($key ==='cate_name'){
								continue;
							}
                            if($key < 2) {
                                continue;
                            }
                            ?>
                            <li><div class="after">&nbsp;&nbsp;</div><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- /.prof-list-item -->
                </div>
            </div> <!-- /.widget-item -->
            <div class="widget-item banner">
                <?php if(!empty($dataAds['banner_top_left'])) { ?>
                    <a href="<?php echo isset($dataAds['banner_top_left'][0]['link'])?$dataAds['banner_top_left'][0]['link']:'javascript:void(0)' ; ?>"><img src="uploads/images/ads/<?php echo $dataAds['banner_top_left'][0]['image'] ; ?>" alt="<?php echo truncate(html_escape($dataAds['banner_top_left'][0]['description']), 150)  ; ?>" style="width: 100%;"/></a>
                <?php } ?>
            </div>
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->

    <div class="row" style="">

        <!-- Show Latest Blog News -->
        <div class="col-md-6" style = "">
            <div class="widget-main">
                <div class="widget-main-title">
                    <h4 class="widget-title"><?php echo (isset($content_04['cate_name'])) ? $content_04['cate_name'] : ''; ?></h4>
                </div> <!-- /.widget-main-title -->
                <div class="widget-inner">
                    <div class="prof-list-item clearfix list-news">
                        <ul>
                            <?php foreach($content_04 as $key => $val) {
							if($key ==='cate_name'){
								continue;
							}?>
                            <li><div class="after">&nbsp;&nbsp;</div><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- /.blog-list-post -->
                </div> <!-- /.widget-inner -->
            </div> <!-- /.widget-main -->
        </div> <!-- /col-md-6 -->

        <!-- Show Latest Events List -->
        <div class="col-md-6"  style = "">
            <div class="widget-main">
                <div class="widget-main-title">
                    <h4 class="widget-title"><?php echo (isset($content_05['cate_name'])) ? $content_05['cate_name'] : ''; ?></h4>
                </div> <!-- /.widget-main-title -->
                <div class="widget-inner">
                    <div class="prof-list-item clearfix list-news">
                        <ul>
                            <?php foreach($content_05 as $key => $val) {
								if($key ==='cate_name'){
									continue;
								}?>
                                <li><div class="after">&nbsp;&nbsp;</div><a href="<?php echo lang_url($siteName.'/'.$val['link'].$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- /.blog-list-post -->
                </div> <!-- /.widget-inner -->

            </div> <!-- /.widget-main -->
        </div> <!-- /.col-md-6 -->

    </div> <!-- /.row -->


    <div class="row">
        <div class="col-md-12">


            <div class="widget-main">
            <div class="widget-main-title">
                <h4 class="welcome-text"><?php echo (isset($content_06['cate_name'])) ? $content_06['cate_name'] : ''; ?></h4>
                </div>
                <div class="widget-inner">
                    <?php foreach($content_06 as $key => $val) {
						if($key ==='cate_name'){
							continue;
						} ?>
                        <div class="prof-list-item clearfix">
                            <div class="prof-thumb250x170">
                                <?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><img src="uploads/images/news/<?php echo $image; ?>" alt="<?php echo truncate(html_escape($val['title']), 120); ?>"></a>
                            </div> <!-- /.prof-thumb -->
                            <div class="prof-details">
                                <h5 class="prof-name-list"><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></h5>
                                <p class="small-text"><?php echo truncate(html_escape($val['description']), 250); ?></p>
                            </div> <!-- /.prof-details -->
                        </div> <!-- /.prof-list-item -->
                    <?php break; } ?>
                    <div class="prof-list-item clearfix list-news">
                        <ul>
                            <?php foreach($content_06 as $key => $val) {
								if($key ==='cate_name'){
									continue;
								}
                                if($key < 1) {
                                    continue;
                                }
                                ?>
                                <li><div class="after">&nbsp;&nbsp;</div><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- /.prof-list-item -->
                </div>
            </div> <!-- /.widget-item -->

        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->

    <?php
        if(isset($dataPartner) && count($dataPartner)){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-main">
                    <div class="widget-main-title">
                        <h4 class="widget-title"><?php echo lang('links_coop');?></h4>
                    </div> <!-- /.widget-main-title -->
                    <div class="widget-inner">
                        <div id="jcl-demo">
                            <div class="custom-container scrollMore">
                                <a href="#" class="prev">&lsaquo;</a>
                                <div class="carousel" style ="height:150px;">
                                    <ul>
                                        <?php foreach($dataPartner as $val) { ?>
                                            <li><a target="_blank" href = "<?php echo $val['link'];?>"><img style = "width: 90%; height: 138px;" src="uploads/images/partner/<?php echo $val['image']; ?>" alt="<?php echo $val['title']; ?>" ></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <a href="#" class="next">&rsaquo;</a>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(function() {
                                $(".scrollMore .carousel").jCarouselLite({
                                    btnNext: ".scrollMore .next",
                                    btnPrev: ".scrollMore .prev",
                                    scroll: 1
                                });
                            });
                        </script>
                    </div>
                </div> <!-- /.widget-main -->
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
        <?php
        }
    ?>

</div> <!-- /.col-md-8 -->

<!-- Here begin Sidebar -->
<div class="col-md-4">

    <div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title"><?php echo (isset($content_02['cate_name'])) ? $content_02['cate_name'] : ''; ?></h4>
        </div>
        <div class="widget-inner">
            <?php foreach($content_02 as $key => $val) { 
				if($key ==='cate_name'){
					continue;
				}
			?>
            <div class="prof-list-item clearfix">
                <div class="prof-thumb">
                    <?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?><a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><img src="uploads/images/news/<?php echo $image; ?>" alt="<?php echo truncate(html_escape($val['title']), 120); ?>"></a>
                </div> <!-- /.prof-thumb -->
                <div class="prof-details">
                    <h5 class="prof-name-list"><a href = "<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></h5>
                    <p class="small-text"><?php echo truncate(html_escape($val['title']), 200); ?></p>
                </div> <!-- /.prof-details -->
            </div> <!-- /.prof-list-item -->
            <?php } ?>
        </div> <!-- /.widget-inner -->
    </div> <!-- /.widget-main -->
    <div class="widget-main-title">
        <?php if(!empty($dataAds['banner_top_right'])) { ?>
            <a href="<?php echo isset($dataAds['banner_top_right'][0]['link'])?$dataAds['banner_top_right'][0]['link']:'javascript:void(0)'; ?>"><img style="width:100%;"src="uploads/images/ads/<?php echo $dataAds['banner_top_right'][0]['image'] ; ?>" alt="<?php echo truncate(html_escape($dataAds['banner_top_right'][0]['description']), 150)  ; ?>" style="width: 100%;"/></a>
        <?php } ?>
    </div>
    <div class="widget-main">
        <div class="widget-main-title">
            <h4 class="widget-title"><?php echo (isset($content_03['cate_name'])) ? $content_03['cate_name'] : ''; ?></h4>
        </div>
        <div class="widget-inner">
            <div id="slider-testimonials">
                <ul>
                    <?php foreach($content_03 as $key => $val) {
						if($key ==='cate_name'){
							continue;
						}
                        if($key % 2 == 0) { ?>
                            <li>
                                <p>- <a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></p>
                        <?php } else { ?>
                            <p>- <a href="<?php echo lang_url($siteName.'/'.$val['link'].slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></p>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <div style="clear: both;">
                    <a class="prev fa fa-angle-left" href="#"></a>
                    <a class="next fa fa-angle-right" href="#"></a>
                </div>
            </div>
        </div> <!-- /.widget-inner -->
    </div> <!-- /.widget-main -->
    <?php
        if(isset($dataGallery) && count($dataGallery)){
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
                        <a class="fancybox" rel="gallery<?php echo $i;?>" href="uploads/images/gallery/<?php echo $val['image_default'];?>" title="<?php echo $key;?>">
                            <img src="uploads/images/gallery/<?php echo $val['image_default'];?>" alt="<?php echo $val['title_default'];?>" title="<?php echo $key;?>">
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
<?php
        }
    ?>
</div>
</div>
</div>
</div>