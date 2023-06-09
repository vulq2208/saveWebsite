<!DOCTYPE html>
<html lang="en" class="js">

<head>
    @include('layout.header')
</head>

<body>
    <header class="header-container">
        <header class="header__menu-top">
            <div class="header__menu-wrapper">
                <div class="header__logo-wrapper">
                    <a href="#" class="logo__link">
                        <img src="https://bizweb.dktcdn.net/100/318/614/themes/667160/assets/logo.png?1681444077990"
                            alt="">
                    </a>
                </div>
                <div class="header__menu__right">
                    <ul class="header__menu__right-list">
                        <li class="menu__right-list__item">
                            <div class="menu__right-icon__search">
                                <button class="btn-icon__search" style=" outline: none; ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                    </svg>
                                </button>
                                <form action="#" class="general-search__form">
                                    <div class="general-search__input-group">
                                        <label for="general-search__search-input" class="type--cat-bold">Search</label>
                                        <input type="text" id="general-search__search-input"
                                            class="general-search__input" placeholder="What are you looking for?">
                                        <button class="general-search__input_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="general-close__input_icon"
                                            style=" outline: none; ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </li>
                        <li class="menu__right-list__item utility-nav__magazine">
                            <span>Magazine</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                            <div class="nav__sublist-container">
                                <ul class="nav__list">
                                    <li class="nav__list-item"><a href="#"
                                            class="nav__list-item-link">Subscribe</a></li>
                                    <li class="nav__list-item"><a href="#" class="nav__list-item-link">Manage Your
                                            Subscription</a></li>
                                    <li class="nav__list-item"><a href="#" class="nav__list-item-link">Give a Gift
                                            Subscription</a></li>
                                    <li class="nav__list-item"><a href="#" class="nav__list-item-link">Get
                                            Help</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu__right-list__item">
                            <a href="#">
                                <span>Newsletter</span>
                            </a>
                        </li>
                        <li class="menu__right-list__item">
                            <a href="#">
                                <span>Sweepstakes</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
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
                    {{-- <li class="utility-nav__list__item" style=" padding-right: 8px;border-right: 0.5px solid #c9c4c4;">
                        <button class="search__icon-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </li> --}}
                    <li class="utility-nav__list__item" style=" padding-left: 8px; ">
                        <a href="#" class="menu-subscribe">
                            Subscribe
                        </a>
                    </li>
                </ul>
            </div>
        </header>
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
                        <li class="footer-nav__list-item"><a href="#" class="squirrel-link">Entertainment</a>
                        </li>
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
