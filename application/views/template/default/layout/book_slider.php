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
                        <?php echo $value['description']; ?>
                            </div>
                        <!-- bi-desc -->
                        <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>">Xem chi tiết</a>
                    </div>
                    <!-- bi-left -->
                    <div class="bi-right">
                        <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>"><img src="uploads/images/news/<?php echo $value['image'];?>" alt="<?php echo $value['title']; ?>" />
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
            <a href="#">BT Việt Nam History</a>
            <span>Sản phẩm</span>
            <a href="#">New promotion</a>
        </div>
    </div>
</div>