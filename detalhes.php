<html>
<meta charset=UTF-8>
<title> Sistema EMFK </title>
<body>
<h2>Sistema complementar para o acompanhamento dos resultados</h2> 
<h2>EMFK - Emotion Math For Kids</h2>
<h3>Consulta Detalhada</h3>

<?php

	if(isset($_GET['id']) && is_numeric($_GET['id'])){
			$id = $_GET['id'];
			$id_corrente = $id;
	} else {
		header('Location: index.php');
	}
	echo '<input type="button" onclick="window.location='."'index.php'".';" value="Lista Geral"><br><br>';
	include_once('conexao.php');
	//criando o objeto mysql e conectando ao banco de dados
	$mysql = new BancodeDados();
	$mysql->conecta();
	
	$mysql1 = new BancodeDados();
	$mysql1->conecta();
	$mysql2 = new BancodeDados();
	$mysql2->conecta();
	
	$sql_anterior = "SELECT * FROM tabdados WHERE codGrupoCiclo < $id_corrente ORDER by id DESC limit 1";
	$dados1 = $mysql1->sqlquery($sql_anterior,'index.php');
	$id_anterior=$dados1['codGrupoCiclo'];
	
	$sql_proximo = "SELECT * FROM tabdados WHERE codGrupoCiclo > $id_corrente ORDER by id ASC limit 1";
	$dados2 = $mysql2->sqlquery($sql_proximo,'index.php');
	$id_proximo=$dados2['codGrupoCiclo'];
	if ($id_anterior==''){
		$id_anterior='Primeiro Registro';
		echo "&nbsp &nbsp &nbsp &nbsp  ";
	}else{
		echo '<input type="button" onclick="window.location='."'detalhes.php?id=$id_anterior'".';" value="<"> &nbsp';
	}
	if ($id_proximo==''){
		$id_proximo='Último Registro';
	}else{
		echo '<input type="button" onclick="window.location='."'detalhes.php?id=$id_proximo'".';" value=">">';
	}
		
	echo " <br><br> Anterior =  ". $id_anterior;
	echo " || Próximo = ". $id_proximo . "<br>";	
	echo "<hr size =2>";
	$query = mysqli_query($mysql->con,"select * from tabdados where codGrupoCiclo = $id order by id;");

	while($dados=mysqli_fetch_array($query)) 
	{
		echo "<table boreder='1px'><tr><td width='250px'>";
		$imagem = $dados['nomeIMG'];

		echo "<img src='$imagem' >";
		echo "</td><td width='500px'>";
		
		echo "<h2> Dados </h2>";
		echo "<table border='1px'>";
		echo "<tr align='center'>
				<th width='100px'>CodGrupo</th>
				<th width='100px'>Data</th>
				<th width='80px'>Hora</th>
				<th width='80px'>Cod Aluno</th>
				<th width='80px'>Nivel</th>
				<th width='80px'>N1</th>
				<th width='80px'>Operação</th>
				<th width='80px'>N2</th>
				<th width='80px'>Resp dada</th>
				<th width='80px'>Resp Esperada</th>
				<th width='80px'>Ciclo</th>
				<th width='80px'>Ajuste</th>
			</tr>";
	
		echo "<tr align='center'>";
		echo "<td>". $dados['codGrupoCiclo']."</td>";
		echo "<td>". convertedata($dados['data'])."</td>";
		echo "<td>". $dados['hora']."</td>";
		echo "<td>". $dados['codAluno']."</td>";
		echo "<td>". $dados['nivel']."</td>";
		echo "<td>". $dados['N1']."</td>";
		echo "<td>". $dados['tipoOperacao']."</td>";		
		echo "<td>". $dados['N2']."</td>";
		echo "<td>". $dados['respostaUsuario']."</td>";
		if ($dados['tipoOperacao']=='+'){
			$respEsperada=$dados['N1'] + $dados['N2'];
		}
		if ($dados['tipoOperacao']=='x'){
			$respEsperada=$dados['N1'] * $dados['N2'];
		}
		if ($dados['tipoOperacao']=='-'){
			$respEsperada=$dados['N1'] - $dados['N2'];
		}
		echo "<td>". $respEsperada."</td>";
		echo "<td>". $dados['ciclo']."</td>";
		echo "<td>". $dados['ajuste']."</td>";
		
		echo "</table> </br></br>";
		
		echo "<h2> Emoções </h2>";
			echo "<table border='1px'>";
		echo "<tr align='center'>
				<th width='80px'>Momento</th>
				<th width='80-px'>Neutro</th>
				<th width='80px'>Felicidade</th>
				<th width='80px'>Surpreso</th>
				<th width='80px'>Raiva</th>
				<th width='80px'>Tristeza</th>
				<th width='80px'>Desprezo</th>
				<th width='80px'>Desgosto</th>
				<th width='80px'>Medo</th>
				<th width='80px'>Idade</th>
				<th width='80px'>Genero</th>
			
			</tr>";
		echo "<tr align='center'>";
			echo "<td>". $dados['momento']."</td>";
			echo "<td>". $dados['apiNeutro']."</td>";
			echo "<td>". $dados['apiFelicidade']."</td>";
			echo "<td>". $dados['apiSurpreso']."</td>";
			echo "<td>". $dados['apiRaiva']."</td>";
			echo "<td>". $dados['apiTristeza']."</td>";
			echo "<td>". $dados['apiDesprezo']."</td>";
			echo "<td>". $dados['apiDesgosto']."</td>";
			echo "<td>". $dados['apiMedo']."</td>";
			echo "<td>". $dados['apiIdade']."</td>";
			echo "<td>". $dados['apiGenero']."</td>";
		echo "</tr>";		
				
		echo "</table>";
		
		echo "</td></tr></table>";	
	}

	$mysql->fechar();
	
?>
<br>
<!--
<input type='button' onclick="window.location='index.php';" value="Voltar">
-->
</body>
</html>
