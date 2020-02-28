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
	/*wp_enqueue_script( 'aes_functions', JSPATH.'functions.js', array(), '1.0', true );*/
 
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
    $colestado 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colestado', true ) );
    $colrsocial = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colrsocial', true ) );
    $coldireccion = esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldireccion', true ) );
    $colcp 		= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcp', true ) );
    $coltel 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_coltel', true ) );
    $colcel 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcel', true ) );
    $collnacim 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_collnacim', true ) );
    $colcurp 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcurp', true ) );
    $colrfc 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colrfc', true ) );
    $colnss 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnss', true ) );
    $colfnacim 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colfnacim', true ) );
    $colpresta 	= esc_html( get_post_meta( $colaborador->ID, 'colaborador_colpresta', true ) );
    $colcliente = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcliente', true ) );
    $colpuesto  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colpuesto', true ) );
    $colingreso = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colingreso', true ) );
    $colsueldo  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colsueldo', true ) );
    $colnomina  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colnomina', true ) );
    $colvence   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colvence', true ) );
    $colfirma   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colfirma', true ) );
    $coldcontrato = esc_html( get_post_meta( $colaborador->ID, 'colaborador_coldcontrato', true ) );
    $colecivil  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colecivil', true ) );
    $colsexo    = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colsexo', true ) );
    $colinfonavit = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colinfonavit', true ) );
    $colncredit   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colncredit', true ) );
    $colvdesc   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colvdesc', true ) );
    $colapriv   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colapriv', true ) );
    $colubicacion  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colubicacion', true ) );
    $colbanco   = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colbanco', true ) );
    $colncuenta = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colncuenta', true ) );
    $colclaveint = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colclaveint', true ) );
    $colcorreo  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colcorreo', true ) );
    $colobserv  = esc_html( get_post_meta( $colaborador->ID, 'colaborador_colobserv', true ) );
?>
    <table class="aes-custum-fields" id="aes_table-colaboradores">
        <tr>
            <th><label for="colaborador_colnumemp">No. Empleado</label></th>
            <td><input type="number" id="colaborador_colnumemp" name="colaborador_colnumemp" value="<?php echo $colnumemp; ?>" placeholder="0"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colestado" class="margin-bottom-20">Estado</label></th>
            <td class="padding-bottom-20">
				<select name="colaborador_colestado">
                    <option value="" <?php selected($colestado, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Activo" <?php selected($colestado, 'Activo'); ?>>Activo</option>
                    <option value="Inactivo" <?php selected($colestado, 'Inactivo'); ?>>Inactivo</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colrsocial" class="margin-bottom-20">Razón social</label></th>
            <td class="padding-bottom-20">
				<select name="colaborador_colrsocial">
                    <option value="" <?php selected($colrsocial, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Altoempleo Tlalnepantla, S.A. de C.V." <?php selected($colrsocial, 'Altoempleo Tlalnepantla, S.A. de C.V.'); ?>>Altoempleo Tlalnepantla, S.A. de C.V.</option>
                    <option value="Altoempleo Izcalli, S.A. de C.V." <?php selected($colrsocial, 'Altoempleo Izcalli, S.A. de C.V.'); ?>>Altoempleo Izcalli, S.A. de C.V.</option>
                    <option value="Alto Empleo, S.A. de C.V." <?php selected($colrsocial, 'Alto Empleo, S.A. de C.V.'); ?>>Alto Empleo, S.A. de C.V.</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_coldireccion">Dirección</label></th>
            <td><textarea name="colaborador_coldireccion" rows="3" placeholder="Calle, número, colonia, municipio y ciudad"><?php echo $coldireccion; ?></textarea></td>
        </tr>
        <tr>
            <th><label for="colaborador_colcp">C.P.</label></th>
            <td><input type="number" id="colaborador_colcp" name="colaborador_colcp" value="<?php echo $colcp; ?>" placeholder="11000"></td>
        </tr>
        <tr>
            <th><label for="colaborador_coltel">Teléfono casa</label></th>
            <td><input type="text" id="colaborador_coltel" name="colaborador_coltel" value="<?php echo $coltel; ?>" placeholder="55 5050 5050"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colcel" class="margin-bottom-20">Teléfono Celular</label></th>
            <td class="padding-bottom-20"><input type="text" id="colaborador_colcel" name="colaborador_colcel" value="<?php echo $colcel; ?>" placeholder="55 5050 5050"></td>
        </tr>
        <tr>
            <th><label for="colaborador_collnacim">Lugar de Nacimiento</label></th>
            <td><input type="text" id="colaborador_collnacim" name="colaborador_collnacim" value="<?php echo $collnacim; ?>" placeholder="Ciudad de México"></td>
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
            <td class="padding-bottom-20">
				<select name="colaborador_colsexo">
                    <option value="" <?php selected($colsexo, ''); ?> disabled selected>Selecciona...</option>
                    <option value="Masculino" <?php selected($colsexo, 'Masculino'); ?>>Masculino</option>
                    <option value="Femenino" <?php selected($colsexo, 'Femenino'); ?>>Femenino</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="colaborador_colcurp">CURP</label></th>
            <td><input type="text" id="colaborador_colcurp" name="colaborador_colcurp" value="<?php echo $colcurp; ?>" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colrfc">RFC</label></th>
            <td><input type="text" id="colaborador_colrfc" name="colaborador_colrfc" value="<?php echo $colrfc; ?>" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colnss">NSS</label></th>
            <td><input type="number" id="colaborador_colnss" name="colaborador_colnss" value="<?php echo $colnss; ?>" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colpresta" class="margin-bottom-20">Prestaciones</label></th>
            <td class="padding-bottom-20"><input type="text" id="colaborador_colpresta" name="colaborador_colpresta" value="<?php echo $colpresta; ?>" placeholder="de Ley"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colcliente">Cliente</label></th>
            <td><input type="text" id="colaborador_colcliente" name="colaborador_colcliente" value="<?php echo $colcliente; ?>" placeholder="Mazda Tláhuac"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colpuesto">Puesto</label></th>
            <td><input type="text" id="colaborador_colpuesto" name="colaborador_colpuesto" value="<?php echo $colpuesto; ?>" placeholder="Promotor"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colingreso">Fecha de Ingreso</label></th>
            <td><input type="date" id="colaborador_colingreso" name="colaborador_colingreso" value="<?php echo $colingreso; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colsueldo">Sueldo</label></th>
            <td><input type="number" id="colaborador_colsueldo" name="colaborador_colsueldo" value="<?php echo $colsueldo; ?>" placeholder="4000"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colnomina">Nómina</label></th>
            <td><input type="text" id="colaborador_colnomina" name="colaborador_colnomina" value="<?php echo $colnomina; ?>" placeholder="Quincenal"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colvence">Vencimiento de contrato</label></th>
            <td><input type="date" id="colaborador_colvence" name="colaborador_colvence" value="<?php echo $colvence; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colfirma">Fecha de firma</label></th>
            <td><input type="date" id="colaborador_colfirma" name="colaborador_colfirma" value="<?php echo $colfirma; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_coldcontrato" class="margin-bottom-20">Días de Contrato</label></th>
            <td class="padding-bottom-20"><input type="number" id="colaborador_coldcontrato" name="colaborador_coldcontrato" value="<?php echo $coldcontrato; ?>" placeholder="30"></td>
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
            <th><label for="colaborador_colncredit">No. de Credito</label></th>
            <td><input type="number" id="colaborador_colncredit" name="colaborador_colncredit" value="<?php echo $colncredit; ?>"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colvdesc">Valor de Descuento</label></th>
            <td><input type="number" id="colaborador_colvdesc" name="colaborador_colvdesc" value="<?php echo $colvdesc; ?>"></td>
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
            <th><label for="colaborador_colubicacion" class="margin-bottom-20">Ubicación</label></th>
            <td class="padding-bottom-20"><input type="text" id="colaborador_colubicacion" name="colaborador_colubicacion" value="<?php echo $colubicacion; ?>" placeholder="Ciudad de México"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colbanco">Banco</label></th>
            <td><input type="text" id="colaborador_colbanco" name="colaborador_colbanco" value="<?php echo $colbanco; ?>" placeholder="Citibanamex"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colncuenta">No. cuenta</label></th>
            <td><input type="number" id="colaborador_colncuenta" name="colaborador_colncuenta" value="<?php echo $colncuenta; ?>" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colclaveint">CLABE interbancaria</label></th>
            <td><input type="number" id="colaborador_colclaveint" name="colaborador_colclaveint" value="<?php echo $colclaveint; ?>" placeholder="Sin espacios"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colcorreo">Correo Electrónico</label></th>
            <td><input type="email" id="colaborador_colcorreo" name="colaborador_colcorreo" value="<?php echo $colcorreo; ?>" placeholder="promotor@email.com"></td>
        </tr>
        <tr>
            <th><label for="colaborador_colobserv" class="margin-bottom-20">Observaciones</label></th>
            <td class="padding-bottom-20"><textarea name="colaborador_colobserv" rows="5" placeholder="Comentarios adicionales"><?php echo $colobserv; ?></textarea></td>
        </tr>
    </table>
<?php }

add_action( 'save_post', 'colaborador_save_metas', 10, 2 );
function colaborador_save_metas( $idcolaborador, $colaborador ){
    if ( $colaborador->post_type == 'colaborador' ){
        if ( isset( $_POST['colaborador_colnumemp'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnumemp', $_POST['colaborador_colnumemp'] );
        }
        if ( isset( $_POST['colaborador_colestado'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colestado', $_POST['colaborador_colestado'] );
        }
        if ( isset( $_POST['colaborador_colrsocial'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colrsocial', $_POST['colaborador_colrsocial'] );
        }
        if ( isset( $_POST['colaborador_coldireccion'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_coldireccion', $_POST['colaborador_coldireccion'] );
        }
        if ( isset( $_POST['colaborador_colcp'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcp', $_POST['colaborador_colcp'] );
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
        if ( isset( $_POST['colaborador_colpresta'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colpresta', $_POST['colaborador_colpresta'] );
        }
        if ( isset( $_POST['colaborador_colcliente'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcliente', $_POST['colaborador_colcliente'] );
        }
        if ( isset( $_POST['colaborador_colpuesto'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colpuesto', $_POST['colaborador_colpuesto'] );
        }
        if ( isset( $_POST['colaborador_colingreso'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colingreso', $_POST['colaborador_colingreso'] );
        }
        if ( isset( $_POST['colaborador_colsueldo'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colsueldo', $_POST['colaborador_colsueldo'] );
        }
        if ( isset( $_POST['colaborador_colnomina'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colnomina', $_POST['colaborador_colnomina'] );
        }
        if ( isset( $_POST['colaborador_colvence'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colvence', $_POST['colaborador_colvence'] );
        }
        if ( isset( $_POST['colaborador_colfirma'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colfirma', $_POST['colaborador_colfirma'] );
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
        if ( isset( $_POST['colaborador_colncredit'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colncredit', $_POST['colaborador_colncredit'] );
        }
        if ( isset( $_POST['colaborador_colvdesc'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colvdesc', $_POST['colaborador_colvdesc'] );
        }
        if ( isset( $_POST['colaborador_colapriv'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colapriv', $_POST['colaborador_colapriv'] );
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
        if ( isset( $_POST['colaborador_colcorreo'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colcorreo', $_POST['colaborador_colcorreo'] );
        }
        if ( isset( $_POST['colaborador_colobserv'] ) ){
            update_post_meta( $idcolaborador, 'colaborador_colobserv', $_POST['colaborador_colobserv'] );
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
            $colfirma  	= get_post_meta( $post_id, 'colaborador_colfirma', true );
            if( $colingreso != "")
                echo "Ingreso: " . date('d/m/Y', strtotime($colingreso)) . "</br>";
            else
                echo "-</br>";
            if( $colfirma != "")
            	echo "Firma: " . date('d/m/Y', strtotime($colfirma)) . "</br>";
            else
                echo "-</br>";
            if( $colvence != "")
            	echo "Vence: " . date('d/m/Y', strtotime($colvence));
            else
                echo "-";
            break;
    }
}