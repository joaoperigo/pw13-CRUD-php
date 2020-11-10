<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PW14 - Products list</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    
<!-- -Utilizando a tabela PRODUTO da atividade PW13 crie uma pagina de listagem utilizando uma tabela com um campo de pesquisa, crie uma coluna que contenha um link para a pagina de crud enviando o parametro codigo por GET. -->

<form method="post" action="lista.php">
	<input type="text" name="search" placeholder="Search by title:">
	<input type="submit" name="bt1" value="ok">
</form>
	<table>
	<tr><td><b>Code</b></td><td><b>Title</b></td><td><b>Price</b></td><td><b>Quantity</b></td><td><b>Category</b></td><td><b>Edit</b></td></tr>
	<?php
		if(isset($_POST["bt1"])){
			pesquisar();
		} else {	
			listar();
		}
	?>
	</table>
</body>
</html>
<?php
function listar(){
	$con = new mysqli("localhost","root","","pw13");
	$sql = "select * from produto order by title";
	$resultado = mysqli_query($con, $sql);
	while($reg = mysqli_fetch_array($resultado)){
		echo '<tr><td>'. $reg['code'] . '</td><td>'. $reg['title'] . '</td><td>'. $reg['price'] .'</td><td>'. $reg['quantity'] .'</td><td>' . $reg['category'] . '</td><td><a href="index.php?code=' . $reg['code'] . '">Edit</a></td></tr>';
	}
	$con->close();
}	
function pesquisar(){
	$search = $_POST["search"];
	$con = new mysqli("localhost","root","","pw13");
	$sql = "select * from produto where title like '%$search%' order by title";
	$resultado = mysqli_query($con, $sql);
	while($reg = mysqli_fetch_array($resultado)){
		echo '<tr><td>'. $reg['code'] . '</td><td>'. $reg['title'] . '</td><td>'. $reg['price'] .'</td><td>'. $reg['quantity'] .'</td><td>' . $reg['category'] . '</td><td><a href="index.php?code=' . $reg['code'] . '">Edit</a></td></tr>';
	}
	$con->close();
}
?>