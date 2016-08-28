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
                    <div class="product-info-thumnail">
                        <div id="slider" class="flexslider">
                          <ul class="slides">
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
                            <select>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
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
            </div>
        </div>
        <script>
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

        </script> 