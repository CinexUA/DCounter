<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="flag-icon flag-icon-{{\LaravelLocalization::getCurrentLocale()}}"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0;">
        @foreach(\LaravelLocalization::getLocalesOrder() as $key=>$lang)
        <a href="{{\LaravelLocalization::localizeURL(url()->current(), $key)}}"
           class="dropdown-item">
            <i class="flag-icon flag-icon-{{$key}} mr-2"></i> {{mb_convert_case($lang['native'], MB_CASE_TITLE)}}
        </a>
        @endforeach
    </div>
</li>
