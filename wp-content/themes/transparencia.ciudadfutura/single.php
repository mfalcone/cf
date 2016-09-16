<? get_header() ?>

  <? if ( have_posts() ) : the_post() ?>


<div class="container">
    
      <section class="article_content" itemprop="description">
      	<?php 
			if ($post->post_type == "respuesta") {
				$nota = get_post_meta(get_the_ID(), '_nota', true); 
				$fecha_respuesta = get_post_meta(get_the_ID(), '_fecha_respuesta', true);
				$categoria = get_post_meta(get_the_ID(), '_categoria', true);
			    $desarrollo = get_post_meta(get_the_ID(), '_desarrollo', true);
			    $concepto = get_post_meta(get_the_ID(), '_concepto', true);
				
				$categorias = explode(",", $categoria);
				//print_r($categorias);
		?>

			<article class="respuesta">
			<h1><?php the_title() ?></h1>
				<dl class="encabezado">
					<dt>Fecha de publicación:</dt>
					<dd><?php echo date("d/m/Y", strtotime($fecha_respuesta));?></dd>
					<dt>Nota:</dt>
					<dd><?php echo $nota;?></dd>
					<dt>Concepto:</dt>
					<dd><?php echo $concepto;?></dd>
				</dl>
				<p class="categoria">
				<?php foreach ($categorias as $cat){?>
						<span class="cat <?php echo strtolower($cat); ?>"> <?php echo $cat; ?></span>
				<?php }?>	
				</p>
				<div><?php echo wpautop($desarrollo,true);?></div>
				
			</article>
		<?php }else if($post->post_type == "votaciones"){
			$fecha = get_post_meta(get_the_ID(), '_fecha_votaciones', true); 
			$video = get_post_meta(get_the_ID(), 'videos_votaciones', true); 
			$totalafavor = get_post_meta(get_the_ID(), 'totalafavor', true); 
			$totalencontra = get_post_meta(get_the_ID(), 'totalencontra', true); 
			$totalabstencion = get_post_meta(get_the_ID(), 'totalabstencion', true); 
			$totalausente = get_post_meta(get_the_ID(), 'totalausente', true); 
			$concejales_totales = get_post_meta(get_the_ID(), 'concejales_totales', true); 
			if($totalafavor == ""){
				$totalafavor = "0";
			}
			if($totalencontra == ""){
				$totalencontra = "0";
			}
			if($totalabstencion == ""){
				$totalabstencion = "0";
			}
			if($totalausente == ""){
				$totalausente = "0";
			}
			?>
			
			<article class="votacion">
				
				<h1><span class="date"><?php echo date("d-m-Y", strtotime($fecha)); ?></span> <?php the_title();?></h1>
				<div class="content">
					<?php the_content(); ?>
				</div>
				<div class="video-wrapper">
					
					<?php 
					if($video){
						$strToEmbed = explode("?v=",$video);
						$iframeurl = "https://www.youtube.com/embed/".$strToEmbed[1];
					?>
					<iframe src="<?php echo $iframeurl; ?>" width="100%" height="350" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
					<?php }else{?>
						
						<img src="<?php bloginfo('template_directory'); ?>/img/taquigrafica.jpg" />

					<?php }?>

				</div>

				<?php echo do_shortcode('[votaciones afavor="'.$totalafavor.'" encontra="'.$totalencontra.'" abstenciones="'.$totalabstencion.'" ausentes="'.$totalausente.'"]') ?>

				<?php
				 //echo $concejales_totales;

				$obj=json_decode($concejales_totales);
				$afavor = array();
				$encontra = array();
				$abstencion = array();
				$ausente = array();

				//print_r($obj[0]->valor);
				foreach($obj as $votacion){
						if($votacion->valor=="afavor"){
							array_push($afavor,$votacion);
						}else if($votacion->valor=="encontra"){
							array_push($encontra,$votacion);
						}else if($votacion->valor=="abstencion"){
							array_push($abstencion,$votacion);
						}else if($votacion->valor=="ausente"){
							array_push($ausente,$votacion);
						};
					}
				?>
				
				<div class="tablas">
					<div class="afavor col-md-3">
						<h2>A favor</h2>
						<ul>
							<?php foreach ($afavor as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
					<div class="encontra  col-md-3">
						<h2>En Contra</h2>
						<ul>
							<?php foreach ($encontra as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
					<div class="abstencion  col-md-3">
						<h2>Abstención</h2>
						<ul>
							<?php foreach ($abstencion as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
					<div class="ausente  col-md-3">
						<h2>Ausentes</h2>
						<ul>
							<?php foreach ($ausente as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
				</div>

			</article>



		<?php }?>

      </section>
</div>
  <? endif ?>

<? get_sidebar() ?>
<? get_footer() ?>
