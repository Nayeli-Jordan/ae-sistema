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

});