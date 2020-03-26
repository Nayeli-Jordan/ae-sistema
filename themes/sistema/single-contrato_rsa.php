<?php
	get_header();
	global $post;
    
	while ( have_posts() ) : the_post(); 
	    $custom_fields  = get_post_custom();
	    $post_id        = get_the_ID();

	    $colnumemp 	= get_post_meta( $post_id, 'colaborador_colnumemp', true );
	    $colnombre 	= get_post_meta( $post_id, 'colaborador_colnombre', true );
	    $colapepat 	= get_post_meta( $post_id, 'colaborador_colapepat', true );
	    $colapemat 	= get_post_meta( $post_id, 'colaborador_colapemat', true );
	    $colrsocial = get_post_meta( $post_id, 'colaborador_colrsocial', true );
	    $colcliente = get_post_meta( $post_id, 'colaborador_colcliente', true );
	    $colestado 	= get_post_meta( $post_id, 'colaborador_colestado', true );
	    $coldcalle 	= get_post_meta( $post_id, 'colaborador_coldcalle', true );
	    $coldnum 	= get_post_meta( $post_id, 'colaborador_coldnum', true );
	    $coldcol 	= get_post_meta( $post_id, 'colaborador_coldcol', true );
	    $colddel 	= get_post_meta( $post_id, 'colaborador_colddel', true );
	    $coldest 	= get_post_meta( $post_id, 'colaborador_coldest', true );
	    $coldcp 	= get_post_meta( $post_id, 'colaborador_coldcp', true );
	    $coltel 	= get_post_meta( $post_id, 'colaborador_coltel', true );
	    $colcel 	= get_post_meta( $post_id, 'colaborador_colcel', true );
	    $collnacim 	= get_post_meta( $post_id, 'colaborador_collnacim', true );
	    $colcurp 	= get_post_meta( $post_id, 'colaborador_colcurp', true );
	    $colrfc 	= get_post_meta( $post_id, 'colaborador_colrfc', true );
	    $colnss 	= get_post_meta( $post_id, 'colaborador_colnss', true );
	    $colfnacim 	= get_post_meta( $post_id, 'colaborador_colfnacim', true );
	    $colpuesto  = get_post_meta( $post_id, 'colaborador_colpuesto', true );
	    $colpresta 	= get_post_meta( $post_id, 'colaborador_colpresta', true );
	    $colubicacion  = get_post_meta( $post_id, 'colaborador_colubicacion', true );
	    $colingreso = get_post_meta( $post_id, 'colaborador_colingreso', true );
	    $colsueldo  = get_post_meta( $post_id, 'colaborador_colsueldo', true );
	    $colsueldot = get_post_meta( $post_id, 'colaborador_colsueldot', true );
	    $colnomina  = get_post_meta( $post_id, 'colaborador_colnomina', true );
	    $colvence   = get_post_meta( $post_id, 'colaborador_colvence', true );
	    $colinicia   = get_post_meta( $post_id, 'colaborador_colinicia', true );
	    $coldcontrato = get_post_meta( $post_id, 'colaborador_coldcontrato', true );
	    $colecivil  = get_post_meta( $post_id, 'colaborador_colecivil', true );
	    $colsexo    = get_post_meta( $post_id, 'colaborador_colsexo', true );
	    $colinfonavit = get_post_meta( $post_id, 'colaborador_colinfonavit', true );
	    $colncredinf = get_post_meta( $post_id, 'colaborador_colncredinf', true );
	    $coltdesc   = get_post_meta( $post_id, 'colaborador_coltdesc', true );
	    $colfonacot   = get_post_meta( $post_id, 'colaborador_colfonacot', true );    
	    $colncredfon = get_post_meta( $post_id, 'colaborador_colncredfon', true );
	    $colpensali = get_post_meta( $post_id, 'colaborador_colpensali', true );
	    $colbanco   = get_post_meta( $post_id, 'colaborador_colbanco', true );
	    $colncuenta = get_post_meta( $post_id, 'colaborador_colncuenta', true );
	    $colclaveint = get_post_meta( $post_id, 'colaborador_colclaveint', true );
	    $colnotarjeta = get_post_meta( $post_id, 'colaborador_colnotarjeta', true );
	    $colcorreo  = get_post_meta( $post_id, 'colaborador_colcorreo', true );
	    $colvaldes  = get_post_meta( $post_id, 'colaborador_colvaldes', true );
	    $colvalcant  = get_post_meta( $post_id, 'colaborador_colvalcant', true );
	    $colapriv   = get_post_meta( $post_id, 'colaborador_colapriv', true );
	    $colpsico   = get_post_meta( $post_id, 'colaborador_colpsico', true );
	    $colcredencial = get_post_meta( $post_id, 'colaborador_colcredencial', true );
	    $colobserv  = get_post_meta( $post_id, 'colaborador_colobserv', true );
    ?>
		
		
		<article class="formato-carta">
			<div class="single_carta-head">
				<p class="titulo_carta">Contrato de <?php the_title(); ?></p>				
			</div>
			<div class="page-carta">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				
				<strong><?php if( $colnumemp != "" ): echo $colnumemp; endif; ?></strong>
				<strong><?php if( $colnombre != "" ): echo $colnombre; endif; ?></strong>
				<strong><?php if( $colapepat != "" ): echo $colapepat; endif; ?></strong>
				<strong><?php if( $colapemat != "" ): echo $colapemat; endif; ?></strong>
				<strong><?php if( $colrsocial != "" ): echo $colrsocial; endif; ?></strong>
				<strong><?php if( $colcliente != "" ): echo $colcliente; endif; ?></strong>
				<strong><?php if( $colestado != "" ): echo $colestado; endif; ?></strong>
				<strong><?php if( $coldcalle != "" ): echo $coldcalle; endif; ?></strong>
				<strong><?php if( $coldnum != "" ): echo $coldnum; endif; ?></strong>
				<strong><?php if( $coldcol != "" ): echo $coldcol; endif; ?></strong>
				<strong><?php if( $colddel != "" ): echo $colddel; endif; ?></strong>
				<strong><?php if( $coldest != "" ): echo $coldest; endif; ?></strong>
				<strong><?php if( $coldcp != "" ): echo $coldcp; endif; ?></strong>
				<strong><?php if( $coltel != "" ): echo $coltel; endif; ?></strong>
				<strong><?php if( $colcel != "" ): echo $colcel; endif; ?></strong>
				<strong><?php if( $collnacim != "" ): echo $collnacim; endif; ?></strong>
				<strong><?php if( $colcurp != "" ): echo $colcurp; endif; ?></strong>
				<strong><?php if( $colrfc != "" ): echo $colrfc; endif; ?></strong>
				<strong><?php if( $colnss != "" ): echo $colnss; endif; ?></strong>
				<strong><?php if( $colfnacim != "" ): echo $colfnacim; endif; ?></strong>
				<strong><?php if( $colpuesto != "" ): echo $colpuesto; endif; ?></strong>
				<strong><?php if( $colpresta != "" ): echo $colpresta; endif; ?></strong>
				<strong><?php if( $colubicacion != "" ): echo $colubicacion; endif; ?></strong>
				<strong><?php if( $colingreso != "" ): echo $colingreso; endif; ?></strong>
				<strong><?php if( $colsueldo != "" ): echo $colsueldo; endif; ?></strong>
				<strong><?php if( $colsueldot != "" ): echo $colsueldot; endif; ?></strong>
				<strong><?php if( $colnomina != "" ): echo $colnomina; endif; ?></strong>
				<strong><?php if( $colvence != "" ): echo $colvence; endif; ?></strong>
				<strong><?php if( $colinicia != "" ): echo $colinicia; endif; ?></strong>
				<strong><?php if( $coldcontrato != "" ): echo $coldcontrato; endif; ?></strong>
				<strong><?php if( $colecivil != "" ): echo $colecivil; endif; ?></strong>
				<strong><?php if( $colsexo != "" ): echo $colsexo; endif; ?></strong>
				<strong><?php if( $colinfonavit != "" ): echo $colinfonavit; endif; ?></strong>
				<strong><?php if( $colncredinf != "" ): echo $colncredinf; endif; ?></strong>
				<strong><?php if( $coltdesc != "" ): echo $coltdesc; endif; ?></strong>
				<strong><?php if( $colfonacot != "" ): echo $colfonacot; endif; ?></strong>
				<strong><?php if( $colncredfon != "" ): echo $colncredfon; endif; ?></strong>
				<strong><?php if( $colpensali != "" ): echo $colpensali; endif; ?></strong>
				<strong><?php if( $colbanco != "" ): echo $colbanco; endif; ?></strong>
				<strong><?php if( $colncuenta != "" ): echo $colncuenta; endif; ?></strong>
				<strong><?php if( $colclaveint != "" ): echo $colclaveint; endif; ?></strong>
				<strong><?php if( $colnotarjeta != "" ): echo $colnotarjeta; endif; ?></strong>
				<strong><?php if( $colcorreo != "" ): echo $colcorreo; endif; ?></strong>
				<strong><?php if( $colvaldes != "" ): echo $colvaldes; endif; ?></strong>
				<strong><?php if( $colvalcant != "" ): echo $colvalcant; endif; ?></strong>
				<strong><?php if( $colapriv != "" ): echo $colapriv; endif; ?></strong>
				<strong><?php if( $colpsico != "" ): echo $colpsico; endif; ?></strong>
				<strong><?php if( $colcredencial != "" ): echo $colcredencial; endif; ?></strong>
				<strong><?php if( $colobserv != "" ): echo $colobserv; endif; ?></strong>



			</div>
			<div class="page-carta">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</article>
		<div class="container text-center">
			<div id="print-page" class="btn">Imprimir</div>
		</div>

<?php 
	endwhile; // end of the loop.
	get_footer(); 
?>