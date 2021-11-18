<footer class="footer-area bg-gray pt-100 section-padding-1">
    <div class="container-fluid">
        <div class="footer-top pb-60">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-logo">
                            <a href="#"><img alt="" src="{{$web_assets}}/images/logo/logo.png"></a>
                            <p>Lorem ipsum dolor sit, consectetur elit, sed do adipisicing eiusmod tempor</p>
                        </div>
                        <div class="footer-contact">
                            <div class="single-footer-contact">
                                <div class="footer-contact-icon">
                                    <i class="la la-phone"></i>
                                </div>
                                <div class="footer-contact-content">
                                    <p>+012 345 678 102</p>
                                </div>
                            </div>
                            <div class="single-footer-contact">
                                <div class="footer-contact-icon">
                                    <i class="la la-globe"></i>
                                </div>
                                <div class="footer-contact-content">
                                    <p><a href="#">urname@email.com</a></p>
                                </div>
                            </div>
                            <div class="single-footer-contact">
                                <div class="footer-contact-icon">
                                    <i class="la la-map-marker"></i>
                                </div>
                                <div class="footer-contact-content">
                                    <p>Address goes here, Crossroad 123.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h3>Useful Link</h3>
                        </div>
                        <div class="footer-list">
                            <ul>
                                <li><a href="{{ route("login")}}">Login</a></li>
                                <li><a href="{{ route("register")}}">Register</a></li>
                                <li><a href="{{ route("web.contact_us")}}">Help</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h3>Categories</h3>
                        </div>
                        <div class="footer-list">
                            <ul>
                                @foreach ($product_categories as $category)
                                <li><a href="#">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom border-top-2 pt-20 pb-20">
        <div class="container">
            <div class="copyright text-center">
                <p>Copyright <a href="#">Gelly</a> © 2021. All Right Reserved.</p>
            </div>
        </div>
    </div>
</footer>
