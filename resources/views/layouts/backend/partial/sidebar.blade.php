<aside id="leftsidebar" class="sidebar">
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="material-icons">category</i>
                    <span>Categories</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li class="{{ Request::is('admin/categories/category') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}" class=" waves-effect waves-block">Category</a>
                    </li>
                    <li class="{{ Request::is('admin/categories/subcategory') ? 'active' : '' }}">
                        <a href="{{ route('admin.subcategory.index') }}" class=" waves-effect waves-block">Sub-Category</a>
                    </li>
                    <li class="{{ Request::is('admin/categories/brand') ? 'active' : '' }}">
                        <a href="{{ route('admin.brand.index') }}" class=" waves-effect waves-block">Brand</a>
                    </li>
                </ul>
            </li>
             <li class="{{ Request::is('admin/coupon') ? 'active' : '' }}">
                <a href="{{ route('admin.coupon.index') }}">
                    <i class="material-icons">money</i>
                    <span>Coupons</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}">
                      <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
            </li> 
            
            
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif
        </ul>
    </div>
</aside>