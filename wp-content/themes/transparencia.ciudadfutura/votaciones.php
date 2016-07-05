<?php function votaciones($postid,$afavor,$encontra,$abstensiones){ 
return <<<HTML
    <div class="votaciones">
	    <svg version="1.1" id="sfv-{$postid}" x="0px" y="0px" width="547px" height="424px" viewBox="0 0 547 424">
			<circle cx="23.695" cy="398.999" r="23.695" id="c-{$postid}-0"/>
			<circle cx="139.475" cy="396.472" r="23.695" id="c-{$postid}-1"/>
			<circle cx="24.7" cy="333.929" r="23.695" id="c-{$postid}-2"/>
			<circle cx="139.475" cy="325.035" r="23.695" id="c-{$postid}-3"/>
			<circle cx="27.115" cy="270.486" r="23.695" id="c-{$postid}-4"/>
			<circle cx="139.475" cy="257.82" r="23.695" id="c-{$postid}-5"/>
			<circle cx="35.524" cy="206.612" r="23.695" id="c-{$postid}-6"/>
			<circle cx="157.486" cy="190.605" r="23.695" id="c-{$postid}-7"/>
			<circle cx="57.524" cy="146.612" r="23.695" id="c-{$postid}-8"/>
			<circle cx="99.398" cy="95.979" r="23.696" id="c-{$postid}-9"/>
			<circle cx="150.511" cy="56.759" r="23.695" id="c-{$postid}-10"/>
			<circle cx="206.69" cy="141.4" r="23.695" id="c-{$postid}-11"/>
			<circle cx="210.031" cy="32.105" r="23.694" id="c-{$postid}-12"/>
			<circle cx="273.906" cy="123.389" r="23.696" id="c-{$postid}-13"/>
			<circle cx="274.696" cy="23.696" r="23.696" id="c-{$postid}-14"/>
			<circle  cx="337.772" cy="32.105" r="23.695" id="c-{$postid}-15"/>
			<circle cx="341.122" cy="141.399" r="23.695" id="c-{$postid}-16"/>
			<circle  cx="397.293" cy="56.759" r="23.696" id="c-{$postid}-17"/>
			<circle cx="390.327" cy="190.605" r="23.695" id="c-{$postid}-18"/>
			<circle cx="447.327" cy="93.605" r="23.695" id="c-{$postid}-19"/>
			<circle cx="485.327" cy="144.605" r="23.695" id="c-{$postid}-20"/>
			<circle cx="507.327" cy="206.605" r="23.695" id="c-{$postid}-21"/>
			<circle cx="411.327" cy="258.605" r="23.695" id="c-{$postid}-22"/>
			<circle cx="518.327" cy="270.605" r="23.695" id="c-{$postid}-23"/>
			<circle cx="415.327" cy="326.605" r="23.695" id="c-{$postid}-24"/>
			<circle  cx="522.777" cy="333.923" r="23.696" id="c-{$postid}-25"/>
			<circle  cx="414.025" cy="396.472" r="23.695" id="c-{$postid}-26"/>
			<circle  cx="522.777" cy="396.472" r="23.695" id="c-{$postid}-27"/>
		</svg>
		<dl>
			<dt class="aprobados">A favor:</dt>
			<dd>{$afavor}</dd>
			<dt class="rechazados">En contra:</dt>
			<dd>{$encontra}</dd>
			<dt class="abstenciones">Abstenciones:</dt>
			<dd>{$abstensiones}</dd>
		</dl>
	</div>
    <script type="text/javascript">

    	 
    	 var aprobados = {$afavor};
    	 var encontra = {$encontra};
    	 var abstensiones = {$abstensiones};
    	 for (var i = 0; i < aprobados; i++) {
	    	 d3.select("#c-{$postid}-"+i).attr("fill","#179338")
    	 }
    	 for(var x = i; x < encontra + aprobados; x++ ){
    	 	 d3.select("#c-{$postid}-"+x).attr("fill","#C32024")
    	 }

    	 for(var z = x; z < encontra + aprobados + abstensiones; z++ ){
    	 	 d3.select("#c-{$postid}-"+z).attr("fill","#666666")
    	 }
    	 
    </script>
HTML;
}
