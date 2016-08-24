
<div id="k-body"><!-- content wrapper -->

<div class="container"><!-- container -->

<div class="row"><!-- row -->

    <div id="k-top-search" class="col-lg-12 clearfix"><!-- top search -->

        <form action="#" id="top-searchform" method="get" role="search">
            <div class="input-group">
                <input type="text" name="s" id="sitesearch" class="form-control" autocomplete="off" placeholder="Type in keyword(s) then hit Enter on keyboard" />
            </div>
        </form>

        <div id="bt-toggle-search" class="search-icon text-center"><i class="s-open fa fa-search"></i><i class="s-close fa fa-times"></i></div><!-- toggle search button -->

    </div><!-- top search end -->
</div><!-- row end -->
</div><!-- container end -->
<div style="margin-top: 20px; margin-bottom: 20px;" class="container">
    <?php if(!empty($dataAds['banner_top_left'])) { ?>
        <a href="<?php echo $dataAds['banner_top_left'][0]['link'] ; ?>"><img src="uploads/images/ads/<?php echo $dataAds['banner_top_left'][0]['image'] ; ?>" alt="<?php echo truncate(html_escape($dataAds['banner_top_left'][0]['description']), 150)  ; ?>" style="width: 100%; box-shadow: 0px 1px 3px;"/></a>
    <?php } ?>
</div>
<div class="container"><!-- container -->

    <div class="row no-gutter"><!-- row -->

        <div class="col-lg-8 col-md-8"><!-- doc body wrapper -->
                	
                    <div class="col-padded"><!-- inner custom column -->
                    
                    	<div class="row gutter"><!-- row -->
                        
                        	<div class="col-lg-12 col-md-12">
                                <div class="events-title-meta clearfix">
                                    <h1 class="page-title"><?php echo $post_detail['title'];?></h1>
                                    <div class="event-meta">
                                        <span class="event-from">Ngày đăng : <?php echo ($post_detail['time_update']!='')?date('H:i:s d/m/y',$post_detail['time_update']):date('H:i:s d/m/y',$post_detail['time_create']);?></span>
                                    </div>
                                </div>
                                
                                <div class="news-body clearfix">
                                    <p>
										<?php echo $post_detail['detail'];?>
                                    </p>
                                </div>
                            </div>
                        </div><!-- row end -->  
                    </div><!-- inner custom column end -->
                </div><!-- doc body wrapper end -->
        <div class="col-lg-4 col-md-4"><!-- widgets column right -->

            <div class="col-padded col-naked">

                <ul class="list-unstyled clear-margins"><!-- widgets -->
                    <li class="widget-container widget_recent_news"><!-- widgets list -->
						<h1 class="title-widget"><?php echo lang('related_news')?></h1>
						<ul class="list-unstyled">
							<li class="recent-news-wrap news-no-summary">
								<div class="recent-news-content clearfix">
								<?php if(isset($getPostAndRelative)&&count($getPostAndRelative)) {
									foreach($getPostAndRelative as $key => $val) {
								?>
									<figure class="recent-news-thumb">
										<?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>"><img style = "width: 120px; margin-right: 5px;"src="uploads/images/news/<?php echo $image; ?>" alt="<?php echo truncate(html_escape($val['title']), 120); ?>"></a>
									</figure>
									<div class="recent-news-text">
										<h1 class="title-median"><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></h1>
									</div>
									<p><?php echo truncate(html_escape($val['description']), 250); ?></p>
								<?php
									}
								}
								?>
								</div>
							</li>
						</ul>
						<h1 class="title-widget"><?php echo lang('news')?></h1>
						<ul class="list-unstyled">
							<li class="recent-news-wrap news-no-summary">
								<div class="recent-news-content clearfix">
								<?php if(isset($getPostAndNew)&&count($getPostAndNew)) {
									foreach($getPostAndNew as $key => $val) {
								?>
									<figure class="recent-news-thumb">
										<?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>"><img style = "width: 120px; margin-right: 5px;"src="uploads/images/news/<?php echo $image; ?>" alt="<?php echo truncate(html_escape($val['title']), 120); ?>"></a>
									</figure>
									<div class="recent-news-text">
										<h1 class="title-median"><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 120); ?></a></h1>
									</div>
									<p><?php echo truncate(html_escape($val['description']), 250); ?></p>
								<?php
									}
								}
								?>
								</div>
							</li>
						</ul>
					</li><!-- widgets list end -->
                </ul>
            </div>
        </div><!-- widgets column right end -->
    </div><!-- row end -->
</div>
</div><!-- content wrapper end -->


