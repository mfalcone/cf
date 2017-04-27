<? get_header() ?>
		<div class="container">
			<div class="col-md-12 main-texto texto-cabecera">
					<h1>
								Transparencia
					</h1>
					<h2>¿Querés saber como se financia un partido político?</h2>

			</div>

		</div>
 <style type="text/css">
	
		.slice path {
		  stroke: #fff;
		}
</style>

<div class="container nuevo-graf">
	<div class="col-md-4 col-sm-5">
		<h2>2016</h2>
		<h3>
			gastos<br>
			inversiones
		</h3>
		
	</div>
	<div class="col-md-7 col-sm-6">
		<h4>
			POR QUE NOSTROS PODEMOS,<br>
			TE MOSTRAMOS TODOS NUESTROS NÚMEROS. <br>
			ACÁ NO HAY NADA QUE OCULTAR.
		</h4>
	</div>
</div>
<div class="container full-graph">
	<div id="graph-container" class="col-md-9">
		
	</div>
	<script type="text/javascript">

				if(jQuery(window).width()>450){
					var w = 650;
					var h = 650;
					var r = 320;	
				}else{
					var w = 310;
					var h = 310;
					var r = 130;
				}

													//allo 
					color = ["#3C3C3B", "#575756", "#6F6F6E", "#878786", "#9D9C9C", "#B2B2B1", "#C6C6C5","#DADAD9","#BE1621"];//d3.scale.category20c();     //builtin range of colors
					
					data=[
						{"value":12},
						{"value":7},
						{"value":6},
						{"value":5},
						{"value":5},
						{"value":4},
						{"value":2},
						{"value":2},
						{"value":57},
						]


					curAngle = 165;
					var vis = d3.select("#graph-container")
						.append("svg:svg")              //create the SVG element inside the <body>
						.data([data])                   //associate our data with the document
							.attr("width", w)           //set the width and height of our visualization (these will be attributes of the <svg> tag
							.attr("height", h)
						.append("svg:g")                //make a group to hold our pie chart
							.attr("transform", "translate(" + r + "," + r + ")"+
							"rotate(" + curAngle + ")"
							)    //move the center of the pie chart from 0, 0 to radius, radius
					var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
						.outerRadius(r)
						.innerRadius(r-150);
					var pie = d3.layout.pie()           //this will create arc data for us given a list of values
						.value(function(d) { return d.value; });    //we must tell it out to access the value of each element in our data array
					var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
						.data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
						.enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
							.append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
								.attr("class", "slice");    //allow us to style things in the slices (like text)
						arcs.append("svg:path")
								.attr("fill", function(d, i) { return color[i]; } ) //set the color for each slice to be chosen from the color function defined above
								.attr("d", arc);                                    //this creates the actual SVG path using the associated data (pie) with the arc drawing function
						arcs.append("svg:text")                                     //add a label to each slice
								.attr("transform", function(d) {                    //set the label's origin to the center of the arc
								//we have to make sure to set these before calling arc.centroid
								d.innerRadius = 0;
								d.outerRadius = r;
								return "translate(" + arc.centroid(d) + ")";        //this gives us a pair of coordinates like [50, 50]
							})
							.attr("text-anchor", "middle")                          //center the text on it's origin
							;        //get the label from our original data array
						
					</script>

		<div class="col-md-3">
			<div class="itemgraph" id="item1">
				<h2>12%</h2>
				<h3>EQUIPAMIENTO Y BIENES DURABLES</h3>
				<h4>724.616$</h4>
				<div class="exp">
					En Ciudad Futura cambiamos el pagar para que lo hagan, por el saber y poder hacerlo. Por eso es transversal a nuestro instrumento político la adquisición y gestión social de los recursos y los medios de producción.
				</div>
			</div>
			<div class="itemgraph" id="item2">
				<h2>6%</h2>
				<h3>ASAMBLEAS ACTOS Y MOVILIZACIONES</h3>
				<h4>381.470$</h4>
				<div class="exp">
					Porque nuestro instrumento político es producto de las luchas de los movimientos sociales que lo hicieron nacer, movimientos sostenidos en la horizontalidad y la democracia directa. Hoy siendo cientos de hombres y mujeres comprometidos en la construcción de la Ciudad Futura, estos pilares siguen intactos, por eso destinamos parte importante de nuestros ingresos a la organización de asambleas, actos y movilizaciones donde nos encontramos todos y todas para debatir y tomar decisiones, y para seguir convidando este proyecto político.
				</div>
			</div>
			<div class="itemgraph" id="item3">
				<h2>6%</h2>
				<h3>FUNCIONAMIENTO EQUIPO CONCEJO</h3>
				<h4>351.128$</h4>
				<div class="exp">
					La producción de políticas públicas y el trabajo legislativo se desarrolla principalmente en un espacio alquilado por el instrumento político, a fin de que los equipos Ciudad Futura cuenten con los recursos necesarios para dicha tarea, como así también con un ámbito que permita y promueva el trabajo creativo y colaborativo.
				</div>
			</div>
			<div class="itemgraph" id="item4">
				<h2>5%</h2>
				<h3>FORTALECIMIENTO PROYECTOS ESTRATÉGICOS</h3>
				<h4>311.800$</h4>
				<div class="exp">
					Si bien todos los proyectos son autogestivos y se sostienen con recursos propios generados a través del trabajo y la producción, o gestionados a través de programas públicos específicos, desde Ciudad Futura ponemos a disposición las Fiestas Rojas que una vez por mes se realizan en Distrito Sie7e. Las mismas que nos permitieron sostener las campañas de 2015, hoy son una herramienta de los proyectos prefigurativos para consolidar, fortalecer y seguir generando retazos de la Ciudad Futura hoy: para cambiar el mobiliario de la Ética, para terminar el salón del Bachi, para instalar una nueva paila dulcera en el Tambo La Resistencia, para mejorar la acústica del D7, para sumar instalaciones a la entrega de la Misión Antiinflación, para publicar los contenidos generados en la Universidad del Hacer, y acercar el conocimiento a los hombres y mujeres comunes.
				</div>
			</div>
			<div class="itemgraph" id="item5">
				<h2>5%</h2>
				<h3>COMUNICACIÓN Y PUBLICIDAD</h3>
				<h4>303.840$</h4>
				<div class="exp">
					Para que la política sea un asunto de todos, hay que llegar e involucrar a todos. En Ciudad Futura apostamos a una variedad de medios y soportes de comunicación para dar a conocer nuestras ideas y prácticas, como así también para sumar los aportes de la gente.
				</div>
			</div>
			<div class="itemgraph" id="item6">
				<h2>4%</h2>
				<h3>FORMACIÓN E INTERCAMBIO</h3>
				<h4>227.048$</h4>
				<div class="exp">
					Porque no somos los únicos ni fuimos los primeros en organizarnos para construir una sociedad mejor, en Ciudad Futura destinamos parte de nuestros recursos para el intercambio con otras experiencias y realidades, la formación técnica- política y la producción colectiva de conocimientos y herramientas de intervención.
				</div>
			</div>
			<div class="itemgraph" id="item7">
				<h2>3%</h2>
				<h3>APOYO TERRITORIAL</h3>
				<h4>142.640$</h4>
				<div class="exp">
					Uno de los principales objetivos del instrumento político radica en profundizar la organización de la gente común y promover la iniciativa política de los territorios. Es por eso que a la principal herramienta con la que cuentan las seccionales: la palabra y la comunicación, se suma un presupuesto específico de apoyo a la organización. El objetivo es garantizar el funcionamiento del día a día y fortalecer las iniciativas de cada territorio.
				</div>
			</div>
			<div class="itemgraph" id="item8">
				<h2>2%</h2>
				<h3>ADMINISTRACIÓN</h3>
				<h4>96.280$</h4>
				<div class="exp">
					Los gastos de la administración legal y contable de la gestión de todos estos recursos, representan el 2% del Presupuesto Anual del Instrumento Político, en concepto de certificaciones, gastos bancarios, software de gestión, etc. Las #CuentasClaras para rendir anualmente al Tribunal Electoral y todos los días a la gente que confía.
				</div>
			</div>
			<div class="itemgraph" id="item9">
				<div class="col-md-">
				<h2>57%</h2>
				<h3>FONDO CAMPAÑAS FUTURAS</h3>
				<h4>3.355.261$</h4>
				<div class="exp">
					El instrumento político destina parte de sus ingresos anuales a un plazo fijo bajo la titularidad de las autoridades partidarias, a fin de crear un fondo que garantice el financiamiento de las futuras campañas electorales.
				</div>
				</div>
				<div class="col-md- equal">
					<h3>=</h3>
				</div>
				<div class="col-md-">
				<h3>AUTONOMÍA POLÍTICA</h3>
				<h4 class="sec">NO DEBERLE NADA A NADIE</h4>
				</div>
			</div>
		</div>

		
</div>
<div class="container">
<a href="http://transparencia.ciudadfutura.com.ar/presupuesto-anual/" class="presupuesto16">
			<h3>¿CÓMO FUE POSIBLE ESTE FONDO?</h3>
			<h2>DONACIONES</h2>
			<h4>ver presupuesto <span>2016</span></h4>
		</a>
</div>

<script type="text/javascript">
	$(".itemgraph h3").mouseenter(function(){
		$(this).parent().find(".exp").show();
	}).mouseleave(function(){
		$(this).parent().find(".exp").hide();
	})
</script>
<? get_footer() ?>