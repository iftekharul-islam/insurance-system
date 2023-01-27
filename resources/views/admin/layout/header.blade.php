<style type="text/css">

</style>
<header class="app-header">

    <a class="app-header__logo" href="{{ route('home') }}">
        <img class="w-100" src="{{ asset('uploads/logo/') . '/' . settings()->site_logo }}" alt="">
    </a>

    <ul class="app-nav">

        <!-- Super Admin -->
        @if (Auth::user()->is_admin == 1)
            <li>
                <a class="app-nav__item" href="{{ route('home') }}">
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>

            <li class="dropdown texr-center">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                    Admin
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a class="dropdown-item" href="{{ route('list.admin') }}">
                            <i class="fa fa-cog fa-lg"></i>
                            List Admin
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('site.db_backup') }}">
                            <i class="fa fa-database fa-lg"></i>
                            Database Backup
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a class="app-nav__item" href="{{ route('all.member.list') }}">
                    <span class="app-menu__label">Member List</span>
                </a>
            </li>
            <li>
                <a class="app-nav__item" href="{{ route('all.close.request.member.list') }}">
                    <span class="app-menu__label">Close Request List</span>
                </a>
            </li>



            <li>
                <a class="app-nav__item" href="{{ route('managerreport.list') }}">
                    <span class="app-menu__label">Loan Report</span>
                </a>
            </li>

            <li>
                <a class="app-nav__item" href="{{ route('site.settings') }}">
                    <span class="app-menu__label">Settings</span>
                </a>
            </li>


            {{-- Notification --}}
            <li class="dropdown">
                <li>
                    <a class="app-nav__item" href="{{ route('loan.status') }}" >
                        <span class="app-menu__label">Account Status</span>
                    </a>
                </li>

            </li>
            {{-- Notification --}}

        @endif
        <!-- Super Admin -->

        <!-- Notice Admin -->
        @if (Auth::user()->is_admin == 4)
            <li>
                <a class="app-nav__item" href="{{ route('home') }}">
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="app-nav__item" href="{{ route('all.member.list.notic') }}">
                    <span class="app-menu__label">Member List</span>
                </a>
            </li>
            <li>
                <a class="app-nav__item" href="{{ route('notice.create') }}">
                    <span class="app-menu__label">Add Notice</span>
                </a>
            </li>

            {{-- Notification --}}
            <li class="dropdown">
                {{-- <a href="{{ route('all.edit.request.member') }}" aria-label="Open Profile Menu"
                    style="line-height: 33px;" class="btn btn-primary" data-toggle="dropdown">
                    Notifications <span class="badge bg-secondary">{{ count(NoticeAdminNotification()) }}</span>
                </a>

                <ul class="dropdown-menu settings-menu dropdown-menu-right">

                    @foreach (NoticeAdminNotification() as $notification)
                        <li style="padding: 10px;display: flex;justify-content: space-between;">
                            <a>
                                {{ $notification->n_type }}
                            </a>
                            <a href="{{ route('notification.view', $notification->id) }}">
                                View
                            </a>
                        </li>
                    @endforeach

                </ul> --}}
                <li>
                    <a class="app-nav__item" href="{{ route('loan.status') }}" >
                        <span class="app-menu__label">Account Status</span>
                    </a>
                </li>
            </li>
            {{-- Notification --}}

        @endif
        <!-- Notice Admin -->


        <!-- Manager -->
        @if (Auth::user()->is_admin == 2)
            <li>
                <a class="app-nav__item" href="{{ route('home') }}">
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="app-nav__item" href="{{ route('create.loan.officer') }}">
                    <span class="app-menu__label">Add Loan Officer</span>
                </a>
            </li>

            <li>
                <a class="app-nav__item" href="{{ route('loanprofile.list.bymanager') }}">
                    <span class="app-menu__label">Member List</span>
                </a>
            </li>


            <li>
                <a class="app-nav__item" href="{{ route('loan.setup') }}">
                    <span class="app-menu__label">Close Loan </span>
                </a>
            </li>

            <li>
                <a class="app-nav__item" href="{{ route('manager.profile.settings') }}">
                    <span class="app-menu__label">Profile Settings</span>
                </a>
            </li>

            <li>
                <a class="app-nav__item" href="{{ route('loanofficer.loanreport.bymanager') }}">
                    <span class="app-menu__label">Loan Report</span>
                </a>
            </li>


            <li>
                <a class="app-nav__item" href="{{ route('loan.status') }}" >
                    <span class="app-menu__label">Account Status</span>
                </a>
            </li>


        @endif
        <!-- Manager -->




        <!-- Loan Officer -->
        @if (Auth::user()->is_admin == 3)
            <li>
                <a class="app-nav__item" href="{{ route('home') }}">
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="app-nav__item" href="{{ route('user.form') }}">
                    <span class="app-menu__label">Form</span>
                </a>
            </li>


            <li>
                <a class="app-nav__item" href="{{ route('loan.oldform') }}">
                    <span class="app-menu__label">Old Form</span>
                </a>
            </li>


            <li>
                <a class="app-nav__item" href="{{ route('loacofficer.member.list') }}">
                    <span class="app-menu__label">Member List</span>
                </a>
            </li>


            <li>
                <a class="app-nav__item" href="{{ route('loan.amount.entry.form') }}">
                    <span class="app-menu__label">Recived Ammount</span>
                </a>
            </li>



            <li>
                <a class="app-nav__item" href="{{ route('officer.profile.settings') }}">
                    <span class="app-menu__label">Profile Settings</span>
                </a>
            </li>


            {{-- Notification --}}
            <li class="dropdown">

                <li>
                    <a class="app-nav__item" href="{{ route('loan.status') }}" >
                        <span class="app-menu__label">Account Status</span>
                    </a>
                </li>

            </li>
            {{-- Notification --}}


        @endif
        <!-- Loan Officer -->


        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                Welcome : {{ Auth::user()->name }}
                <i class="fa fa-user fa-lg"></i>
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i
                            class="fa fa-user fa-lg"></i>Logout</a>
                </li>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>


            </ul>
        </li>


    </ul>
</header>
