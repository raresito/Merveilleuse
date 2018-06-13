

    <link rel="stylesheet" href="../resources/css/sidebar.css">
    <link rel="stylesheet" href="../resources/css/Sidebar-Menu.css">
    <link href="../resources/css/merveilleuseSideBar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="../resources/js/merveilleuseSideBar.js"></script>

    <nav id="sidebar" class="toggle">
        <div class="sidebar-header">
            <img id="sidebarBrand" class="toggle" src="../resources/res/logo.jpg" style="">
            <strong>M</strong>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="dashboard.php">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="products.php">
                    <i class="fas fa-briefcase"></i>
                    Products
                </a>
            </li>
            <li>
                <a href="usersPanel.php">
                    <i class="fas fa-users"></i>
                    Users
                </a>
            </li>
            <li>
                <a href="gallery.php">
                    <i class="fas fa-image"></i>
                    Gallery
                </a>
            </li>
            <li>
                <a href="orders.php">
                    <i class="fas fa-tasks"></i>
                    Orders
                </a>
            </li>
            <li>
                <a href="stocks.php">
                    <i class="fas fa-boxes"></i>
                    Stocks
                </a>
            </li>
            <li>
                <form id="leave" method="post" action="adminLogin.php">
                    <input type="hidden" name="logoutVariable" value="true">
                    <a onclick="document.getElementById('leave').submit()">
                        <i class="fas fa-user-times"></i>
                        Logout
                    </a>
                </form>
            </li>

        </ul>

    </nav>
