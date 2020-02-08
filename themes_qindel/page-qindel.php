<?php get_header('onlyhead'); //Template Name: Front-page-Audi 
	$imagen_hero = get_field( 'imagen_hero' ); 
	$imagen_hero2 = get_field( 'imagen_hero2' ); 
?>
<header class="hero" style="background-image: url('<?php echo $imagen_hero['url'] ?>'); border-bottom: 10px solid <?php the_field( 'color_line_banner' ); ?> ;"> 		
	<div class="contenedor">
		<div class="hero1">
			<h1 class="titleaudi">Nuevo Audi A3</h1>
			<h2 class="sutitleaudi">por 150/Mes* + IVA</h2>
			<button class="btn_audi"> saber mas </button>
		</div>
		<div class="hero2">
			<p class="txt_audi">* Consultar Condiciones</p>
			<img src="<?php echo $imagen_hero2['url'] ?>" class="imgaudi" alt="">
		</div>
	</div>
</header>

<div class="diff">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<p class="titlecoche"><?php the_title(); ?></p>
		<p><?php the_content(); ?></p>
	<?php endwhile; endif; ?>
</div>


<div class="diff">
	<div class="cuentas">

				<?php
				if( have_rows('cuenta_coche') ):
				    while ( have_rows('cuenta_coche') ) : the_row(); ?>
						<ul class="cuenta">
							<li><?php the_sub_field('cuenta_descripcion');  ?></li>
							<li class="item"><?php the_sub_field('cuenta_numero');  ?></li>
							<li>Sujeto a cambio*</li>
						</ul>		
				<?php    
				    endwhile;
				else :
				endif;
				?>



	</div>

	<div class="complemento">
		<h3>recibe 3 pagos de arrendamiento complementarios,*</h3>
	</div>

	<div class="logoaudi">
		<img src="<?php the_field( 'logo_audi' ); ?>">
	</div>

</div>


