<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    <header class="header-menu header-fixed-menu">
        <div class="header-logo">
            <ul class="header-nav-list">
                <li class="header-nav__list-item">
                    <a href="#">
                        News
                    </a>
                </li>
                <li class="header-nav__list-item">
                    <a href="#">
                        Entertainment
                    </a>
                </li>
                <li class="header-nav__list-item">
                    <a href="#">
                        Royals
                    </a>
                </li>
                <li class="header-nav__list-item">
                    <a href="#">
                        Lifestyle
                    </a>
                </li>
                <li class="header-nav__list-item">
                    <a href="#">
                        StyleWatch
                    </a>
                </li>
                <li class="header-nav__list-item">
                    <a href="#">
                        Shopping
                    </a>
                </li>
            </ul>
        </div>
        <div class="header-right">
            <ul class="utility-nav__list">
                <li class="utility-nav__list__item" style=" padding-right: 8px;border-right: 0.5px solid #c9c4c4;">
                    <button class="search__icon-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </li>
                <li class="utility-nav__list__item" style=" padding-left: 8px; ">
                    <a href="#" class="menu-subscribe">
                        Subscribe
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <div class="div__slide">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar">
                        @foreach ($categories->filter(function ($category) {
        return isset($category->slug);
    }) as $category)
                            <a href="{{ route('new-post', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-10">
                    <img src="https://people.com/thmb/XDgOV_R9TT0UuwTzozhJ3FLFfeU=/2400x600/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/parents2021-d-313b7205d3874e6ea826ede9dd2d20e3.png"
                        alt="">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer__inner">
            <div class="footer_right">
                <div class="footer__newsletter">
                    <a href="#">Newsletter</a>
                </div>
                <div class="footer__magsub">
                    <div class="img-placeholder">
                        <img src="https://people.com/thmb/BOKx3oqH9disHhvJGKJW84rn9L8=/300x150/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/people_magazine_sub-e6689738996d40f38f154099e1751481.png"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="footer_menu">
                <div class="footer-nav_1">
                    <ul class="footer-nav__list">
                        <li class="footer-nav__list-item"><a href="#" class="squirrel-link">News</a></li>
                        <li class="footer-nav__list-item"><a href="#" class="squirrel-link">Entertainment</a></li>
                        <li class="footer-nav__list-item"><a href="#" class="squirrel-link">Royals</a></li>
                        <li class="footer-nav__list-item"><a href="#" class="squirrel-link">Lifestyle</a></li>
                        <li class="footer-nav__list-item"><a href="#" class="squirrel-link">Shopping</a></li>
                    </ul>

                    <div class="footer-links_1-0">
                        <ul class="footer-links_1-0_1">
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">About Us</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">PEOPLE Tested</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">Editorial Policy</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">Careers</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">Privacy Policy</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">Contact Us</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">Terms of Use</a>
                            </li>
                            <li class="footer-links_1-0_item"><a href="#"
                                    class="footer-links_1-0_item_links">Advertise</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @include('layout.bottom')
</body>

</html>
