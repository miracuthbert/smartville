<nav data-spy="affix" data-offset-top="70" class="navbar navbar-default navbar-static-top" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('getEstateDashboard') }}">SmartVille</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><span class="hidden-xs glyphicon glyphicon-envelope"></span> Messages <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">New</a></li>
                        <li><a href="#">Archived</a></li>
                        <li><a href="#">All </a></li>

                    </ul>
                </li>
                <li><a href="../notifications.html"><span class="hidden-xs glyphicon glyphicon-bell"></span>
                        Notifications</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="{{ route('getEstateDashboard') }}" title="my dashboard"><span
                                class="hidden-xs glyphicon glyphicon-dashboard"></span> <span class="visible-xs">My Dashboard</span></a>
                </li>

                <li><a href="{{ route('getEstateSettings') }}" title="settings"><span class="hidden-xs glyphicon glyphicon-cog"></span>
                        <span class="visible-xs">Settings</span></a></li>

                <li><a href="{{ route('getEstateProfile') }}" title="my profile"><span class="hidden-xs glyphicon glyphicon-user"></span>
                        <span class="visible-xs">Profile</span></a></li>

                <li><a href="{{ route('logout') }}" title="my store">Logout</a></li>

            </ul>
            <!-- Search form -->
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="hidden-xs glyphicon glyphicon-search"></span>
                    <span class="visible-xs">Search</span></button>
            </form>
        </div><!--/.nav-collapse -->
    </div>
</nav>
