<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <hr />
            </li>
            <li>
                <a href="">
                    @lang('custom.common.change_language')
                    <a href="{!! route('admin.change-language', ['en']) !!}" class="changeLang" data-lang="en" style="color: black;">
                        <img src="{{ asset('images/en.png') }}" alt="English" />
                        English
                    </a>
                    <a href="{!! route('admin.change-language', ['vi']) !!}" class="changeLang" data-lang="vi" style="color: black;">
                        <img src="{{ asset('images/vi.png') }}" alt="Vietnamese" />
                        Tiếng Việt
                    </a>
                </a>
            </li>
            <li>
                <hr />
            </li>
            <li>
                <a href="">
                    <i class="fa fa-list"></i> <span>@lang('custom.nav.categories')</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-product-hunt"></i> <span>@lang('custom.nav.products')</span>
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
