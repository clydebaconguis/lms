<ul class="nav-main">
    <div class="content content-full text-center">
        <div class="my-3">
            <img class="img-avatar img-avatar-thumb"
            src="{{ $isvalid }}"
            alt="profile" style="object-fit: cover; height:100px; width: 100px;">
        
        </div>
        <h1 class="h5 text-white mb-0">{{ strtoupper(auth()->user()->name) }}</h1>
        <span
            class="text-white-75">{{ DB::table('usertype')->where('id', auth()->user()->type)->value('utype') }}</span>
    </div>

    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/home') ? ' active' : '' }} || {{ request()->is('/') ? ' active' : '' }} || {{request()->is('home') ? ' active' : '' }}"
            href="/admin/home">
            <i class="nav-main-link-icon si si-home"></i>
            <span class="nav-main-link-name">Home</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('view/profile') ? ' active' : '' }}"
            href="/view/profile">
            <i class="nav-main-link-icon far fa-user"></i>
            <span class="nav-main-link-name">Profile</span>
        </a>
    </li>

    <li class="nav-main-heading">Books</li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/masterlist') ? ' active' : '' }}"
            href="/admin/masterlist">
            <i class="nav-main-link-icon si si-book-open"></i>
            <span class="nav-main-link-name">Masterlist</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('cataloging') ? ' active' : '' }}"
            href="/cataloging">
            <i class="nav-main-link-icon si si-puzzle"></i>
            <span class="nav-main-link-name">Cataloging</span>
        </a>
    </li>

    <li class="nav-main-heading">General Setup</li>
    @if (auth()->user()->type == 5)
        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is('admin/setup/libraries') ? ' active' : '' }}"
                href="/admin/setup/libraries?action=lib">
                <i class="nav-main-link-icon si si-wrench"></i> 
                <span class="nav-main-link-name">Library Setup</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is('admin/setup/category') ? ' active' : '' }}"
                href="/admin/setup/category?action=cat">
                <i class="nav-main-link-icon si si-settings"></i>  
                <span class="nav-main-link-name">Category Setup</span>
            </a>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link{{ request()->is('admin/setup/genre') ? ' active' : '' }}"
                href="/admin/setup/genre?action=genre">
                <i class="nav-main-link-icon si si-settings"></i>
                <span class="nav-main-link-name">Genre Setup</span>
            </a>
        </li>
    @endif
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/setup/borrower') ? ' active' : '' }}"
            href="/admin/setup/borrower?action=borrower">
            <i class="nav-main-link-icon si si-wrench"></i>  
            <span class="nav-main-link-name">Borrower Setup</span>
        </a>
    </li>
    
    <li class="nav-main-heading">Circulations</li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/circulation/issued') ? ' active' : '' }}"
            href="/admin/circulation/issued?action=1">
            <i class="nav-main-link-icon fa fa-book-reader"></i>
            <span class="nav-main-link-name">Issued Book(s)</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/circulation/borrowed') ? ' active' : '' }}"
            href="/admin/circulation/borrowed?action=2">
            <i class="nav-main-link-icon fa fa-book-reader"></i>
            <span class="nav-main-link-name">Borrowed Book(s)</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/circulation/returned') ? ' active' : '' }}"
            href="/admin/circulation/returned?action=3">
            <i class="nav-main-link-icon far fa-calendar-check"></i>
            <span class="nav-main-link-name">Returned Books(s)</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/circulation/lost') ? ' active' : '' }}"
            href="/admin/circulation/lost?action=4">
            <i class="nav-main-link-icon fa fa-book-dead"></i>
            <span class="nav-main-link-name">Lost Books(s)</span>
        </a>
    </li>

    <li class="nav-main-heading">Procurements</li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/procurements/store') ? ' active' : '' }}"
            href="/admin/procurements/store?action=store">
            <i class="nav-main-link-icon fa fa-store-alt"></i>
            <span class="nav-main-link-name">Supplier</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/procurements/purchase') ? ' active' : '' }}"
            href="/admin/procurements/purchase?action=purchase">
            <i class="nav-main-link-icon fab fa-shopify"></i>
            <span class="nav-main-link-name">Purchases</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/procurements/donation') ? ' active' : '' }}"
            href="/admin/procurements/donation?action=donation">
            <i class="nav-main-link-icon fa fa-gift"></i>
            <span class="nav-main-link-name">Donation</span>
        </a>
    </li>
    
    <li class="nav-main-heading">Reports</li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/report/circulation') ? ' active' : '' }}"
            href="/admin/report/circulation?action=circulation">
            <i class="nav-main-link-icon si si-bar-chart"></i>
            <span class="nav-main-link-name">Circulation Report</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/report/borrower') ? ' active' : '' }}"
            href="/admin/report/borrower?action=borrower">
             <i class="nav-main-link-icon si si-bar-chart"></i>
            <span class="nav-main-link-name">Borrower Report</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/report/hardreference') ? ' active' : '' }}"
            href="/admin/report/hardreference?action=hardref">
             <i class="nav-main-link-icon si si-bar-chart"></i>
            <span class="nav-main-link-name">Hard Reference Report</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/report/e-reference') ? ' active' : '' }}"
            href="/admin/report/e-reference?action=eref">
             <i class="nav-main-link-icon si si-bar-chart"></i>
            <span class="nav-main-link-name">E-Reference Report</span>
        </a>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/report/overdue') ? ' active' : '' }}"
            href="/admin/report/overdue?action=overdue">
             <i class="nav-main-link-icon si si-bar-chart"></i>
            <span class="nav-main-link-name">Overdues Report</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('admin/report/miscellaneous') ? ' active' : '' }}"
            href="/admin/report/miscellaneous?action=miscellaneous">
             <i class="nav-main-link-icon si si-bar-chart"></i>
            <span class="nav-main-link-name">Miscellaneous Report</span>
        </a>
    </li>

</ul>