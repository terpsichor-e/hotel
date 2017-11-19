@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ backpack_avatar_url(Auth::user()) }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <small>
                        <small><a href="{{ route('backpack.account.info') }}"><span><i
                                            class="fa fa-user-circle-o"></i> {{ trans('backpack::base.my_account') }}</span></a>
                            &nbsp; &nbsp; <a href="{{ backpack_url('logout') }}"><i class="fa fa-sign-out"></i>
                                <span>{{ trans('backpack::base.logout') }}</span></a></small>
                    </small>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
            {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
            <!-- ================================================ -->
                <!-- ==== Recommended place for admin menu items ==== -->
                <!-- ================================================ -->
                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>
                        <span>На сайт</span></a></li>
                <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i>
                        <span>Главная</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix').'/page') }}"><i class="fa fa-file-o"></i> <span>Страницы</span></a></li>
                <li><a href="{{  backpack_url('elfinder') }}"><i class="fa fa-files-o"></i>
                        <span>Загрузки</span></a></li>
                <li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Настройки</span></a></li>

                <!-- ======================================= -->
                {{-- <li class="header">Other menus</li> --}}
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
@endif
