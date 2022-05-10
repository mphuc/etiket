@extends('layouts.app')

@section('body')
    <section class="banner" id="sect-overview">
        <div data-uk-slideshow="{animation: 'swipe'}" data-uk-parallax="{yp: '25', velocity: '0.4'}">
            <ul class="uk-slideshow">
                @foreach ($slider as $key => $value)
                <li style="background-image: url('img/load/800/450/crop/{{ $value['post_img'] }}')">
                    <div class="uk-container uk-container-center">
                        <div class="slide_content_a">
                            <h2 class="slide_header">{{ $value['post_title'] }}</h2>
                            {!! $value['post_content'] !!}
                            <a href="{{ $setting_link_slider }}" class="md-btn md-btn-large md-btn-danger">{{ lang('purchase_now') }}</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="slide_navigation">
                <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
                <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slideshow-item="next"></a>
                <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                    @foreach ($slider as $key => $value)
                    <li data-uk-slideshow-item="{{ $key }}"><a href=""></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section section_large" id="sect-features" style="margin-top: 150px;">
        <div class="uk-container uk-container-center">
            <div class="uk-grid">
                <div class="uk-width-large-3-5 uk-container-center uk-text-center">
                    <h2 class="heading_b">
                        {{ lang('feature') }}
                        <span class="sub-heading">{{ $desc_feature }}</span>
                    </h2>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 animate" data-uk-scrollspy="{cls:'uk-animation-slide-bottom animated',target:'> *',delay:300,topoffset:-100}">
                @foreach ($features as $key => $value)
                <div class="uk-margin-top uk-text-center">
                    <div class="uk-text-center uk-margin-bottom">
                        <img src="img/load/150/150/png2/{{ $value['post_img'] }}" width="150">
                    </div>
                    <h3 class="heading_c uk-text-center">{{ $value['post_title'] }}</h3>
                    {{ $value['post_content'] }}
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section_gallery md-bg-blue-grey-50" id="sect-templates">
        <div class="uk-container-fluid uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
            <h2 class="heading_c uk-margin-medium-bottom uk-text-center">
                {{ lang('template') }}
                <span class="sub-heading">{{ $desc_template }}</span>
            </h2>
            <div>
                <ul class="uk-grid uk-grid-small template uk-grid-width-medium-1-3 uk-grid-width-large-1-4">
                    @foreach ($template as $key => $value)
                    <li>
                        <div class="md-card">
                            <div class="md-card-content padding-reset"><img src="img/load/365/144/png2/{{ $value['post_img'] }}" alt=""></div>
                            <div class="md-card-footer">
                                <h4 class="md-card-footer-head">{{ $value['post_title'] }}</h4>
                                {{ $value['post_content'] }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section section_gallery md-bg-blue-grey-50" id="sect-testimonial">
        <div class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
            <h2 class="heading_b uk-margin-medium-bottom uk-text-center">
                {{ lang('testimonial')  }}
                <span class="sub-heading">{{ $desc_testimonial }}</span>
            </h2>
            <div data-uk-slider>
                <div class="uk-slider-container">
                    <ul class="uk-grid uk-grid-small uk-slider uk-grid-width-medium-1-2 uk-grid-width-large-1-2">
                        @foreach ($testimonial as $key => $value):
                        <li>
                            <div class="uk-grid">
                                <div class="uk-width-2-10"><img src="img/load/83/83/png2/{{ $value['post_img'] }}" width="100%"></div>
                                <div class="uk-width-8-10">
                                    <h2>{{ $value['post_title'] }}</h2>
                                    {!! $value['post_content'] !!}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="slide_navigation">
                    <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slider-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slider-item="next"></a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section_gallery" id="sect-client">
        <div class="uk-container uk-container-center uk-invisible" data-uk-scrollspy="{cls:'uk-animation-fade uk-invisible',delay:300,topoffset:-150}">
            <h2 class="heading_b uk-margin-medium-bottom uk-text-center">
                {{ lang('our_client') }}
                <span class="sub-heading">{{ $desc_client }}</span>
            </h2>
            <div data-uk-slider>
                <div class="uk-slider-container">
                    <ul class="uk-grid uk-grid-small uk-slider uk-grid-width-medium-1-3 uk-grid-width-large-1-5">
                        @foreach ($client as $key => $value):
                        <li>
                            <div class="md-card">
                                <div class="md-card-content padding-reset"><img src="img/load/217/144/png2/{{ $value['post_img'] }}" alt=""></div>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="slide_navigation">
                    <a href="" class="uk-slidenav uk-slidenav-previous" data-uk-slider-item="previous"></a>
                    <a href="" class="uk-slidenav uk-slidenav-next" data-uk-slider-item="next"></a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section_large md-bg-blue-grey-50" id="sect-contact">
        <div class="uk-container uk-container-center">
            <div class="uk-grid uk-grid-divider" data-uk-grid-margin>
                <div class="uk-width-large-2-5">
                    <h3 class="heading_c uk-margin-large-bottom">{{ lang('contact_form') }}</h3>
                    <form action="kirim-email" method="POST">
                        <div class="uk-form-row">
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2">
                                    <label>{{ lang('first_name') }}</label>
                                    <input name="first_name" type="text" class="md-input" />
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <label>{{ lang('last_name') }}</label>
                                    <input name="last_name" type="text" class="md-input" />
                                </div>
                            </div>
                        </div>
                        <div class="uk-form-row">
                            <label>{{ lang('email_address') }}</label>
                            <input name="email" type="email" class="md-input" />
                        </div>
                        <div class="uk-form-row">
                            <label>{{ lang('message') }}</label>
                            <textarea name="message" cols="30" rows="4" class="md-input"></textarea>
                        </div>
                        <div class="uk-form-row">
                            <button type="submit" class="md-btn md-btn-success md-btn-large">{{ lang('send_message') }}</button>
                        </div>
                    </form>
                </div>
                <div class="uk-width-large-3-5">
                    <h3 class="heading_c uk-margin-large-bottom">{{ lang('contact') }}</h3>
                    <p class="uk-margin-large-bottom">
                        {{ $company['company_address'] }}
                    </p>
                    <p>
                        <i class="material-icons md-24 uk-margin-small-right">&#xE551;</i> {{ $company['company_telephone'] }}
                    </p>
                    <p>
                        <i class="material-icons md-24 uk-margin-small-right">&#xE0E1;</i>
                        <a href="mailto:{{ $company['company_email'] }}">{{ $company['company_email'] }}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('print-head')
    <style type="text/css">
        /*you can print style here*/
    </style>
    <script type="text/javascript">
        /*you can print script here*/
    </script>
@endsection

@section('script-body')
    <script type="text/javascript">
        /*you can print script here*/
    </script>
@endsection