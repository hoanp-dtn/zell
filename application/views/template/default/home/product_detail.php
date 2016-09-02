 <div class="about">
           <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
                    <?php if (is_array($breadcrumb)): ?>
                        <?php foreach ($breadcrumb as $key => $value): ?>
                            <li><a href="<?php echo $value['link']."-p".$value['nav_id'].".html"; ?>"><?php echo $value['title']; ?></a></li><span>/</span>
                        <?php endforeach; ?>
                    <?php endif ?>
                    <li><span> <?php echo html_escape($post_detail['title']); ?></span></li>
                </ul>
            </div>
            <hr>
            <div class="about-main" >
                <div class="title">
                    <h2>
                        <?php echo $post_detail['cate_name']; ?>
                    </h2>
                </div>
                <div class="about-content">
                    <div class="product">
                        <div class="product-info-thumnail">
                            <div id="slider" class="flexslider">
                              <ul class="slides">

                                <li>
                                  <img src="uploads/images/news/<?php echo $post_detail['image'] ?>" />
                                </li>
                                <?php foreach ($post_detail['file'] as $key => $value): ?>
                                    <li>
                                      <img src="uploads/files/<?php echo $value['value'] ?>" />
                                    </li>
                                <?php endforeach ?>
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                            <div id="carousel-product" class="flexslider">
                              <ul class="slides">
                                <li>
                                  <img src="uploads/images/news/<?php echo $post_detail['image'] ?>" />
                                </li>
                                 <?php foreach ($post_detail['file'] as $key => $value): ?>
                                    <li>
                                      <img src="uploads/files/<?php echo $value['value'] ?>" />
                                    </li>
                                <?php endforeach ?>
                              </ul>
                            </div>
                        </div>
                        <div class="product-detail">
                            <h4><?php echo $post_detail['title']; ?></h4>
                            <div class="row">
                                <span>Mã sản phẩm : <?php echo $post_detail['id']; ?></span>
                            </div>
                            <div class="price row">
                                <label>Giá :</label>
                                <div>
                                    <span class="price-actualy"><?php echo number_format($post_detail['price'],0,",","."); ?> VND</span>
                                    <span class="price-old"><?php echo number_format($post_detail['price'],0,",","."); ?> VND</span>
                                </div>
                            </div>

                            <div class="row">
                                <span>Tình trạng : <?php echo $post_detail['is_top']==2?"Còn hàng":"Hết hàng"; ?></span>
                            </div>  
                            <div class="row">
                                <span>Số lượng</span>
                                <select id="number">
                                <?php 
                                    for ($i=1; $i <= 20 ; $i++) { 
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                    }
                                 ?>
                                </select>
                            </div>
                            <div class="row">
                                <button>Đặt hàng</button>
                            </div>
                            <div class="row">
                                <span>Hotline:</span>
                                <span>0973 059 555</span>
                            </div>
                            <div class="row">
                                <ul>
                                    <li>
                                        <img src="publics/template/default/images/good.png">
                                        <span>Miễn phí vận chuyển nội thành Hà Nội</span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/good.png">
                                        <span>Hỗ trợ phí vận chuyển tỉnh xa</span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/good.png">
                                        <span>Tự động tích lũy điểm</span>  
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                       <div class="product-info">
                        <div class="tab-panels" role="tabpanel">
                          <div class="tabs" role="tablist">
                            <!-- Tab navigation -->
                            <a href="#" id="tab1" role="tab" aria-labelledby="tab1" aria-describedby="tabcontent1" data-tab="1" class="active">Thông tin chi tiết</a>
                            <a href="" id="tab2" role="tab" aria-labelledby="tab2" aria-describedby="tabcontent2" data-tab="2" class="">Đánh giá</a>
                            <a href="" id="tab3" role="tab" aria-labelledby="tab3" aria-describedby="tabcontent3" data-tab="3" class="">Bình luận</a>
                          </div>
                          <div id="tabcontent1" class="tab-content active">
                            <div>
                                <?php echo html_entity_decode($post_detail['detail']); ?>
                            </div>
                          </div>
                          <div id="tabcontent2" class="tab-content">
                            
                                <h2>Đánh giá sản phẩm</h2>
                                <hr>
                                 <form action="<?php echo base_url(); ?>review/add?redirect=<?php echo base64_encode(current_url()) ?>" method="post">
                                <p>1. Đánh giá sản phẩm</p>
                                <input type="hidden" name="product_id" value="<?php echo $post_detail['id']; ?>">
                                <ul>
                                    <li data-vote="1"></li>
                                    <li data-vote="2"></li>
                                    <li data-vote="3"></li>
                                    <li data-vote="4"></li>
                                    <li data-vote="5"></li>
                                </ul>
                                <input type="hidden" name="vote" value="1">
                                <p>2. Nội dung đánh giá</p>
                                <textarea name="detail" required=""></textarea>
                                <button type="submit">Đánh giá</button>
                            </form>
                            <?php foreach ($dataReviews as $key => $value): ?>
                                <div class="review-item">
                                    <div class="ava">
                                    </div>
                                    <div class="review-item-info">
                                        <ul data-rate="<?php echo $value['location']; ?>">
                                            <li data-vote="1"></li>
                                            <li data-vote="2"></li>
                                            <li data-vote="3"></li>
                                            <li data-vote="4"></li>
                                            <li data-vote="5"></li>
                                        </ul>
                                        <div class="review-item-content">
                                            <?php echo htmlentities($value['description']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                                
                               
                          </div>

                          <div id="tabcontent3" class="tab-content">
                                  <div class="fb-comments" data-colorscheme="dark" data-href="<?php echo curPageURL();?>" data-width="650" data-numposts="5"></div>  
                          </div>
                        </div>
                    </div>
                    <div class="product-related">
                        <h2>
                            Sản phẩm cùng loại
                        </h2>
                        <div class="nav">
                            <a href="#" data-info="pr">
                                <img src="publics/template/default/images/pr_pr.png">
                            </a>
                            <a href="#" data-info="nx">
                                <img src="publics/template/default/images/pr_next.png">
                            </a>
                        </div>
                        <div class="product-inline">
                         <?php foreach ($productRelative as $key => $value): ?>
                            <div class="product-item">
                                <div class="product-thumnail">
                                    <a href="<?php echo $value['link'].slug($value['title']).'-i'.$value['id'].'.html' ?>">
                                        <img src="uploads/images/news/<?php echo $value['image'];?>">
                                    </a>
                                </div>
                                <div class="vote">
                                    <ul>
                                        <li>
                                            <img src="publics/template/default/images/tim.png">
                                            <span>30</span>
                                        </li>
                                        <li>
                                            <img src="publics/template/default/images/view.png">
                                            <span>150</span>
                                        </li>
                                        <li>
                                            <img src="publics/template/default/images/fb.png">
                                            <span>200</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="<?php echo $value['link'].slug($value['title']).'-i'.$value['id'].'.html' ?>"><span><?php echo $value['title'];?></span></a>
                                <div class="price">
                                    <label>Giá :</label>
                                    <div>
                                        <span class="price-actualy"><?php echo number_format($value['price'],0,",","."); ?> VND</span>
                                        <span class="price-old"><?php echo number_format($value['price_old'],2,",","."); ?> VND</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="order" style="display:none;width:450px">
            <form action="<?php echo base_url(); ?>order/add?redirect=<?php echo base64_encode(current_url()) ?>" method="post">
                <h2>Đặt hàng</h2>
                <h3>Thông tin khách hàng</h3>
                <input type="hidden" name="product_id" value="<?php echo $post_detail['id']; ?>">
                <input type="hidden" name="number" placeholder="Số lượng">
                <div class="row">
                    <input type="" name="name" placeholder="Họ và tên" required="">
                </div>
                <div class="row">
                    <input type="" name="phone" placeholder="Số điện thoại" required="">
                </div>
                <div class="row">
                    <input type="email" name="email" placeholder="Email" required="">
                </div>
                <div class="row">
                    <input type="" name="address" placeholder="Địa chỉ" required="">
                </div>
                <div class="row">
                    <input type="" name="message" placeholder="Nội dung" required="">
                </div>
                <div class="row">
                    <button type="submit">Mua ngay</button>
                </div>
            </form>
        </div>
        <script>
        $(".review-item-info ul").each(function () {
            var rate = $(this).data("rate");
            var i = 1;
            $(this).children("li").each(function () {
                if(i++ > rate){
                    return;
                }
                 $(this).css({
                "background-image" : "url('publics/template/default/images/star_yellow.png')"
            });
            });
        });
        $(".product-detail button").click(function () {
             $.fancybox.open({
                href: "#order",
                closeBtn : false,
                'padding' : 0,
                beforeShow : function () {
                    this.skin.css({
                        "background" : "#d2a72a",
                        'border-radius' : "0px",
                        "padding" : "0",
                        "margin" : "0"
                    });
                }
            });

            $("#order input[name='number']").val($("#number").val());
        });
            $('.menu-outer li:eq(0)').addClass('active');
            $(".container .about .about-content").mCustomScrollbar({

            });
           $(window).load(function() {
              // The slider being synced must be initialized first
              $('#carousel-product').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: $("#carousel-product").width() / 3 - 5 ,
                itemMargin: 5,
                asNavFor: '#slider'
              });
             
              $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel-product"
              });
            });

           $(".about-content .product-info .tabs a").click(function (e) {
                e.preventDefault();
                var tab_index = parseInt($(this).data("tab"));
                if(tab_index < 1){
                    tab_index = 1;
                }
                $(".about-content .product-info .tabs a.active").removeClass("active");
                $(".about-content .product-info .tab-content.active").removeClass("active").hide();
                $("#tabcontent"+tab_index).addClass("active").hide().fadeIn(500);
                $(this).addClass("active");
                return false;
           });
           $(".about-content .product-info #tabcontent2 form li:nth-of-type("+1+")").css({
                "background-image" : "url('publics/template/default/images/star_yellow.png')"
            });
           $(".about-content .product-info #tabcontent2 form li").hover(function () {
                var vote = $(this).data('vote');
                $(".about-content .product-info #tabcontent2 form input[name='vote']").val(vote);
                for (var i = 1; i <= vote; i++) {

                    $(".about-content .product-info #tabcontent2 form li:nth-of-type("+i+")").css({
                        "background-image" : "url('publics/template/default/images/star_yellow.png')"
                    });
                }
                for (var i = vote + 1; i <= 5; i++) {

                    $(".about-content .product-info #tabcontent2 form li:nth-of-type("+i+")").css({
                        "background-image" : "url('publics/template/default/images/star_df.png')"
                    });
                }
           });
           var w = $(".about-content .product-related").width();
           $(".about-content .product-related .product-inline .product-item").css({
                "width" :  w / 3 - (5/100) * w,
                "margin-right" : w * (5/100) + "px"
           });

           $(".about-content .product-related .nav a").click(function (e) {
                e.preventDefault();
                var ml = parseInt($(".about-content .product-related .product-inline").css("margin-left"));
                ml_max = -(w/3) * ($(".about-content .product-related .product-inline .product-item").length - 3);

                if($(this).data("info") == "nx"){
                    if(ml <= ml_max){
                        return;
                    }
                    $(".about-content .product-related .product-inline").animate({
                        "margin-left" : "-=" + (w / 3)
                    },{
                        queue : true
                    });
                }else{
                    if(ml >= 0){
                        return;
                    }
                    $(".about-content .product-related .product-inline").animate({
                        "margin-left" : "+=" + (w / 3)
                    },{
                        
                        queue : true
                    });
                }
                return false;
           });
           $("#number").change(function(){
                $("#order input[name='number']").val($(this).val());
           });
        </script> 