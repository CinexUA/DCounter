<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @foreach(\LaravelLocalization::getLocalesOrder() as $key=>$lang)
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{\LaravelLocalization::localizeURL(route('dashboard.index'), $key)}}" class="nav-link">
                {{strtoupper($key)}}
            </a>
        </li>
        @endforeach
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
