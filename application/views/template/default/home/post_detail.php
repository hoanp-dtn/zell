<div class="about">
    <div class="breadcrumbs">
        <ul>
            <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
            <?php if (is_array($breadcrumb)): ?>
                <?php foreach ($breadcrumb as $key => $value): ?>
                
                <?php endforeach; ?>
            <?php endif ?>
            
            <li><a href="about-us.html">Giới thiệu</a></li><span>/</span>
            <li><span> <?php echo html_escape($post_detail['title']); ?></span></li>
        </ul>
    </div>
    <hr>
    <div class="about-main" >
        <div class="title">
            <h2>
                <?php echo html_escape($post_detail['title']); ?>
            </h2>
        </div>
        <div class="about-content">
           <?php echo html_entity_decode($post_detail['detail']); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".container .about .about-content").mCustomScrollbar({});
        $('.menu-outer li:eq(0)').addClass('active');
    });

</script>    