 <div class="about">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="home.html">Trang chủ</a></li><span>/</span>
                    <li><a href="about-us.html">Giới thiệu</a></li><span>/</span>
                    <li><span>Công ty Zell-V</span></li>
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
                    <?php foreach ($list_product as $key => $value): ?>
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
         <script>
            $('.menu-outer li:eq(0)').addClass('active');
            $(".container .about .about-content").mCustomScrollbar({
                
            });

        </script>  