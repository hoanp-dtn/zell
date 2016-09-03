<div class="about">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
                    <li><span>Photo</span></li>
                </ul>
            </div>
            <hr>
            <div class="about-main" >
                <div class="title">
                    <h2>
                        Photo
                    </h2>
                </div>
                <div class="about-content">
                <?php foreach ($dataGallery as $keyMain => $valMain): ?>
                    <div class="item">
                        <a rel="<?php echo "g".$keyMain; ?>" class="fancybox" href="<?php echo getThumb($valMain['image_default'], 'uploads/images/gallery', 800, 600);?>" title="<?php echo $valMain['title_default'];?>">
                             <img alt="<?php echo slug($valMain['title_default']);?>"  src="<?php echo getThumb($valMain['image_default'], 'uploads/images/gallery', 205, 105);?>">

                        </a>
                        <p><?php echo $valMain['title_default'];?></p>
                        <?php foreach ($valMain as $keyItem => $valItem): ?>
                            <?php if (is_array($valItem)): ?>
                                  <div style="display:none;">
                                        <a rel="<?php echo "g".$keyMain; ?>" class="fancybox" href="<?php echo getThumb($valItem['image'], 'uploads/images/gallery', 800, 600);?>" title="<?php echo $valItem['title'];?>">

                                            <img alt="<?php echo slug($valItem['title'])?>" src="<?php echo getThumb($valItem['image'], 'uploads/images/gallery', 205, 105);?>">
                                        </a>
                                        <p><?php echo $valItem['title'];?></p>
                                    </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                <?php endforeach ?>
                    
                </div>
            </div>
        </div>
        <script>
            $('.fancybox').fancybox({
                prevEffect      : 'slide',
                nextEffect      : 'slide',
                beforeShow: function () {
                    this.width = 800;
                    this.height = 600;
                    this.skin.css({'padding': '10px 50px'});
                },
                tpl: {
                    next: '<a id="next-custom" title="Next" href="javascript:;"><img src="publics/template/default/images/next.png"/></a>',
                    prev: '<a id="prev-custom" title="Previous" href="javascript:;"><img src="publics/template/default/images/prev.png"/></a>'
                }
            });
            $(".container .about .about-content").mCustomScrollbar({
                
            });
            $('.menu-outer li:eq(0)').addClass('active');

        </script>  