        <!--=================================
 header start-->
        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo-dark.png" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-icon-dark.png"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
       
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                {{--  --}}
            </ul>
                        <!-- choose the language -->
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="btn btn-primary" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                @endforeach

            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ URL::asset('assets/images/logout.png') }}" alt="avatar" title="تسجيل الخروج">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <span>{{auth()->user()->email}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div  style="display: none;">
                            @if (auth("student")->check())
                            {{$type="student"}}
                        @elseif(auth("parent")->check())
                        {{$type="parent"}}
                        @elseif(auth("teacher")->check())
                        {{$type="teacher"}}
                        @else
                        {{$type="web"}}
                        @endif
                        </div>
                        <a class="dropdown-item" href="{{ route('logout',$type) }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                        class="bx bx-log-out"></i>تسجيل خروج</a>
                        <form id="logout-form" action="{{ route('logout',$type) }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!--=================================
 header End-->

