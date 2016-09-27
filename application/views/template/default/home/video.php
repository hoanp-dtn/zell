<div class="about">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
                    <li><span>Video</span></li>
                </ul>
            </div>
            <hr>
            <div class="about-main" >
                <div class="title">
                    <h2>
                        Video
                    </h2>
                    <hr>
                </div>
                <div class="about-content">
                <?php foreach ($dataVideo as $key => $value): ?>
                    <div class="item">
                            <a class="fancybox video" href="<?php echo $value['link']; ?>" title="<?php echo $value['title']; ?>">
                                <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['img'], 'uploads/images/video', 600, 405);?>">
                            </a>
                        <p><?php echo $value['title']; ?></p>
                    </div>
                <?php endforeach ?>
                </div>
                <div class="sf-row more-button"><button>Xem thêm</button></div>
                
            </div>
        </div>
        <script>
            $('.fancybox').fancybox({
                beforeShow: function () {
                    this.width = 800;
                    this.height = 600;
                    this.skin.css({'padding': '10px 50px'});
                },
                arrows :  false,
                type: 'iframe'
            });
            $(".container .about .about-content").mCustomScrollbar({
                
            });
            $('.menu-outer li:eq(0)').addClass('active');

        </script>  