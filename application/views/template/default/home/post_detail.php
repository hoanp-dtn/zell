<div class="about">
    <div class="breadcrumbs">
        <ul>
            <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
            <?php if (is_array($breadcrumb)): ?>
                <?php foreach ($breadcrumb as $key => $value): ?>
                    <li><a href="<?php echo $value['link']."-n".$value['nav_id'].".html"; ?>"><?php echo $value['title']; ?></a></li><span>/</span>
                <?php endforeach; ?>
            <?php endif ?>
            <li><span> <?php echo html_escape($post_detail['title']); ?></span></li>
        </ul>
    </div>
    <hr>
    <div class="about-main product-view pt-detail">
        <div class="cat_name">
            <h2>
                <?php echo html_escape($post_detail['cate_name']); ?>
            </h2>
            <hr>
            </div>
        <div class="title">
            <h2>
                <?php echo html_escape($post_detail['title']); ?>
            </h2>
        </div>
        <div class="about-content">
            <div id="news-content">
            <?php echo html_entity_decode($post_detail['detail']); ?>
           </div>
           <div class="product-related">
                        <div class="product-header">
                        <h2>
                            các bài tin liên quan
                        </h2>
                        <div class="nav">
                            <a href="#" data-info="pr">
                                <img src="publics/template/default/images/pr_pr.png" class="mCS_img_loaded">
                            </a>
                            <a href="#" data-info="nx">
                                <img src="publics/template/default/images/pr_next.png" class="mCS_img_loaded">
                            </a>
                        </div>
                        </div>
                            <div class="product-inline">
                        <?php foreach ($getPostAndRelative as $key => $value): ?>
                            <div class="product-item">
                                <div class="product-thumnail">
                                    <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>">

                                        <img alt="<?php echo truncate($value['title']); ?>" src="<?php echo 'uploads/images/news/'.$value['image'];?>">
                                    </a>
                                </div>
                                <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>"><span><?php echo truncate($value['title'], 100); ?></span></a>
                                <p><?php echo truncate($value['description'], 150); ?></p>
                            </div>
                        <?php endforeach ?>
                        </div>
                    </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".container .about .about-content").mCustomScrollbar({});
        $('.menu-outer li:eq(0)').addClass('active');
    });

    var w = $(".about-content .product-related").width();
        var col = 3;
            if($(window).width() < 550){

                col = 2;
            }
            if($(window).width() < 350){

                col = 1;
            }
           $(".about-content .product-related .product-inline .product-item").css({
                "width" :  w / col - (4/100) * w,
                "margin-right" : w * (4/100) + w * (4/((col-1)*100)) +  "px"
            });

            $(window).resize(function(){
                if($(window).width() > 550){

                    col = 3;
                }
                if($(window).width() < 550){

                col = 2;
            }
            if($(window).width() < 350){

                col = 1;
            }
                 w = $(".about-content .product-related").width();

               $(".about-content .product-related .product-inline .product-item").css({
                    "width" :  w / col - (4/100) * w,
                    "margin-right" : w * (4/100) + w * (4/((col-1)*100))+ "px"
                });
            });

           $(".about-content .product-related .nav a").click(function (e) {
                e.preventDefault();
                var ml = parseInt($(".about-content .product-related .product-inline").css("margin-left"));
                ml_max = -(w/col) * ($(".about-content .product-related .product-inline .product-item").length - col);

                if($(this).data("info") == "nx"){
                    if(ml <= ml_max){
                        return;
                    }
                    $(".about-content .product-related .product-inline").animate({
                        "margin-left" : "-=" + (w / col )
                    },{
                        queue : true
                    });
                }else{
                    if(ml >= 0){
                        return;
                    }
                    $(".about-content .product-related .product-inline").animate({
                        "margin-left" : "+=" + ( + w / col )
                    },{
                        
                        queue : true
                    });
                }
                return false;
           });

</script>    