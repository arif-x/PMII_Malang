<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon1.png" type="image/png">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/swiper-bundle.min.css') }}">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">

    <title>E-PMII Malang</title>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">E-PMII Malang</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="#about" class="nav__link">About</a>
                    </li>
                    <li class="nav__item">
                        <a href="#discover" class="nav__link">Team</a>
                    </li>
                    <li class="nav__item">
                        <a href="#modul" class="nav__link">Modul</a>
                    </li>
                    <li class="nav__item">
                        <a href="#video" class="nav__link">Video</a>
                    </li>
                    <li>
                        <div class="nav__dark">
                            <!-- Theme change button -->
                            <span class="change-theme-name">Dark mode</span>
                            <i class="ri-moon-line change-theme" id="theme-button"></i>
                        </div>
                    </li>
                </ul>                

                <i class="ri-close-line nav__close" id="nav-close"></i>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-function-line"></i>
            </div>
        </nav>
    </header>

    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="assets/img/home11.jpg" alt="" class="home__img">

            <div class="home__container container grid">
                <div class="home__data">
                    <!-- <span class="home__data-subtitle">Cross your limit</span> -->
                    <h1 class="home__data-title">PMII Kota<br> <b>Malang Pelopor</b><br>PMII Digital</h1>
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary" style="padding: 15px">Home</a>
                    <strong class="text-white">|</strong>
                    <a class="btn btn-primary" style="padding: 15px;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                    </a>
                    @else
                    <a href="/login" class="btn btn-primary" style="padding: 15px"><strong>Join Now</strong></a>
                    @if (Route::has('register'))                    
                    @endif
                    @endauth
                    @endif

                </div>

                <div class="home__social">
                    <a href="https://www.facebook.com/goodnewsfrompmii/" target="_blank" class="home__social-link">
                        <i class="ri-facebook-box-fill"></i>
                    </a>
                    <a href="https://www.instagram.com/sahabatpmii/" target="_blank" class="home__social-link">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="home__social-link">
                        <i class="ri-twitter-fill"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCZvpdPWZKwC1w099jN694pQ" target="_blank" class="home__social-link">
                        <i class="ri-youtube-fill"></i>
                    </a>
                </div>

                <div class="home__info">
                    <div>
                        <span class="home__info-title">Subscribe Youtube Sahabat</span>
                        <a href="https://www.youtube.com/channel/UCZvpdPWZKwC1w099jN694pQ" class="button button--flex button--link home__info-button">
                            More <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>

                    <div class="home__info-overlay">
                        <img src="assets/img/home21.jpg" alt="" class="home__info-img">
                    </div>
                </div>
            </div>
        </section>

        <!--==================== ABOUT ====================-->
        <section class="about section" id="about">
            <div class="about__container container grid">
                <div class="about__data">
                    <h2 class="section__title about__title">E-PMII <br> Kota Malang</h2>
                    <p class="about__description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.
                    </p>
                </div>

                <div class="about__img">
                    <div class="about__img-overlay">
                        <img src="assets/img/about11.jpg" alt="" class="about__img-one">
                    </div>

                    <div class="about__img-overlay">
                        <img src="assets/img/about21.jpg" alt="" class="about__img-two">
                    </div>
                </div>
            </div>
        </section>

        <!--==================== DISCOVER ====================-->
        <section class="discover section" id="discover">
            <h2 class="section__title">Developer Team <br> E-PMII Malang</h2>

            <div class="discover__container container swiper-container">
                <div class="swiper-wrapper">
                    <!--==================== DISCOVER 1 ====================-->
                    <div class="discover__card swiper-slide">
                        <img src="assets/img/discover11.jpg" alt="" class="discover__img">
                        <div class="discover__data">
                            <h2 class="discover__title">Wangg Surya Putra</h2>
                            <span class="discover__description">Kepala Suku</span>
                        </div>
                    </div>

                    <!--==================== DISCOVER 2 ====================-->
                    <div class="discover__card swiper-slide">
                        <img src="assets/img/discover11.jpg" alt="" class="discover__img">
                        <div class="discover__data">
                            <h2 class="discover__title">Paijo</h2>
                            <span class="discover__description">Bagian Paijo</span>
                        </div>
                    </div>

                    <!--==================== DISCOVER 3 ====================-->
                    <div class="discover__card swiper-slide">
                        <img src="assets/img/discover11.jpg" alt="" class="discover__img">
                        <div class="discover__data">
                            <h2 class="discover__title">Paijo</h2>
                            <span class="discover__description">Bagian Paijo</span>
                        </div>
                    </div>

                    <!--==================== DISCOVER 4 ====================-->
                    <div class="discover__card swiper-slide">
                        <img src="assets/img/discover11.jpg" alt="" class="discover__img">
                        <div class="discover__data">
                            <h2 class="discover__title">Paijo</h2>
                            <span class="discover__description">Bagian Paijo</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--==================== EXPERIENCE ====================-->
        <section class="experience section">
            <h2 class="section__title">With Our Experience <br> We Will Serve You</h2>

            <div class="experience__container container grid">
                <div class="experience__content grid">
                    <div class="experience__data">
                        <h2 class="experience__number">20</h2>
                        <span class="experience__description">Article <br> Education</span>
                    </div>

                    <div class="experience__data">
                        <h2 class="experience__number">75</h2>
                        <span class="experience__description">Donation <br> Member</span>
                    </div>

                    <div class="experience__data">
                        <h2 class="experience__number">650+</h2>
                        <span class="experience__description">Member <br> PMII Malang</span>
                    </div>
                </div>

                <div class="experience__img grid">
                    <div class="experience__overlay">
                        <img src="assets/img/home11.jpg" alt="" class="experience__img-one">
                    </div>

                    <div class="experience__overlay">
                        <img src="assets/img/experience21.jpg" alt="" class="experience__img-two">
                    </div>
                </div>
            </div>
        </section>

        <!--==================== VIDEO ====================-->
        <section class="video section">
            <h2 class="section__title">Video Sahabat</h2>

            <div class="video__container container">
                <p class="video__description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.
                </p>

                <div class="video__content">
                    <video id="video-file">
                        <source src="assets/video/video.mp4" type="video/mp4">
                        </video>

                        <button class="button button--flex video__button" id="video-button">
                            <i class="ri-play-line video__button-icon" id="video-icon"></i>
                        </button>
                    </div>
                </div>
            </section>

            <!--==================== PLACES ====================-->
            <section class="place section" id="modul">
                <h2 class="section__title">Choose Your Modul</h2>
                <div class="gr">
                    <div class="containers">
                        @foreach($modul as $data)
                        <div class="box">
                            <div class="image">
                                <img src="/img/thumbnail_pdf.png" alt="">
                            </div>
                            <div class="name_job text-capitalize">{{ $data->judul_post }}</div>
                            <div class="text-center text-capitalize">
                                @if($data->jenis_post == 1)
                                Jenis: Modul
                                @elseif($data->jenis_post == 2)
                                Jenis: Video
                                @endif
                                <br>By {{ $data->nama_lengkap }}
                            </div>
                            <div class="btns">
                                <a type="button" target="_blank" class="btn btn-primary" href="/video/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="place section" id="video">
                <h2 class="section__title">Choose Your Video</h2>
                <div class="gr">
                    <div class="containers">
                        @foreach($video as $data)
                        <div class="box">
                            <div class="image">
                                <img src="/img/thumbnail_pdf.png" alt="">
                            </div>
                            <div class="name_job text-capitalize">{{ $data->judul_post }}</div>
                            <div class="text-center text-capitalize">
                                @if($data->jenis_post == 1)
                                Jenis: Modul
                                @elseif($data->jenis_post == 2)
                                Jenis: Video
                                @endif
                                <br>By {{ $data->nama_lengkap }}
                            </div>
                            <div class="btns">
                                <a type="button" target="_blank" class="btn btn-primary" href="/video/{{ $data->file }}.{{ $data->format_post }}" style="width: 100%">Lihat</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>     
            </section>

            <!--==================== SUBSCRIBE ====================-->
            <section class="subscribe section">
                <div class="subscribe__bg">
                    <div class="subscribe__container container">
                        <h2 class="section__title subscribe__title">Subscribe Our <br> Newsletter</h2>
                        <p class="subscribe__description">Subscribe to our newsletter and get a 
                            special 30% discount.
                        </p>

                        <form action="" class="subscribe__form">
                            <input type="text" placeholder="Enter email" class="subscribe__input">

                            <button class="button">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </section>
            
            <!--==================== SPONSORS ====================-->
            <section class="sponsor section">
                <div class="sponsor__container container grid">
                    <div class="sponsor__content">
                        <img src="assets/img/sponsors11.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/sponsors2.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/sponsors3.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/sponsors4.png" alt="" class="sponsor__img">
                    </div>
                    <div class="sponsor__content">
                        <img src="assets/img/sponsors5.png" alt="" class="sponsor__img">
                    </div>
                </div>
            </section>
        </main>

        <!--==================== FOOTER ====================-->
        <footer class="footer section">
            <div class="footer__container container grid">
                <div class="footer__content grid">
                    <div class="footer__data">
                        <h3 class="footer__title">E-PMII Malang</h3>
                        <p class="footer__description">PMII Kota Malang <br> Pelopor PMII <br> Digital.
                        </p>
                        <div>
                            <a href="https://www.facebook.com/goodnewsfrompmii/" target="_blank" class="footer__social">
                                <i class="ri-facebook-box-fill"></i>
                            </a>
                            <a href="https://twitter.com/" target="_blank" class="footer__social">
                                <i class="ri-twitter-fill"></i>
                            </a>
                            <a href="https://www.instagram.com/sahabatpmii/" target="_blank" class="footer__social">
                                <i class="ri-instagram-fill"></i>
                            </a>
                            <a href="https://www.youtube.com/channel/UCZvpdPWZKwC1w099jN694pQ" target="_blank" class="footer__social">
                                <i class="ri-youtube-fill"></i>
                            </a>
                        </div>
                    </div>

                    <div class="footer__data">
                        <h3 class="footer__subtitle">About</h3>
                        <ul>
                            <li class="footer__item">
                                <a href="" class="footer__link">About Us</a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link">Features</a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link">New & Blog</a>
                            </li>
                        </ul>
                    </div>

                    <div class="footer__data">
                        <h3 class="footer__subtitle">Company</h3>
                        <ul>
                            <li class="footer__item">
                                <a href="" class="footer__link">Team</a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link">Plan y Pricing</a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link">Become a member</a>
                            </li>
                        </ul>
                    </div>

                    <div class="footer__data">
                        <h3 class="footer__subtitle">Support</h3>
                        <ul>
                            <li class="footer__item">
                                <a href="" class="footer__link">FAQs</a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link">Support Center</a>
                            </li>
                            <li class="footer__item">
                                <a href="" class="footer__link">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="footer__rights">
                    <p class="footer__copy">&#169; 2021 Java Foundation. All rigths reserved.</p>
                    <div class="footer__terms">
                        <a href="#" class="footer__terms-link">Terms & Agreements</a>
                        <a href="#" class="footer__terms-link">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </footer>

        <!--========== SCROLL UP ==========-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="ri-arrow-up-line scrollup__icon"></i>
        </a>

        <!--=============== SCROLL REVEAL===============-->
        <script src="{{ URL::asset('assets/js/scrollreveal.min.js') }}"></script>
        
        <!--=============== SWIPER JS ===============-->
        <script src="{{ URL::asset('assets/js/swiper-bundle.min.js') }}"></script>

        <!--=============== MAIN JS ===============-->
        <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    </body>
    </html>