<nav class="navbar navbar navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $i['title']; ?> - ADMIN PANEL</a>
                <ul class="user-menu">
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i> <?php echo $in['username']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../">Return to site</a></li>
                            <li><a href="../logout.php">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
                            
        </div><!-- /.container-fluid -->
    </nav>
        
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

    <ul class="nav menu">
        
        <li <?php if ($pagename=="home") {
    echo 'class="active"';
}?>>
            <a href="index.php"> <i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
        </li>
        <li <?php if ($pagename=="manage_games") {
    echo 'class="active"';
}?>>
            <a href="manage_games.php"><i class="fa fa-gamepad" aria-hidden="true"></i> Games</a>
        </li>
        <li <?php if ($pagename=="manage_categories") {
    echo 'class="active"';
}?>>
            <a href="manage_categories.php"><i class="fa fa-folder" aria-hidden="true"></i> Categories</a>
        </li>
        <li <?php if ($pagename=="manage_pages") {
    echo 'class="active"';
}?>>
            <a href="manage_pages.php"><i class="fa fa-folder" aria-hidden="true"></i> Pages</a>
        </li>
        <li <?php if ($pagename=="manage_menus") {
    echo 'class="active"';
}?>>
            <a href="manage_menus.php"><i class="fa fa-folder" aria-hidden="true"></i> Menus</a>
        </li>
        <li <?php if ($pagename=="manage_users") {
    echo 'class="active"';
}?>>
            <a href="manage_users.php"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
        </li>
        <hr>
            
        <li <?php if ($pagename=="activitylog") {
    echo 'class="active"';
}?>>
            <a href="activitylog.php"><i class="fa fa-list" aria-hidden="true"></i> Activity log</a>
        </li>
        <li <?php if ($pagename=="site_settings") {
    echo 'class="active"';
}?>>
            <a href="site_settings.php"><i class="fa fa-cog" aria-hidden="true"></i> Site settings</a>
        </li>
        
        
        
    </ul>
    <div style="background:#0f1115;position: fixed;bottom: 0;width: 100%;padding:5px;font-size:9pt;" <?php if ($pagename=="site_settings") {
    echo 'class="active"';
}?>>
    <?php echo $i['title'];?> &copy; 2017. All rights reserved
        <a href="../"><span style="color:#57595e;float:right;">Return to homepage ></span></a>
    </div>

    </div><!--/.sidebar-->