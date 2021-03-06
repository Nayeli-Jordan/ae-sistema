<!DOCTYPE html>
<!-- Importante agregar el prefijo para cuando dice que og no se está usando -->
<html prefix="og: http://ogp.me/ns#" lang="es">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?></title>
		<!-- Sets initial viewport load and disables zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- SEO -->
		<meta name="keywords" content="">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<!-- Meta robots -->
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow" />

		<!-- Favicon -->
		<!-- <link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="<?php echo THEMEPATH; ?>favicon/favicon-16x16.png" sizes="16x16" /> -->

		<!-- Facebook, Twitter metas -->
		<meta property="og:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo site_url(); ?>" />
		<meta property="og:image" content="<?php echo THEMEPATH; ?>images/share.png">
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
		<meta name="twitter:description" content="<?php bloginfo('description'); ?>" />
		<meta name="twitter:image" content="<?php echo THEMEPATH; ?>images/share.png" />
		<meta name="twitter:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:image:width" content="210" />
		<meta property="og:image:height" content="110" />
		<meta property="fb:app_id" content="" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@" />

		<!-- Google+ -->
		<link rel="publisher" href="https://plus.google.com/+">

		<!-- Compatibility -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta http-equiv="cleartype" content="on">

		<!-- Google font(s) -->
		<!-- <link href="https://fonts.googleapis.com/css?family=Rancho|Open+Sans:400" rel="stylesheet"> -->

		<!--Style-->
		<link type="text/css" rel="stylesheet" href="<?php echo THEMEPATH; ?>stylesheets/styles.css" media="screen,projection, print" />

		<!-- Canonical URL -->
		<link rel="canonical" href="<?php echo site_url(); ?>" />

		<!-- Sitemap Google Verify -->
		<meta name="google-site-verification" content="" />

		<!-- Noscript -->
		<noscript>Tu navegador no soporta JavaScript!</noscript>
		<?php wp_head(); ?>
	</head>
	<body>
		<header class="js-header">	
			<div class="container">
				<div class="row">
					<div class="col s12 m5 l6" id="logo-altoempleo">
						<a href="<?php echo SITEURL; ?>">
							<img class="responsive-img" src="<?php echo THEMEPATH; ?>images/identidad/logo_altoempleo.png">
						</a>
					</div>
				</div>
			</div>		
			<nav>
				<ul class="mb-nav" itemscope>
					<!-- <?php
						$menu_name = 'top_menu';

						if (( $locations = get_nav_menu_locations()) && isset( $locations[ $menu_name ])) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
							$menu_items = wp_get_nav_menu_items( $menu->term_id );
							$menu_list = '';
							foreach ( (array) $menu_items as $key => $menu_item) {

								$url 				= $menu_item->url;
								$title 				= $menu_item->title;
								$class 				= esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );

								//$menu_item_parent	= $menu_item->menu_item_parent;		id del padre
								//$id 				= $menu_item->ID;
								//$attr_title 		= $menu_item->attr_title;
								//$description		= $menu_item->description;
								//$xfn 				= $menu_item->xfn;
								//$type 			= $menu_item->type;		taxonomy, page...
								//$type_label		= $menu_item->type_label;		página, categoría...
								//$slug 			= sanitize_title( $menu_item->title );
								//$slugId				= $menu_item->post_name;

								$menu_list .='<li itemprop="actionOption" class="' . $class .'"><a href="' . $url . '">' . $title . '</a></li>';
							}
						}
						echo $menu_list;
					?>	 -->					
				</ul>
			</nav>
		</header>
		<div class="[ main-body ]">