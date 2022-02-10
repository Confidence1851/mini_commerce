<footer class="footer-area bg-gray pt-100 section-padding-1">
    <div class="container-fluid">
        <div class="footer-top pb-60">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-logo">
                            <img src="{{$logo_image}}" width="110" alt="logo">
                            <p>Your Fashion, our Passion</p>
                        </div>
                        <div class="footer-contact">
                            <div class="single-footer-contact">
                                <div class="footer-contact-icon">
                                    <i class="la la-phone"></i>
                                </div>
                                <div class="footer-contact-content">
                                    <p><a href="tel:+234 (0) 706 324 0620">+234 (0) 706 324 0620</a></p>
                                </div>
                            </div>
                            <div class="single-footer-contact">
                                <div class="footer-contact-icon">
                                    <i class="la la-envelope"></i>
                                </div>
                                <div class="footer-contact-content">
                                    <p><a href="mailto:Sales@gelly.ng">Sales@gelly.ng</a></p>
                                </div>
                            </div>
                            <div class="single-footer-contact">
                                <div class="footer-contact-icon">
                                    <i class="la la-map-marker"></i>
                                </div>
                                <div class="footer-contact-content">
                                    <p>Gate 3, Zion Court Estate, Ikate, Lekki by Mercedes Company.</p>
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
                                {{-- <li><a href="#">FAQs</a></li> --}}
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
                <p>Copyright <a href="#">Gelly</a> © {{ today()->format("Y") }}. All Right Reserved.</p>
            </div>
        </div>
    </div>
</footer>
