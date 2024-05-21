<div>
    <ul class="navbar-nav navbar-right">
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('img') }}/avatar/avatar-1.png" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->currentTeam->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title"> {{ __('Manage Team') }}</div>
                    <a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="dropdown-item has-icon">
                        <i class="far fa-users"></i> {{ __('Team Settings') }}
                    </a>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <a href="{{ route('teams.create') }}" class="dropdown-item has-icon">
                            {{ __('Create New Team') }}
                        </a>
                    @endcan
                    <hr class="dropdown-divider">
                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" />
                    @endforeach
                </div>
            </li>

        @endif

        <!-- Settings Dropdown -->
        @auth
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="rounded-circle mr-1" width="32" height="32"
                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <img alt="image" src="{{ asset('img') }}/avatar/avatar-1.png" class="rounded-circle mr-1">
                    @endif
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">{{ __('Manage Account') }}</div>
                    <a href="{{ route('user-profile') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> {{ __('Profile') }}
                    </a>
                    <a href="{{ route('profile.show') }}" class="dropdown-item has-icon"> <i class="fa fa-cog"
                            aria-hidden="true"></i>
                        {{ __('Setting') }}
                    </a>
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a href="{{ route('api-tokens.index') }}" class="dropdown-item has-icon">
                            <i class="fas fa-code"></i> {{ __('API Tokens') }}
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    </a>
                </div>
            </li>


        @endauth
    </ul>
</div>


@push('scripts')
    <script>
        $("#cleanNotif").on('click', function() {
            $.ajax({
                url: `{{ route('clearnotif') }}`
            }).done(function() {
                $(".notifications").load(location.href + " .notifications");
            })
        })
    </script>
@endpush
