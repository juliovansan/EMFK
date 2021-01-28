<html>
<meta charset=UTF-8>
<title> Projeto EMFK - Julio Vansan Gonçalves </title>
<body>
<h3> Projeto EMFK - Julio Vansan Gonçalves - Consulta geral</h3>
<b>* Clique na imagem para ver detalhes</b><br><br>
<?php

	
	include_once('conexao.php');
	//criando o objeto mysql e conectando ao banco de dados
	$mysql = new BancodeDados();
	$mysql->conecta();
	
	// ajustando a instrução select para ordenar por id agrupado
	$query = mysqli_query($mysql->con,"select * from tabdados group by codGrupoCiclo order by id;");

	if (!$query) {
		echo '<input type="button" onclick="window.location='."'index.php'".';" value="Voltar"><br><br>';
		die('<b>Query Inválida:</b>' . @mysqli_error($mysql->con));  
	}

	echo "<table border='1px'>";
	echo "<tr align='center'>
			<th width='100px'>Data</th>
			<th width='80px'>Hora</th>
			<th width='80px'>Cod Aluno</th>
			<th width='80px'>Nivel</th>
			<th width='80px'>Operação</th>
			<th width='100px'>CodGrupo</th>
			<th width='100px'>Foto *</th>
		<tr>";

	while($dados=mysqli_fetch_array($query)) 
	{
		echo "<tr align='center'>";
		echo "<td>". convertedata($dados['data'])."</td>";
		echo "<td>". $dados['hora']."</td>";
		echo "<td>". $dados['codAluno']."</td>";
		echo "<td>". $dados['nivel']."</td>";
		echo "<td>". $dados['tipoOperacao']."</td>";
		echo "<td>". $dados['codGrupoCiclo']."</td>";
			$imagem = $dados['nomeIMG'];
		//}
		$id = $dados['codGrupoCiclo'];
		echo "<td align='center'><a href='detalhes.php?id=$id'><img src='$imagem' width='50px' heigth='50px'></a>";
		echo "</tr>";
	}
	echo "</table>";
	
	$mysql->fechar();
?>
<br>
</body>
</html>
