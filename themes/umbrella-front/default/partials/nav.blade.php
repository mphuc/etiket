<header id="header_main">
    <nav class="uk-navbar">
        <div class="uk-container uk-container-center">
            <a href="#" class="uk-float-left" id="mobile_navigation_toggle" data-uk-offcanvas="{target:'#mobile_navigation'}"><i class="material-icons">&#xE5D2;</i></a>
            <a href="" class="uk-navbar-brand">
                <img src="img/load/1/1/full/{{ $site_logo }}" alt="" width="71" height="15">
            </a>

            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav" id="main_navigation">
                    <li>
                        <a href="#sect-overview">
                            {{ lang('home') }}
                        </a>
                    </li>
                    <li>
                        <a href="#sect-features">
                            {{ lang('feature') }}
                        </a>
                    </li>
                    <li>
                        <a href="#sect-templates">
                            {{ lang('template') }}
                        </a>
                    </li>
                    <li>
                        <a href="#sect-pricing">
                            {{ lang('pricing') }}
                        </a>
                    </li>
                    <li>
                        <a href="#sect-testimonial">
                            {{ lang('testimonial') }}
                        </a>
                    </li>
                    <li>
                        <a href="#sect-client">
                            {{ lang('our_client') }}
                        </a>
                    </li>
                    <li>
                        <a href="#sect-contact">
                            {{ lang('contact') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div id="mobile_navigation" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
        <ul>
            <li>
                <a href="#sect-overview" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE417;</i></span>
                    <span class="menu_title">{{ lang('home') }}</span>
                </a>
            </li>
            <li>
                <a href="#sect-features" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE896;</i></span>
                    <span class="menu_title">{{ lang('feature') }}</span>
                </a>
            </li>
            <li>
                <a href="#sect-templates" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE410;</i></span>
                    <span class="menu_title">{{ lang('template') }}</span>
                </a>
            </li>
            <li>
                <a href="#sect-pricing" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE227;</i></span>
                    <span class="menu_title">{{ lang('pricing') }}</span>
                </a>
            </li>
            <li>
                <a href="#sect-testimonial" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE7FB;</i></span>
                    <span class="menu_title">{{ lang('testimonial') }}</span>
                </a>
            </li>
            <li>
                <a href="#sect-contact" data-uk-smooth-scroll="{offset: 48}">
                    <span class="menu_icon"><i class="material-icons">&#xE0E1;</i></span>
                    <span class="menu_title">{{ lang('contact') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>