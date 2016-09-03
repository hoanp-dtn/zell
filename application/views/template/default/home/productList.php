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
                </div>
                <div class="about-content">
                    <?php $i=0; foreach ($list_product as $key => $value): $i++?>
                        <div class="product-item">
                            <div class="product-thumnail">
                                <a href="<?php echo $value['link'].slug($value['title']).'-i'.$value['id'].'.html' ?>">
                                    <img alt="<?php echo slug($value['title'])?>" src="uploads/images/news/<?php echo $value['image'];?>">
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

                        <?php if($i%3 == 0) echo '<div style="clear:both"></div>';?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
         <script>
            $('.menu-outer li:eq(0)').addClass('active');
            $(".container .about .about-content").mCustomScrollbar({
                
            });

        </script>  