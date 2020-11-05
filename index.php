<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            padding: 0;
            margin: 0;
            background-color: #2299f4;
        }
        h1 {
            text-align: center;
            background-color: violet;
            padding: 30px 0;
            text-transform: uppercase;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 100;
        }
        h2 {
            text-align: center;
        }
        form {
            width: 600px;
            background-color: #f4f4f4;
            padding: 25px 40px 30px;
            margin: 0 auto;
        }
        input, textarea {
            width: 100%;
            margin: 8px 0;
            outline: none;
            border: 0;
            padding: 8px;
            background-color:#ccc;
            color: #000;
            font-size: 1rem;
            max-width: 100%;
            min-width: 100%;
        }
        textarea {
            min-height: 100px;
        }
        button {
            background-color:seagreen;
            outline: none;
            border: 0;
            font-size: 1rem;
            color: #f4f4f4;
            padding: 10px 20px;
            cursor: pointer;
            margin: 30px 0 0 0;
        }
        .wrapper {
            display: flex;
            justify-content: space-between;
        }
        #code {
            /* width: 40px; */
            min-width: auto;
            margin: 0;
        }
        .rud {
            margin: 0;
        }
        #create {
            display: block;
            width: 100%;
        }
        input:hover, button:hover, textarea:hover {
            filter: invert(1);
        }
        input:focus, textarea:focus {
            filter: invert(1);
        }
        input, button, form, textarea {
            border-radius: 5px;
        }
    </style>
    <script>
    function loadValue(pcode,ptitle,pdescription,pprice,pquantity,pcategory) {
        code.value = pcode;
	    title.value	 = ptitle;
        description.value	 = pdescription;
	    price.value	 = pprice;
        quantity.value	 = pquantity;
        category.value	 = pcategory;
    }
    </script>
</head>
<body>
    <h1>CRUD - pw13 - Fatec (brazilian Harvard) WEB</h1>
    <form action="index.php" method="POST">
    <h2>Chose by code</h2>
        <div class="wrapper">
            <div>
                <label for="code">code</label>
                <input id="code" name="code" type="number">
            </div>

            <button id="read" class="rud" name="read">read</button>
            <button id="update" class="rud" name="update">update</button>
            <button id="delete" class="rud" name="delete">delete</button>
        </div>
        <hr>
        <h2>Info</h2>
        <label for="title">title</label>
        <input name="title" id="title" type="text" placeholder="title">
        <label for="description">description</label>
        <textarea name="description" id="description" type="text" placeholder="description"></textarea>
        <label for="price">price</label>
        <input name="price" id="price" type="text" placeholder="price">
        <label for="quantity">quantity</label>
        <input name="quantity" id="quantity" type="number" placeholder="quantity">
        <label for="category">category</label>
        <input name="category" id="category" type="text" placeholder="category">
        <button name="create" id="create">Create</button>
    </form>

</body>
</html>

<?php 


if(isset($_POST["create"])) create();
if(isset($_POST["read"])) read();
if(isset($_POST["update"])) update();
if(isset($_POST["delete"])) delete();


function create(){
    $title 	= $_POST["title"];
    $description 	= $_POST["description"];
    $price	= $_POST["price"];
    $quantity	= $_POST["quantity"];
    $category	= $_POST["category"];
    echo '<script>alert("sad)</script>';
    $con	= new mysqli("localhost","root","","pw13");	
    $sql	= "insert into produto(title, description, price, quantity, category) values('$title', '$description', '$price', '$quantity', '$category')";
    $err = mysqli_query($con, $sql);
    echo "<script>alert('Registro inserido')</script>";
    echo $showTb;
    $con->close();
}

function read(){
    $code 	= $_POST["code"];
    $con	= new mysqli("localhost","root","","pw13");	
    $sql	= "select code, title, description, price, quantity, category from produto where code=$code";
    $retorno = mysqli_query($con, $sql);
    if($reg = mysqli_fetch_array($retorno)){
        echo '<script>alert("sad)</script>';
        $code 	= $reg["code"];
        $title 	= $reg["title"];
        $description 	= $reg["description"];
        $price	= $reg["price"];
        $quantity	= $reg["quantity"];
        $category	= $reg["category"];   
        echo "<script lang='javascript'>loadValue('$code', '$title','$description','$price','$quantity','$category');</script>";

    } else {
        echo "<script>alert('Registro inexistente')</script>";
    }
    $con->close();
}

function update(){

    $code 	= $_POST["code"];

    $title 	= $_POST["title"];
    $description 	= $_POST["description"];
    $price	= $_POST["price"];
    $quantity	= $_POST["quantity"];
    $category	= $_POST["category"];

    $con	= new mysqli("localhost","root","","pw13");	
    $sql	= "update produto set title='$title', description='$description', price='$price', quantity='$quantity', category='$category' where code=$code";
    $err = mysqli_query($con, $sql);
    echo "<script>alert('Registro inserido')</script>";
    $con->close();
}

function delete(){
    $code 	= $_POST["code"];
    $con	= new mysqli("localhost","root","","pw13");	
    $sql	= "delete from produto where code=$code";
    $err = mysqli_query($con, $sql);
    echo "<script>alert('Registro deletado')</script>";
    $con->close();
}

// //show
// for($i=0; $i<10; $i++) {
//     $con	= new mysqli("localhost","root","","pw13");	
//     $sql	= "select title, description, price, quantity, category from produto where code=$i";
//     $retorno = mysqli_query($con, $sql);
//     if($reg = mysqli_fetch_array($retorno)){
//         $code = $reg["code"];
//         $title = $reg["title"];
//         $description = $reg["description"];
//         $price = $reg["price"];
//         $quantity = $reg["quantity"];
//         $category = $reg["category"];
//         // echo "<script lang='javascript'>carregaValor('$title','$description','$price','$quantity','$category');</script>";
//         $showTb = '<ul><li>' . $code . '</li>';
//         $showTb += '<ul><li>' . $title . '</li>';
//         $showTb += '<ul><li>' . $description . '</li>';
//         $showTb += '<ul><li>' . $quantity . '</li>';
//         $showTb += '<ul><li>' . $category . '</li>';
//         echo $showTb;
//     }
//     //  else {
//     //     echo "<h4>Registro não existe !</h4>";
//     // }
//     echo $showTb;
//     $con->close();
// }

    // header('Refresh: 4; location:index.php');

?>