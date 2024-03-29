<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo "$title";?>">
    <meta name="author" content="Randy Bastian">
    <title><?php echo "$title";?> | WHITE-VPS.COM</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('administrator');?>">WHITE-VPS.COM</a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <li><a href="<?php echo site_url("login/signout");?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?php echo site_url('administrator');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo site_url('administrator/account');?>"><i class="fa fa-users fa-fw"></i> Accounts List</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-book fa-fw"></i> Announcement <span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('administrator/announcement_create');?>">Create Announcement</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('administrator/announcement');?>">Announcement List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-tasks fa-fw"></i> Products <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('administrator/product_create');?>">Create Produk</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('administrator/product');?>">Products List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url('administrator/server');?>"><i class="fa fa-tasks fa-fw"></i> Servers <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('administrator/server_create');?>">Create Server</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('administrator/server');?>">Servers List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url('administrator/transaction');?>"><i class="fa fa-line-chart fa-fw"></i> Transaction</a>
                </li>
                <li>
                    <a href="<?php echo site_url('administrator/user');?>"><i class="fa fa-user-md fa-fw"></i> Users <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('administrator/user_create');?>">Create New</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('administrator/user');?>">Users List</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo "$title"; ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>