<?php

	$scrip = 'models/tes/insertRecibos.php';
	
	switch ($_POST['grupo']) {
		case '2':
			//tesoureiros
			$codConta = 143;
			$tesoureiro = $scrip;
		break;
		case '3':
			//Aux�lios A��o Social
			$codConta = 103;
			$auxilio = $scrip;
		break;
		case '4':
			//Demais Zeladores
			$codConta = 88;
			$zeladores = $scrip;
		break;
		case '5':
			//Demais Pagamentos
			$codConta = 180;
			$demaisPgto= $scrip;
		break;
		
		default:
			//grupo = 1 -> Ministerio
			$codConta = 485;
			$ministerio = $scrip;
		break;
	}
?>