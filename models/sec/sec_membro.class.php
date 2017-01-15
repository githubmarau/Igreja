<?php
class sec_membro {

	protected $rolMembro;

	function __construct ($rolMembro='') {
		$sqlConsulta  = 'SELECT m.*,i.razao, ';
		$sqlConsulta .= 'p.cpf,p.rg ';
		$sqlConsulta .= 'FROM eclesiastico AS e,igreja AS i,membro AS m, est_civil AS c ';
		$sqlConsulta .= ',profissional AS p ';
		$sqlConsulta .= 'WHERE e.congregacao=i.rol AND m.rol=c.rol AND ';
		$sqlConsulta .= 'm.rol=p.rol AND m.rol=c.rol AND m.rol="'.$rolMembro.'" ';
		$sqlConsulta .= 'ORDER BY m.nome,i.razao';
		$query = $sqlConsulta;
		$membros = mysql_query($query) or die (mysql_error());
		while($dados = mysql_fetch_assoc($membros))
		{

				$arrayCargos[$dados['rol']]= array('nome'=>$dados['nome'],'bairro'=>$dados['bairro']
				,'celular'=>$dados['celular'],'cep'=>$dados['cep'],'cidade'=>$dados['cidade']
						,'datanasc'=>$dados['datanasc'],'doador'=>$dados['doador'],'dt_cadastro'=>$dados['dt_cadastro']
						,'email'=>$dados['email'],'endereco'=>$dados['endereco'],'escolaridade'=>$dados['escolaridade']
						,'fone_resid'=>$dados['fone_resid'],'graduacao'=>$dados['graduacao'],'mae'=>$dados['mae']
						,'nacionalidade'=>$dados['nacionalidade'],'naturalidade'=>$dados['naturalidade']
						,'numero'=>$dados['numero'],'obs'=>$dados['obs'],'pai'=>$dados['pai'],
						,'rol_mae'=>$dados['rol_mae'],''=>$dados['rol_pai'],''=>$dados['rol_pai'],
						,'sangue'=>$dados['sangue'],'sexo'=>$dados['sexo'],'uf_nasc'=>$dados['uf_nasc'],
						,'uf_resid'=>$dados['uf_resid'],'auxiliar'=>$dados['auxiliar'],'batismo_em_aguas'=>$dados['batismo_em_aguas'],
						,'batismo_espirito_santo'=>$dados['batismo_espirito_santo'],'congregacao'=>$dados['congregacao'],'data'=>$dados['data'],
						,'dat_aclam'=>$dados['dat_aclam'],'diaconato'=>$dados['diaconato'],'evangelista'=>$dados['evangelista'],
						,'pastor'=>$dados['pastor'],'presbitero'=>$dados['presbitero'],'situacao_espiritual'=>$dados['situacao_espiritual'],
						,''=>$dados[''],''=>$dados[''],''=>$dados[''],
						,''=>$dados[''],''=>$dados[''],''=>$dados[''],
						,''=>$dados[''],''=>$dados[''],''=>$dados[''],
						,''=>$dados[''],''=>$dados[''],''=>$dados[''],
						,''=>$dados[''],''=>$dados[''],''=>$dados['']);

		}
		$this->arrayNomeIgreja = $todos;
	}

	function dadosArray () {
		return $this->arrayNomeIgreja;
	}

	function dadosCargo() {
		return $this->arrayCargo;
	}

	function cargoIgreja($rolIgreja,$descricao) {
		$cargoAtivo = array();
		foreach ($this->arrayCargo as $chave => $valor) {
			if ($valor['igreja']==$rolIgreja && $valor['descricao']==$descricao) {
				$cargoAtivo [] = $valor;
			}
		}
		return $cargoAtivo;
	}
}
?>
