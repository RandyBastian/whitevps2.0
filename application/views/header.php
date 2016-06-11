<!--DOCTYPE html -->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OpenVPN Premium & Unlimited, One Account for All Servers. Pertama di Indonesia !!">
    <meta name="author" content="white-vps.com">
    <meta name="robots" content="index,follow">
    <meta name="copyright" content="White-VPS">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="alexaVerifyID" content="8GIwmn7DRgUeWZuINl9D3VxrECQ"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo site_url();?>assets/front/img/openvpn.png">
    <meta property="fb:admins" content="100002680752716" />
    <meta name="keywords" content="vpn, vpn premium, what is a virtual private network, private vpn service, what is virtual private network, vpn programs, setting up a vpn, set up a vpn, free vpn services, vpn proxy service, what is a vpn connection, how to setup a vpn, vpn proxy server, how vpn works, fastest vpn, free us vpn, vpn program, free vpn servers, best vpn software, free online vpn, how to setup a vpn server, free vpn server software, types of vpn, web based vpn, free uk vpn, freevpn, how to get a vpn, free vpn connection, open source vpn, how a vpn works, what is vpn connection, top vpn services, how to create a vpn, best free vpn service, high speed vpn, what is a vpn server, fastest vpn service, how to create a vpn server, witopia vpn, vpn server software, create a vpn, best vpn router, linux vpn server, paid vpn, best vpn provider, uk vpn free, free vpn uk, what is the best vpn, setting up a vpn server, top 10 vpn, open source vpn server, how to create vpn, ipv6 vpn, best ssh client, vpn tool, vpntunnel, us vpn free, vpn for ubuntu, how to setup a vpn connection, what is vpn network, vpn strong, vpn france, best vpn client, best private vpn, openvpn service, vpn server ubuntu,free vpn,VPN US, VPN Europe, VPN Indonesia, VPN murah, VPN tidak terbatas, vpn unlimited, VPN terbaik, openvpn inject, openvpn xl, openvpn indosat, openvpn telkomsel, openvpn isat, openvpn axis, openvpn im3">
    <title><?php echo $title;?> | White-VPS</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/front/img/icon.jpg">

    <!-- All Theme Styles including Bootstrap, FontAwesome, etc. compiled from styles.scss-->
    <link href="<?php echo site_url();?>assets/front/css/styles.min.css" rel="stylesheet" media="screen">

    <!--Modernizr / Detectizr-->
    <script src="<?php echo site_url();?>assets/front/js/vendor/modernizr.custom.js"></script>
    <script src="<?php echo site_url();?>assets/front/js/vendor/detectizr.min.js"></script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '613162992183045');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=613162992183045&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>
<body class="is-preloader preloading parallax">

  <div id="preloader" data-spinner="spinner1" data-screenbg="#fff"></div>

  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <!-- Navbar -->
    <!-- Add class ".navbar-sticky" to make navbar stuck when it hits the top of the page. Another modifier class is: "navbar-fullwidth" to stretch navbar and make it occupy 100% of the page width. The screen width at which navbar collapses can be controlled through the variable "$nav-collapse" in sass/variables.scss -->
    <header class="navbar navbar-sticky navbar-fullwidth">

      <!-- Toolbar -->
      <div class="topbar">
        <div class="container">
          <a href="<?php echo site_url(); ?>" class="site-logo">
            <img src="<?php echo site_url(); ?>assets/front/img/logo_2.png" alt="Logo" title="Logo White-VPS">
          </a><!-- .site-logo -->

          <!-- Mobile Menu Toggle -->
          <div class="nav-toggle"><span></span></div>

          <div class="toolbar">
            <a href="<?php echo site_url("register"); ?>" class="text-sm">Sign up</a>
            <a href="<?php echo site_url("login");?>" class="btn btn-sm btn-default btn-icon-right waves-effect waves-light">Log In <i class="icon-head"></i></a>
            <!-- <a href="shopping-cart.html" class="cart-btn"><i class="icon-bag"></i></a> -->
          </div><!-- .toolbar -->
        </div><!-- .container -->
      </div><!-- .topbar -->

      <!-- Main Navigation -->
      <div class="container">
        <nav class="main-navigation">
          <ul class="menu">
            <li class="<?php if(!empty($navigation)){if($navigation == "home") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url();?>"> <i class="fa fa-home"></i> Home</a>
            </li>
            <li class="<?php if(!empty($navigation)){if($navigation == "announcement") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url("announcement"); ?>"><i class="flaticon-wireless-internet6"></i> Announcement</a>
            </li>
            <li class="<?php if(!empty($navigation)){if($navigation == "order") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url("order"); ?>"> <i class="flaticon-drawing33"></i>Plans & Pricing</a>
            </li>
            <li class="<?php if(!empty($navigation)){if($navigation == "server") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url("server");?>"><i class="flaticon-technology46"></i> Server Information</a>
            </li>
            <li class="menu-item-has-children">
              <a href="<?php echo site_url();?>blog"><i class="fa fa-book"></i> Blog</a>
            </li>
            <li class="<?php if(!empty($navigation)){if($navigation == "payment") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url("payment");?>"><i class="fa fa-credit-card"></i> Payment Method</a>
            </li>
            <li class="<?php if(!empty($navigation)){if($navigation == "trik") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url("trik-tools");?>"><i class="fa fa-codepen"></i> Trik & Tools</a>
            </li>
            <li class="<?php if(!empty($navigation)){if($navigation == "contact") echo "current-menu-item";}?> menu-item-has-children">
              <a href="<?php echo site_url("contact");?>"> <i class="flaticon-chatting"></i> Contact</a>
            </li>
          </ul><!-- .menu -->
        </nav><!-- .main-navigation -->
      </div><!-- .container -->
    </header><!-- .navbar -->