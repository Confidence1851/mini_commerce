@extends("web.layouts.app")
@section("content")
<div class="breadcrumb-area pt-95 pb-100 bg-img" style="background-image:url({{$web_assets}}/images/bg/breadcrumb.jpg);">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-title">
                <h2>contact page</h2>
            </div>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li class="active">contact </li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="contact-info-area">
                    <h2>Get In Touch</h2>
                    <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elituis. </p>
                    <div class="contact-info-wrap">
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="la la-globe"></i>
                            </div>
                            <div class="contact-info-content">
                                <p>Address goes here, street, Crossroad 123.</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="la la-envelope"></i>
                            </div>
                            <div class="contact-info-content">
                                <p><a href="#">info@example.com</a> / <a href="#">info@example.com</a></p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="la la-phone"></i>
                            </div>
                            <div class="contact-info-content">
                                <p>+1 35 776 859 000 / +1 35 776 859 011</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="contact-from contact-shadow">
                    <form id="contact-form" action="{{ route("web.contact_us.send_message")}}" method="post">
                        @csrf
                        <input name="name" type="text" placeholder="Name" required>
                        <input name="email" type="email" placeholder="Email" required>
                        <input name="subject" type="text" placeholder="Subject" required>
                        <textarea name="message" placeholder="Your Message" required></textarea>
                        <button class="submit" type="submit">Send Message</button>
                    </form>

                    <div class="alert d-none text-center mt-3" id="form_reponse_container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
