<?php 

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_stylesheet_directory_uri() . '/js/' );
define( 'THEMEPATH', get_stylesheet_directory_uri() . '/' );
define( 'SITEURL', get_site_url() . '/' );


/*------------------------------------*\
	#SNIPPETS
\*------------------------------------*/
require_once( 'inc/pages.php' );
require_once( 'inc/post-types.php' );
/*require_once( 'inc/taxonomies.php' );*/

/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){
 
	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(''), '2.1.1', true );
	// wp_enqueue_script( 'masonry_js', JSPATH.'packery.pkgd.min.js', array(), '', true );
    wp_enqueue_script( 'aes_functions', JSPATH.'functions.js', array(), '1.0', true );
 
	wp_localize_script( 'aes_functions', 'siteUrl', SITEURL );
	wp_localize_script( 'aes_functions', 'theme_path', THEMEPATH );
	
	// $is_home = is_front_page() ? "1" : "0";
	// wp_localize_script( 'rcc_functions', 'isHome', $is_home );
 
});

/**
* Configuraciones WP
*/

// Agregar css y js al administrador
function load_custom_files_wp_admin() {
        wp_register_style( 'aes_admin_css', THEMEPATH . '/admin/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'aes_admin_css' );

        wp_register_script( 'aes_admin_js', THEMEPATH . 'admin/admin-script.js', false, '1.0.0' );
        wp_enqueue_script( 'aes_admin_js' );        
}
add_action( 'admin_enqueue_scripts', 'load_custom_files_wp_admin' );

//Habilitar thumbnail en post
add_theme_support( 'post-thumbnails' ); 

//Habilitar menú (aparece en personalizar)
add_action('after_setup_theme', 'add_top_menu');
function add_top_menu(){
	register_nav_menu('top_menu',__('Top menu'));
}

//Delimitar número palabras excerpt
/*function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );*/


/**
* Optimización
*/

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


/**
* Perfiles - Permisos
*/
//Hide item admin menu for certain user profile
function qo_remove_menu_items() {
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('edit-comments.php'); // Comments
}
add_action( 'admin_menu', 'qo_remove_menu_items' );


/**
* SEO y Analitics
**/

//Código Analitics
// function add_google_analytics() {
//     echo '<script src="https://www.google-analytics.com/ga.js" type="text/javascript"></script>';
//     echo '<script type="text/javascript">';
//     echo 'var pageTracker = _gat._getTracker("UA-117075138-1");';
//     echo 'pageTracker._trackPageview();';
//     echo '</script>';
// }
// add_action('wp_footer', 'add_google_analytics');

/* Aplaza el análisis de JavaScript para una carga más rápida */
if(!is_admin()) {
    // Move all JS from header to footer
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}

/**
* SUPPORT WOOCOMMERCE
*/
/*add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}*/


/*
** Custom menu admin
*/
add_action( 'admin_menu', 'my_plugin_menu' );
 function my_plugin_menu(){
   add_menu_page('Altoempleo s.a. de c.v.', 'Altoempleo', 'manage_options',  'rs_altoempleo', 'my_menu_function', 'dashicons-buddicons-buddypress-logo', '6');
   add_submenu_page( 'rs_altoempleo', 'Custom Post Type Admin', 'Contratos', 'manage_options','edit.php?post_type=contrato_rsa');

    add_menu_page('Alto empleo de izcalli s.a. de c.v.', 'Alto empleo de izcalli', 'manage_options',  'rs_altoempleo_de_izcalli', 'my_menu_function', 'dashicons-buddicons-buddypress-logo', '7');
    add_submenu_page( 'rs_altoempleo_de_izcalli', 'Custom Post Type Admin', 'Contratos', 'manage_options','edit.php?post_type=contrato_rsa');

    add_menu_page('Altoempleo tlalnepantla s.a. de c.v.', 'Altoempleo tlalnepantla', 'manage_options',  'rs_altoempleo_tlalnepantla', 'my_menu_function', 'dashicons-buddicons-buddypress-logo', '6');
    add_submenu_page( 'rs_altoempleo_tlalnepantla', 'Custom Post Type Admin', 'Contratos', 'manage_options','edit.php?post_type=contrato_rsa'); 

    add_menu_page('High enterprises consulting s.a. de c.v.', 'High enterprises consulting', 'manage_options',  'rs_high_enterprises_consulting', 'my_menu_function', 'dashicons-buddicons-buddypress-logo', '7');
    add_submenu_page( 'rs_high_enterprises_consulting', 'Custom Post Type Admin', 'Contratos', 'manage_options','edit.php?post_type=contrato_rsa'); 

    add_menu_page('Comercializadora bolita s.a. de c.v.', 'Comercializadora bolita', 'manage_options',  'rs_comercializadora_bolita', 'my_menu_function', 'dashicons-buddicons-buddypress-logo', '8');
    add_submenu_page( 'rs_comercializadora_bolita', 'Custom Post Type Admin', 'Contratos', 'manage_options','edit.php?post_type=contrato_rsa');
 }




/**
*** CUSTOM FUNCTIONS
**/

/* Colaboradores */

add_action( 'add_meta_boxes', 'colaborador_custom_metabox' );
function colaborador_custom_metabox(){
    add_meta_box( 'colaborador_meta', 'Información del colaboradoro', 'display_colaborador_atributos', 'colaborador', 'advanced', 'default');
}

function display_colaborador_atributos( $colaborador ){
    $colnumemp 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnumemp', true ) );
    $colnombre 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnombre', true ) );
    $colapepat 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colapepat', true ) );
    $colapemat 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colapemat', true ) );
    $colrsocial = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colrsocial', true ) );
    $colcliente = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcliente', true ) );

    $colestado 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colestado', true ) );
    $coldcalle 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldcalle', true ) );
    $coldnum 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldnum', true ) );
    $coldcol 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldcol', true ) );
    $colddel 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colddel', true ) );
    $coldest 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldest', true ) );
    $coldcp 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldcp', true ) );
    $coltel 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coltel', true ) );
    $colcel 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcel', true ) );
    $collnacim 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_collnacim', true ) );
    $colcurp 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcurp', true ) );
    $colrfc 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colrfc', true ) );
    $colnss 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnss', true ) );
    $colfnacim 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colfnacim', true ) );
    $colpuesto  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colpuesto', true ) );
    $colpresta 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colpresta', true ) );
    $colubicacion  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colubicacion', true ) );
    $colingreso = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colingreso', true ) );
    $colsueldo  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colsueldo', true ) );
    $colsueldot = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colsueldot', true ) );
    $colnomina  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnomina', true ) );
    $colvence   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colvence', true ) );
    $colinicia   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colinicia', true ) );
    $coldcontrato = esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldcontrato', true ) );
    $colecivil  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colecivil', true ) );
    $colsexo    = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colsexo', true ) );
    $colinfonavit = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colinfonavit', true ) );
    $colncredinf = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colncredinf', true ) );
    $coltdesc   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_coltdesc', true ) );
    $colfonacot   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colfonacot', true ) );    
    $colncredfon = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colncredfon', true ) );
    $colpensali = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colpensali', true ) );
    $colbanco   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colbanco', true ) );
    $colncuenta = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colncuenta', true ) );
    $colclaveint = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colclaveint', true ) );
    $colnotarjeta = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnotarjeta', true ) );
    $colcorreo  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcorreo', true ) );
    $colvaldes  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colvaldes', true ) );
    $colvalcant  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colvalcant', true ) );
    $colapriv   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colapriv', true ) );
    $colpsico   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colpsico', true ) );
    $colcredencial = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcredencial', true ) );
    $colobserv  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colobserv', true ) );
?>
    <table class="aes-custum-fields" id="aes_table-colaboradores">
        <tr>
            <th><label for="colaborador_colestado" class="margin-bottom-20">Estado</label></th>
            <td class="padding-bottom-30">
				<select name="colaborador_colestado">
                    <option value="" <?php selected($colestado, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Activo" <?php selected($colestado, 'Activo'); ?>>Activo</option>
                    <option value="Inactivo" <?php selected($colestado, 'Inactivo'); ?>>Inactivo</option>
                </select>
            </td>
        </tr>

        <tr>
            <th><label for="colaborador_colnumemp">No. Empleado</label></th>
            <td><input type="number" id="colaborador_colnumemp" name="colaborador_colnumemp" value="<?php echo $colnumemp; ?>" placeholder="0"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colnombre">Nombre(s)</label></th>
            <td><input type="text" id="colaborador_colnombre" name="colaborador_colnombre" value="<?php echo $colnombre; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colapepat">Apellido paterno</label></th>
            <td><input type="text" id="colaborador_colapepat" name="colaborador_colapepat" value="<?php echo $colapepat; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colapemat" class="margin-bottom-20">Apellido materno</label></th>
            <td class="padding-bottom-30"><input type="text" id="colaborador_colapemat" name="colaborador_colapemat" value="<?php echo $colapemat; ?>"></td>
        </tr>

        <tr>
            <th><label for="colaborador_colrsocial">Razón social</label></th>
            <td>
				<select name="colaborador_colrsocial">
                    <option value="" <?php selected($colrsocial, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Altoempleo s.a. de c.v." <?php selected($colrsocial, 'Altoempleo s.a. de c.v.'); ?>>Altoempleo s.a. de c.v.</option>
                    <option value="Alto empleo de izcalli s.a. de c.v." <?php selected($colrsocial, 'Alto empleo de izcalli s.a. de c.v.'); ?>>Alto empleo de izcalli s.a. de c.v.</option>
                    <option value="Altoempleo tlalnepantla s.a. de c.v." <?php selected($colrsocial, 'Altoempleo tlalnepantla s.a. de c.v.'); ?>>Altoempleo tlalnepantla s.a. de c.v.</option>
                    <option value="High enterprises consulting s.a. de c.v." <?php selected($colrsocial, 'High enterprises consulting s.a. de c.v.'); ?>>High enterprises consulting s.a. de c.v.</option>
                    <option value="Comercializadora bolita s.a. de c.v." <?php selected($colrsocial, 'Comercializadora bolita s.a. de c.v.'); ?>>Comercializadora bolita s.a. de c.v.</option>
                </select>
            </td>
        </tr>        
        <tr>
            <th><label for="colaborador_colcliente" class="margin-bottom-20">Cliente</label></th>
            <td class="padding-bottom-30"><input type="text" id="colaborador_colcliente" name="colaborador_colcliente" value="<?php echo $colcliente; ?>" placeholder="Mazda Tláhuac"></td>
        </tr>

        <tr>
            <th><label for="colaborador_coldcalle">Calle</label></th>
            <td><input type="text" id="colaborador_coldcalle" name="colaborador_coldcalle" value="<?php echo $coldcalle; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_coldnum">Número</label></th>
            <td><input type="text" id="colaborador_coldnum" name="colaborador_coldnum" value="<?php echo $coldnum; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_coldcol">Colonia</label></th>
            <td><input type="text" id="colaborador_coldcol" name="colaborador_coldcol" value="<?php echo $coldcol; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colddel">Delegación</label></th>
            <td><input type="text" id="colaborador_colddel" name="colaborador_colddel" value="<?php echo $colddel; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_coldest">Estado</label></th>
            <td>
				<select name="colaborador_coldest">
                    <option value="" <?php selected($coldest, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Aguascalientes" <?php selected($coldest, 'Aguascalientes'); ?>>Aguascalientes</option>
                    <option value="Baja California" <?php selected($coldest, 'Baja California'); ?>>Baja California</option>
                    <option value="Baja California Sur" <?php selected($coldest, 'Baja California Sur'); ?>>Baja California Sur</option>
                    <option value="Campeche" <?php selected($coldest, 'Campeche'); ?>>Campeche</option>
                    <option value="Chiapas" <?php selected($coldest, 'Chiapas'); ?>>Chiapas</option>
                    <option value="Chihuahua" <?php selected($coldest, 'Chihuahua'); ?>>Chihuahua</option>
                    <option value="Coahuila de Zaragoza" <?php selected($coldest, 'Coahuila de Zaragoza'); ?>>Coahuila de Zaragoza</option>
                    <option value="Colima" <?php selected($coldest, 'Colima'); ?>>Colima</option>
                    <option value="Ciudad de México" <?php selected($coldest, 'Ciudad de México'); ?>>Ciudad de México</option>
                    <option value="Durango" <?php selected($coldest, 'Durango'); ?>>Durango</option>
                    <option value="Guanajuato" <?php selected($coldest, 'Guanajuato'); ?>>Guanajuato</option>
                    <option value="Guerrero" <?php selected($coldest, 'Guerrero'); ?>>Guerrero</option>
                    <option value="Hidalgo" <?php selected($coldest, 'Hidalgo'); ?>>Hidalgo</option>
                    <option value="Jalisco" <?php selected($coldest, 'Jalisco'); ?>>Jalisco</option>
                    <option value="Estado de México" <?php selected($coldest, 'Estado de México'); ?>>Estado de México</option>
                    <option value="Michoacán de Ocampo" <?php selected($coldest, 'Michoacán de Ocampo'); ?>>Michoacán de Ocampo</option>
                    <option value="Morelos" <?php selected($coldest, 'Morelos'); ?>>Morelos</option>
                    <option value="Nayarit" <?php selected($coldest, 'Nayarit'); ?>>Nayarit</option>
                    <option value="Nuevo León" <?php selected($coldest, 'Nuevo León'); ?>>Nuevo León</option>
                    <option value="Oaxaca" <?php selected($coldest, 'Oaxaca'); ?>>Oaxaca</option>
                    <option value="Puebla" <?php selected($coldest, 'Puebla'); ?>>Puebla</option>
                    <option value="Querétaro" <?php selected($coldest, 'Querétaro'); ?>>Querétaro</option>
                    <option value="Quintana Roo" <?php selected($coldest, 'Quintana Roo'); ?>>Quintana Roo</option>
                    <option value="San Luis Potosí" <?php selected($coldest, 'San Luis Potosí'); ?>>San Luis Potosí</option>
                    <option value="Sinaloa" <?php selected($coldest, 'Sinaloa'); ?>>Sinaloa</option>
                    <option value="Sonora" <?php selected($coldest, 'Sonora'); ?>>Sonora</option>
                    <option value="Tabasco" <?php selected($coldest, 'Tabasco'); ?>>Tabasco</option>
                    <option value="Tamaulipas" <?php selected($coldest, 'Tamaulipas'); ?>>Tamaulipas</option>
                    <option value="Tlaxcala" <?php selected($coldest, 'Tlaxcala'); ?>>Tlaxcala</option>
                    <option value="Veracruz de Ignacio de la Llave" <?php selected($coldest, 'Veracruz de Ignacio de la Llave'); ?>>Veracruz de Ignacio de la Llave</option>
                    <option value="Yucatán" <?php selected($coldest, 'Yucatán'); ?>>Yucatán</option>
                    <option value="Zacatecas" <?php selected($coldest, 'Zacatecas'); ?>>Zacatecas</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_coldcp" class="margin-bottom-20">C.P.</label></th>
            <td class="padding-bottom-30"><input type="number" id="colaborador_coldcp" name="colaborador_coldcp" value="<?php echo $coldcp; ?>" placeholder="11000"></td>
        </tr>

        <tr>
            <th><label for="colaborador_coltel">Teléfono casa</label></th>
            <td><input type="text" id="colaborador_coltel" name="colaborador_coltel" value="<?php echo $coltel; ?>" placeholder="55 5050 5050"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colcel" class="margin-bottom-20">Teléfono Celular</label></th>
            <td class="padding-bottom-30"><input type="text" id="colaborador_colcel" name="colaborador_colcel" value="<?php echo $colcel; ?>" placeholder="55 5050 5050"></td>
        </tr>

        <tr>
            <th><label for="colaborador_collnacim">Lugar de Nacimiento</label></th>
            <td>
				<select name="colaborador_collnacim">
                    <option value="" <?php selected($collnacim, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Aguascalientes" <?php selected($collnacim, 'Aguascalientes'); ?>>Aguascalientes</option>
                    <option value="Baja California" <?php selected($collnacim, 'Baja California'); ?>>Baja California</option>
                    <option value="Baja California Sur" <?php selected($collnacim, 'Baja California Sur'); ?>>Baja California Sur</option>
                    <option value="Campeche" <?php selected($collnacim, 'Campeche'); ?>>Campeche</option>
                    <option value="Chiapas" <?php selected($collnacim, 'Chiapas'); ?>>Chiapas</option>
                    <option value="Chihuahua" <?php selected($collnacim, 'Chihuahua'); ?>>Chihuahua</option>
                    <option value="Coahuila de Zaragoza" <?php selected($collnacim, 'Coahuila de Zaragoza'); ?>>Coahuila de Zaragoza</option>
                    <option value="Colima" <?php selected($collnacim, 'Colima'); ?>>Colima</option>
                    <option value="Ciudad de México" <?php selected($collnacim, 'Ciudad de México'); ?>>Ciudad de México</option>
                    <option value="Durango" <?php selected($collnacim, 'Durango'); ?>>Durango</option>
                    <option value="Guanajuato" <?php selected($collnacim, 'Guanajuato'); ?>>Guanajuato</option>
                    <option value="Guerrero" <?php selected($collnacim, 'Guerrero'); ?>>Guerrero</option>
                    <option value="Hidalgo" <?php selected($collnacim, 'Hidalgo'); ?>>Hidalgo</option>
                    <option value="Jalisco" <?php selected($collnacim, 'Jalisco'); ?>>Jalisco</option>
                    <option value="Estado de México" <?php selected($collnacim, 'Estado de México'); ?>>Estado de México</option>
                    <option value="Michoacán de Ocampo" <?php selected($collnacim, 'Michoacán de Ocampo'); ?>>Michoacán de Ocampo</option>
                    <option value="Morelos" <?php selected($collnacim, 'Morelos'); ?>>Morelos</option>
                    <option value="Nayarit" <?php selected($collnacim, 'Nayarit'); ?>>Nayarit</option>
                    <option value="Nuevo León" <?php selected($collnacim, 'Nuevo León'); ?>>Nuevo León</option>
                    <option value="Oaxaca" <?php selected($collnacim, 'Oaxaca'); ?>>Oaxaca</option>
                    <option value="Puebla" <?php selected($collnacim, 'Puebla'); ?>>Puebla</option>
                    <option value="Querétaro" <?php selected($collnacim, 'Querétaro'); ?>>Querétaro</option>
                    <option value="Quintana Roo" <?php selected($collnacim, 'Quintana Roo'); ?>>Quintana Roo</option>
                    <option value="San Luis Potosí" <?php selected($collnacim, 'San Luis Potosí'); ?>>San Luis Potosí</option>
                    <option value="Sinaloa" <?php selected($collnacim, 'Sinaloa'); ?>>Sinaloa</option>
                    <option value="Sonora" <?php selected($collnacim, 'Sonora'); ?>>Sonora</option>
                    <option value="Tabasco" <?php selected($collnacim, 'Tabasco'); ?>>Tabasco</option>
                    <option value="Tamaulipas" <?php selected($collnacim, 'Tamaulipas'); ?>>Tamaulipas</option>
                    <option value="Tlaxcala" <?php selected($collnacim, 'Tlaxcala'); ?>>Tlaxcala</option>
                    <option value="Veracruz de Ignacio de la Llave" <?php selected($collnacim, 'Veracruz de Ignacio de la Llave'); ?>>Veracruz de Ignacio de la Llave</option>
                    <option value="Yucatán" <?php selected($collnacim, 'Yucatán'); ?>>Yucatán</option>
                    <option value="Zacatecas" <?php selected($collnacim, 'Zacatecas'); ?>>Zacatecas</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colfnacim">Fecha de Nacimiento</label></th>
            <td><input type="date" id="colaborador_colfnacim" name="colaborador_colfnacim" value="<?php echo $colfnacim; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colecivil">Estado Cilvil </label></th>
            <td>
				<select name="colaborador_colecivil">
                    <option value="" <?php selected($colecivil, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Soltero" <?php selected($colecivil, 'Soltero'); ?>>Soltero</option>
                    <option value="Casado" <?php selected($colecivil, 'Casado'); ?>>Casado</option>
                    <option value="Unión Libre" <?php selected($colecivil, 'Unión Libre'); ?>>Unión Libre</option>
                    <option value="Divorciado" <?php selected($colecivil, 'Divorciado'); ?>>Divorciado</option>
                    <option value="Viudo" <?php selected($colecivil, 'Viudo'); ?>>Viudo</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colsexo" class="margin-bottom-20">Sexo</label></th>
            <td class="padding-bottom-30">
				<select name="colaborador_colsexo">
                    <option value="" <?php selected($colsexo, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Masculino" <?php selected($colsexo, 'Masculino'); ?>>Masculino</option>
                    <option value="Femenino" <?php selected($colsexo, 'Femenino'); ?>>Femenino</option>
                </select>
            </td>
        </tr>

        <tr>
            <th><label for="colaborador_colcurp">CURP</label></th>
            <td><input type="text" id="colaborador_colcurp" name="colaborador_colcurp" value="<?php echo $colcurp; ?>" maxlength="18" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colrfc">RFC</label></th>
            <td><input type="text" id="colaborador_colrfc" name="colaborador_colrfc" value="<?php echo $colrfc; ?>"maxlength="13" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colnss" class="margin-bottom-20">NSS</label></th>
            <td class="padding-bottom-30"><input type="text" id="colaborador_colnss" name="colaborador_colnss" value="<?php echo $colnss; ?>"maxlength="11" placeholder="Sin espacios"></td>
        </tr>

        <tr>
            <th><label for="colaborador_colpuesto">Puesto</label></th>
            <td><input type="text" id="colaborador_colpuesto" name="colaborador_colpuesto" value="<?php echo $colpuesto; ?>" placeholder="Promotor"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colpresta">Prestaciones</label></th>
            <td>
				<select name="colaborador_colpresta">
                    <option value="" <?php selected($colpresta, ''); ?> disabled selected>Selecciona...</option>
                    <option value="de Ley" <?php selected($colpresta, 'de Ley'); ?>>de Ley</option>
                    <option value="superiores" <?php selected($colpresta, 'superiores'); ?>>superiores</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colubicacion" class="margin-bottom-20">Ubicación</label></th>
            <td class="padding-bottom-30">
				<select name="colaborador_colubicacion">
                    <option value="" <?php selected($colubicacion, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Aguascalientes" <?php selected($colubicacion, 'Aguascalientes'); ?>>Aguascalientes</option>
                    <option value="Baja California" <?php selected($colubicacion, 'Baja California'); ?>>Baja California</option>
                    <option value="Baja California Sur" <?php selected($colubicacion, 'Baja California Sur'); ?>>Baja California Sur</option>
                    <option value="Campeche" <?php selected($colubicacion, 'Campeche'); ?>>Campeche</option>
                    <option value="Chiapas" <?php selected($colubicacion, 'Chiapas'); ?>>Chiapas</option>
                    <option value="Chihuahua" <?php selected($colubicacion, 'Chihuahua'); ?>>Chihuahua</option>
                    <option value="Coahuila de Zaragoza" <?php selected($colubicacion, 'Coahuila de Zaragoza'); ?>>Coahuila de Zaragoza</option>
                    <option value="Colima" <?php selected($colubicacion, 'Colima'); ?>>Colima</option>
                    <option value="Ciudad de México" <?php selected($colubicacion, 'Ciudad de México'); ?>>Ciudad de México</option>
                    <option value="Durango" <?php selected($colubicacion, 'Durango'); ?>>Durango</option>
                    <option value="Guanajuato" <?php selected($colubicacion, 'Guanajuato'); ?>>Guanajuato</option>
                    <option value="Guerrero" <?php selected($colubicacion, 'Guerrero'); ?>>Guerrero</option>
                    <option value="Hidalgo" <?php selected($colubicacion, 'Hidalgo'); ?>>Hidalgo</option>
                    <option value="Jalisco" <?php selected($colubicacion, 'Jalisco'); ?>>Jalisco</option>
                    <option value="Estado de México" <?php selected($colubicacion, 'Estado de México'); ?>>Estado de México</option>
                    <option value="Michoacán de Ocampo" <?php selected($colubicacion, 'Michoacán de Ocampo'); ?>>Michoacán de Ocampo</option>
                    <option value="Morelos" <?php selected($colubicacion, 'Morelos'); ?>>Morelos</option>
                    <option value="Nayarit" <?php selected($colubicacion, 'Nayarit'); ?>>Nayarit</option>
                    <option value="Nuevo León" <?php selected($colubicacion, 'Nuevo León'); ?>>Nuevo León</option>
                    <option value="Oaxaca" <?php selected($colubicacion, 'Oaxaca'); ?>>Oaxaca</option>
                    <option value="Puebla" <?php selected($colubicacion, 'Puebla'); ?>>Puebla</option>
                    <option value="Querétaro" <?php selected($colubicacion, 'Querétaro'); ?>>Querétaro</option>
                    <option value="Quintana Roo" <?php selected($colubicacion, 'Quintana Roo'); ?>>Quintana Roo</option>
                    <option value="San Luis Potosí" <?php selected($colubicacion, 'San Luis Potosí'); ?>>San Luis Potosí</option>
                    <option value="Sinaloa" <?php selected($colubicacion, 'Sinaloa'); ?>>Sinaloa</option>
                    <option value="Sonora" <?php selected($colubicacion, 'Sonora'); ?>>Sonora</option>
                    <option value="Tabasco" <?php selected($colubicacion, 'Tabasco'); ?>>Tabasco</option>
                    <option value="Tamaulipas" <?php selected($colubicacion, 'Tamaulipas'); ?>>Tamaulipas</option>
                    <option value="Tlaxcala" <?php selected($colubicacion, 'Tlaxcala'); ?>>Tlaxcala</option>
                    <option value="Veracruz de Ignacio de la Llave" <?php selected($colubicacion, 'Veracruz de Ignacio de la Llave'); ?>>Veracruz de Ignacio de la Llave</option>
                    <option value="Yucatán" <?php selected($colubicacion, 'Yucatán'); ?>>Yucatán</option>
                    <option value="Zacatecas" <?php selected($colubicacion, 'Zacatecas'); ?>>Zacatecas</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colingreso">Fecha de Ingreso</label></th>
            <td><input type="date" id="colaborador_colingreso" name="colaborador_colingreso" value="<?php echo $colingreso; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colsueldo">Sueldo</label></th>
            <td><input type="number" id="colaborador_colsueldo" name="colaborador_colsueldo" value="<?php echo $colsueldo; ?>" step="0.01" placeholder="0.00"><input type="text" id="colaborador_colsueldot" name="colaborador_colsueldot" value="<?php echo $colsueldot; ?>" placeholder="Cantidad con letra"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colnomina">Nómina</label></th>
            <td>
				<select name="colaborador_colnomina">
                    <option value="" <?php selected($colnomina, ''); ?> disabled selected>Selecciona...</option>
                    <option value="semanal" <?php selected($colnomina, 'semanal'); ?>>semanal</option>
                    <option value="catorcenal" <?php selected($colnomina, 'catorcenal'); ?>>catorcenal</option>
                    <option value="quicenal" <?php selected($colnomina, 'quicenal'); ?>>quicenal</option>
                    <option value="mensual" <?php selected($colnomina, 'mensual'); ?>>mensual</option>
                    <option value="asimilado" <?php selected($colnomina, 'asimilado'); ?>>asimilado</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colinicia">Inicio de contrato</label></th>
            <td><input type="date" id="colaborador_colinicia" name="colaborador_colinicia" value="<?php echo $colinicia; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colvence">Vencimiento de contrato</label></th>
            <td><input type="date" id="colaborador_colvence" name="colaborador_colvence" value="<?php echo $colvence; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_coldcontrato" class="margin-bottom-20">Días de Contrato</label></th>
            <td class="padding-bottom-30"><input type="number" id="colaborador_coldcontrato" name="colaborador_coldcontrato" value="<?php echo $coldcontrato; ?>" placeholder="30"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colinfonavit">Infonavit</label></th>
            <td>
				<select name="colaborador_colinfonavit">
                    <option value="" <?php selected($colinfonavit, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Sí" <?php selected($colinfonavit, 'Sí'); ?>>Sí</option>
                    <option value="No" <?php selected($colinfonavit, 'No'); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colncredinf">No. de Credito</label></th>
            <td><input type="text" id="colaborador_colncredinf" name="colaborador_colncredinf" value="<?php echo $colncredinf; ?>"></td>
        </tr>        
        <tr>
            <th><label for="colaborador_coltdesc">Tipo de descuento</label></th>
            <td><input type="text" id="colaborador_coltdesc" name="colaborador_coltdesc" value="<?php echo $coltdesc; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colfonacot">Fonacot</label></th>
            <td>
				<select name="colaborador_colfonacot">
                    <option value="" <?php selected($colfonacot, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Sí" <?php selected($colfonacot, 'Sí'); ?>>Sí</option>
                    <option value="No" <?php selected($colfonacot, 'No'); ?>>No</option>
                </select>
            </td>
        </tr>        
        <tr>
            <th><label for="colaborador_colncredfon">No. de Credito</label></th>
            <td><input type="text" id="colaborador_colncredfon" name="colaborador_colncredfon" value="<?php echo $colncredfon; ?>"></td>
        </tr>  
        <tr>
            <th><label for="colaborador_colpensali" class="margin-bottom-20">Pensión alimenticia</label></th>
            <td class="padding-bottom-30"><textarea name="colaborador_colpensali" rows="5"><?php echo $colpensali; ?></textarea></td>
        </tr> <!-- Campo abierto -->
        <tr>
            <th><label for="colaborador_colbanco">Banco</label></th>
            <td>
            	<select name="colaborador_colbanco">
                    <option value="" <?php selected($colbanco, ''); ?> disabled selected>Selecciona...</option>
                    <option value="BANAMEX" <?php selected($colbanco, 'BANAMEX'); ?>>BANAMEX</option>
                    <option value="BANCOMEXT" <?php selected($colbanco, 'BANCOMEXT'); ?>>BANCOMEXT</option>
                    <option value="BANOBRAS" <?php selected($colbanco, 'BANOBRAS'); ?>>BANOBRAS</option>
                    <option value="BBVA BANCOMER" <?php selected($colbanco, 'BBVA BANCOMER'); ?>>BBVA BANCOMER</option>
                    <option value="SANTANDER" <?php selected($colbanco, 'SANTANDER'); ?>>SANTANDER</option>
                    <option value="BANJERCITO" <?php selected($colbanco, 'BANJERCITO'); ?>>BANJERCITO</option>
                    <option value="HSBC" <?php selected($colbanco, 'HSBC'); ?>>HSBC</option>
                    <option value="BAJIO" <?php selected($colbanco, 'BAJIO'); ?>>BAJIO</option>
                    <option value="IXE" <?php selected($colbanco, 'IXE'); ?>>IXE</option>
                    <option value="INBURSA" <?php selected($colbanco, 'INBURSA'); ?>>INBURSA</option>
                    <option value="INTERACCIONES" <?php selected($colbanco, 'INTERACCIONES'); ?>>INTERACCIONES</option>
                    <option value="MIFEL" <?php selected($colbanco, 'MIFEL'); ?>>MIFEL</option>
                    <option value="SCOTIABANK" <?php selected($colbanco, 'SCOTIABANK'); ?>>SCOTIABANK</option>
                    <option value="BANREGIO" <?php selected($colbanco, 'BANREGIO'); ?>>BANREGIO</option>
                    <option value="INVEX" <?php selected($colbanco, 'INVEX'); ?>>INVEX</option>
                    <option value="BANSI" <?php selected($colbanco, 'BANSI'); ?>>BANSI</option>
                    <option value="AFIRME" <?php selected($colbanco, 'AFIRME'); ?>>AFIRME</option>
                    <option value="BANORTE" <?php selected($colbanco, 'BANORTE'); ?>>BANORTE</option>
                    <option value="THE ROYAL BANK" <?php selected($colbanco, 'THE ROYAL BANK'); ?>>THE ROYAL BANK</option>
                    <option value="AMERICAN EXPRESS" <?php selected($colbanco, 'AMERICAN EXPRESS'); ?>>AMERICAN EXPRESS</option>
                    <option value="BAMSA" <?php selected($colbanco, 'BAMSA'); ?>>BAMSA</option>
                    <option value="TOKYO" <?php selected($colbanco, 'TOKYO'); ?>>TOKYO</option>
                    <option value="JP MORGAN" <?php selected($colbanco, 'JP MORGAN'); ?>>JP MORGAN</option>
                    <option value="BMONEX" <?php selected($colbanco, 'BMONEX'); ?>>BMONEX</option>
                    <option value="VE POR MAS" <?php selected($colbanco, 'VE POR MAS'); ?>>VE POR MAS</option>
                    <option value="ING" <?php selected($colbanco, 'ING'); ?>>ING</option>
                    <option value="DEUTSCHE" <?php selected($colbanco, 'DEUTSCHE'); ?>>DEUTSCHE</option>
                    <option value="CREDIT SUISSE" <?php selected($colbanco, 'CREDIT SUISSE'); ?>>CREDIT SUISSE</option>
                    <option value="AZTECA" <?php selected($colbanco, 'AZTECA'); ?>>AZTECA</option>
                    <option value="AUTOFIN" <?php selected($colbanco, 'AUTOFIN'); ?>>AUTOFIN</option>
                    <option value="BARCLAYS" <?php selected($colbanco, 'BARCLAYS'); ?>>BARCLAYS</option>
                    <option value="COMPARTAMOS" <?php selected($colbanco, 'COMPARTAMOS'); ?>>COMPARTAMOS</option>
                    <option value="BANCO FAMSA" <?php selected($colbanco, 'BANCO FAMSA'); ?>>BANCO FAMSA</option>
                    <option value="BMULTIVA" <?php selected($colbanco, 'BMULTIVA'); ?>>BMULTIVA</option>
                    <option value="ACTINVER" <?php selected($colbanco, 'ACTINVER'); ?>>ACTINVER</option>
                    <option value="WAL-MART" <?php selected($colbanco, 'WAL-MART'); ?>>WAL-MART</option>
                    <option value="NAFIN" <?php selected($colbanco, 'NAFIN'); ?>>NAFIN</option>
                    <option value="INTERBANCO" <?php selected($colbanco, 'INTERBANCO'); ?>>INTERBANCO</option>
                    <option value="BANCOPPEL" <?php selected($colbanco, 'BANCOPPEL'); ?>>BANCOPPEL</option>
                    <option value="ABC CAPITAL" <?php selected($colbanco, 'ABC CAPITAL'); ?>>ABC CAPITAL</option>
                    <option value="UBS BANK" <?php selected($colbanco, 'UBS BANK'); ?>>UBS BANK</option>
                    <option value="CONSUBANCO" <?php selected($colbanco, 'CONSUBANCO'); ?>>CONSUBANCO</option>
                    <option value="VOLKSWAGEN" <?php selected($colbanco, 'VOLKSWAGEN'); ?>>VOLKSWAGEN</option>
                    <option value="CIBANCO" <?php selected($colbanco, 'CIBANCO'); ?>>CIBANCO</option>
                    <option value="BBASE" <?php selected($colbanco, 'BBASE'); ?>>BBASE</option>
                    <option value="BANSEFI" <?php selected($colbanco, 'BANSEFI'); ?>>BANSEFI</option>
                    <option value="HIPOTECARIA FEDERAL" <?php selected($colbanco, 'HIPOTECARIA FEDERAL'); ?>>HIPOTECARIA FEDERAL</option>
                    <option value="MONEXCB" <?php selected($colbanco, 'MONEXCB'); ?>>MONEXCB</option>
                    <option value="GBM" <?php selected($colbanco, 'GBM'); ?>>GBM</option>
                    <option value="MASARI" <?php selected($colbanco, 'MASARI'); ?>>MASARI</option>
                    <option value="VALUE" <?php selected($colbanco, 'VALUE'); ?>>VALUE</option>
                    <option value="ESTRUCTURADORES" <?php selected($colbanco, 'ESTRUCTURADORES'); ?>>ESTRUCTURADORES</option>
                    <option value="TIBER" <?php selected($colbanco, 'TIBER'); ?>>TIBER</option>
                    <option value="VECTOR" <?php selected($colbanco, 'VECTOR'); ?>>VECTOR</option>
                    <option value="B&B" <?php selected($colbanco, 'B&B'); ?>>B&B</option>
                    <option value="ACCIVAL" <?php selected($colbanco, 'ACCIVAL'); ?>>ACCIVAL</option>
                    <option value="MERRILL LYNCH" <?php selected($colbanco, 'MERRILL LYNCH'); ?>>MERRILL LYNCH</option>
                    <option value="FINAMEX" <?php selected($colbanco, 'FINAMEX'); ?>>FINAMEX</option>
                    <option value="VALMEX" <?php selected($colbanco, 'VALMEX'); ?>>VALMEX</option>
                    <option value="UNICA" <?php selected($colbanco, 'UNICA'); ?>>UNICA</option>
                    <option value="MAPFRE" <?php selected($colbanco, 'MAPFRE'); ?>>MAPFRE</option>
                    <option value="PROFUTURO" <?php selected($colbanco, 'PROFUTURO'); ?>>PROFUTURO</option>
                    <option value="CB ACTINVER" <?php selected($colbanco, 'CB ACTINVER'); ?>>CB ACTINVER</option>
                    <option value="OACTIN" <?php selected($colbanco, 'OACTIN'); ?>>OACTIN</option>
                    <option value="SKANDIA" <?php selected($colbanco, 'SKANDIA'); ?>>SKANDIA</option>
                    <option value="CBDEUTSCHE" <?php selected($colbanco, 'CBDEUTSCHE'); ?>>CBDEUTSCHE</option>
                    <option value="ZURICH" <?php selected($colbanco, 'ZURICH'); ?>>ZURICH</option>
                    <option value="ZURICHVI" <?php selected($colbanco, 'ZURICHVI'); ?>>ZURICHVI</option>
                    <option value="SU CASITA" <?php selected($colbanco, 'SU CASITA'); ?>>SU CASITA</option>
                    <option value="CB INTERCAM" <?php selected($colbanco, 'CB INTERCAM'); ?>>CB INTERCAM</option>
                    <option value="CI BOLSA" <?php selected($colbanco, 'CI BOLSA'); ?>>CI BOLSA</option>
                    <option value="BULLTICK CB" <?php selected($colbanco, 'BULLTICK CB'); ?>>BULLTICK CB</option>
                    <option value="STERLING" <?php selected($colbanco, 'STERLING'); ?>>STERLING</option>
                    <option value="FINCOMUN" <?php selected($colbanco, 'FINCOMUN'); ?>>FINCOMUN</option>
                    <option value="HDI SEGUROS" <?php selected($colbanco, 'HDI SEGUROS'); ?>>HDI SEGUROS</option>
                    <option value="ORDER" <?php selected($colbanco, 'ORDER'); ?>>ORDER</option>
                    <option value="AKALA" <?php selected($colbanco, 'AKALA'); ?>>AKALA</option>
                    <option value="CB JPMORGAN" <?php selected($colbanco, 'CB JPMORGAN'); ?>>CB JPMORGAN</option>
                    <option value="REFORMA" <?php selected($colbanco, 'REFORMA'); ?>>REFORMA</option>
                    <option value="STP" <?php selected($colbanco, 'STP'); ?>>STP</option>
                    <option value="TELECOMM" <?php selected($colbanco, 'TELECOMM'); ?>>TELECOMM</option>
                    <option value="EVERCORE" <?php selected($colbanco, 'EVERCORE'); ?>>EVERCORE</option>
                    <option value="SKANDIA" <?php selected($colbanco, 'SKANDIA'); ?>>SKANDIA</option>
                    <option value="SEGMTY" <?php selected($colbanco, 'SEGMTY'); ?>>SEGMTY</option>
                    <option value="ASEA" <?php selected($colbanco, 'ASEA'); ?>>ASEA</option>
                    <option value="KUSPIT" <?php selected($colbanco, 'KUSPIT'); ?>>KUSPIT</option>
                    <option value="SOFIEXPRESS" <?php selected($colbanco, 'SOFIEXPRESS'); ?>>SOFIEXPRESS</option>
                    <option value="UNAGRA" <?php selected($colbanco, 'UNAGRA'); ?>>UNAGRA</option>
                    <option value="OPCIONES EMPRESARIALES DEL NOROESTE" <?php selected($colbanco, 'OPCIONES EMPRESARIALES DEL NOROESTE'); ?>>OPCIONES EMPRESARIALES DEL NOROESTE</option>
                    <option value="CLS" <?php selected($colbanco, 'CLS'); ?>>CLS</option>
                    <option value="INDEVAL" <?php selected($colbanco, 'INDEVAL'); ?>>INDEVAL</option>
                    <option value="LIBERTAD" <?php selected($colbanco, 'LIBERTAD'); ?>>LIBERTAD</option>
                    <option value="N/A" <?php selected($colbanco, 'N/A'); ?>>N/A</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colncuenta">No. cuenta</label></th>
            <td><input type="text" id="colaborador_colncuenta" name="colaborador_colncuenta" value="<?php echo $colncuenta; ?>" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colclaveint">CLABE interbancaria</label></th>
            <td><input type="text" id="colaborador_colclaveint" name="colaborador_colclaveint" value="<?php echo $colclaveint; ?>" maxlength="18" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colnotarjeta">Número de tarjeta</label></th>
            <td><input type="text" id="colaborador_colnotarjeta" name="colaborador_colnotarjeta" value="<?php echo $colnotarjeta; ?>" maxlength="16" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colcorreo" class="margin-bottom-20">Correo Electrónico</label></th>
            <td class="padding-bottom-30"><input type="email" id="colaborador_colcorreo" name="colaborador_colcorreo" value="<?php echo $colcorreo; ?>" placeholder="colaborador@email.com"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colvaldes">Vales de despensa</label></th>
            <td>
				<select name="colaborador_colvaldes">
                    <option value="" <?php selected($colvaldes, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Sí" <?php selected($colvaldes, 'Sí'); ?>>Sí</option>
                    <option value="No" <?php selected($colvaldes, 'No'); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colvalcant" class="margin-bottom-20">Monto de despensa</label></th>
            <td class="padding-bottom-30"><input type="number" id="colaborador_colvalcant" name="colaborador_colvalcant" value="<?php echo $colvalcant; ?>" step="0.01" placeholder="0.00"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colapriv">Aviso de privacidad</label></th>
            <td>
				<select name="colaborador_colapriv">
                    <option value="" <?php selected($colapriv, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Sí" <?php selected($colapriv, 'Sí'); ?>>Sí</option>
                    <option value="No" <?php selected($colapriv, 'No'); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colpsico">Pruebas psicométricas</label></th>
            <td>
				<select name="colaborador_colpsico">
                    <option value="" <?php selected($colpsico, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Sí" <?php selected($colpsico, 'Sí'); ?>>Sí</option>
                    <option value="No" <?php selected($colpsico, 'No'); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colcredencial">Credencial</label></th>
            <td>
				<select name="colaborador_colcredencial">
                    <option value="" <?php selected($colcredencial, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Sí" <?php selected($colcredencial, 'Sí'); ?>>Sí</option>
                    <option value="No" <?php selected($colcredencial, 'No'); ?>>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colobserv" class="margin-bottom-20">Observaciones</label></th>
            <td class="padding-bottom-30"><textarea name="colaborador_colobserv" rows="5" placeholder="Comentarios adicionales"><?php echo $colobserv; ?></textarea></td>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'colaborador_save_metas', 10, 2 );
function colaborador_save_metas( $idcolaborador, $colaborador ){
    if ( $colaborador->post_type == 'colaborador' ){
        if ( isset( $_POST['colaborador_colnumemp'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnumemp', $_POST['colaborador_colnumemp'] );
        }
        if ( isset( $_POST['colaborador_colnombre'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnombre', $_POST['colaborador_colnombre'] );
        }
        if ( isset( $_POST['colaborador_colapepat'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colapepat', $_POST['colaborador_colapepat'] );
        }
        if ( isset( $_POST['colaborador_colapemat'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colapemat', $_POST['colaborador_colapemat'] );
        }
        if ( isset( $_POST['colaborador_colestado'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colestado', $_POST['colaborador_colestado'] );
        }
        if ( isset( $_POST['colaborador_colrsocial'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colrsocial', $_POST['colaborador_colrsocial'] );
        }
        if ( isset( $_POST['colaborador_colcliente'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcliente', $_POST['colaborador_colcliente'] );
        }
        if ( isset( $_POST['colaborador_coldcalle'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldcalle', $_POST['colaborador_coldcalle'] );
        }
        if ( isset( $_POST['colaborador_coldnum'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldnum', $_POST['colaborador_coldnum'] );
        }
        if ( isset( $_POST['colaborador_coldcol'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldcol', $_POST['colaborador_coldcol'] );
        }
        if ( isset( $_POST['colaborador_colddel'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colddel', $_POST['colaborador_colddel'] );
        }
        if ( isset( $_POST['colaborador_coldest'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldest', $_POST['colaborador_coldest'] );
        }
        if ( isset( $_POST['colaborador_coldcp'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldcp', $_POST['colaborador_coldcp'] );
        }
        if ( isset( $_POST['colaborador_coltel'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coltel', $_POST['colaborador_coltel'] );
        }
        if ( isset( $_POST['colaborador_colcel'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcel', $_POST['colaborador_colcel'] );
        }
        if ( isset( $_POST['colaborador_collnacim'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_collnacim', $_POST['colaborador_collnacim'] );
        }
        if ( isset( $_POST['colaborador_colcurp'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcurp', $_POST['colaborador_colcurp'] );
        }
        if ( isset( $_POST['colaborador_colrfc'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colrfc', $_POST['colaborador_colrfc'] );
        }
        if ( isset( $_POST['colaborador_colnss'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnss', $_POST['colaborador_colnss'] );
        }
        if ( isset( $_POST['colaborador_colfnacim'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colfnacim', $_POST['colaborador_colfnacim'] );
        }
        if ( isset( $_POST['colaborador_colpuesto'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colpuesto', $_POST['colaborador_colpuesto'] );
        }
        if ( isset( $_POST['colaborador_colpresta'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colpresta', $_POST['colaborador_colpresta'] );
        }
        if ( isset( $_POST['colaborador_colingreso'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colingreso', $_POST['colaborador_colingreso'] );
        }
        if ( isset( $_POST['colaborador_colsueldo'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colsueldo', $_POST['colaborador_colsueldo'] );
        }
        if ( isset( $_POST['colaborador_colsueldot'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colsueldot', $_POST['colaborador_colsueldot'] );
        }
        if ( isset( $_POST['colaborador_colnomina'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnomina', $_POST['colaborador_colnomina'] );
        }
        if ( isset( $_POST['colaborador_colvence'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colvence', $_POST['colaborador_colvence'] );
        }
        if ( isset( $_POST['colaborador_colinicia'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colinicia', $_POST['colaborador_colinicia'] );
        }
        if ( isset( $_POST['colaborador_coldcontrato'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldcontrato', $_POST['colaborador_coldcontrato'] );
        }
        if ( isset( $_POST['colaborador_colecivil'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colecivil', $_POST['colaborador_colecivil'] );
        }
        if ( isset( $_POST['colaborador_colsexo'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colsexo', $_POST['colaborador_colsexo'] );
        }
        if ( isset( $_POST['colaborador_colinfonavit'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colinfonavit', $_POST['colaborador_colinfonavit'] );
        }
        if ( isset( $_POST['colaborador_colncredinf'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colncredinf', $_POST['colaborador_colncredinf'] );
        }
        if ( isset( $_POST['colaborador_coltdesc'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coltdesc', $_POST['colaborador_coltdesc'] );
        }
        if ( isset( $_POST['colaborador_colfonacot'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colfonacot', $_POST['colaborador_colfonacot'] );
        }
        if ( isset( $_POST['colaborador_colncredfon'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colncredfon', $_POST['colaborador_colncredfon'] );
        }
        if ( isset( $_POST['colaborador_colpensali'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colpensali', $_POST['colaborador_colpensali'] );
        }
        if ( isset( $_POST['colaborador_colubicacion'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colubicacion', $_POST['colaborador_colubicacion'] );
        }
        if ( isset( $_POST['colaborador_colbanco'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colbanco', $_POST['colaborador_colbanco'] );
        }
        if ( isset( $_POST['colaborador_colncuenta'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colncuenta', $_POST['colaborador_colncuenta'] );
        }
        if ( isset( $_POST['colaborador_colclaveint'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colclaveint', $_POST['colaborador_colclaveint'] );
        }
        if ( isset( $_POST['colaborador_colnotarjeta'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnotarjeta', $_POST['colaborador_colnotarjeta'] );
        }
        if ( isset( $_POST['colaborador_colcorreo'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcorreo', $_POST['colaborador_colcorreo'] );
        }
        if ( isset( $_POST['colaborador_colvaldes'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colvaldes', $_POST['colaborador_colvaldes'] );
        }
        if ( isset( $_POST['colaborador_colvalcant'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colvalcant', $_POST['colaborador_colvalcant'] );
        }
        if ( isset( $_POST['colaborador_colapriv'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colapriv', $_POST['colaborador_colapriv'] );
        }
        if ( isset( $_POST['colaborador_colpsico'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colpsico', $_POST['colaborador_colpsico'] );
        }
        if ( isset( $_POST['colaborador_colcredencial'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcredencial', $_POST['colaborador_colcredencial'] );
        }
        if ( isset( $_POST['colaborador_colobserv'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colobserv', $_POST['colaborador_colobserv'] );
        }
    }
}


/* Colaboradores */

add_action( 'add_meta_boxes', 'rsocial_custom_metabox' );
function rsocial_custom_metabox(){
    add_meta_box( 'rsocial_meta', 'Información General', 'display_rsocial_atributos', 'rsocial', 'advanced', 'default');
}

function display_rsocial_atributos( $rsocial ){
    $rsnombre 	= esc_html( get_post_meta( $rsocial->ID, 'rsocial_rsnombre', true ) );
    $rsrfc 		= esc_html( get_post_meta( $rsocial->ID, 'rsocial_rsrfc', true ) );
    $rsdirec 	= esc_html( get_post_meta( $rsocial->ID, 'rsocial_rsdirec', true ) );
    $rscuenta 	= esc_html( get_post_meta( $rsocial->ID, 'rsocial_rscuenta', true ) );
?>
    <table class="aes-custum-fields" id="aes_table-rsocial">
        <tr>
            <th><label for="rsocial_rsnombre">Nombre o razón social</label></th>
            <td><input type="text" id="rsocial_rsnombre" name="rsocial_rsnombre" value="<?php echo $rsnombre; ?>"></td>
        </tr>
        <tr>
            <th><label for="rsocial_rsrfc">RFC</label></th>
            <td><input type="text" id="rsocial_rsrfc" name="rsocial_rsrfc" value="<?php echo $rsrfc; ?>"></td>
        </tr>
        <tr>
            <th><label for="rsocial_rsdirec">Dirección fiscal</label></th>
            <td><textarea name="rsocial_rsdirec" rows="3" placeholder="Calle, número, colonia, municipio, ciudad, c.p."><?php echo $rsdirec; ?></textarea></td>
        </tr>
        <tr>
            <th><label for="rsocial_rscuenta">Cuenta</label></th>
            <td><input type="number" id="rsocial_rscuenta" name="rsocial_rscuenta" value="<?php echo $rscuenta; ?>"></td>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'rsocial_save_metas', 10, 2 );
function rsocial_save_metas( $idrsocial, $rsocial ){
    if ( $rsocial->post_type == 'rsocial' ){
        if ( isset( $_POST['rsocial_rsrfc'] ) ){
            update_post_meta( $idcolaborador, 'rsocial_rsrfc', $_POST['rsocial_rsrfc'] );
        }
        if ( isset( $_POST['rsocial_rsrfc'] ) ){
            update_post_meta( $idcolaborador, 'rsocial_rsrfc', $_POST['rsocial_rsrfc'] );
        }
        if ( isset( $_POST['rsocial_rsdirec'] ) ){
            update_post_meta( $idcolaborador, 'rsocial_rsdirec', $_POST['rsocial_rsdirec'] );
        }
        if ( isset( $_POST['rsocial_rscuenta'] ) ){
            update_post_meta( $idcolaborador, 'rsocial_rscuenta', $_POST['rsocial_rscuenta'] );
        }
    }
}


/* Contrato */


add_action( 'add_meta_boxes', 'contrato_rsa_custom_metabox' );
function contrato_rsa_custom_metabox(){
    add_meta_box( 'contrato_rsa_meta', 'Más Información', 'display_contrato_rsa_atributos', 'contrato_rsa', 'advanced', 'default');
}

function display_contrato_rsa_atributos( $contrato_rsa ){
    $cncolaborador = esc_html( get_post_meta( $contrato_rsa->ID, 'contrato_rsa_cncolaborador', true ) );
?>
    <table class="ae-custom-fields">
        <tr>
            <th colspan="2">
                <label for="contrato_rsa_cncolaborador">Colaborador</label>
                <select id="contrato_rsa_cncolaborador" name="contrato_rsa_cncolaborador" required>
                    <option value="" <?php selected($cncolaborador, ''); ?>></option>
                    <?php 
                    $aeColaborador = array(
                        'post_type'         => 'colaborador',
                        'posts_per_page'    => -1,
                        'post_status'       => 'publish',
                        'orderby'           => 'title',
                        'order'             => 'ASC',
                    ); 
                    $loopColaborador = new WP_Query( $aeColaborador );
                    if ( $loopColaborador->have_posts() ) {
                        while ( $loopColaborador->have_posts() ) : $loopColaborador->the_post(); 
                            $post_id        = get_the_ID();
                            $cncolaboradorName = get_the_title( $post_id ); ?>
                            <option value="<?php echo $cncolaboradorName; ?>" <?php selected($cncolaborador, $cncolaboradorName); ?>><?php echo $cncolaboradorName; ?></option>
                    <?php endwhile; } wp_reset_postdata(); ?>
                </select>
            </th>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'contrato_rsa_save_metas', 10, 2 );
function contrato_rsa_save_metas( $idcontrato_rsa, $contrato_rsa ){
    //Comprobamos que es del tipo que nos interesa
    if ( $contrato_rsa->post_type == 'contrato_rsa' ){
    //Guardamos los datos que vienen en el POST
        if ( isset( $_POST['contrato_rsa_cncolaborador'] ) ){
            update_post_meta( $idcontrato_rsa, 'contrato_rsa_cncolaborador', $_POST['contrato_rsa_cncolaborador'] );
        }
    }
}










/* Formatos generales */

add_action( 'add_meta_boxes', 'formato_custom_metabox' );
function formato_custom_metabox(){
    add_meta_box( 'formato_meta', 'Información General', 'display_formato_atributos', 'formato', 'advanced', 'default');
}

function display_formato_atributos( $formato ){
    $farchivo 	= esc_html( get_post_meta( $formato->ID, 'formato_farchivo', true ) );
    $fdescrip 	= esc_html( get_post_meta( $formato->ID, 'formato_fdescrip', true ) );
?>
    <table class="aes-custum-fields" id="aes_table-formato">
        <tr>
            <th><label class="margin-bottom-20">Archivo</label></th>
			<td class="padding-bottom-30">
				<div class="input-image">
					<input type="text" name="formato_farchivo" id="formato_farchivo" class="meta-image" placeholder="Elegir archivo" value="<?php echo $farchivo; ?>">
				<input type="button" class="button image-upload" value="Seleccionar">
				</div>                	
			</td>
        </tr>
        <tr>
            <th><label for="formato_fdescrip">Dirección fiscal</label></th>
            <td><textarea name="formato_fdescrip" rows="3" placeholder="Descripción del uso del formato"><?php echo $fdescrip; ?></textarea></td>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'formato_save_metas', 10, 2 );
function formato_save_metas( $idformato, $formato ){
    if ( $formato->post_type == 'formato' ){
        if ( isset( $_POST['formato_farchivo'] ) ){
            update_post_meta( $idformato, 'formato_farchivo', $_POST['formato_farchivo'] );
        }
        if ( isset( $_POST['formato_fdescrip'] ) ){
            update_post_meta( $idformato, 'formato_fdescrip', $_POST['formato_fdescrip'] );
        }
    }
}




/*
**Custom Columns Wp-Admin
*/

/* Candidatos */

add_filter( 'manage_colaborador_posts_columns', 'set_custom_edit_colaborador_columns' );
function set_custom_edit_colaborador_columns($columns) {
    $columns['aes_colrsocial'] 	= __( 'Razón social', 'aempleo' );
    $columns['aes_colestado'] 	= __( 'Estado', 'aempleo' );
    $columns['aes_contrato'] 	= __( 'Contrato', 'aempleo' );

    return $columns;
}

add_action( 'manage_colaborador_posts_custom_column' , 'custom_colaborador_column', 10, 2 );
function custom_colaborador_column( $column, $post_id ) {
    switch ( $column ) {
        case 'aes_colrsocial' :
            $colrsocial  = get_post_meta( $post_id, 'colaborador_colrsocial', true );
            if( $colrsocial != "")
                echo $colrsocial;
            else
                echo "-";
            break;
        case 'aes_colestado' :
            $colestado  = get_post_meta( $post_id, 'colaborador_colestado', true );
            $colpuesto  = get_post_meta( $post_id, 'colaborador_colpuesto', true );
            if( $colestado != "")
                echo "** " . $colestado . " **</br>";
            else
                echo "-</br>";
            if( $colpuesto != "")
                echo $colpuesto;
            else
                echo "-";
            break;
        case 'aes_contrato' :
            $colingreso = get_post_meta( $post_id, 'colaborador_colingreso', true );
            $colvence  	= get_post_meta( $post_id, 'colaborador_colvence', true );
            $colinicia  = get_post_meta( $post_id, 'colaborador_colinicia', true );
            if( $colingreso != "")
                echo "Ingreso: " . date('d/m/Y', strtotime($colingreso)) . "</br>";
            else
                echo "-</br>";
            if( $colinicia != "")
            	echo "Firma: " . date('d/m/Y', strtotime($colinicia)) . "</br>";
            else
                echo "-</br>";
            if( $colvence != "")
            	echo "Vence: " . date('d/m/Y', strtotime($colvence));
            else
                echo "-";
            break;
    }
}


/* Formatos generales */

add_filter( 'manage_formato_posts_columns', 'set_custom_edit_formato_columns' );
function set_custom_edit_formato_columns($columns) {
    $columns['aes_farchivo'] 	= __( 'Archivo', 'aempleo' );
    $columns['aes_fdescrip'] 	= __( 'Descripción', 'aempleo' );

    return $columns;
}

add_action( 'manage_formato_posts_custom_column' , 'custom_formato_column', 10, 2 );
function custom_formato_column( $column, $post_id ) {
    switch ( $column ) {
        case 'aes_farchivo' :
            $farchivo  = get_post_meta( $post_id, 'formato_farchivo', true );
            if( $farchivo != "")
                echo "<a href='" . $farchivo . "' target='_blank'>Ver</a>";
            else
                echo "-";
            break;
        case 'aes_fdescrip' :
            $fdescrip  = get_post_meta( $post_id, 'formato_fdescrip', true );
            if( $fdescrip != "")
                echo $fdescrip;
            else
                echo "-";
            break;
    }
}