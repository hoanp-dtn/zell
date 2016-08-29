 <div class="bg">        
    <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($dataSlider as $key => $value): ?>
                
            <li data-target="#carousel" data-slide-to="<?php echo $key; ?>" class="<?php echo $key==0?"active":""; ?>"></li>
            <?php endforeach ?>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php foreach ($dataSlider as $key => $value): ?>
                <img class="item <?php echo $key==0?"active":""; ?>" src="uploads/images/slide/<?php echo $value['img']; ?>" alt="<?php echo $value['title']; ?>" />
            <?php endforeach ?>
        </div>
        <!-- Carousel nav -->
    </div>
</div>