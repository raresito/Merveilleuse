<html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <!--<link href="css/sidebarStyle.css" rel="stylesheet">-->
        <link href="css/merveilleuseSideBar.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.2.4.min.js"></script>

    </head>
    <body>
        <nav class="navbar navbar-inverse"> <!-- DEFAULT BOOTSTRAP NAVBAR -->
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Merveilleuse</a>

                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Page 1</a></li>
                </ul>
            </div>
        </nav>



        <div class="content">
            <div class="side-bar">
                <div class="brand" >
                    Merveilleuse
                    <div class = "toggle-button">
                        <img src="res/menu_icon.png" alt="Mountain View">
                    </div>
                </div>
                <div class="menu-list">
                    <ul class="menu-content">
                        <li>
                            <a href="#">
                                <i class="fa fa-dashboard fa-lg"></i> Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        </div>
        <!--
        <div class="nav-side-menu">
            <div class="brand">Brand Logo</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list">

                <ul id="menu-content" class="menu-content collapse out">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard fa-lg"></i> Dashboard
                        </a>
                    </li>

                    <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                        <a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="products">
                        <li class="active"><a href="#">CSS3 Animation</a></li>
                        <li><a href="#">General</a></li>
                        <li><a href="#">Buttons</a></li>
                        <li><a href="#">Tabs & Accordions</a></li>
                        <li><a href="#">Typography</a></li>
                        <li><a href="#">FontAwesome</a></li>
                        <li><a href="#">Slider</a></li>
                        <li><a href="#">Panels</a></li>
                        <li><a href="#">Widgets</a></li>
                        <li><a href="#">Bootstrap Model</a></li>
                    </ul>


                    <li data-toggle="collapse" data-target="#service" class="collapsed">
                        <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="service">
                        <li>New Service 1</li>
                        <li>New Service 2</li>
                        <li>New Service 3</li>
                    </ul>


                    <li data-toggle="collapse" data-target="#new" class="collapsed">
                        <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="new">
                        <li>New New 1</li>
                        <li>New New 2</li>
                        <li>New New 3</li>
                    </ul>


                    <li>
                        <a href="#">
                            <i class="fa fa-user fa-lg"></i> Profile
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="fa fa-users fa-lg"></i> Users
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>