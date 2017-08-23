<div class="container">
    <div class="row">
        <div class="col l6 s12 text-cursor" onclick="backToTop()">
            <h5 class="white-text">@lang('interface/footer.goToTop')</h5>
            <img src="/img/grimpeur-footer.svg" height="200px">
        </div>
        <div class="col l4 offset-l2 s12">
            <h5 class="white-text">@lang('interface/footer.moreAboutOblyk')</h5>
            <ul>
                <li><a class="grey-text text-lighten-3" href="{{ route('project') }}">@lang('interface/nav.theProject')</a></li>
                <li><a class="grey-text text-lighten-3" href="{{ route('contact') }}">@lang('interface/nav.contact')</a></li>
                <li><a class="grey-text text-lighten-3" href="{{ route('about') }}">@lang('interface/nav.aboutUs')</a></li>
                <li><a class="grey-text text-lighten-3" href="{{ route('supportUs') }}"><i class="material-icons tiny red-text">favorite</i> @lang('interface/nav.supportUs')</a></li>
                <li><a class="grey-text text-lighten-3" href="{{ route('developer') }}">@lang('interface/nav.developerAndApi')</a></li>
                <li><a data-modal="{'id':'global', 'model':'Page'}" data-target="modal" data-route="{{route('problemModal')}}" class="grey-text text-lighten-3 btnModal">@lang('interface/footer.reportAProblem')</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="footer-copyright">
    <div class="container">
        © 2017 Oblyk
        <a class="grey-text text-lighten-4 right" href="{{ route('termsOfUse') }}">@lang('interface/nav.TermsOfService ')</a>
    </div>
</div>