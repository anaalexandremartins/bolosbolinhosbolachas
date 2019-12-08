<?php include '../conecta/conecta.php'; ?>
<?php

    $id = '';
    $nome = '';
    $descricao = '';
    $preco = '';



    if (isset($_POST['adicionar'])){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        $tmpname = $_FILES['selecionarimagem']['tmp_name'];
        $fp      = fopen($tmpname, 'r');
        $content = fread($fp, filesize($tmpname));
        $content = addslashes($content);

        $query = mysqli_query($conn, "INSERT INTO bolos (nome, descricao, preco, imagem) VALUES('$nome', '$descricao', '$preco','$content')");

        header("Location: ../paginas/bolos.php");
    }

    if (isset($_GET['eliminar'])){
        $id = $_GET['eliminar'];
        $query = mysqli_query($conn, "DELETE FROM bolos WHERE id_bolo=$id");

        //header("Location: ../paginas/bolos.php");
    }

    if (isset($_GET['editar'])){
        $id = $_GET['editar'];
        $query = mysqli_query($conn, "SELECT * FROM bolos WHERE id_bolo=$id");
        if (count($query)>0){
            $linha = $query->fetch_array();
            $nome = $linha['nome'];
            $descricao = $linha['descricao'];
            $preco = $linha['preco'];
        }
    }

    if (isset($_POST["atualizar"])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        $query = mysqli_query($conn, "UPDATE bolos SET nome='$nome', descricao='$descricao', preco='$preco' WHERE id_bolo=$id");

        header("Location: ../paginas/bolos.php");
    }
?>