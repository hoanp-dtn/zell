
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
                            <li><a href="<?php echo $value['link']."-n".$value['nav_id'].".html"; ?>"><?php echo $value['title']; ?></a></li><span>/</span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif ?>
                </ul>
            </div>
            <hr>
            <div class="about-main" >
                <div class="title">
                    <h2>
                        Tin tức
                    </h2>
                </div>
                <div class="about-content">
                    <div id="news-hot">
                        <?php if (isset($list_posts[0])): ?>
                            <a href="<?php echo $list_posts[0]['link'].slug($list_posts[0]['title'])."-a".$list_posts[0]['id'].".html"; ?>">
                                <img src="uploads/images/news/<?php echo $list_posts[0]['image'];?>"/>
                            </a>
                            <a href="<?php echo $list_posts[0]['link'].slug($list_posts[0]['title'])."-a".$list_posts[0]['id'].".html"; ?>"><h3><?php echo truncate($list_posts[0]['title']); ?></h3></a>
                            <p><?php echo truncate($list_posts[0]['description'], 300); ?></p>
                        <?php endif ?>
                    </div>
                    <div id="list-news">
                        <?php for ($i= 1; $i < count($list_posts); $i++){ ?>
                           <div class="list-news-item">
                                <a class="thumnail" href="<?php echo $list_posts[$i]['link'].slug($list_posts[$i]['title'])."-a".$list_posts[$i]['id'].".html"; ?>"><img src="uploads/images/news/<?php echo $list_posts[$i]['image'];?>"></a>
                                <a href="<?php echo $list_posts[$i]['link'].slug($list_posts[$i]['title'])."-a".$list_posts[$i]['id'].".html"; ?>"><?php echo truncate($list_posts[$i]['title']); ?></a>
                            </div> 
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(".container .about .about-content #list-news").mCustomScrollbar({
                
            });
            $('.menu-outer li:eq(0)').addClass('active');

        </script>  