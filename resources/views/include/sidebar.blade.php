<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Library!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('/asset/images/user.png')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Admin</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Home </a>
                    </li>
                    <li><a><i class="fa fa-book"></i> Books <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('book.index')}}">All Books</a></li>
                            <li><a href="{{route('set.book.show')}}">Add Set Book</a></li>
                            <li><a href="{{route('book.create')}}">Add Single Book</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-graduation-cap"></i> Jamaat <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('jamaat.index')}}">All jamaat</a></li>
                            <li><a href="{{route('jamaat.create')}}">Add New</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-group"></i> Member <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('member.index')}}">All Member</a></li>
                            <li><a href="{{route('member.create')}}">Add Member</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cubes"></i> Book Self <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('book-self.index')}}">Book Self List</a></li>
                            <li><a href="{{route('book-self.create')}}">Add Book Self</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-language"></i> Language <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('language.index')}}">All Language</a></li>
                            <li><a href="{{route('language.create')}}">Add Language</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pencil"></i> Author <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('author.index')}}">All Author</a></li>
                            <li><a href="{{route('author.create')}}">Add Author</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-clone"></i> Subject <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('subject.index')}}">All Subject</a></li>
                            <li><a href="{{route('subject.create')}}">Add Subject</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit()">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <form action="{{route('logout')}}" method="post" id="logoutForm">
                @csrf
            </form>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
