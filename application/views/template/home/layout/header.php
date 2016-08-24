
<!-- device test, don't remove. javascript needed! -->
<span class="visible-xs"></span><span class="visible-sm"></span><span class="visible-md"></span><span class="visible-lg"></span>
<!-- device test end -->

<div id="k-head" class="container"><!-- container + head wrapper -->

    <div class="row"><!-- row -->

        <nav class="k-functional-navig"><!-- functional navig -->

            <ul class="list-inline pull-right">
                <li><?php echo anchor($this->lang->switch_uri('vn'), lang('language_vn'));?></li>
                <li><?php echo anchor($this->lang->switch_uri('en'),lang('language_en'));?></li>
                <li><a href="#"><?php echo lang('login');?></a></li>
            </ul>

        </nav><!-- functional navig end -->

        <div class="col-lg-12">

            <div id="k-site-logo" class="pull-left"><!-- site logo -->

                <h1 class="k-logo">
                    <a href="<?php echo lang_url(); ?>" title="<?php echo lang('utt');?>">
                        <?php
                        assets_img('images/logo.png', array(
                                                        'alt' => lang('utt'),
                                                        'class' => 'img-responsive',
                                                        'style' => 'width: 220px; margin-top: 20px;'
                                                    )
                        );
                        ?>
                    </a>
                </h1>

                <a id="mobile-nav-switch" href="#drop-down-left"><span class="alter-menu-icon"></span></a><!-- alternative menu button -->

            </div><!-- site logo end -->

            <nav id="k-menu" class="k-main-navig"><!-- main navig -->

                <ul id="drop-down-left" class="k-dropdown-menu">
					 <?php 
						function displayMenu($dataMenu,$siteName){
							$href = ($dataMenu['url']!="")?$dataMenu['url']:lang_url($siteName.'/'.slug($dataMenu['title']).'-n'.$dataMenu['id'].'.html');
						?>
							<li><a href="<?php echo $href;?>"><?php echo $dataMenu['title'];?></a>
								<?php
									if(isset($dataMenu['children'])){
										?>
										<ul class="sub-menu">
										<?php
										foreach($dataMenu['children'] as $key => $val){
											displayMenu($val,$siteName);
										}
										?>
										</ul>
										<?php
									}
								?>
							</li>
						<?php
						}
						if(!empty($dataMenu)){foreach($dataMenu as $key => $val){
							displayMenu($val,$siteName);
						}}
						
					?>
					<!--
                    <li><a href="<?php //echo lang_url(); ?>" title="Home Page">Trang Chủ</a></li>
                    <li>
                        <a href="<?php //echo lang_url('gioi-thieu.html'); ?>" title="Introduction">Giới Thiệu</a>
                    </li>
                    <li>
                        <a href="<?php //echo lang_url('tin-tuc.html'); ?>" title="News">Tin Tức</a>
                    </li>
                    <li>
                        <a href="<?php //echo lang_url('to-chuc.html'); ?>" class="Pages Collection" title="Constitutive">Tổ Chức</a>
                        <ul class="sub-menu">
                            <li><a href="news-single.html">News Single Page</a></li>
                            <li><a href="events-single.html">Events Single Page</a></li>
                            <li><a href="courses-single.html">Course Single Page</a></li>
                            <li><a href="gallery-single.html">Gallery Single Page</a></li>
                            <li><a href="news-stacked.html">News Stacked Page</a></li>
                            <li><a href="search-results.html">Search Results Page</a></li>
                            <li>
                                <a href="#">Menu Test</a>
                                <ul class="sub-menu">
                                    <li><a href="#">Second Level 01</a></li>
                                    <li>
                                        <a href="#">Second Level 02</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">Third Level 01</a></li>
                                            <li><a href="#">Third Level 02</a></li>
                                            <li><a href="#">Third Level 03</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Second Level 03</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php //echo lang_url('dao-tao.html'); ?>" title="Educate">Đào Tạo</a>
                        <ul class="sub-menu">
                            <li><a href="full-width.html">Full Width Page</a></li>
                            <li><a href="sidebar-left.html">Sidebar on Left</a></li>
                            <li><a href="formatting.html">Formatting</a></li>
                            <li><a href="school-leadership.html">School Leadership</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="404.html">404 Error</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php //echo lang_url('tuyen-sinh.html'); ?>" title="Admissions">Tuyển Sinh</a>
                    </li>-->
                </ul>

            </nav><!-- main navig end -->

        </div>

    </div><!-- row end -->

</div><!-- container + head wrapper end -->