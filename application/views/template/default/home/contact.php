 <div class="about">
            <div class="breadcrumbs">
                <ul>
                   <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li><span>/</span>
                    <li><span>Liên hệ</span></li>
                </ul>
            </div>
            <hr>
            <div class="about-main" >
            <?php $message_flashdata = $this->session->flashdata('message_flashdata');
                            if(isset($message_flashdata)&&count($message_flashdata)) {
                                if($message_flashdata['type']=='successful') {
                                ?>  
                                    <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
                                <?php
                                }
                                else if($message_flashdata['type']=='error'){
                                ?>
                                    <div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div><?php echo $message_flashdata['message']; ?></div></div>
                            <?php
                                }
                            }
                        ?>
                <div class="title">
                    <h2>
                        Liên hệ
                    </h2>
                </div>
                <div class="about-content">
                    <div id="contact-info">
                        <h4>Cty TNHH đầu tư thương mại & dịch vụ BT Việt Nam</h4>
                        <div class="row">
                            <img src="publics/template/default/images/location.png" />
                            <p>Lô B9 số 9A, ngõ 233 Xuân Thủy, P. Dịch Vọng Hậu,
Q. Cầu Giấy Hà Nội</p>
                        </div>
                        <div class="row">
                            <img src="publics/template/default/images/phone.png" />
                            <p>043-6-43-43-43</p>
                        </div>
                        <div class="row">
                            <img src="publics/template/default/images/mobile.png" />
                            <p>0973 059 555 (Tư vấn 24/24)</p>
                        </div>
                        <div class="row">
                            <img src="publics/template/default/images/mail.png" />
                            <p>zellvvietnam@gmail.com</p>
                        </div>
                        <div class="row">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10532.942572776738!2d105.7804865258461!3d21.034384085306915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4ac02390ad%3A0x1b72b19d4fa6eb33!2zTmfDtSAyMzMgWHXDom4gVGh1eSwgROG7i2NoIFbhu41uZyBI4bqtdSwgQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2sus!4v1471774685113"  frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div id="contact-submit">
                        <h4>Thông tin liên hệ</h4>
                        <hr>
                        <form action="<?php echo base_url(); ?>contact/add" method="post">
                            <div class="row">
                                <input type="" name="name" placeholder="Họ và tên" required="">
                            </div>
                            <div class="row">
                                <input type="" name="phone" placeholder="Hotline" required="">
                            </div>
                            <div class="row">
                                <input type="email" name="email" placeholder="Email" required="">
                            </div>
                            <div class="row">
                                <input type="" name="address" placeholder="Địa chỉ" required="">
                            </div>
                            <div class="row">
                                <textarea type="" name="message" placeholder="Nội dung" required=""></textarea> 
                            </div>
                            <div class="row">
                                <button type="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.menu-outer li:eq(0)').addClass('active');
            $(".container .about .about-content").mCustomScrollbar({});
        </script>  