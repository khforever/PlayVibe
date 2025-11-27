 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

<li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
    {{-- category --}}
        <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{ route('categories.index') }}" data-i18n="nav.dash.ecommerce">Category</a>
            </li>
            <li><a class="menu-item" href="{{ route('categories.create') }}" data-i18n="nav.dash.crypto">addCategory</a>
            </li>

        </ul>

    {{--subcategory  --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('subcategory.index')}}" data-i18n="nav.dash.ecommerce">sub Category</a>
            </li>
            <li><a class="menu-item" href="{{route('subcategory.create')}}" data-i18n="nav.dash.crypto">addsubCategory</a>
            </li>

        </ul>
    {{--Product Size  --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('sizes.index')}}" data-i18n="nav.dash.ecommerce">Sizes</a>
            </li>
            <li><a class="menu-item" href="{{route('sizes.create')}}" data-i18n="nav.dash.crypto">Add Size</a>
            </li>

        </ul>
    {{--Product color  --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('colors.index')}}" data-i18n="nav.dash.ecommerce">Colors</a>
            </li>
            <li><a class="menu-item" href="{{route('colors.create')}}" data-i18n="nav.dash.crypto">Add Color</a>
            </li>

        </ul>
    {{--Product   --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('products.index')}}" data-i18n="nav.dash.ecommerce">Products</a>
            </li>
            <li><a class="menu-item" href="{{route('products.create')}}" data-i18n="nav.dash.crypto">Add Product</a>
            </li>

        </ul>





  {{--Users   --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('users.index')}}" data-i18n="nav.dash.ecommerce">Users</a>
            </li>
            <li><a class="menu-item" href="{{route('users.create')}}" data-i18n="nav.dash.crypto">Add User</a>
            </li>

        </ul>

  {{--Carts   --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('cart.index')}}" data-i18n="nav.dash.ecommerce">Cart</a>
            </li>


        </ul>
        <div class="pt-2"></div>
  {{--orders   --}}
         <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('orders.index')}}" data-i18n="nav.dash.ecommerce">Orders</a>
            </li>


        </ul>















 </li>




























      </ul>
    </div>
  </div>
