<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        @if(auth()->user()->hasMedia('avatar'))
        <img src="{{ auth()->user()->getMedia('avatar')->first()->getUrl('thumb') }}" class="user-image img-circle elevation-2" alt="User Image">
        @else
        <img src="{{ asset('images/no-image.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
        @endif
        <span class="d-none d-md-inline">{{auth()->user()->getName()}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <!-- User image -->
        <li class="user-header bg-primary">
            @if(auth()->user()->hasMedia('avatar'))
            <img src="{{ auth()->user()->getMedia('avatar')->first()->getUrl('thumb') }}" class="img-circle elevation-2" alt="User Image">
            @else
            <img src="{{ asset('images/no-image.jpg') }}" class="img-circle elevation-2" alt="User Image">
            @endif
            <p>
                {{auth()->user()->getName()}}
            </p>
        </li>

        <li class="user-footer">
            <a href="{{route('dashboard.profile.edit', auth()->user())}}" class="btn btn-default btn-flat">
                {{__('Profile')}}
            </a>
            <a href="{{ route('logout') }}"
               class="btn btn-default btn-flat float-right"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                @lang("auth.logout")
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>
