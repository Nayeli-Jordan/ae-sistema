<?php

// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////


add_action('init', function(){

	// Colaboradores
	$labels = array(
		'name'          => 'Colaboradores',
		'singular_name' => 'Colaboradores',
		'add_new'       => 'Nuevo colaborador',
		'add_new_item'  => 'Nuevo colaborador',
		'edit_item'     => 'Editar colaborador',
		'new_item'      => 'Nuevo colaborador',
		'all_items'     => 'Todo',
		'view_item'     => 'Ver colaborador',
		'search_items'  => 'Buscar colaborador',
		'not_found'     => 'No hay colaborador.',
		'menu_name'     => 'Colaboradores'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'colaborador' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-admin-users'
	);
	register_post_type( 'colaborador', $args );	


	// Razón social
	$labels = array(
		'name'          => 'Razón social',
		'singular_name' => 'Razón social',
		'add_new'       => 'Nueva razón social',
		'add_new_item'  => 'Nueva razón social',
		'edit_item'     => 'Editar razón social',
		'new_item'      => 'Nueva razón social',
		'all_items'     => 'Todo',
		'view_item'     => 'Ver razón social',
		'search_items'  => 'Buscar razón social',
		'not_found'     => 'No hay razón social.',
		'menu_name'     => 'Razón social'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'rsocial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-building'
	);
	register_post_type( 'rsocial', $args );	


	// Formatos generales
	$labels = array(
		'name'          => 'Formatos generales',
		'singular_name' => 'Formatos generales',
		'add_new'       => 'Nuevo formato',
		'add_new_item'  => 'Nuevo formato',
		'edit_item'     => 'Editar formato',
		'new_item'      => 'Nuevo formato',
		'all_items'     => 'Todo',
		'view_item'     => 'Ver formato',
		'search_items'  => 'Buscar formato',
		'not_found'     => 'No hay formato.',
		'menu_name'     => 'Formatos generales'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'formato' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'supports'           => array( 'title', 'thumbnail' ),
		'menu_icon' 		 => 'dashicons-media-text'
	);
	register_post_type( 'formato', $args );	

});