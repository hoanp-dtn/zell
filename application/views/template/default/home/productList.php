 <div class="about">
             <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
                    <?php if (is_array($breadcrumb)): ?>
                        <?php $i = 0; ?>
                        <?php foreach ($breadcrumb as $key => $value): ?>
                            <?php $i++; ?>
                            <?php if ($i == count($breadcrumb)): ?>
                                <li><span><?php echo $value['title']; ?></span></li>
                            <?php else: ?>
                            <li><a href="<?php echo $value['link']."-p".$value['nav_id'].".html"; ?>"><?php echo $value['title']; ?></a></li><span>/</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif ?>
                </ul>
            </div>
            <hr>
            <div class="about-main" >
                <div class="title">
                    <h2>
                        Sản phẩm
                    </h2>
                    <hr>
                    <?php echo (isset($list_product[0]))?"<h3>".$list_product[0]['cate_name']."</h3>":""; ?>
                </div>

                <div class="about-content">
                    <?php $i=0; foreach ($list_product as $key => $value): $i++?>
                        <div class="product-item">
                            <div class="product-thumnail">
                                <a href="<?php echo $value['link'].slug($value['title']).'-i'.$value['id'].'.html' ?>">
                                    <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 200, 220);?>">
                                </a>
                            </div>
                            <div class="vote">
                                <ul>
                                    <li>
                                    <a href="#" data-love="<?php echo $value['id']; ?>">
                                        <img src="publics/template/default/images/tim.png">
                                        </a>
                                        <span><?php echo $value['love_count']; ?></span>
                                    </li>
                                    <li>
                                        <img src="publics/template/default/images/view.png">
                                        <span><?php echo $value['view_count']; ?></span>
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

                        <?php if($i%3 == 0) echo '<div style="clear:both"></div>';?>
                    <?php endforeach ?>

                </div>

                <div class="sf-row more-button"><button>Xem thêm</button></div>
            </div>
        </div>
         <script>
            $('.menu-outer li:eq(0)').addClass('active');
            $(".container .about .about-content").mCustomScrollbar({
                
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
        </script>  