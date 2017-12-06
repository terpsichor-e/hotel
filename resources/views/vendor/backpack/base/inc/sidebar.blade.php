@if (Auth::check())
    <aside class="main-sidebar">
        <section class="sidebar">
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
            <ul class="sidebar-menu">
                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>
                        <span>На сайт</span></a></li>
                <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i>
                        <span>Главная</span></a></li>
                <li><a href="{{ url(config('backpack.base.route_prefix').'/page') }}"><i class="fa fa-file-o"></i>
                        <span>Страницы</span></a></li>
                <li><a href="{{ backpack_url('booking') }}"><i class="fa fa-book"></i> <span>Брони</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-tags"></i>
                        <span>Номерной фонд</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ backpack_url('feature') }}"><i class="fa fa-wifi"></i> <span>Удобства</span></a>
                        <li><a href="{{ backpack_url('class') }}"><i
                                        class="fa fa-tags"></i> <span>Категории</span></a></li>
                        <li><a href="{{ backpack_url('room') }}"><i
                                        class="fa fa-tag"></i> <span>Номера</span></a></li>
                    </ul>
                </li>
                {{--<li class="treeview">--}}
                    {{--<a href="#"><i class="fa fa-group"></i> <span>Доступ</span> <i--}}
                                {{--class="fa fa-angle-left pull-right"></i></a>--}}
                    {{--<ul class="treeview-menu">--}}
                        {{--<li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i>--}}
                                {{--<span>Пользователи</span></a></li>--}}
                        {{--<li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Роли</span></a></li>--}}
                        {{--<li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Права</span></a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li><a href="{{ backpack_url('menu-item') }}"><i class="fa fa-list"></i> <span>Меню</span></a></li>
                <li><a href="{{  backpack_url('elfinder') }}"><i class="fa fa-files-o"></i>
                        <span>Загрузки</span></a></li>
                <li><a href="{{ backpack_url('setting') }}"><i class="fa fa-cog"></i> <span>Настройки</span></a></li>
                <li><a href="{{  backpack_url('language') }}"><i class="fa fa-flag-o"></i> <span>Языки</span></a>
                </li>
                <li><a href="{{ backpack_url( 'language/texts') }}"><i class="fa fa-language"></i>
                        <span>Переводы</span></a></li>
            </ul>
        </section>
    </aside>
@endif
