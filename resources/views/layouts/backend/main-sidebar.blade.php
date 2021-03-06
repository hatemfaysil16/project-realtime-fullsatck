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
                    <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">{{__('backend/dashboard.sections') }}</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">

                    <li> <a href="{{route('Categories.index')}}">{{__('backend/dashboard.category') }}</a> </li>
                    <li> <a href="{{route('mail')}}">  {{__('backend/dashboard.Mail') }} </a> </li>
                    <li> <a href="{{route('slider.index')}}">  {{__('backend/dashboard.slider') }} </a> </li>
                    <li> <a href="{{route('OurTeam.index')}}">  {{__('backend/OurTeam.Add_ourTeam') }} </a> </li>
                    <li> <a href="{{route('services.index')}}">  {{__('backend/services.Add_services') }} </a> </li>
                    <li> <a href="{{route('aboutUs.index')}}">  {{__('backend/aboutUs.Add_aboutUs') }} </a> </li>
                    <li> <a href="{{route('question.index')}}">  {{__('backend/question.question') }} </a> </li>
                    <li> <a href="{{route('features.index')}}">  features </a> </li>
                    <li> <a href="{{route('map.index')}}">  map </a> </li>
                    <li> <a href="{{route('ContactUs.index')}}">  ContactUs </a> </li>
                    <li> <a href="{{route('price.index')}}">  price </a> </li>
                    <li> <a href="{{route('logo.index')}}">  logo </a> </li>
                    <li> <a href="{{route('multi.image')}}">  protifilo </a> </li>
                    <li> <a href="{{route('Media_center.index')}}">  Media_center </a> </li>

                    
                </ul>
            </li>



            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                    <div class="pull-left"><i class="ti-pie-chart"></i><span class="right-nav-text">{{__('backend/dashboard.users') }}</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="chart" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="{{route('roles.index')}}">{{__('backend/dashboard.User_Permissions') }}</a> </li>
                    <li> <a href="{{route('users.index')}}">{{__('backend/dashboard.User_List') }}</a> </li>
                </ul>
            </li>





                </ul>
            </li>
        </ul>
    </div>
</div>

<!-- Left Sidebar End-->
