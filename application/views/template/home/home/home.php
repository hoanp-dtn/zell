
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

    <div class="k-breadcrumbs col-lg-12 clearfix"><!-- breadcrumbs -->

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Page Example</li>
        </ol>

    </div><!-- breadcrumbs end -->

</div><!-- row end -->

<div class="row no-gutter fullwidth"><!-- row -->

    <div class="col-lg-12 clearfix"><!-- featured posts slider -->

        <div id="carousel-featured" class="carousel slide" data-interval="4000" data-ride="carousel"><!-- featured posts slider wrapper; auto-slide -->

            <ol class="carousel-indicators"><!-- Indicators -->
                <?php foreach($dataSlider as $k => $v) { ?>
                <li data-target="#carousel-featured" data-slide-to="<?php echo $k; ?>" <?php echo ($k == 0) ? 'class="active"' : ''; ?>></li>
                <?php } ?>
            </ol><!-- Indicators end -->

            <div class="carousel-inner"><!-- Wrapper for slides -->
                <?php foreach($dataSlider as $k => $v) { ?>
                    <div class="item <?php echo ($k < 1 ) ? 'active' : ''?>">
                        <img src="uploads/images/slide/<?= $v['img']?>" alt="<?php echo truncate(html_escape($v['description']), 100); ?>" />
                        <div class="k-carousel-caption pos-2-3-left scheme-dark">
                            <div class="caption-content">
                                <h3 class="caption-title"><?php echo truncate(html_escape($v['description']), 100); ?></h3>
                                <p>
                                    <?php echo truncate(html_escape($v['description']), 200); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div><!-- Wrapper for slides end -->

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-featured" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
            <a class="right carousel-control" href="#carousel-featured" data-slide="next"><i class="fa fa-chevron-right"></i></a>
            <!-- Controls end -->

        </div><!-- featured posts slider wrapper end -->

    </div><!-- featured posts slider end -->

</div><!-- row end -->

<div class="row no-gutter"><!-- row -->

<div class="col-lg-4 col-md-4"><!-- upcoming events wrapper -->

    <div class="col-padded col-shaded"><!-- inner custom column -->

        <ul class="list-unstyled clear-margins"><!-- widgets -->

            <li class="widget-container widget_up_events"><!-- widgets list -->

                <h1 class="title-widget"><?php echo (isset($content_04[0]['cate_name'])) ? $content_04[0]['cate_name'] : ''; ?></h1>

                <ul class="list-unstyled">
                    <?php foreach($content_04 as $key => $val) {
                        if($key > 2) break;
                        ?>
                        <li class="up-event-wrap">

                            <h1 class="title-median"><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" title="Annual alumni game"><?php echo truncate(html_escape($val['title']), 120); ?></a></h1>

                            <div class="up-event-meta clearfix">
                                <div class="up-event-date">Ngày đăng </div><div class="up-event-time"><?php echo date("d-m-Y", $val['time_create']); ?></div>
                            </div>

                            <p>
                                <?php echo truncate(html_escape($val['description']), 200); ?> <a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" class="moretag" title="read more">MORE</a>
                            </p>

                        </li>
                    <?php } ?>

                </ul>

            </li><!-- widgets list end -->

        </ul><!-- widgets end -->

    </div><!-- inner custom column end -->

</div><!-- upcoming events wrapper end -->

<div class="col-lg-4 col-md-4"><!-- recent news wrapper -->

    <div class="col-padded"><!-- inner custom column -->

        <ul class="list-unstyled clear-margins"><!-- widgets -->

            <li class="widget-container widget_recent_news"><!-- widgets list -->

                <h1 class="title-widget"><?php echo (isset($content_02[0]['cate_name'])) ? $content_02[0]['cate_name'] : ''; ?></h1>

                <ul class="list-unstyled">
                    <?php foreach($content_02 as $key => $val) {
                        if($key > 2) break;
                    ?>
                        <li class="recent-news-wrap">
                            <?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?>
                            <h1 class="title-median"><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></h1>

                            <div class="recent-news-meta">
                                <div class="recent-news-date"><?php echo date("d-m-Y", $val['time_create']); ?></div>
                            </div>

                            <div class="recent-news-content clearfix">
                                <figure class="recent-news-thumb">
                                    <a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><img src="uploads/images/news/<?php echo $image; ?>" class="attachment-thumbnail wp-post-image" alt="<?php echo truncate(html_escape($val['title']), 65); ?>" /></a>
                                </figure>
                                <div class="recent-news-text">
                                    <p>
                                        <?php echo truncate(html_escape($val['description']), 150); ?>&nbsp;&nbsp;<a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" class="moretag" title="read more">MORE</a>
                                    </p>
                                </div>
                            </div>

                        </li>
                    <?php } ?>

                </ul>

            </li><!-- widgets list end -->

        </ul><!-- widgets end -->

    </div><!-- inner custom column end -->

</div><!-- recent news wrapper end -->

<div class="col-lg-4 col-md-4"><!-- misc wrapper -->

    <div class="col-padded col-shaded"><!-- inner custom column -->

        <ul class="list-unstyled clear-margins"><!-- widgets -->

            <li class="widget-container widget_course_search"><!-- widget -->

                <form role="search" method="get" id="course-finder" action="#">
                    <div class="input-group">
                        <input type="text" placeholder="<?php echo lang('search_article');?>..." autocomplete="off" class="form-control" id="find-course" name="find-course" />
                        <span class="input-group-btn"><button type="submit" class="btn btn-default">GO!</button></span>
                    </div>
                    <span class="help-block">* <?php echo lang('key_search');?>.</span>
                </form>

            </li><!-- widget end -->

            <li class="widget-container widget_text"><!-- widget -->

                <h1 class="title-titan"><?php echo lang('to_organize');?></h1>
                <div class="custom-button cb-green">
                    <span class="custom-button-title"><?php echo lang('to_organize');?></span>
                            <span class="custom-button-wrap" >
                                <span class="custom-button-tagline"><a href="">Phòng Đào tạo</a></span>
                                <span class="custom-button-tagline"><a href="">Phòng Đào tạo Sau đại học</a></span>
                                <span class="custom-button-tagline"><a href="">Phòng KHCN và HTQT</a></span>
                                <span class="custom-button-tagline"><a href="">Phòng Tài chính kế toán</a></span>
                                <span class="custom-button-tagline"><a href="">Phòng Hành chính - Quản trị</a></span>
                                <span class="custom-button-tagline"><a href="">Ban Xây dựng cơ bản</a></span>
                            </span>
                    <em></em>
               </div>


                <div class="custom-button cb-gray">
                    <span class="custom-button-title"><?php echo lang('science_the_mom');?></span>
                            <span class="custom-button-wrap" >
                                <span class="custom-button-tagline"><a href="">Phòng KHCN và HTQT</a></span>
                                <span class="custom-button-tagline"><a href="">Phòng Tài chính kế toán</a></span>
                                <span class="custom-button-tagline"><a href="">Phòng Hành chính - Quản trị</a></span>
                                <span class="custom-button-tagline"><a href="">Ban Xây dựng cơ bản</a></span>
                            </span>
                    <em></em>
                </div>

            </li><!-- widget end -->

        </ul><!-- widgets end -->

    </div><!-- inner custom column end -->

</div><!-- misc wrapper end -->

</div><!-- row end -->

</div><!-- container end -->
<div style="margin-top: 20px; margin-bottom: 20px;" class="container">
    <?php if(!empty($dataAds['banner_top_left'])) { ?>
        <a href="<?php echo $dataAds['banner_top_left'][0]['link'] ; ?>"><img src="uploads/images/ads/<?php echo $dataAds['banner_top_left'][0]['image'] ; ?>" alt="<?php echo truncate(html_escape($dataAds['banner_top_left'][0]['description']), 150)  ; ?>" style="width: 100%; box-shadow: 0px 1px 3px;"/></a>
    <?php } ?>
</div>
<div class="container"><!-- container -->

    <div class="row no-gutter"><!-- row -->

        <div class="col-lg-8 col-md-8"><!-- widgets column left -->

            <div class="col-padded col-naked">
                <ul class="list-unstyled clear-margins"><!-- widgets -->

                    <li class="widget-container widget_nav_menu"><!-- widgets list -->

                        <h1 class="title-widget"><?php echo (isset($content_01[0]['cate_name'])) ? $content_01[0]['cate_name'] : ''; ?></h1>

                        <ul class="list-unstyled" >
                            <?php foreach($content_01 as $key => $val) {
                                if($key > 1) break;
                                ?>
                                <li class="recent-news-wrap">
                                    <?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?>
                                    <div class="recent-news-content clearfix">
                                        <div class="recent-news-thumb content-01">
                                            <a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><img src="uploads/images/news/<?php echo $image; ?>" class="attachment-thumbnail wp-post-image" alt="<?php echo truncate(html_escape($val['title']), 65); ?>" /></a>
                                        </div>
                                        <div class="recent-news-text description">
                                            <h4 class="title"><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></h4>
                                            <p class="description">
                                                <?php echo truncate(html_escape($val['description']), 200); ?>
                                            </p>
                                        </div>
                                    </div>

                                </li>
                            <?php } ?>

                        </ul>
                        <ul style="margin-top: 20px; margin-left: 50px;">
                            <?php foreach($content_01 as $key => $val) {
                                    if($key < 2) continue;
                            ?>
                            <li><a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></li>
                            <?php } ?>
                        </ul>

                    </li>
                    <li class="widget-container widget_nav_menu"><!-- widgets list -->

                        <h1 class="title-widget"><?php echo (isset($content_06[0]['cate_name'])) ? $content_06[0]['cate_name'] : ''; ?></h1>

                        <ul class="list-unstyled" >
                            <?php foreach($content_06 as $key => $val) {
                                if($key > 1) break;
                                ?>
                                <li class="recent-news-wrap">
                                    <?php $image = ($val['image'] != '') ? $val['image'] : 'no-image.jpg'; ?>
                                    <div class="recent-news-content clearfix">
                                        <div class="recent-news-thumb content-01">
                                            <a href="<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><img src="uploads/images/news/<?php echo $image; ?>" class="attachment-thumbnail wp-post-image" alt="<?php echo truncate(html_escape($val['title']), 65); ?>" /></a>
                                        </div>
                                        <div class="recent-news-text description">
                                            <h4 class="title"><a href = "<?php echo lang_url($siteName.'/'.slug($val['title']).'-a'.$val['id'].'.html');?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></h4>
                                            <p class="description">
                                                <?php echo truncate(html_escape($val['description']), 200); ?>
                                            </p>
                                        </div>
                                    </div>

                                </li>
                            <?php } ?>

                        </ul>
                        <ul style="margin-top: 20px; margin-left: 50px;">
                            <?php foreach($content_06 as $key => $val) {
                                    if($key < 2) continue;
                            ?>
                            <li><a href="#" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></li>
                            <?php } ?>
                        </ul>

                    </li>

                </ul>

            </div>

        </div><!-- widgets column left end -->


        <div class="col-lg-4 col-md-4"><!-- widgets column right -->

            <div class="col-padded col-naked">

                <ul class="list-unstyled clear-margins"><!-- widgets -->
                    <li class="widget-container widget_nav_menu"><!-- widgets list -->

                        <h1 class="title-widget"><?php echo (isset($content_03[0]['cate_name'])) ? $content_03[0]['cate_name'] : ''; ?></h1>

                        <ul>
                            <?php foreach($content_03 as $key => $val) { ?>
                            <li><a href="#" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></li>
                            <?php } ?>
                        </ul>

                    </li>
                    <li class="widget-container widget_nav_menu">
                        <?php if(!empty($dataAds['banner_top_right'])) { ?>
                            <a href="<?php echo $dataAds['banner_top_right'][0]['link'] ; ?>"><img src="uploads/images/ads/<?php echo $dataAds['banner_top_right'][0]['image'] ; ?>" alt="<?php echo truncate(html_escape($dataAds['banner_top_right'][0]['description']), 150)  ; ?>" style="width: 100%;"/></a>
                        <?php } ?>
                    </li>
                    <li class="widget-container widget_nav_menu"><!-- widgets list -->

                        <h1 class="title-widget"><?php echo (isset($content_05[0]['cate_name'])) ? $content_05[0]['cate_name'] : ''; ?></h1>

                        <ul>
                            <?php foreach($content_05 as $key => $val) { ?>
                            <li><a href="#" title="<?php echo truncate(html_escape($val['title']), 65); ?>"><?php echo truncate(html_escape($val['title']), 65); ?></a></li>
                            <?php } ?>
                        </ul>

                    </li>

                </ul>

            </div>


        </div><!-- widgets column right end -->

    </div><!-- row end -->

</div>
</div><!-- content wrapper end -->


