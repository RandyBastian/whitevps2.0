<!--DOCTYPE html -->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OpenVPN Premium & Unlimited, One Account for All Servers">
    <meta name="author" content="white-vps.com">
    <meta name="robots" content="index,follow">
    <meta name="copyright" content="White-VPS">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="keywords" content="vpn, vpn premium, what is a virtual private network, private vpn service, what is virtual private network, vpn programs, setting up a vpn, set up a vpn, free vpn services, vpn proxy service, what is a vpn connection, how to setup a vpn, vpn proxy server, how vpn works, fastest vpn, free us vpn, vpn program, free vpn servers, best vpn software, free online vpn, how to setup a vpn server, free vpn server software, types of vpn, web based vpn, free uk vpn, freevpn, how to get a vpn, free vpn connection, open source vpn, how a vpn works, what is vpn connection, top vpn services, how to create a vpn, best free vpn service, high speed vpn, what is a vpn server, fastest vpn service, how to create a vpn server, witopia vpn, vpn server software, create a vpn, best vpn router, linux vpn server, paid vpn, best vpn provider, uk vpn free, free vpn uk, what is the best vpn, setting up a vpn server, top 10 vpn, open source vpn server, how to create vpn, ipv6 vpn, best ssh client, vpn tool, vpntunnel, us vpn free, vpn for ubuntu, how to setup a vpn connection, what is vpn network, vpn strong, vpn france, best vpn client, best private vpn, openvpn service, vpn server ubuntu,free vpn,VPN US, VPN Europe, VPN Indonesia, VPN murah, VPN tidak terbatas, vpn unlimited, VPN terbaik">
    <title><?php echo $title;?> | White-VPS</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/frontend/images/icon.jpg">

     <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700italic,700,600italic,600,400italic,300italic,300|Roboto:100,300,400,500,700&amp;subset=latin,latin-ext' type='text/css' />
    
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- ######### CSS STYLES ######### -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/reset.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/style.css" type="text/css" />
    
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/font-awesome/css/font-awesome.min.css">
    
    <!-- responsive devices styles -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>assets/frontend/css/responsive-leyouts.css" type="text/css" />    
    <!-- style switcher -->
    <link rel = "stylesheet" media = "screen" href = "<?php echo base_url();?>assets/frontend/js/style-switcher/color-switcher.css" />
    
    <!-- sticky menu -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/js/sticky-menu/core.css">
    
    <!-- REVOLUTION SLIDER -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/js/revolutionslider/css/fullwidth.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/js/revolutionslider/rs-plugin/css/settings.css" media="screen" />
    
    <!-- jquery jcarousel -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/js/jcarousel/skin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/js/jcarousel/skin2.css" />
    
    <!-- faqs -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/js/accordion/accordion.css" type="text/css" media="all">
    
    <!-- tabs css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/js/tabs/tabs.css" />
    
    <!-- testimonials -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/js/testimonials/fadeeffect.css" type="text/css" media="all">
    
</head>

<body>

<div class="site_wrapper">
   

<!-- HEADER -->
<header id="header">
<div class="main_header">

    <!-- Top header bar -->
    <div id="topHeader">
    
    <div class="wrapper">
         
        <div class="top_contact_info">
        
        <div class="container">
        
            <div class="date_wrap">
            <script type="text/javascript">
            var mydate=new Date()
            var year=mydate.getYear()
            if (year < 1000)
            year+=1900
            var day=mydate.getDay()
            var month=mydate.getMonth()
            var daym=mydate.getDate()
            if (daym<10)
            daym="0"+daym
            var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
            document.write("<b class='date'>"+montharray[month]+" "+daym+", "+year+"</b>")
            </script>
            </div><!-- end date -->
            <ul class="tci_list">
                <li class="empty"><a href="mailto:admin@white-vps.com"><i class="fa fa-envelope"></i> admin@white-vps.com</a></li>
                <li class="empty"><i class="fa fa-whatsapp"></i> 0877-3309-2188</li>
                <li class="empty two"><a href="<?php echo site_url("login");?>">Login</a> |</li>
                <li class="empty two"><a href="<?php echo site_url("register");?>">Register</a> |</li>
                <li class="empty two"><a href="<?php echo site_url("contact");?>">Contact</a></li>
                <li class="space"></li>
                <li><a href="https://www.facebook.com/openvpnpremiumwhitevps/" rel='no-follow'><i class="fa fa-facebook"></i></a></li>
                <li></li>                 
            </ul>
            
        </div>
    </div><!-- end top contact info -->  
    </div>
    </div>
    <!-- Top header bar -->
    <div id="trueHeader">
    <div class="wrapper">
     <div class="container">
        <!-- Logo -->
        <div class="one_fourth"><a href="<?php echo site_url();?>" id="logo"></a></div>
        <!-- Menu -->
        <div class="three_fourth last">
           <nav id="access" class="access" role="navigation">
            <div id="menu" class="menu">
                <ul id="tiny">
                    <li><a href="<?php echo base_url();?>" class="<?php if($navigation == 'home') echo 'active';?>">Home</a></li>
                    <li><a href="<?php echo site_url("announcement");?>" class="<?php if($navigation == 'announcement') echo 'active';?>">Announcements</a></li>
                    <li><a href="<?php echo site_url("order");?>" class="<?php if($navigation == 'order') echo 'active';?>">Plans & Pricing</a></li>
                    <li><a href="<?php echo site_url("server");?>" class="<?php if($navigation == 'server') echo 'active';?>">Server Information</a></li>
                    <li><a href="<?php echo site_url("knowledge");?>" class="<?php if($navigation == 'knowledge') echo 'active';?>">Knowledge</a></li>
                    <li><a href="<?php echo site_url("payment");?>" class="<?php if($navigation == 'payment') echo 'active';?>">Payment</a></li>
                    <li><a href="<?php echo site_url("contact"); ?>" class="<?php if($navigation == 'contact') echo 'active';?>">Contact</a></li>
                </ul>
            </div>
        </nav><!-- end nav menu -->
        </div>
        </div>
    </div>
    </div>
</div>
</header><!-- end header -->
<div class="clearfix"></div>