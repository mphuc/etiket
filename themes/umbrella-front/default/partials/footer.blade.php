<section class="section section_dark md-bg-blue-grey-700">
    <div class="uk-container uk-container-center">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-3-5 uk-text-center-medium">
                {{ $company['company_copyright'] }}
            </div>
            <div class="uk-width-medium-2-5">
                <div class="uk-align-medium-right uk-text-center-medium">
                    <a href="{{ $company['company_facebook_fans_page']  }}" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Facebook"><i class="uk-icon-facebook uk-icon-small md-color-white"></i></a>
                    <a href="{{ $company['company_twitter'] }}" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="Twitter"><i class="uk-icon-twitter uk-icon-small md-color-white"></i></a>
                    <a href="{{ $company['company_linkedin'] }}" class="uk-margin-medium-right" data-uk-tooltip="{offset: 12}" title="LinkedIn"><i class="uk-icon-linkedin uk-icon-small md-color-white"></i></a>
                    <a href="{{ $company['commpany_google_plus'] }}" data-uk-tooltip="{offset: 12}" title="Google Plus"><i class="uk-icon-google-plus uk-icon-small md-color-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>