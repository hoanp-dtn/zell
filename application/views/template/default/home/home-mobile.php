<div class="home-mobile">
	<?php if ($post_about_detail): ?>
		<section class="about-mobile">
		<h2>Giới thiệu</h2>
		<hr>
		<img src="<?php echo getThumb($post_about_detail['image'], 'uploads/images/news', 800, 400); ?>">
		<h3><?php echo html_escape($post_about_detail['title']); ?></h3>
		<p><?php echo truncate($post_about_detail['description'], 600); ?></p>
		<div class="detail">
			<a href="<?php echo slug($post_about_detail['cate_name'])."/".slug($post_about_detail['title'])."-a".$post_about_detail['id'].".html"; ?>">Xem chi tiết</a>
		</div>
	</section>
	<?php endif ?>
	<section class="product-mobile about-content">
		<h2>Sản phẩm</h2>
		<hr>
		<div class="products">
		<?php foreach ($list_product as $key => $value): ?>
			<div class="product-item">
		        <div class="product-thumnail">
		            <a href="<?php echo $value['link'].slug($value['title'])."-i".$value['id'].".html"; ?>">
		                <img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 175, 146);?>">
		            </a>
		        </div>
		        <div class="vote">
		            <ul>
		                <li>
		                <a href="#" data-love="5">
		                    <img src="publics/template/default/images/tim.png" class="">
		                    </a>
		                    <span>0</span>
		                </li>
		                <li>
		                    <img src="publics/template/default/images/view.png" class="">
		                    <span>8</span>
		                </li>
		                <li>
		                    <img src="publics/template/default/images/fb.png" class="">
		                    <span>200</span>
		                </li>
		            </ul>
		        </div>
		        <a href="san-pham/vien-uong/tang-cuong-sinh-luc-phai-manh-zendic-plus-i5.html"><span><?php echo $value['title']; ?></span></a>
		        <div class="price">
		            <label>Giá :</label>
		            <div>
		                <span class="price-actualy"><?php echo $value['price']; ?> VNĐ</span>
		                <span class="price-old"><?php echo $value['price_old']; ?> VNĐ</span>
		            </div>
		        </div>
		    </div>
		<?php endforeach ?>
	    </div>
	    <div class="detail">
	    <a href="">Xem thêm</a></div>
	</section>
	<section class="new-promotion">
		<h2>New promotion</h2>
		<hr>
		<div id="list-news">
		<?php foreach ($list_promotion as $key => $value): ?>
			<div class="list-news-item">
	            <a class="thumnail" href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>"><img alt="<?php echo slug($value['title'])?>" src="<?php echo getThumb($value['image'], 'uploads/images/news', 250, 180);?>" class=""></a>
	            <div class="desc">
		            <a href="<?php echo $value['link'].slug($value['title'])."-a".$value['id'].".html"; ?>"><?php echo $value['title']; ?></a>
		            <p> <?php echo truncate($value['description'], 400); ?></p>
	            </div>
	        </div>
		<?php endforeach ?>
        </div>
	</section>
</div>