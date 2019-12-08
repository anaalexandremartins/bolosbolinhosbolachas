<!DOCTYPE html>
<?php session_start();include 'conecta/conecta.php'; ?>
<html lang="en">
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
<div class="loginform">
    <form method="post" action="#">
        <div class="form-group">
            <label>Utilizador</label>
            <input name="utilizador" class="form-control" style="width:300px;" placeholder="Intoduza o utilizador">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input name="password" class="form-control"  style="width:300px;" placeholder="Password">
        </div>
        <button name="enviar" type="submit" class="btn btn-primary" style=" width: 300px;">Submit</button>
    </form>
    <?php
        if(isset($_POST['enviar'])){
            $utilizador = strip_tags(mysqli_real_escape_string($conn,$_POST['utilizador']));
            $password = strip_tags(mysqli_real_escape_string($conn,$_POST['password']));

            $query = mysqli_query($conn,"SELECT * FROM login WHERE utilizador = '$utilizador' and password = '$password'");

            if(mysqli_num_rows($query) > 0){
               $_SESSION['utilizador'] = $utilizador;
               $_SESSION['password'] = $password;
               header('location:index.php');
            }else{
                unset($_SESSION['utilizador']);
                unset($_SESSION['password']);
                header('location:login.php');
            }
        }
    ?>
</div>
</body>
</html>