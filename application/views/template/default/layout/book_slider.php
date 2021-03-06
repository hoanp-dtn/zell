<div class="book-slider">
    <div class="bs-content">
        <span class="bs-close"></span>
        <div class="bs-slider">
            <div id="bookslider" class="owl-carousel">
            <?php 
                foreach ($list_posts as $key => $value) {
                ?>
                <div class="bs-item">
                    <div class="bi-left">
                        <a class="bi-title" href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>"><?php echo $value['title']; ?></a>
                        <div class="bi-desc">
                        <?php echo truncate($value['description'], 300); ?>
                            </div>
                        <!-- bi-desc -->
                        <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>">Xem chi tiết</a>
                    </div>
                    <!-- bi-left -->
                    <div class="bi-right">
                        <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>">
                       <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 175, 146);?>">

                        </a>
                    </div>
                </div>
                <?php
                }
             ?>
                
            </div>
            <div id="product" class="owl-carousel">
            <?php 
                foreach ($list_product as $key => $value) {
                ?>
                <div class="bs-item">
                    <div class="bi-left">
                        <a class="bi-title" href="<?php echo $value['link'].slug($value['title'])."-i".$value['id'].".html"; ?>"><?php echo $value['title']; ?></a>
                        <div class="bi-desc">
                        <?php echo truncate(html_entity_decode($value['detail']), 300); ?>
                            </div>
                        <!-- bi-desc -->
                        <a href="<?php echo $value['link'].slug($value['title'])."-i".$value['id'].".html"; ?>">Xem chi tiết</a>
                    </div>
                    <!-- bi-left -->
                    <div class="bi-right">
                        <a href="<?php echo $value['link'].slug($value['title'])."-i".$value['id'].".html"; ?>">
                       <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 175, 146);?>">

                        </a>
                    </div>
                </div>
                <?php
                }
             ?>
                
            </div>
            <div id="promotion" class="owl-carousel">
            <?php 
                foreach ($list_promotion as $key => $value) {
                ?>
                <div class="bs-item">
                    <div class="bi-left">
                        <a class="bi-title" href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>"><?php echo $value['title']; ?></a>
                        <div class="bi-desc">
                        <?php echo truncate($value['description'], 300); ?>
                            </div>
                        <!-- bi-desc -->
                        <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>">Xem chi tiết</a>
                    </div>
                    <!-- bi-left -->
                    <div class="bi-right">
                        <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>">
                       <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 175, 146);?>">

                        </a>
                    </div>
                </div>
                <?php
                }
             ?>
                
            </div>

        </div>
        <!-- bs-slider -->
        <div class="bs-footer">
            <a href="#" id="bt">BT Việt Nam History</a>
           <a href="#" id="pd" style="margin-left:-10px;">Sản phẩm</a>
            <a href="#" id="pt" style="float:right;padding-right:26px;">New promotion</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#promotion, #product").hide();
    $("#bookslider").show();
    $("#bt").css({
        'color' : '#d2a72a'
    });
    $("#bt").click(function () {
        $("#promotion, #product").hide();
        $("#bookslider").fadeIn(200);
        $(this).css({
            'color' : '#d2a72a'
        });
        $("#pd, #pt").css({
            'color' : 'white'
        });
    });
    $("#pd").click(function () {
        $("#promotion, #bookslider").hide();
        $("#product").fadeIn(200);
        $(this).css({
            'color' : '#d2a72a'
         });
        $("#bt, #pt").css({
            'color' : 'white'
        });
    });
    $("#pt").click(function () {
        $("#bookslider, #product").hide();
        $("#promotion").fadeIn(200);
        $(this).css({
            'color' : '#d2a72a'
        });
        $("#pd, #bt").css({
            'color' : 'white'
        });
    });
</script>
