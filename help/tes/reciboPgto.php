<?php
//Limpa as vari�veis
$ministerio = '';$tesoureiro = '';$auxilio = '';$zeladores = '';$sexta = '';$demaisPgto = '';$rec_tipo=false;

if ($_POST['referente']!='' && $_POST['grupo']>'0' && $_POST['grupo']<'9') {
	//Verifica click duplo no form de criar recibos
	if ((check_transid($_POST["transid"]) || $_POST["transid"]<1)) {
		//houve click duplo no form
		$gerarPgto = true;
	}else {
		//N�o houve click duplo no form
		$gerarPgto = false;
		//Grava no banco codigo de autoriza��o para o novo recibo
		add_transid($_POST["transid"]);
		//script que orienta a cria��o dos recibos
		$gerar = 'help/tes/gerarRecGrupo.php';
		require_once 'help/tes/definirRecGrupo.php';
	}
}
$dia1 ='';$dia15 ='';$diaOutros ='';
$cor=true;$cor1=true;$cor2=true;
foreach ($listaPgto as $chave => $valor) {

	$referente = $_POST['referente'].' - '.$valor['nomeFunc'];
	$bgcolor = $cor ? 'class="dados"' : 'class="odd"';
	$bgcolor1 = $cor1 ? 'class="dados"' : 'class="odd"';
	$bgcolor2 = $cor2 ? 'class="dados"' : 'class="odd"';
	$bgcolor3 = $cor3 ? 'class="dados"' : 'class="odd"';
	$bgcolor4 = $cor4 ? 'class="dados"' : 'class="odd"';
	$bgcolor5 = $cor5 ? 'class="dados"' : 'class="odd"';
	$bgcolor6 = $cor6 ? 'class="dados"' : 'class="odd"';
	$bgcolor7 = $cor7 ? 'class="dados"' : 'class="odd"';

	if (!empty($_POST['grupo']) && $valor['pgto']=='0') {
		$vlrPgto = false;
	}else {
		$vlrPgto = true;
	}

	$pgto	= ($valor['pgto']>'0') ? $valor['pgto']:'<span class="btn btn-success btn-xs">Volunt�rio</span>';

	$nomeMembro = ($valor['nome']=='') ? $valor['naoMembro']:$valor['nome'];
  	$nomeDiaPgto = $valor['diapgto'];

	$remove = '<a href="./?#" title="Remover!"> <span class="glyphicon glyphicon-remove"> </span></a>';
	$nomeMembro = sprintf ("%s %'05u - %s ",$remove,$valor['rolMembro'],$nomeMembro);

	if (($valor['descricao']=='1' || $valor['descricao']=='17' )&& $vlrPgto) {
		//Lista do Minist�rio
		$dia1 .='<tr '.$bgcolor.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor = !$cor;
		$totMinisterio += $valor['pgto'];
		//Cadastra o recibo
		if ($ministerio!='') {
			require $gerar;
			require $ministerio;
		}
	}elseif ($valor['descricao']=='8' && $vlrPgto){
		//Lista dos Tesoureiros
		$dia15 .='<tr '.$bgcolor1.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor1 = !$cor1;
		$totTesoureiro += $valor['pgto'];
		//Cadastra o recibo
		if ($tesoureiro!='') {
			require $gerar;
			require $tesoureiro;
		}
	}elseif ($valor['descricao']=='12' && $vlrPgto) {
		//Lista dos Zeladores
		$diaZelador .='<tr '.$bgcolor2.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor2 = !$cor2;
		$totZelador += $valor['pgto'];
		//Cadastra o recibo
		if ($zeladores!='') {
			require $gerar;
			require $zeladores;
		}
	}elseif ($valor['descricao']=='14' && $vlrPgto) {
		//Lista dos Auxilios
		$diaAux .='<tr '.$bgcolor3.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor3 = !$cor3;
		$totAuxilio += $valor['pgto'];
		//Cadastra o recibo
		if ($auxilio!='') {
			require $gerar;
			require $auxilio;
		}
	}elseif ($valor['diapgto']=='661' && $vlrPgto) {
		//Pgto's as Sexta
		$diaSexta .='<tr '.$bgcolor5.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">Sexta</td></tr>';
		$cor5 = !$cor5;
		$totSexta += $valor['pgto'];
		//Cadastra o recibo
		if ($sextaFeira!='') {
			require $gerar;
			require $sextaFeira;
		}
	}elseif ($valor['diapgto']=='615' && $vlrPgto) {
		//Pgto's da Quinzena
		$diaQuinza .='<tr '.$bgcolor6.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">Quinzenal</td></tr>';
		$cor6 = !$cor6;
		$totQuinza += $valor['pgto'];
		//Cadastra o recibo
		if ($quinza!='') {
			require $gerar;
			require $quinza;
		}
	}elseif ($valor['diapgto']=='600' && $vlrPgto) {
		//Pgto's da Sede
		$diaSede .='<tr '.$bgcolor7.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">15</td></tr>';
		$cor7 = !$cor7;
		$totSede += $valor['pgto'];
		//Cadastra o recibo
		if ($sede!='') {
			require $gerar;
			require $sede;
		}
	}elseif ($vlrPgto) {
		//Lista dos Demais Pgto
		$diaOutros .='<tr '.$bgcolor4.'><td>'.$nomeMembro.'</td><td>'.$valor['nomeFunc'].
		'</td><td title="'.$title.'">'.$valor['razao'].
		'</td><td id="moeda">'.$pgto.'</td>
				<td class="text-center">'.$nomeDiaPgto.'</td></tr>';
		$cor4 = !$cor4;
		$totOutros += $valor['pgto'];
		//Cadastra o recibo
		if ($demaisPgto!='') {
			require $gerar;
			require $demaisPgto;
		}
	}

//echo '<br />'.$indice.' -- > ';
//print_r($valor);
}

if ($totMinisterio>'0') {
	$dia1 = '<tbody><tr id="subtotal" class="sub"><th><strong>Minist�rio</strong></th><td></td><td></td><td id="moeda">'
		.number_format($totMinisterio,2,',','.').'</td><td></td></tr>'.$dia1.'</tbody>';
}else {
	$dia1='';
}

if ($totTesoureiro>'0') {
$dia15 = '<tbody><tr id="subtotal" class="sub"><th><strong>Tesoureiro</strong></th><td></td><td></td><td id="moeda">'
		.number_format($totTesoureiro,2,',','.').'</td><td></td></tr>'.$dia15.'</tbody>';
}else {
	$dia15='';
}

if ($totAuxilio>'0') {
	$diaAux = '<tbody><tr id="subtotal" class="sub"><th><strong>Aux�lio</strong></th><td></td><td></td><td id="moeda">'
	.number_format($totAuxilio,2,',','.').'</td><td></td></tr>'.$diaAux.'</tbody>';
}else {
	$diaAux='';
}
if ($totZelador>'0') {
	$diaZelador = '<tbody><tr id="subtotal" class="sub"><th><strong>Total para Zelador:</strong></th><td></td><td></td><td id="moeda">'
	.number_format($totZelador,2,',','.').'</td><td></td></tr>'.$diaZelador.'</tbody>';
}else {
	$diaAux='';
}
if ($totSexta>'0') {
	$diaSexta = '<tbody><tr id="subtotal" class="sub"><th><strong>Sexta-Feira</strong></th><td></td><td></td><td id="moeda">'
	.number_format($totSexta,2,',','.').'</td><td></td></tr>'.$diaSexta.'</tbody>';
}else {
	$diaSexta='';
}
if ($totQuinza>'0') {
	$diaQuinza = '<tbody><tr id="subtotal" class="sub"><th><strong>Quinzena</strong></th><td></td><td></td><td id="moeda">'
	.number_format($totQuinza,2,',','.').'</td><td></td></tr>'.$diaQuinza.'</tbody>';
}else {
	$diaQuinza='';
}
if ($totSede>'0') {
	$diaSede = '<tbody><tr id="subtotal" class="sub"><th><strong>Sede</strong></th><td></td><td></td><td id="moeda">'
	.number_format($totSede,2,',','.').'</td><td></td></tr>'.$diaSede.'</tbody>';
}else {
	$diaSede='';
}
if ($totOutros>'0') {
$diaOutros = '<tbody><tr id="subtotal" class="sub"><th><strong>Demais pgto&prime;s</strong></th><td></td><td></td><td id="moeda">'
		.number_format($totOutros,2,',','.').'</td><td></td></tr>'.$diaOutros.'</tbody>';
}else {
	$Outros='';
}
$nivel1 = $dia1.$dia15.$diaAux.$diaZelador.$diaSexta.$diaQuinza.$diaSede.$diaOutros;
$debito = $totMinisterio+$totTesoureiro+$totAuxilio+$totZelador+$totSexta+$totQuinza+$totSede+$totOutros;
