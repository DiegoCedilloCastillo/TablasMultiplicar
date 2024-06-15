<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Multiplicar</title>
</head>
<body style="background-color: #f0f0f0; color: #333;">

<?php
function generarTabla($num, $inicioRango, $finRango) {
    echo "<h2 style='color: #007bff;'>Tabla de multiplicar del $num</h2>";
    echo "<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>";
    echo "<input type='hidden' name='num' value='$num'>";
    echo "<input type='hidden' name='inicioRango' value='$inicioRango'>";
    echo "<input type='hidden' name='finRango' value='$finRango'>";
    echo "<table border='1'>";
    for ($i = $inicioRango; $i <= $finRango; $i++) {
        echo "<tr><td>$num</td><td>x</td><td>$i</td><td>=</td><td><input type='number' name='respuesta_$i' required></td></tr>";
    }
    echo "</table>";
    echo "<br><input type='submit' name='comprobar' value='Comprobar respuestas' style='background-color: #007bff; color: #fff; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;'>";
    echo "</form>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['comprobar'])){
        $num = $_POST["num"];
        $inicioRango = $_POST["inicioRango"];
        $finRango = $_POST["finRango"];

        if($inicioRango > $finRango) {
            echo "<h2 style='color: red;'>El valor de inicio no puede ser mayor que el valor final.</h2>";
            echo "<br><a href='index.php' style='color: #007bff; text-decoration: none;'>Regresar al primer menú</a>";
        } else {
            $respuestasCorrectas = [];
            $respuestasIncorrectas = [];

            for ($i = $inicioRango; $i <= $finRango; $i++) {
                $respuesta = $_POST["respuesta_$i"];
                $resultado = $num * $i;
                if ($respuesta == $resultado) {
                    $respuestasCorrectas[$i] = $respuesta;
                } else {
                    $respuestasIncorrectas[$i] = $respuesta;
                }
            }

            echo "<h2 style='color: #007bff;'>Resultados:</h2>";
            echo "<h3 style='color: #007bff;'>Respuestas correctas:</h3>";
            if (empty($respuestasCorrectas)) {
                echo "<p>No hay respuestas correctas.</p>";
            } else {
                echo "<ul>";
                foreach ($respuestasCorrectas as $key => $value) {
                    echo "<li>$num x $key = $value</li>";
                }
                echo "</ul>";
            }

            echo "<h3 style='color: #007bff;'>Respuestas incorrectas:</h3>";
            if (empty($respuestasIncorrectas)) {
                echo "<p>No hay respuestas incorrectas.</p>";
            } else {
                echo "<ul>";
                foreach ($respuestasIncorrectas as $key => $value) {
                    echo "<li>$num x $key = $value</li>";
                }
                echo "</ul>";
            }

            echo "<br><a href='index.php' style='color: #007bff; text-decoration: none;'>Regresar al primer menú</a>";
        }
    } else {
        $num = $_POST["num"];
        $inicioRango = !empty($_POST["inicioRango"]) ? $_POST["inicioRango"] : 1;
        $finRango = !empty($_POST["finRango"]) ? $_POST["finRango"] : 10;
        if($inicioRango > $finRango) {
            echo "<h2 style='color: red;'>El valor de inicio no puede ser mayor que el valor final.</h2>";
            echo "<br><a href='index.php' style='color: #007bff; text-decoration: none;'>Regresar al primer menú</a>";
        } else {
            generarTabla($num, $inicioRango, $finRango);
            echo "<br><a href='index.php' style='color: #007bff; text-decoration: none;'>Regresar al primer menú</a>";
        }
    }
} else {
    ?>
    <h1 style="color: #007bff;">Ingrese los valores:</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Número: <input type="number" name="num" required><br><br>
        Inicio del rango: <input type="number" name="inicioRango" value="1"><br><br>
        Fin del rango: <input type="number" name="finRango" value="10"><br><br>
        <input type="submit" value="Aceptar" style="background-color: #007bff; color: #fff; border: none; padding: 8px 12px; border-radius: 5px; cursor: pointer;">
    </form>
    <?php
}
?>

</body>
</html>
