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
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->



    <div class="row">
        <div class="col-md-12">


            <div class="widget-main">
                <div class="widget-main-title">
                    <h4 class="welcome-text"><?php echo lang('examiner');?></h4>
                </div>
                <div class="widget-inner">

                    <div class="box-footer clearfix">
                        <form method="get" action="">
                            <fieldset>
                                <h4><b>Tìm kiếm nhanh</b></h4>
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control" value="<?php echo (!empty($conditions_search) && isset($conditions_search['year_code']))? $conditions_search['year_code']:'' ;?>" name="year_code" placeholder="Tìm kiếm theo khóa ...">
                                </div>
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control" value="<?php echo (!empty($conditions_search) && isset($conditions_search['course_code']))? $conditions_search['course_code']:'' ;?>" name="course_code" placeholder="Tìm kiếm theo mã môn ...">
                                </div>
                                <div class="form-group col-lg-4">
                                    <input type="text" class="form-control datepicker" value="<?php echo (!empty($conditions_search) && isset($conditions_search['exam_date']))? $conditions_search['exam_date']:'' ;?>" name="exam_date" placeholder="Tìm kiếm theo ngày thi ...">
                                    <script>
                                        $('.datepicker').datepicker()
                                    </script>
                                </div>
                            </fieldset>
                            <button class="pull-right btn btn-default btn-primary" type="submit" style="margin-bottom:10px;">Tìm kiếm  </button>
                        </form>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 3px;">Mã khóa học</th>
                                <th>Mã môn</th>
                                <th>Tên môn</th>
                                <th>Hình thức thi</th>
                                <th>Thời gian</th>
                                <th>Ngày thi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(isset($list_posts) && count($list_posts)){
                                $link = base64_encode(getCurrentUrl());
                                foreach($list_posts as $key => $val){
                                    ?>
                                    <tr class="" id="<?php echo $key;?>">
                                        <td width="100px"><?php echo $val['year_code']; ?></td>
                                        <td width="80px"><?php echo $val['course_code']; ?></td>
                                        <td width="200px"><?php echo $val['subject_name']; ?></td>
                                        <td width="100px"><?php echo $form_exam[$val['exam_form']]?></td>
                                        <td width="80px"><?php echo $val['time']; ?></td>
                                        <td width="100px">
                                            <?php echo date('d/m/Y', strtotime($val['exam_date'])); ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                            else {
                                echo '<tr><td colspan="4">Không có dữ liệu</td></tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        echo (isset($list_paginition)&&count($list_paginition))?$list_paginition:'';
                        ?>
                        <div class="clear"></div>
                    </div><!-- /.box-body -->
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

    <div class="widget-main-title">
        <?php if(!empty($dataAds['banner_top_right'])) { ?>
            <a href="<?php echo isset($dataAds['banner_top_right'][0]['link'])?$dataAds['banner_top_right'][0]['link']:'javascript:void(0)'; ?>"><img style="width:100%;"src="uploads/images/ads/<?php echo $dataAds['banner_top_right'][0]['image'] ; ?>" alt="<?php echo truncate(html_escape($dataAds['banner_top_right'][0]['description']), 150)  ; ?>" style="width: 100%;"/></a>
        <?php } ?>
    </div>
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