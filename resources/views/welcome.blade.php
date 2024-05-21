<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ASTI Academy</title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale = 0.86, maximum-scale=3.0, minimum-scale=0.86">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="front_assets/images/logo/logoicon.png">

    <link rel="stylesheet" href="front_assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="front_assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="front_assets/css/vendor/eduvibe-font.css">
    <link rel="stylesheet" href="front_assets/css/vendor/magnifypopup.css">
    <link rel="stylesheet" href="front_assets/css/vendor/slick.css">
    <link rel="stylesheet" href="front_assets/css/vendor/odometer.css">
    <link rel="stylesheet" href="front_assets/css/vendor/lightbox.css">
    <link rel="stylesheet" href="front_assets/css/vendor/animation.css">
    <link rel="stylesheet" href="front_assets/css/vendor/jqueru-ui-min.css">
    <link rel="stylesheet" href="front_assets/css/style.css">

</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M72KD25G" height="0" width="0"
                  style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="main-wrapper">
    <header class="edu-header header-transparent header-style-2 header-default">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-xl-3 col-md-6 col-6">
                    <div class="logo">
                        <a href="https://www.astiacademy.ac.ae/">
                            <img class="logo-light" src="front_assets/images/latest/asti.webp" alt="Site Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9 col-md-6 col-6 text-right">
                    <div class="header-links">
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                    <a href="{{ url('/promo-codes') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Promo Codes</a> |
                                    <a href="{{ url('/checkout') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Check Out</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="popup-mobile-menu">
        <div class="inner">
            <div class="header-top">
                <div class="logo">
                    <a href="https://www.astiacademy.ac.ae/">
                        <img src="front_assets/images/latest/asti.png" alt="Site Logo">
                    </a>
                </div>
                <div class="close-menu">
                    <button class="close-button">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- Start banner area  -->
    <div class="slider-area banner-style-2 edu-section-gap bg-image d-flex ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="inner" style="margin-top: 24px;">
                        <div class="content">

                            <h1 class="title text_shadows" data-sal-delay="200" data-sal="slide-up"
                                data-sal-duration="800" style="font-size: 48px !important;">
                                Crafting future<br>
                                <div>
                                    <span id="engineering-category" style="color: brown;">Mechanical</span>
                                    Engineers
                                </div>
                            </h1>
                            <p class="description" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                                ASTI combines science, creativity, and critical thinking to drive innovation and
                                fuel your path toward engineering excellence.</p>

                            <div class="arrow-sign d-lg-block d-none">
                                <img src="front_assets/images/banner/banner-02/arrow.png" alt="Banner Images"
                                     data-sal-delay="150" data-sal="fade" data-sal-duration="800">
                            </div>
                            <div class="read-more-btn mb--50" data-sal-delay="300" data-sal="slide-up"
                                 data-sal-duration="800">
                                <a href="contactus.php">
                                    <button type="button" class=" animated-button1"><span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span> Apply Now <i class="icon-arrow-right-line-right"></i></button>
                                </a>
                            </div>

                            <h6 class="" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                                Application closes in:</h6>

                            <div class="countdown-style-1" style="margin-bottom: 80px;">
                                <div class="countdown" data-date="2024-05-30" style=" justify-content: left;">
                                    <div class="countdown-container days">
                                        <span class="countdown-value">87</span>
                                        <span class="countdown-heading">Days</span>
                                    </div>
                                    <div class="countdown-container hours">
                                        <span class="countdown-value">23</span>
                                        <span class="countdown-heading">Hours</span>
                                    </div>
                                    <div class="countdown-container minutes">
                                        <span class="countdown-value">38</span>
                                        <span class="countdown-heading">Mins</span>
                                    </div>
                                    <div class="countdown-container seconds">
                                        <span class="countdown-value">27</span>
                                        <span class="countdown-heading">Secs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 d-none d-md-inline">
                    <div class="banner-thumbnail">
                        <a href="contactus.php">
                            <img class="girl-thumb" src="front_assets/images/latest/banner-comp.webp"
                                 alt="Girl Images" /></a>
                    </div>
                    <!--  <div class="banner-bg d-lg-block d-none">
                        <img class="girl-bg" src="front_assets/images/latest/banner-comp.png" alt="Girl Background" data-sal-delay="150" data-sal="fade" data-sal-duration="800" />
                    </div> -->
                </div>
            </div>

            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="front_assets/images/shapes/shape-19.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="front_assets/images/shapes/shape-05-01.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-3">
                    <img src="front_assets/images/shapes/shape-19-01.webp" alt="Shape Thumb" />
                </div>
            </div>
        </div>
    </div>

    <!-- Start counter area  -->

    <div class="counterup-style-2 ptb--15">
        <div class="row g-5">
            <div class="col-md-2 line-separator">
                <div class="edu-counterup-2 text-center">
                    <div class="inner">
                        <div class="content">
                            <h3 class="counter"><span class="odometer" data-count="37">00</span>
                                <span class="after-icon">+</span>
                            </h3>
                            <span class="subtitle">Nationalities</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 line-separator">
                <div class="edu-counterup-2 text-center">
                    <div class="inner">
                        <div class="content">
                            <h3 class="counter"><span class="odometer" data-count="10000">00</span>
                                <span class="after-icon">+</span>
                            </h3>
                            <span class="subtitle">Alumni network</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 line-separator">
                <div class="edu-counterup-2 text-center">
                    <div class="inner">
                        <div class="content">
                            <h3 class="counter"><span class="odometer" data-count="27">00</span>
                                <span class="after-icon">+</span>
                            </h3>
                            <span class="subtitle">Years of Experience</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 line-separator">
                <div class="edu-counterup-2 text-center">
                    <div class="inner">
                        <div class="content">
                            <h3 class="counter"><span class="odometer" data-count="126">00</span>
                                <span class="after-icon">+</span>
                            </h3>
                            <span class="subtitle">MNC Placement</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 line-separator">
                <div class="edu-counterup-2 text-center">
                    <div class="inner">
                        <div class="content">
                            <h3 class="counter"><span class="odometer" data-count="6">00</span>
                                <span class="after-icon">+</span>
                            </h3>
                            <span class="subtitle"> Type of scholarship</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 line-separator">
                <div class="edu-counterup-2 text-center">
                    <div class="inner">
                        <div class="content">
                            <h3 class="counter"><span class="odometer" data-count="100">00</span>
                                <span class="after-icon">+</span>
                            </h3>
                            <span class="subtitle">speciality programs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Start program details area  -->
    <div class="edu-event-area eduvibe-home-two-event edu-section-gap bg-image video-gallery-overlay-area"
         style="padding-top:100px !important">
        <div class="container eduvibe-animated-shape">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12">
                    <div class="section-title text-start" data-sal-delay="150" data-sal="slide-up"
                         data-sal-duration="800">
                        <h3 class="title-heading gradient" align="center">Our Undergraduate Engineering Programs
                        </h3>
                    </div>
                </div>
                <div class="col-lg-12">
                    <ul class="edu-course-tab nav nav-tabs custom-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="mechanical-tab" data-bs-toggle="tab"
                                    data-bs-target="#mechanical" type="button" role="tab" aria-controls="mechanical"
                                    aria-selected="false">Mechanical</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="automobile-tab" data-bs-toggle="tab"
                                    data-bs-target="#automobile" type="button" role="tab" aria-controls="automobile"
                                    aria-selected="false">Automobile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="eee-tab" data-bs-toggle="tab" data-bs-target="#eee"
                                    type="button" role="tab" aria-controls="eee"
                                    aria-selected="false">Electrical</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="electronic-tab" data-bs-toggle="tab"
                                    data-bs-target="#electronic" type="button" role="tab" aria-controls="electronic"
                                    aria-selected="false">Electronic</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="civil-tab" data-bs-toggle="tab" data-bs-target="#civil"
                                    type="button" role="tab" aria-controls="civil" aria-selected="true">Civil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="it-tab" data-bs-toggle="tab" data-bs-target="#it"
                                    type="button" role="tab" aria-controls="it" aria-selected="false">IT</button>
                        </li>
                    </ul><br><br>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="mechanical" role="tabpanel"
                             aria-labelledby="mechanical-tab">
                            <div class="course-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumbnail">
                                            <a href="contactus.php">
                                                <img src="front_assets/images/latest/mechanical.jpg" alt="Shop Images"
                                                     style="border-radius:2%;width: 100%;height: 100%;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="inner mt_md--40 mt_sm--40 text-center">

                                            <div class="feature-list-wrapper">
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-student"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Mode of Study</h6>
                                                        <p>Online / On Campus / Weekend / Flexible Learning</p>

                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="200"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-square"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Program Duration</h6>
                                                        <p>2 Years
                                                        </p>
                                                        <p>6 Months (RPL)</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="250"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-research"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Credits Level</h6>
                                                        <p>240 Credits</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="300"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-clock"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Qualification</h6>
                                                        <p>UK Level 5
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="automobile" role="tabpanel" aria-labelledby="automobile-tab">
                            <div class="course-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumbnail"><a href="contactus.php">
                                                <img src="front_assets/images/latest/automobile.jpg" alt="Shop Images"
                                                     style="border-radius:2%;width: 100%;height: 100%;"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="inner mt_md--40 mt_sm--40 text-center">
                                            <div class="feature-list-wrapper">
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-student"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Mode of Study</h6>
                                                        <p>Online / On Campus / Weekend / Flexible Learning</p>

                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="200"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-square"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Program Duration</h6>
                                                        <p>2 Years
                                                        </p>
                                                        <p>6 Months (RPL)</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="250"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-research"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Credits Level</h6>
                                                        <p>240 Credits</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="300"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-clock"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Qualification</h6>
                                                        <p>UK Level 5
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="eee" role="tabpanel" aria-labelledby="eee-tab">
                            <div class="course-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumbnail">
                                            <a href="contactus.php">
                                                <img src="front_assets/images/latest/electrical.jpg" alt="Shop Images"
                                                     style="border-radius:2%;width: 100%;height: 100%;"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="inner mt_md--40 mt_sm--40 text-center">
                                            <div class="feature-list-wrapper">
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-student"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Mode of Study</h6>
                                                        <p>Online / On Campus / Weekend / Flexible Learning</p>

                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="200"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-square"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Program Duration</h6>
                                                        <p>2 Years
                                                        </p>
                                                        <p>6 Months (RPL)</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="250"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-research"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Credits Level</h6>
                                                        <p>240 Credits</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="300"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-clock"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Qualification</h6>
                                                        <p>UK Level 5
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="electronic" role="tabpanel" aria-labelledby="electronic-tab">
                            <div class="course-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumbnail">
                                            <a href="contactus.php">
                                                <img src="front_assets/images/latest/EEE.jpg" alt="Shop Images"
                                                     style="border-radius:2%;width: 100%;height: 100%;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="inner mt_md--40 mt_sm--40 text-center">

                                            <div class="feature-list-wrapper">
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-student"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Mode of Study</h6>
                                                        <p>Online / On Campus / Weekend / Flexible Learning</p>

                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="200"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-square"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Program Duration</h6>
                                                        <p>2 Years
                                                        </p>
                                                        <p>6 Months (RPL)</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="250"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-research"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Credits Level</h6>
                                                        <p>240 Credits</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="300"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-clock"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Qualification</h6>
                                                        <p>UK Level 5
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="civil" role="tabpanel" aria-labelledby="civil-tab">
                            <div class="course-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumbnail">
                                            <a href="contactus.php">
                                                <img src="front_assets/images/latest/civil.jpg" alt="Shop Images"
                                                     style="border-radius:2%;width: 100%;height: 100%;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="inner mt_md--40 mt_sm--40 text-center">
                                            <div class="feature-list-wrapper">
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-student"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Mode of Study</h6>
                                                        <p>Online / On Campus / Weekend / Flexible Learning</p>

                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="200"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-square"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Program Duration</h6>
                                                        <p>2 Years
                                                        </p>
                                                        <p>6 Months (RPL)</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="250"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-research"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Credits Level</h6>
                                                        <p>240 Credits</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="300"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-clock"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Qualification</h6>
                                                        <p>UK Level 5
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="it" role="tabpanel" aria-labelledby="it-tab">
                            <div class="course-tab-content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="thumbnail">
                                            <a href="contactus.php">
                                                <img src="front_assets/images/latest/IT.jpg" alt="Shop Images"
                                                     style="border-radius:2%;width: 100%;height: 100%;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="inner mt_md--40 mt_sm--40 text-center">
                                            <div class="feature-list-wrapper">
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="150"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-student"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Mode of Study</h6>
                                                        <p>Online / On Campus / Weekend / Flexible Learning</p>

                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="200"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-square"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Program Duration</h6>
                                                        <p>2 Years
                                                        </p>
                                                        <p>6 Months (RPL)</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="250"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-research"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Credits Level</h6>
                                                        <p>240 Credits</p>
                                                    </div>
                                                </div>
                                                <div class="feature-list mt--35 mt_mobile--15" data-sal-delay="300"
                                                     data-sal="slide-up" data-sal-duration="800">
                                                    <div class="icon">
                                                        <i class="icon-clock"></i>
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="title">Qualification</h6>
                                                        <p>UK Level 5
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="front_assets/images/shapes/shape-04-02.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="front_assets/images/shapes/shape-03-06.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-3">
                    <img src="front_assets/images/shapes/shape-04-03.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-4">
                    <img src="front_assets/images/shapes/shape-07-01.webp" alt="Shape Thumb" />
                </div>
            </div>
        </div>
    </div>

    <!-- Start Our Recognition & Accreditation  area  -->
    <div class="edu-brand-area" style="padding: 30px 0 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-logo mb--50">
                        <h4 align="center">Our Recognition & Accreditation </h4>
                    </div>

                    <div class="row eduvibe-home-five-brands mb--50">


                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main"
                                     src="front_assets/images/Accreditation Logos_116x 25/higher education-04.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/khda-01.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo mt-2">
                                <img class="logo-main"
                                     src="front_assets/images/Accreditation Logos_116x 25/ministry-03.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main"
                                     src="front_assets/images/Accreditation Logos_116x 25/ofqual-05.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/qad-06.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/sce-07.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/tvet-08.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/wes-02.webp"
                                     alt="Brand Images">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start free workshop area  -->
    <div class="edu-event-area eduvibe-home-two-event edu-section-gap bg-image video-gallery-overlay-area">
        <div class="container eduvibe-animated-shape">
            <div class="row gy-lg-0 gy-5 row--60 align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="workshop-inner">
                        <div class="section-title text-white" data-sal-delay="150" data-sal="slide-up"
                             data-sal-duration="800">
                                <span>
                                    <h3 class="title gradient-text">Guiding Passion into Profession:</h3>
                                    <h5>The ASTI Approach to Engineering Success.</h5>
                                </span>
                        </div>
                        <p class="description" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                            Embark on a transformational voyage as ASTI's students evolve into skilled engineers,
                            leaving their mark on the world of innovation and technology.</p>
                        <div class="read-more-btn" data-sal-delay="350" data-sal="slide-up" data-sal-duration="800">
                            <a id="more-workshop" href="contactus.php">
                                <button class=" animated-button1"><span></span>
                                    <span></span>
                                    <span></span> Know more about ASTI</button>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">

                    <div class="video-container">
                        <video controls playsinline autoplay muted loop id="video-source">
                            <source src="front_assets/images/videopopup/video-less.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>

                </div>
            </div>
            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="front_assets/images/shapes/shape-09-01.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="front_assets/images/shapes/shape-04-05.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-3">
                    <img src="front_assets/images/shapes/shape-13-02.webp" alt="Shape Thumb" />
                </div>
            </div>

        </div>
    </div>

    <div class="edu-workshop-area eduvibe-home-three-video workshop-style-1 edu-section-gap bg-image ">
        <div class="container eduvibe-animated-shape">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <div class="section-title text-center mb--50" data-sal-delay="150" data-sal="slide-up"
                             data-sal-duration="800">

                            <h3 class="title">This program is for you if you are a...</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-style-1">
                                    <li><i class="icon-checkbox-circle-fill-solid"></i>12th Grade Students</li>
                                    <li><i class="icon-checkbox-circle-fill-solid"></i>Working Professionals</li>
                                    <li><i class="icon-checkbox-circle-fill-solid"></i>Looking for distance or
                                        online education</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-style-1">
                                    <li><i class="icon-checkbox-circle-fill-solid"></i>Looking upgrade or change
                                        your career</li>
                                    <li><i class="icon-checkbox-circle-fill-solid"></i>School or University dropout
                                    </li>
                                    <li><i class="icon-checkbox-circle-fill-solid"></i>Looking for a Vocational
                                        British Qualification</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="front_assets/images/shapes/shape-03-04.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="front_assets/images/shapes/shape-16.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-3">
                    <img src="front_assets/images/shapes/shape-13-02.webp" alt="Shape Thumb" />
                </div>
            </div>

        </div>
    </div>

    <!-- Start We offer quality area  -->
    <div class="edu-event-area eduvibe-home-two-event  bg-image video-gallery-overlay-area">
        <div class="container eduvibe-animated-shape">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up"
                             data-sal-duration="800">

                            <h3 class="title">UAE's Premier Hub for International Engineering Excellence: Your
                                Journey Starts Here</h3>
                            <br>
                            <span class="pre-title" style="text-transform: none; font-size: 21px;">Experience a
                                    world-class education that celebrates diversity and fuels your engineering dreams at
                                    ASTI Academy, the UAE's unrivaled destination for excellence."</span><br><br>
                        </div>
                        <div class="thumbnail">
                            <a href="assets/images/peoplegroup/1300 x 700.webp">
                                <img src="front_assets/images/peoplegroup/1300 x 700.webp" alt="Event Images"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="front_assets/images/shapes/shape-03-04.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="front_assets/images/shapes/shape-16.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-3">
                    <img src="front_assets/images/shapes/shape-13-02.webp" alt="Shape Thumb" />
                </div>
            </div>

        </div>
    </div>

    <!-- Start unlock your potential area  -->
    <div class="edu-workshop-area eduvibe-home-three-video workshop-style-1 edu-section-gap bg-image "
         style="padding:40px !important">
        <div class="container eduvibe-animated-shape">
            <div class="row">
                <div class="col-lg-8">
                    <h5 class="title" style="margin-top: 14px;">We deliver innovative programs that span a broad
                        range of disciplines.</h5>
                </div>
                <div class="col-lg-4">
                    <a href="contactus.php" class=" animated-button1">
                        <span></span><span></span><span></span>Download Brochure<i
                            class="icon-arrow-right-line-right"> </i>
                    </a>
                </div>
            </div>

            <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                <div class="shape-image shape-image-1">
                    <img src="front_assets//images/shapes/shape-03-04.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-2">
                    <img src="front_assets//images/shapes/shape-16.webp" alt="Shape Thumb" />
                </div>
                <div class="shape-image shape-image-3">
                    <img src="front_assets//images/shapes/shape-13-02.webp" alt="Shape Thumb" />
                </div>
            </div>

        </div>
    </div>

    <!-- Start featured area  -->
    <div class="edu-workshop-area eduvibe-home-three-video workshop-style-1 bg-image" style="padding: 5px 0 ;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-logo">
                        <h4 align="center">Our Alumni Work at: </h4>
                    </div>

                    <div class="row eduvibe-home-five-brands mb--50" style="animation-duration: 5s;
                        animation-name: slidein;
                        animation-iteration-count: infinite;">
                        <!-- <div class="col-lg-2 col-md-12">
                            <div class="client-logo">
                                <h6>Our Recognitions: </h6>
                            </div>
                        </div> -->

                        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/higher education-04.webp" alt="Brand Images">

                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/higher education-04.webp" alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo mt-2">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/higher education-04.webp" alt="Brand Images">

                            </a>
                        </div>
                        <!-- <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/brand/futtain-01.png" alt="Brand Images">

                            </a>
                        </div> -->
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/brand/ibm-01.png" alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/higher education-04.webp" alt="Brand Images">
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                            <a href="contactus.php" class="client-logo">
                                <img class="logo-main" src="front_assets/images/Accreditation Logos_116x 25/higher education-04.webp" alt="Brand Images">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Start let us help area  -->
    <div class="edu-brand-area bg-color-gray eduvibe-home-two-event bg-image video-gallery-overlay-area"
         style="padding: 40px 0 100px !important;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="inner">
                        <div class="section-title text-start" data-sal-delay="150" data-sal="slide-up"
                             data-sal-duration="800">
                            <!-- <span class="pre-title">Let Us Help</span> -->
                            <h5>Get Higher International Diploma at 1/3 cost of a traditional Diploma
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div
                        class="newsletter-right-content d-block d-sm-flex align-items-center justify-content-start justify-content-lg-end">
                        <div class="contact-btn">
                            <a class="animated-button1"
                               href="contactus.php"><span></span><span></span><span></span>Request info<i
                                    class="icon-arrow-right-line-right"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="edu-btn btn-medium left-icon header-button callBtn" href="tel:+971 4 280 9955"><i
            class="icon-phone-line trin-trin" style="font-size:25px"></i>Call Now</a>


    <div class="edu-header  header-sticky header-transparent header-style-2 header-default "
         style="background:#931616 !important">
        <div class="row align-items-center">
            <div class="  col-2">
            </div>
            <div class="col-lg-4 col-xl-3 col-md-6 col-5">
                <h6 class="heading-mobile" style="color:white !important">Time Is Running Out.<br>Avail 30%
                    scholarship now
                </h6>
            </div>
            <div class="col-lg-3 d-none d-xl-block">
                <nav class="mainmenu-nav d-none d-lg-block">

                    <ul class="mainmenu">
                        <li class="has-droupdown"><span id="countdown-timer"></span>
                        </li>
                        <li class="has-droupdown">
                            <!-- <article>Seat filled</article> -->
                            <button class="white-box-icon">
                                <!-- <i class="ri-menu-line"></i> -->

                                <div class="flex-wrapper " style="background:#931616 !important">
                                    <div class="single-chart">
                                        <svg viewBox="0 0 36 36" class="circular-chart orange">
                                            <path class="circle-bg" d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path class="circle" stroke-dasharray="70, 100" d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <text x="18" y="20.35" class="percentage">70%</text>
                                        </svg>

                                    </div>
                                </div>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-8 col-xl-3 col-md-6 col-5" style="margin-left: -20px">
                <div class="header-right d-flex justify-content-end">
                    <div class="mobile-menu-bar ml--15 ml_sm--5 d-block d-xl-none">
                        <div class="hamberger">
                            <button class="btn btn-white" id="countdown-timer-two">
                            </button>
                        </div>
                    </div>
                    <div class="mobile-menu-bar ml--15 ml_sm--5" style="display:none">
                        <div class="hamberger">
                            <button class="white-box-icon ">
                                <!-- <i class="ri-menu-line"></i> -->
                                <div class="flex-wrapper " style="background:#931616 !important">
                                    <div class="single-chart">
                                        <svg viewBox="0 0 36 36" class="circular-chart orange">
                                            <path class="circle-bg" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <path class="circle" stroke-dasharray="70, 100" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                            <text x="18" y="20.35" class="percentage">70%</text>
                                        </svg>

                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="header-menu-bar">
                        <div class="quote-icon quote-user d-none d-md-block ml--15 ml_sm--5">
                            <a class="edu-btn btn-medium left-icon header-button animated-button1"
                               href="contactus.php" style=" background: white; color: brown;"><i
                                    class="icon-arrow-right-line-right"></i><span class="footer-btn"></span><span
                                    class="footer-btn"></span><span class="footer-btn"></span>Don't miss out</a>
                        </div>
                        <div class="quote-icon quote-user d-block d-md-none ml--15 ml_sm--5">
                            <a class="white-box-icon" href="contactus.php" style="color: brown !important;"><i
                                    class="icon-arrow-right-line-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" id="zsiqchat">
    var $zoho = $zoho || {};
    $zoho.salesiq = $zoho.salesiq || {
        widgetcode: "siqb22568c162f117ac6f5958d4b432f632a940b678d7d4f9d8507f744877dba4aa",
        values: {},
        ready: function () { }
    };
    var d = document;
    s = d.createElement("script");
    s.type = "text/javascript";
    s.id = "zsiqscript";
    s.defer = true;
    s.src = "https://salesiq.zohopublic.com/widget";
    t = d.getElementsByTagName("script")[0];
    t.parentNode.insertBefore(s, t);
</script>
<script src="front_assets/js/vendor/modernizr.min.js"></script>
<script src="front_assets/js/vendor/jquery.js"></script>
<script src="front_assets/js/vendor/bootstrap.min.js"></script>
<script src="front_assets/js/vendor/sal.min.js"></script>
<script src="front_assets/js/vendor/magnifypopup.js"></script>
<script src="front_assets/js/vendor/slick.js"></script>
<script src="front_assets/js/vendor/countdown.js"></script>
<script src="front_assets/js/vendor/jquery-appear.js"></script>
<script src="front_assets/js/vendor/odometer.js"></script>
<script src="front_assets/js/vendor/isotop.js"></script>
<script src="front_assets/js/vendor/imageloaded.js"></script>
<script src="front_assets/js/vendor/lightbox.js"></script>
<script src="front_assets/js/vendor/wow.js"></script>
<script src="front_assets/js/vendor/paralax.min.js"></script>
<script src="front_assets/js/vendor/paralax-scroll.js"></script>
<script src="front_assets/js/vendor/jquery-ui.js"></script>
<script src="front_assets/js/vendor/tilt.jquery.min.js"></script>
<script src="front_assets/js/main.js"></script>
<script>
    (function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-M72KD25G');
</script>
<script type="text/javascript">
    (function (c, l, a, r, i, t, y) {
        c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };
        t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "m1h7pve1si");
</script>
<script>

    // let countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
    const countDownDate = new Date();
    countDownDate.setHours(countDownDate.getHours() + 2);
    let x = setInterval(function () {
        let now = new Date().getTime();
        let distance = countDownDate - now;
        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown-timer").innerHTML = hours + "h :" +
            minutes + "m :" + seconds + "s ";
        document.getElementById("countdown-timer-two").innerHTML = hours + "h :" +
            minutes + "m :" + seconds + "s ";
        if (distance < 0) {
            clearInterval(x);
            document.getElementsByClassName("countdown-timer").innerHTML = "EXPIRED";
        }
    }, 1000);

    const changingTextElement = document.getElementById('engineering-category');
    const textArray = ['Civil', 'Automobile', 'Electrical', 'Electronic', 'IT', 'Mechanical'];
    let currentIndex = 0;

    function changeText() {
        changingTextElement.textContent = textArray[currentIndex];
        currentIndex = (currentIndex + 1) % textArray.length;
    }
    setInterval(changeText, 2000);
</script>

</body>

</html>
