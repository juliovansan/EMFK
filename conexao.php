<?php

function convertedata($data){
		$data_vetor = explode('-', $data);
		$novadata = implode('/', array_reverse ($data_vetor));
		return $novadata;
	}
	
class BancodeDados {
    private $host = "localhost"; 	// Nome ou IP do Servidor
    private $user = "xxxx"; 		// Usuário do Servidor MySQL
    private $senha = "xxxx"; 		// Senha do Usuário MySQL
    private $banco = "bd_projeto"; 		// Nome do seu Banco de Dados
    public $con;
	
	// método responsável para conexão a base de dados
	function conecta(){
        $this->con = @mysqli_connect($this->host,$this->user,$this->senha, $this->banco);
	    // Conecta ao Banco de Dados
        if(!$this->con){
      		// Caso ocorra um erro, exibe uma mensagem com o erro
			die ("Problemas com a conexão");
        }
    }
	
	// método responsável para fechar a conexão
	function fechar(){
		mysqli_close($this->con);
		return;
	}
	// função para executar o SELECT 
	function sqlquery($string,$caminho){
		// executando instrução SQL
		$resultado = @mysqli_query($this->con, $string);
		if (!$resultado) {
			echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
			die('<b>Query Inválida:</b>' . @mysqli_error($this->con)); 
		} else {
			$num = @mysqli_num_rows($resultado);
			if ($num==0){
			// se não encontrar nada	
			}else{
				$dados=mysqli_fetch_array($resultado);
			}
		} 
		$this->fechar();
		return $dados;
	}

	
}


?>