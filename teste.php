<?php

$host = 'localhost';
$login = "root";
$senha = '';
$bd = "barber";
$conn = mysqli_connect($host, $login, $senha, $bd);

$agora = new DateTime();
$periodo = new DateInterval('P1D');

$sqlSelect = "SELECT * FROM teste";
$query1 = $conn->query($sqlSelect) or die("404 sql" . $conn->error);


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];
    $campo3 = $_POST['campo3'];

    $sqlInsert = "INSERT INTO teste(campo1, campo2, campo3) VALUES ('$campo1', '$campo2', '$campo3')";
    $query = $conn->query($sqlInsert) or die("404 sql" . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark">
        <h1 class="fw-bold text-white text-center py-2">Agendamento</h1>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <select name="" id="" class="form-select my-4">
                        <?php
                        for ($i = 1; $i <= 7; $i++) {
                            echo "<option>";
                            echo $agora->format('l - d/m/Y');
                            echo "</option>";
                            $agora->add($periodo);
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4"></div>

                <?php
                for ($i = 6; $i <= 23; $i++) {
                    echo '<div class=" mb-3 col-4">';
                    echo '<input type="text" class="form-control" placeholder="' . $i . ':00' . '">';
                    echo '</div>';
                }
                ?>

                <button class="btn btn-primary" type="submit">Enviar</button>

                <form method="POST">

                    <?php
                    while ($linha = mysqli_fetch_row($query1)) {
                    ?>
                        <input type="text" class="form-control my-3" value="<?php if (isset($linha[1])) {
                                                                                echo $linha[0];
                                                                            } ?>" placeholder="1" name="campo1">
                        <input type="text" class="form-control my-3" value="<?php if (isset($linha[1])) {
                                                                                echo $linha[1];
                                                                            } ?>" placeholder="2" name="campo2">
                        <input type="text" class="form-control my-3" value="<?php if (isset($linha[2])) {
                                                                                echo $linha[2];
                                                                            } ?>" placeholder="3" name="campo3">
                    <?php
                    }
                    ?>


                    <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>