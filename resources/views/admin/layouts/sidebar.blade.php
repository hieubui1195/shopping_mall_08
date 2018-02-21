<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="float: left;">
                <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info" style="float: left;">
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-globe"></i> <span>@lang('custom.common.change_language')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.change-language', ['en']) !!}">
                            <img src="{{ asset('images/en.png') }}" alt="English" />
                            English
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.change-language', ['vi']) !!}">
                            <img src="{{ asset('images/vi.png') }}" alt="Vietnamese" />
                            Tiếng Việt
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-list"></i> <span>@lang('custom.nav.categories')</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fab fa-product-hunt"></i> <span>@lang('custom.nav.products')</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-plus"></i> <span>@lang('custom.nav.promotions')</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-file"></i> <span>@lang('custom.nav.orders')</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-users"></i> <span>@lang('custom.nav.accounts')</span>
                </a>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>
