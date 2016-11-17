<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package victoriacolectiva
 */
		$fecha_inicio = get_post_meta(get_the_ID(), 'fecha_inicio', true); 
		$hora_inicio = get_post_meta(get_the_ID(), 'horario_inicio', true); 
		$fecha_fin = get_post_meta(get_the_ID(), 'fecha_fin', true); 
		$horario_fin = get_post_meta(get_the_ID(), 'horario_fin', true);

		$month = date("m",strtotime($fecha_inicio));
		$dia = date("d",strtotime($fecha_inicio));
		$meses = array("0","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	?>
<div id="page" class="agenda-single">
	<article>
			<div class="row">
			<div class="col-md-1 col-sm-2 col-xs-3">
				<div class="fecha-calendario">
					<h5><?php echo $dia; ?></h5>
					<small><?php echo $meses[$month];?></small>
				</div>
			</div>
			
			<div class="col-md-11 col-sm-10 col-xs-9">
			<h1><?php the_title(); ?></h1>
			<small>inicio: <?php echo date("d/m", strtotime($fecha_inicio));?> - <?php echo $hora_inicio;?>hs. | 
					fin:<?php echo date("d/m", strtotime($fecha_fin));?> - <?php echo $horario_fin;?>hs.</small>
			</div>
			</div>
			<div class="row">
				<?php if(has_post_thumbnail() ):?>
				<div class="col-md-4">
					<?php the_post_thumbnail( array(400)); ?>
				</div>
				<div class="col-md-8 contenido">
					<?php the_content();?>
				</div>
				<?php else:?>
				<div class="col-md-12 contenido">
					<?php the_content();?>
				</div>
				<?php endif?>
			</div>
	</article>	
</div>