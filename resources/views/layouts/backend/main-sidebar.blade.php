<!-- Left Sidebar start-->
<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">

            <li>
                <a href="{{route('admin_dashboard')}}"><i class="ti-home"></i><span class="right-nav-text">{{ __('backend/dashboard.home')}}</span></a>
            </li>


            <!-- menu item calendar-->
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                    <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">الاقسام</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">

                    <li> <a href="{{route('Categories.index')}}">الفئة</a> </li>
                    <li> <a href="{{route('mail')}}">  Mail </a> </li>




                </ul>
            </li>


            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                    <div class="pull-left"><i class="ti-settings"></i><span class="right-nav-text">الإعدادات</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="elements" class="collapse" data-parent="#sidebarnav">

                    {{-- <li> <a href="{{route('Setting.index')}}">  وسائل التواصل الاجتماعي </a> </li> --}}
                </ul>
            </li>


            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                    <div class="pull-left"><i class="ti-pie-chart"></i><span class="right-nav-text">المستخدمين</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="chart" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('roles.index')}}">صلاحيات المستخدمين</a> </li>
                    <li> <a href="{{route('users.index')}}">قائمة المستخدمين</a> </li>
                </ul>
            </li>





                </ul>
            </li>
        </ul>
    </div>
</div>

<!-- Left Sidebar End-->
