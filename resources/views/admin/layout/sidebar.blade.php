<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside class="app-sidebar">

    <ul class="app-menu">


        @if (Auth::user()->is_admin == 1)
            <li><a class="app-menu__item" href="{{ route('admin.dashboard') }}"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
            </li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Admin</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('list.admin') }}"><i class="icon fa fa-circle-o"></i>
                            List Admin</a>
                    </li>
                    <!--             <li>
                                                            <a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o">
                                                            </i> Manage Category</a>
                                                        </li>
                                    -->
                </ul>
            </li>
            <!-- <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa-light fa-file-lines"></i><span class="app-menu__label">Menu</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a class="treeview-item" href="{{ route('aboutUs') }}"><i class="icon fa fa-circle-o"></i>About Us</a></li>
                            <li><a class="treeview-item" href="{{ route('list.admin') }}"><i class="icon fa fa-circle-o"></i>Contact Us</a></li>
                            <li><a class="treeview-item" href="{{ route('disclaimer.admin.page') }}"><i class="icon fa fa-circle-o"></i>Disclaimer</a></li>
                            <li><a class="treeview-item" href="{{ route('privacyPolicy') }}"><i class="icon fa fa-circle-o"></i>Privacy & Policy</a></li>
                        </ul>
                        </li> -->

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa-light fa fa-user"></i>
                    <span class="app-menu__label">Profile</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="{{ route('all.manager.profile') }}"><i
                                class="icon fa fa-circle-o"></i>Manager Profile</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('all.officer.profile') }}"><i
                                class="icon fa fa-circle-o"></i>Loan Officer Profile</a>
                    </li>
                    <li>
                        <a class="treeview-item" href="{{ route('all.rejected.profile') }}"><i
                                class="icon fa fa-circle-o"></i>Member Rejected Profile</a>
                    </li>

                </ul>
            </li>




            <li>
                <a class="app-menu__item" href="{{ route('all.notice') }}"><i
                        class="app-menu__icon fa-solid fa-newspaper"></i><span class="app-menu__label">View
                        Notice</span></a>

            <li>
                <a class="app-menu__item" href="{{ route('all.member.list') }}"><i
                        class="app-menu__icon fa-solid fa-user  "></i><span class="app-menu__label">Member
                        List</span>
                </a>








            <li>
                <a class="app-menu__item" href="{{ route('site.settings') }}"><i
                        class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Settings</span>
                </a>

            </li>
        @endif
        {{-- End --}}





        @if (Auth::user()->is_admin == 2)
            <li><a class="app-menu__item" href="{{ route('home') }}"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
            </li>
            <li><a class="app-menu__item" href="{{ route('create.loan.officer') }}"><i
                        class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Add Loan Officer</span></a>
            </li>
            <li><a class="app-menu__item" href="{{ route('loan.member.list') }}"><i
                        class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Member List</span></a></li>
            <li><a class="app-menu__item" href="{{ route('manager.profile.settings') }}"><i
                        class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Profile Settings</span></a>
            </li>
            <li><a class="app-menu__item" href="{{ route('manager.notice') }}"><i
                        class="app-menu__icon fa-solid fa-newspaper"></i><span class="app-menu__label">View
                        Notice</span></a>
        @endif

        @if (Auth::user()->is_admin == 3)
            <li><a class="app-menu__item" href="{{ route('home') }}"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
            </li>

            <!-- <li><a class="app-menu__item" href="{{ route('loan.submit') }}"><i class="app-menu__icon fa-solid fa-handshake"></i><span class="app-menu__label">Loan</span></a></li> -->
            <li><a class="app-menu__item" href="{{ route('user.form') }}"><i
                        class="app-menu__icon fa-brands fa-pagelines"></i><span
                        class="app-menu__label">Form</span></a></li>
            <li><a class="app-menu__item" href="{{ route('approve.member.list') }}"><i
                        class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Member List</span></a>
            </li>
            <li><a class="app-menu__item" href="{{ route('officer.profile.settings') }}"><i
                        class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">Profile
                        Settings</span></a></li>
            <li><a class="app-menu__item" href="{{ route('officer.notice') }}"><i
                        class="app-menu__icon fa-solid fa-newspaper"></i><span class="app-menu__label">View
                        Notice</span></a>
        @endif


        @if (Auth::user()->is_admin == 4)
            <li><a class="app-menu__item" href="{{ route('notice.create') }}"><i
                        class="fa-solid fa-newspaper"></i><span class="app-menu__label">&nbsp;Add Notice</span></a>
        @endif


    </ul>



</aside>
