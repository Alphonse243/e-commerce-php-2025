<?php

class Footer {
    private array $instagramImages = [
        'i1.jpg', 'i2.jpg', 'i3.jpg', 'i4.jpg',
        'i5.jpg', 'i6.jpg', 'i7.jpg', 'i8.jpg'
    ];

    private array $socialLinks = [
        ['icon' => 'facebook', 'url' => '#'],
        ['icon' => 'twitter', 'url' => '#'],
        ['icon' => 'dribbble', 'url' => '#'],
        ['icon' => 'behance', 'url' => '#']
    ];

    public function render(): void {
        ?>
        <footer class="footer-area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6>About Us</h6>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
                                magna aliqua.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6>Newsletter</h6>
                            <p>Stay update with our latest</p>
                            <div id="mc_embed_signup">
                                <form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                    method="get" class="form-inline">
                                    <div class="d-flex flex-row">
                                        <input class="form-control" name="EMAIL" placeholder="Enter Email" 
                                               onfocus="this.placeholder = ''" 
                                               onblur="this.placeholder = 'Enter Email'"
                                               required type="email">
                                        <button class="click-btn btn btn-default">
                                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        </button>
                                        <div style="position: absolute; left: -5000px;">
                                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                        </div>
                                    </div>
                                    <div class="info"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget mail-chimp">
                            <h6 class="mb-20">Instragram Feed</h6>
                            <ul class="instafeed d-flex flex-wrap">
                                <?php foreach ($this->instagramImages as $image): ?>
                                    <li><img src="img/<?= htmlspecialchars($image) ?>" alt=""></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h6>Follow Us</h6>
                            <p>Let us be social</p>
                            <div class="footer-social d-flex align-items-center">
                                <?php foreach ($this->socialLinks as $social): ?>
                                    <a href="<?= htmlspecialchars($social['url']) ?>">
                                        <i class="fa fa-<?= htmlspecialchars($social['icon']) ?>"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                    <p class="footer-text m-0">
                        Copyright &copy;<?= date('Y') ?> All rights reserved | This template is made with 
                        <i class="fa fa-heart-o" aria-hidden="true"></i> by 
                        <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    </p>
                </div>
            </div>
        </footer>
        <?php
    }
}
