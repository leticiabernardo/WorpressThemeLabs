<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php bloginfo('name'); ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="Labs - Design Studio">
    <meta name="keywords" content="lab, onepage, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="<?php bloginfo('template_url');?>/img/favicon.ico" rel="shortcut icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,700|Roboto:300,400,700" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/flaticon.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/magnific-popup.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/owl.carousel.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/style.css"/>

    <?php //wp_head(); ?>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body <?php body_class(); ?>>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader">
        <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
        <h2>Carregando...</h2>
    </div>
</div>


<!-- Header section -->
<header class="header-section">
    <div class="logo">
        <a href="/">
            <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
        </a>
    </div>
    <!-- Navigation -->
    <div class="responsive"><i class="fa fa-bars"></i></div>
    <nav>
        <ul class="menu-list">
            <?php
            wp_nav_menu(
                    array('theme_location' => 'header-menu')
            ); ?>
        </ul>
    </nav>
</header>
<!-- Header section end -->
