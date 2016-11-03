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
                <h2>Sản phẩm</h2>
                <hr>
                    <h2>
                        <?php echo $post_detail['cate_name']; ?>
                    </h2>
                    <div class="title-mobile">
                        <h4><?php echo $post_detail['title']; ?></h4>
                            <span>Mã sản phẩm : <?php echo $post_detail['id']; ?></span>
                        <div class="price">
                            <label>Giá :</label>
                            <div>
                                <span class="price-actualy"><?php echo number_format($post_detail['price'],0,",","."); ?> VND</span>
                                <span class="price-old"><?php echo number_format($post_detail['price'],0,",","."); ?> VND</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-content">
                    <div class="product">
                        <div class="product-info-thumnail">

                            <div class="vote mobile">
                                <ul>
                                    <li>
                                        <a href="#" data-love="<?php echo $post_detail['id'];?>">
                                        <img src="publics/template/default/images/tim.png">
                                        </a>
                                        <span><?php echo $post_detail['love_count']; ?></span>
                                        <span class="border">|</span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/view.png">
                                        <span><?php echo $post_detail['view_count']; ?></span>
                                        <span class="border">|</span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/fb.png">
                                        <span>200</span>
                                    </li>
                                </ul>
                            </div>
                            <div id="slider" class="flexslider">
                              <ul class="slides">

                                <li>
                                  <img  alt="<?php echo slug($post_detail['title'])?>" src="<?php echo  'uploads/images/news/'.$post_detail['image'];?>"/>
                                </li>
                                <?php foreach ($post_detail['file'] as $key => $value): ?>
                                    <li>
									  <img  alt="<?php echo slug($post_detail['title'])?>" src="<?php echo  'uploads/files/'.$value['value'];?>"/>
                                    </li>
                                <?php endforeach ?>
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                            <div id="carousel-product" class="flexslider">
                              <ul class="slides">
                                <li id="nav-1">
                                  <img alt="<?php echo slug($post_detail['title'])?>" src="<?php echo getThumb($post_detail['image'], 'uploads/images/news', 93, 77);?>" />
                                </li>
                                <?php   $i = 2; ?>
                                 <?php foreach ($post_detail['file'] as $key => $value): ?>
                                    <li id="nav-<?php echo $i++; ?>">
                                      <img alt="<?php echo slug($post_detail['title'])?>" src="<?php echo getThumb($value['value'], 'uploads/files', 93, 77);?>"  />
                                    </li>
                                <?php endforeach ?>
                              </ul>
                            </div>
                            <div class="vote">
                                <ul>
                                    <li>
                                        <a href="#" data-love="<?php echo $post_detail['id'];?>">
                                        <img src="publics/template/default/images/tim.png">
                                        </a>
                                        <span><?php echo $post_detail['love_count']; ?></span>
                                        <span class="border">|</span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/view.png">
                                        <span><?php echo $post_detail['view_count']; ?></span>
                                        <span class="border">|</span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/fb.png">
                                        <span>200</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="mobile-nav">    
                                    <ul>    
                                         <li data-id="1" class="active">    </li>

                                <?php   $i = 2; ?>
                                  <?php foreach ($post_detail['file'] as $key => $value): ?>
                                    <li data-id="<?php echo $i++; ?>">
                                    </li>
                                <?php endforeach ?>
                                </ul>
                            </div>  
                        </div>
                        <div class="product-detail">
                            <h4><?php echo $post_detail['title']; ?></h4>
                            <div class="row code">
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
                            <div class="row hotline">
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
                        <div class="product-header">
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
                        </div>
                        <div class="product-inline">
                         <?php foreach ($productRelative as $key => $value): ?>
                            <div class="product-item">
                                <div class="product-thumnail">
                                    <a href="<?php echo $value['link'].slug($value['title']).'-i'.$value['id'].'.html' ?>">

                                        <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 320, 180);?>">
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
        $(document).ready(function () {
            w = $(window).width();
            if(w < 850){
                var img_w = $(".about-content .product-thumnail").width();
                $(".about-content .product-thumnail").css({
                    "height": img_w/1.77 +"px"
                });
                $(".product-view .product-info-thumnail #slider").css({
                    "height": $(".product-view .product-info-thumnail #slider").width()/1.77 +"px"
                });
            }
            $(window).resize(function(){
                 w = $(window).width();
                if(w < 850){
                    var img_w = $(".about-content .product-thumnail").width();
                    $(".about-content .product-thumnail").css({
                        "height": img_w/1.77 +"px"
                    });

                $(".product-view .product-info-thumnail #slider").css({
                    "height": $(".product-view .product-info-thumnail #slider").width()/1.77 +"px"
                });
                }
            });
        });
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

           var col = 3;
            if($(window).width() < 550){

                col = 2;
            }
            if($(window).width() < 350){

                col = 1;
            }

           var w = $(".about-content .product-related").width();
           $(".about-content .product-related .product-inline .product-item").css({
                "width" :  w / col - (4/100) * w,
                "margin-right" : w * (4/100) + w * (4/((col-1)*100)) + "px"
           });


            $(window).resize(function(){
                w = $(".about-content .product-related").width();

            if($(window).width() >550){

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
                        "margin-left" : "-=" + (  w / col )
                    },{
                        queue : true
                    });
                }else{
                    if(ml >= 0){
                        return;
                    }
                    $(".about-content .product-related .product-inline").animate({
                        "margin-left" : "+=" + ( w / col )
                    },{
                        
                        queue : true
                    });
                }
                return false;
           });
           $("#number").change(function(){
                $("#order input[name='number']").val($(this).val());
           });
           $(".vote ul li a").click(function (e) {
                var product_id = $(this).data('love');

                $.ajax({
                    type : 'post',
                    url : '<?php echo base_url(); ?>product/addLoveCount',
                    data : {product_id : product_id},
                    success :  function (result) {
                        if(result){
                            alert(result);
                        }
                    }
                });
                e.preventDefault();
            });

           $(".mobile-nav li").click(function(){
                var id = parseInt($(this).data("id"));
                $("#nav-"+id).click();
                $(".mobile-nav li").removeClass("active");
                $(this).addClass("active");
           });
           if($(window).width() < 850){
                $(".about-content .product-detail .row ul li img").attr("src", "publics/template/default/images/ok.png");
           }    
        </script> 