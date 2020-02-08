<?php 
/*
    Plugin Name: Qindel Test
    Plugin URI: 
    Description: Plugin a media metaboxes nativos de WP
    Version: 1.0.0
    Author: Luis bernal
    Author URI: lbernal.com.ve
    Text Domain: lbernal
*/
//por seguridad para que nadien puede la que sta en esta en plugin
if(!defined('ABSPATH')) die();
function audi_get_url( $path = '' ) {
	if( !defined('qindel_url') ) {
		define( 'qindel_url', '/wp-content/plugins/qindel/' );
	}
	return qindel_url . $path;
}

function crear_cpt_audi(){
	$labels = array(
		'name'               => __( 'audi', 'qindel' ),
		'singular_name'      => __( 'audi', 'qindel' ),
		'add_new'            => _x( 'Agrega nueva audi', 'qindel', 'qindel' ),
		'add_new_item'       => __( 'Añade audi', 'qindel' ),
		'edit_item'          => __( 'Edita audi', 'qindel' ),
		'new_item'           => __( 'Nueva audi', 'qindel' ),
		'view_item'          => __( 'Mirar audi', 'qindel' ),
		'search_items'       => __( 'Buscar audis', 'qindel' ),
		'not_found'          => __( 'audi no encontrada', 'qindel' ),
		'not_found_in_trash' => __( 'audi no encontrada en la Basura', 'qindel' ),
		'parent_item_colon'  => __( 'Parent audi:', 'qindel' ),
		'menu_name'          => __( 'Audis', 'qindel' ),
	);
	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           =>'dashicons-clipboard',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'page',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
			'page-attributes',
			'post-formats',
		),
	);
	register_post_type( 'audi', $args );
}
add_action( 'init', 'crear_cpt_audi',0 );

function estado_finanzas_taxonomia(){
	$labels = array(
		'name'             => _x('Estado de finanzas','taxonomia general name '),
		'singular_name'    => _x('Estado de finanzas' ,'taxonomia singular name'),
		'search_items'     => __('Buscar Horario', 'Audi' ),		
		'all_items' 	   => __('Todos los Estado de finanzas'),
		'parent_item' 	   => __('Estado de finanzas  padre'),
		'parent_item_colon'=> __('Estado de finanzas padre'),
		'edit_item'		   => __('Editar Estado de finanzas'),
		'update_item'      => __('Actualizar Estado de finanzas'),
		'add_new_item'     => __('Agregar Estado de finanzas'),
		'new_item_name'    => __('Nuevo Estado de finanzas'),
		'menu_name'        => __('Estado de finanzas'),
	);
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'estado-finanzas') 
	);

	register_taxonomy('estado-finanzas', array('audi'), $args);
}
add_action( 'init', 'estado_finanzas_taxonomia' );

function audi_agregar_metaboxes(){
	add_meta_box('audi-metaxobox','Componentes Audi Metaboxes','audi_diseno_metaboxes','audi','normal','high', null );
}
add_action( 'add_meta_boxes','audi_agregar_metaboxes');

function audi_update_metabox($post_id, $post, $update){

	$url_img_metabox = "";
	$coloraudi = "";
	$alquiler = "";
	$taza = "";
	$credito = "";

	if (isset($_POST['url_img_metabox'])) {
		$input_metabox = $_POST['url_img_metabox'];
	}
	update_post_meta($post_id, 'url_img_metabox', $input_metabox );

	if (isset($_POST['coloraudi'])) {
		$color_audi = $_POST['coloraudi'];
	}
	update_post_meta($post_id, 'coloraudi', $color_audi );

	if (isset($_POST['alquiler'])) {
		$alquiler_audi = $_POST['alquiler'];
	}
	update_post_meta($post_id, 'alquiler', $alquiler_audi );

	if (isset($_POST['taza'])) {
		$taza_audi = $_POST['taza'];
	}
	update_post_meta($post_id, 'taza', $taza_audi );


	if (isset($_POST['credit'])) {
		$credit_audi = $_POST['credit'];
	}
	update_post_meta($post_id, 'credit', $credit_audi );
}
add_action('save_post','audi_update_metabox', 10, 3);

function audi_diseno_metaboxes ($post){ 
?> 
	<div style="display: flex; flex-direction: column; width: 50%;">
		<label for="url_img_metabox">Imagen Hero / Ingresa Url</label>
		<input type="text" name="url_img_metabox" value="<?php echo get_post_meta( $post->ID, 'url_img_metabox', true) ?>"	>
		<br>
		<label for="coloraudi">Color border hero</label>
		<input type="text" name="coloraudi" value="<?php echo get_post_meta( $post->ID, 'coloraudi', true) ?>"	>
		<br>
	</div>
	<div style="display: flex; flex-direction: column; width: 25%">
		<h1>Cuentas</h1>
		<label for="alquiler">Alquiler Mensual</label>
		<input type="text" name="alquiler" value="<?php echo get_post_meta( $post->ID, 'alquiler', true )?>"	>
		<br>
		<label for="taza">Taza</label>
		<input type="text" name="taza" value="<?php echo get_post_meta( $post->ID, 'taza', true )?>"	>
		<br>
		<label for="credit">Credit Audi</label>
		<input type="text" name="credit" value="<?php echo get_post_meta( $post->ID, 'credit', true )?>"	>
		<br>
	</div>
<?php
}

function audi_view(){
	$args = array(
		'post_type' => 'audi',
		'posts_per_page' => 1
	);

	$autoaudi = new WP_Query($args);

	while($autoaudi->have_posts()): $autoaudi->the_post();
		$img_hero = get_post_meta( get_the_id(), 'url_img_metabox',true );
		$color =    get_post_meta( get_the_id(), 'coloraudi',true );
		$alquiler = get_post_meta( get_the_id(), 'alquiler', true );
		$tazas    = get_post_meta( get_the_id(), 'taza', true);
		$creditos = get_post_meta( get_the_id(), 'credit', true);
		include 'qindel.css';
		?> 
		<header class="hero" style="background-image: url('<?php echo $img_hero; ?>'); border-bottom: 10px solid <?php echo $color; ?>;"> 	
			<div class="contenedor">
				<div class="hero1">
					<h1 class="titleaudi"><?php the_title(); ?></h1>
					<h2 class="sutitleaudi"><?php the_content(); ?></h2>
					<button class="btn_audi"> Saber mas </button>
				</div>
				<div class="hero2">
					<p class="txt_audi">* Consultar Condiciones</p>
					<img src="<?php echo audi_get_url('imagen/Recurso 2.png'); ?>" class="imgaudi" alt="">
				</div>
			</div>
		</header>
		<div class="diff">
			<p class="titlecoche"><?php the_title(); ?></p>
			<p>queee<?php the_content(); ?></p>
		</div>
		<div class="diff">
			<div class="cuentas">
				<!-- repear -->
				<ul class="cuenta">
					<li>Alquila por</li>
					<li class="item"><?php echo $alquiler; ?></li>
					<li>al mes</li>
				</ul>

				<ul class="cuenta">
					<li>Alquila por</li>
					<li class="item"><?php echo  $tazas ?></li>
					<li>por hasta 48 meses</li>
				</ul>
				<ul class="cuenta">
					<li>Con un maximo de</li>
					<li class="item"><?php  echo $creditos ?></li>
					<li>Audi Credit</li>
				</ul>
			</div>
			<div class="complemento">
				<h3>recibe 3 pagos de arrendamiento complementarios,*</h3>
			</div>
			<div class="logoaudi">
				<img src="<?php echo audi_get_url('imagen/Recurso 1.png'); ?>" />
			</div>
		</div>
	<?php
	endwhile;
	wp_reset_query();


}  

function mostrarfinalaudio() {
	return audi_view();
}
add_shortcode( 'ftaview', 'mostrarfinalaudio' );


?>

