<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <img src="{{ url('images/site/cropped-sv_00-32x32.png') }}" alt="smartville logo">
                {{ $app->company->title }}
            </div>
        </div>
        <nav class="menu">
            <ul class="nav metismenu" id="sidebar-menu">
                <li class="{{ ActivePage('hostel.dashboard') }}">
                    <a href="{{ route('hostel.dashboard', ['id' => $app->id]) }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a></li>
                <li><a href="">
                        <i class="fa fa-laptop"></i> Profile
                    </a></li>
                <li><a href="">
                        <i class="fa fa-cogs"></i> Settings
                    </a></li>
                <li><a href="">
                        <i class="fa fa-th-large"></i> Amenities Manager
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('hostel.amenity.create', ['id' => $app->id]) }}">
                                Add New Amenity
                            </a></li>
                        <li><a href="{{ route('hostel.amenity.index', ['id' => $app->id]) }}">
                                View All
                            </a></li>
                    </ul>
                </li>
                <li class="{{ ActivePage('hostel.property.index') }}{{ ActivePage('hostel.property.create') }}"><a href="">
                        <i class="fa fa-building"></i> Properties Manager
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('hostel.property.create', ['id' => $app->id]) }}">
                                Add New Property
                            </a></li>
                        <li><a href="{{ route('hostel.property.index', ['id' => $app->id]) }}">
                                View All
                            </a></li>
                    </ul>
                </li>
                <li><a href="">
                        <i class="fa fa-users"></i> Tenants Manager
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('hostel.tenant.create', ['id' => $app->id]) }}">
                                Add New Tenants
                            </a></li>
                        <li><a href="{{ route('hostel.tenant.index', ['id' => $app->id]) }}">
                                View All
                            </a></li>
                    </ul>
                </li>
                <li><a href="">
                        <i class="fa fa-credit-card"></i> Bills Manager
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li><a href="">
                                Pending
                            </a></li>
                        <li><a href="">
                                Paid
                            </a></li>
                        <li><a href="">
                                Drafts
                            </a></li>
                        <li><a href="">
                                Trashed
                            </a></li>
                        <li><a href="">
                                View All
                            </a></li>
                    </ul>
                </li>
                <li><a href="">
                        <i class="fa fa-credit-card-alt"></i> Rent Manager
                        <i class="fa arrow"></i>
                    </a>
                    <ul>
                        <li><a href="">
                                Pending
                            </a></li>
                        <li><a href="">
                                Paid
                            </a></li>
                        <li><a href="">
                                Drafts
                            </a></li>
                        <li><a href="">
                                Trashed
                            </a></li>
                        <li><a href="">
                                View All
                            </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <footer class="sidebar-footer">
        <ul class="nav metismenu" id="customize-menu">
            <li>
                <ul>
                    <li class="customize">
                        <div class="customize-item">
                            <div class="row customize-header">
                                <div class="col-4"></div>
                                <div class="col-4"><label class="title">fixed</label></div>
                                <div class="col-4"><label class="title">static</label></div>
                            </div>
                            <div class="row hidden-md-down">
                                <div class="col-4"><label class="title">Sidebar:</label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="sidebarPosition"
                                               value="sidebar-fixed">
                                        <span></span>
                                    </label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                        <span></span>
                                    </label></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label class="title">Header:</label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="headerPosition"
                                               value="header-fixed">
                                        <span></span>
                                    </label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="headerPosition" value="">
                                        <span></span>
                                    </label></div>
                            </div>
                            <div class="row">
                                <div class="col-4"><label class="title">Footer:</label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="footerPosition"
                                               value="footer-fixed">
                                        <span></span>
                                    </label></div>
                                <div class="col-4"><label>
                                        <input class="radio" type="radio" name="footerPosition" value="">
                                        <span></span>
                                    </label></div>
                            </div>
                        </div>
                        <div class="customize-item">
                            <ul class="customize-colors">
                                <li><span class="color-item color-red" data-theme="red"></span></li>
                                <li><span class="color-item color-orange" data-theme="orange"></span></li>
                                <li><span class="color-item color-green active" data-theme=""></span></li>
                                <li><span class="color-item color-seagreen" data-theme="seagreen"></span></li>
                                <li><span class="color-item color-blue" data-theme="blue"></span></li>
                                <li><span class="color-item color-purple" data-theme="purple"></span></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <a href="">
                    <i class="fa fa-cog"></i> Customize
                </a></li>
        </ul>
    </footer>
</aside>
