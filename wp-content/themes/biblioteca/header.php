<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php biblioteca_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-grid.min.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">
  <div class="container-fluid">
    <a href="/" class="logo"><img src="<?php print get_template_directory_uri(); ?>/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
    <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
    <?php wp_nav_menu( array( 'menu' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
    <a class="btn" href="https://strutture-provincia.primo.exlibrisgroup.com/discovery/search?vid=39SBT_INST:39SBT_VU1" target="_blank" rel="nofollow"><span></span>Cerca in CBT</a>
    </nav>
  </div>
</header>
<div id="container">
<main id="content" role="main">
