<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="@yield('meta_title')">
    <meta name="description" content="@yield('meta_description')">
    <title> @yield('meta_title')</title>


    {{-- google font  --}}
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace&family=Poppins:wght@500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace&family=Poppins:wght@500&display=swap"
        rel="stylesheet">





</head>

<body class="font-sans antialiased" style="background: rgba(147, 178, 176, 0.475)">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation Bar -->
        @include('layouts.nav')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="py-4">
            @yield('content')
        </main>

        <footer class="new_footer_area bg_color">
            <div class="new_footer_top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s"
                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Get in Touch</h3>
                                <p>Don’t miss any updates of our new templates and extensions.!</p>
                                <form action="#" class="f_subscribe_two mailchimp" method="post" novalidate="true"
                                    _lpchecked="1">
                                    <input type="text" name="EMAIL" class="form-control memail"
                                        placeholder="Email">
                                    <button class="btn btn_get btn_get_two" type="submit">Subscribe</button>
                                    <p class="mchimp-errmessage" style="display: none;"></p>
                                    <p class="mchimp-sucmessage" style="display: none;"></p>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s"
                                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Download</h3>
                                <ul class="list-unstyled f_list">
                                    <li><a href="#">Company</a></li>
                                    <li><a href="#">Android App</a></li>
                                    <li><a href="#">ios App</a></li>
                                    <li><a href="#">Desktop</a></li>
                                    <li><a href="#">Projects</a></li>
                                    <li><a href="#">My tasks</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s"
                                style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Help</h3>
                                <ul class="list-unstyled f_list">
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Term &amp; conditions</a></li>
                                    <li><a href="#">Reporting</a></li>
                                    <li><a href="#">Documentation</a></li>
                                    <li><a href="#">Support Policy</a></li>
                                    <li><a href="#">Privacy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s"
                                style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                                <h3 class="f-title f_600 t_color f_size_18">Team Solutions</h3>
                                <div class="f_social_icon">
                                    <a href="#" class="fab fa-facebook"></a>
                                    <a href="#" class="fab fa-twitter"></a>
                                    <a href="#" class="fab fa-linkedin"></a>
                                    <a href="#" class="fab fa-pinterest"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer_bg">
                    <div class="footer_bg_one"></div>
                    <div class="footer_bg_two"></div>
                </div>
            </div>
            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-7">
                            <p class="mb-0 f_400">© cakecounter Inc.. 2019 All rights reserved.</p>
                        </div>
                        <div class="col-lg-6 col-sm-5 text-right">
                            <p>Made with <i class="icon_heart"></i> in <a href="http://cakecounter.com"
                                    target="_blank">CakeCounter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/sweet.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</body>

</html>
