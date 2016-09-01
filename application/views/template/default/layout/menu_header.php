<div class="header">
    <div class="menu">
        <ul>
            <li>
                <a href="#">Thư viện<span class="menu-bullet"></span></a>
                <ul class="top-submenu">
                    <li></li>
                    <li><a href="<?php echo base_url()."thu-vien/photo.html"?>">Photo</a>
                    </li>
                    <li><a href="<?php echo base_url()."thu-vien/video.html"?>">Video</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/about-us/vi/ban-do-chi-dan-1.html">Tin tức nổi bật<span class="menu-bullet"></span></a>
                <ul class="top-submenu">
                    <li></li>
                    <?php foreach ($dataMenuNews as $key => $value): ?>
                        <li><a href="<?php echo base_url($value['link']); ?>"><?php echo $value['title']; ?></a></li>
                    <?php endforeach ?>
                </ul>
            </li>
            <li>
                <a href="/about-us/vi/quy-dinh-va-hinh-thuc-thanh-toan-5.html">Đối tác<span class="menu-bullet"></span></a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>contact.html">Liên hệ<span class="menu-bullet"></span></a>
            </li>
        </ul>
    </div>
    <!-- menu -->
    <div class="box-language">
        <ul>
            <li class="choose-lang active">
                <a onclick="chooseLang('vi')"><img src="publics/template/default/images/flag-vie.png" alt="vie" />
                </a>
            </li>
            <li class="choose-lang">
                <a onclick="chooseLang('en')"><img src="publics/template/default/images/flag-eng.png" alt="eng" />
                </a>
            </li>
            <li style="display:none;">
                <a href="#"><img src="publics/template/default/images/flag-gem.png" alt="gem" />
                </a>
            </li>
            <li style="display:none;">
                <a href="#"><img src="publics/template/default/images/flag-fra.png" alt="fra" />
                </a>
            </li>
            <li style="display:none;">
                <a href="#"><img src="publics/template/default/images/flag-chn.png" alt="chn" />
                </a>
            </li>
        </ul>
    </div>
    <!-- box-language -->
</div>
<!-- header -->