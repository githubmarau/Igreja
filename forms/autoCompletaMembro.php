<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/autocomplete.css">
<script type="text/javascript">
$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular,igreja ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#igreja").val(igreja);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autoMembroCargos.php?q=" + this.value;
	});

});
</script>
<!-- Desenvolvido por Wellington Ribeiro -->
<table class="table">
	<tbody>
		<tr>
			<td colspan="3"><label>Nome:</label>
				<input type="text" name="nome" id="campo_estado" size="40%" class="form-control" autofocus="autofocus" />
				<input type="hidden" name="escolha" value="adm/rest_busca.php">
			</td><td><label>Igreja</label>
			<input type="text" disabled="disabled" class="form-control" name="igreja" value="">
			</td>
		</tr>
		<tr>
			<td colspan="2">Endere�o:<br />
			<input type="text" id="estado_val" class="btn btn-default btn-sm" name="estado" disabled="disabled" value="" size="30%" />
			</td>
			<td>Fone: <br />
			<input type="text" id="id_val" name="id" class="btn btn-default btn-sm" disabled="disabled" value="" /></td>
			<td>Celular:<br />
			<input type="text" id="sigla_val" class="btn btn-default btn-sm" name="sigla" disabled="disabled" value="" /></td>
	</tbody>
</table>


	
	
	
