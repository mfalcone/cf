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
		<?php }?>
      </section>
</div>
  <? endif ?>

<? get_sidebar() ?>
<? get_footer() ?>
