<?php
session_start();
if((!isset ($_SESSION['utilizador']) == true) and (!isset ($_SESSION['password']) == true))
{
    unset($_SESSION['utilizador']);
    unset($_SESSION['password']);
    header('location:../login.php');
}
$login = $_SESSION['utilizador'];
?>
<?php include '../conecta/conecta.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Três Doces</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="../index.php">Três Doces</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Início<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./bolos.php">Bolos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./categorias.php">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pesquisas.php">Pesquisas</a>
                </li>
            </ul>
        </span>
        </div>
    </nav>
    <div>
        <?php
            $query = mysqli_query($conn,"SELECT * FROM bolos");
            echo "<table class=\"table table-bordered table-dark\">";
            echo "<thead>";
                echo "<tr>";
                    echo "<th scope=\"col\">";
                        echo "ID";
                    echo "</th>";

                    echo "<th scope=\"col\">";
                        echo "NOME";
                    echo "</th>";

                    echo "<th scope=\"col\">";
                        echo "DESCRICAO";
                    echo "</th>";

                    echo "<th scope=\"col\">";
                        echo "PRECO";
                    echo "</th>";

                    echo "<th scope=\"col\">";
                    echo "IMAGEM";
                    echo "</th>";

                echo "</tr>";
            echo "</thead>";
            while ($linha = $query->fetch_assoc())
            {
                echo "<tr>";
                    foreach($linha as $valor)
                    if(!empty($linha['imagem'])) {
                        if($linha['imagem']==$valor){
                            echo '<th scope="col" style="text-align: center;"><img src="data:image/jpeg;base64,'.base64_encode( $linha['imagem'] ).'" height="100px" width="100px"/></th>';
                        }else{
                            echo "<th scope=\"col\">$valor</th>";
                        }
                    }else{
                        echo "<th scope=\"col\">$valor</th>";
                    }
                    echo "<th scope=\"col\">";
                        echo "<a href='../paginas/bolos.php?editar=$linha[id_bolo]' class='btn btn-info'> Editar </a>";
                    echo "</th>";
                    echo "<th scope=\"col\">";
                        echo "<a href='../paginas/bolos.php?eliminar=$linha[id_bolo]' name='eliminar' class='btn btn-danger'>Eliminar </a>";
                    echo "</th>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </div>
    <?php require_once '../accoes/accoes.php'; ?>
    <div>
        <h1>ATUALIZAR</h1>
        <form method="post" action="../accoes/accoes.php">
                <input type="hidden"value="<?php echo $id; ?>" name="id" >
            <div class="form-group">
                <label>Nome</label>
                <input value="<?php echo $nome; ?>" name="nome" class="form-control" style="width:300px;" placeholder="Introduza o nome a editar">
            </div>
            <div class="form-group">
                <label>Descricao</label>
                <input value="<?php echo $descricao; ?>" name="descricao" class="form-control"  style="width:300px;" placeholder="Introduza a descricao a editar">
            </div>
            <div class="form-group">
                <label>Preco</label>
                <input value="<?php echo $preco; ?>" name="preco" class="form-control"  style="width:300px;" placeholder="Introduza o preco a editar">
            </div>
            <div class="form-group" style="width:300px">
                <label>Imagem</label>
                <div class="custom-file">
                    <input type="file" name="selecionarimagem">
                </div>
            </div>
            <button name="atualizar" type="submit" class="btn btn-primary" style="width: 300px;">Atualizar</button>
        </form>
    </div>

    <div>
        <h1>ADICIONAR</h1>
        <form method="post"  action="../accoes/accoes.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nome</label>
                <input name="nome" class="form-control" style="width:300px;" placeholder="Introduza o nome a adicionar">
            </div>
            <div class="form-group">
                <label>Descricao</label>
                <input name="descricao" class="form-control"  style="width:300px;" placeholder="Introduza a descricao a adicionar">
            </div>
            <div class="form-group">
                <label>Preco</label>
                <input name="preco" class="form-control"  style="width:300px;" placeholder="Introduza o preco a adicionar">
            </div>
            <div class="form-group" style="width:300px">
                <label>Imagem</label>
                <div class="custom-file">
                    <input type="file" name="selecionarimagem">
                </div>
            </div>
            <button name="adicionar" type="submit" class="btn btn-primary" style=" width: 300px;">Adicionar</button>
        </form>
    </div>
</body>


