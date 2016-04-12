<?php /* Template Name:Calculadora */ 

get_header(); 

$thumbID = get_post_thumbnail_id( $post->ID );
$imgDestacada = wp_get_attachment_url( $thumbID );

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=667685589998815";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/calculadora.css" media="screen" />

<section id="main-calculadora" class="blog">
	<header class="blog" style="background-image:url(<?php echo $imgDestacada?>)">
		<hgroup>
		<h1 class="title"><?php the_title(); // Display the title of the post ?></h1>
		<h2><?php echo get_post_meta($post->ID, 'Extracto', true); ?> </h2>
		</hgroup>

	</header>
	<article class="post">
		<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				?>

						
						<div class="the-content-calculadora">
							<?php the_content(); ?>
							
						</div><!-- the-content -->
						
						
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
				
			


			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
					<h1 class="404">No hay nada</h1>
			
			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
		<dl class="main-calculadora">
			<dt>¿Cuánto pagabas por tu factura de la EPE en 2015?</dt>
			<dd>
				<input id="user_enter" type="number">
				<input type="button" id="user_enter_bt" value="calcular">
				<input type="text" placeholder="Primer Aumento" id="primer_aumento" disabled="disabled">
				<input type="text" placeholder="Segundo Aumento" id="segundo_aumento" disabled="disabled">
			</dd>
			<dt>¿Querés hacer el cálculo a partir de los Kilowatts consumidos?</dt>
			<dd>
				<input type="number" id="userkw">
				<input type="button" id="user_enter_kw"  value="calcular">
			</dd>
		</dl>
		<div class="resultados" style="display:none;">
			<h2>Resultados</h2>

			<table>
				<tr>
					<th class="tit_tabla">Información</th>
					<th>Primer aumento</th>
					<th>Segundo aumento</th>
				</tr>
				<tr>
					<td class="tit_tabla">Basico:</td>
					<td class="basico-diciembre"></td>
					<td class="basico-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">Ley 6604:</td>
					<td class="Ley_6604-diciembre"></td>
					<td class="Ley_6604-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">Ley 23681:</td>
					<td class="Ley_23681-diciembre"></td>
					<td class="Ley_23681-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">OM 1592/62:</td>
					<td class="OM_1592__62-diciembre"></td>
					<td class="OM_1592__62-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">OM 1618/62:</td>
					<td class="OM_1618__62-diciembre"></td>
					<td class="OM_1618__62-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">Ley 7797:</td>
					<td class="Ley_7797-diciembre"></td>
					<td class="Ley_7797-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">CAP:</td>
					<td class="CAP-diciembre"></td>
					<td class="CAP-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">IVA:</td>
					<td class="IVA-diciembre"></td>
					<td class="IVA-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">Ley 12692:</td>
					<td class="Ley_12692-diciembre"></td>
					<td class="Ley_12692-marzo"></td>
				</tr>
				<tr>
					<td class="tit_tabla">final:</td>
					<td class="final-diciembre"></td>
					<td class="final-marzo"></td>
				</tr>
			</table>
			
		</div>
		<p class="disclaimer">
			El valor calculado es aproximado y puede diferir de la factura real. El aumento de las tarifas de la EPE fue hecho en dos tramos, <a href="http://www.epe.santafe.gov.ar/fileadmin/archivos/Comercial/Clientes/Cuadro_Tarifario_Diciembre_2015.PDF" target="_blank">diciembre</a> y <a href="http://www.epe.santafe.gov.ar/fileadmin/archivos/Comercial/Clientes/Cuadro_Tarifario_Marzo_2016.PDF" target="_blank">marzo</a> (comparar con <a href="http://www.epe.santafe.gov.ar/fileadmin/archivos/Comercial/Clientes/Cuadro_Tarifario_Marzo_2015.PDF" target="_blank">2015</a>), por lo que el segundo aumento se podrá ver en las facturas de abril y mayo de 2016. La factura domiciliaria es bimestral y puede incluir más de un esquema tarifario. La tarifa que se usó para este cálculo es la de uso residencial (Tarifa 1301), considerada la más representativa y no se considera la posibilidad una tarifa menor por ahorro en el consumo energético respecto del año anterior, así como tampoco se consideran las variables debidas a aumentos de consumo que cambian el esquema tarifario, etc. El valor de la Cuota de Alumbrado Público (CAP) es un valor promedio y no refleja exactamente el de los cuadros tarifarios respectivos. El valor fijo de la Ley 12692 de Biocombustibles es aproximado. En el cálculo inverso a partir del precio pagado puede haber diferencias de redondeo. En ningún caso este cálculo reemplaza al valor de la factura calculado por la propia EPE.
		</p>

		<div class="fb-like" data-href="http://ciudadfutura.com.ar/apagon14a/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>

	</article>
</section>

<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/calculadora.js"></script>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>