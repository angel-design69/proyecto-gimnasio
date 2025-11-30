<?php
include("conexion.php");

// ID usuario logueado (EJEMPLO)
$id_usuario = $_SESSION["id_usuario"] ?? 3;

// 1. OBTENER RUTINA DEL USUARIO
$sqlRutina = "SELECT id_rutina FROM rutinas WHERE id_usuario = $id_usuario LIMIT 1";
$resRutina = $conn->query($sqlRutina);

if ($resRutina->num_rows == 0) {
    die("<h2>No tienes una rutina asignada.</h2>");
}

$id_rutina = $resRutina->fetch_assoc()["id_rutina"];

// 2. OBTENER CATEGORÍAS DE ESA RUTINA
$sqlCat = "
    SELECT rc.id_rutina_categoria, c.nombre_categoria
    FROM rutinas_categoria rc
    INNER JOIN categorias c ON c.id_categoria = rc.id_categoria
    WHERE rc.id_rutina = $id_rutina
";
$categorias = $conn->query($sqlCat);
?>
<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset='UTF-8'>
<title>Mi Rutina</title>
<link rel="stylesheet" href="usuario.css">
<script>

// DESPLEGAR
function toggleContent(id){
    let box = document.getElementById(id);
    box.style.display = box.style.display === "block" ? "none" : "block";
}

// MARCAR HECHO
function marcarHecho(btn, cat){
    btn.classList.toggle("done");

    let total = document.querySelectorAll(".cat"+cat).length;
    let hechos = document.querySelectorAll(".cat"+cat+" .done").length;

    document.getElementById("prog"+cat).style.width = (hechos/total)*100 + "%";
}

// CRONÓMETRO
let timers = {};

function iniciarCrono(id){
    let label = document.getElementById("cr"+id);

    if(!timers[id]){
        timers[id] = {seg:0};
        timers[id].int = setInterval(()=>{
            timers[id].seg++;
            let m = String(Math.floor(timers[id].seg/60)).padStart(2,"0");
            let s = String(timers[id].seg%60).padStart(2,"0");
            label.innerHTML = m+":"+s;
        },1000);
    } else {
        clearInterval(timers[id].int);
        delete timers[id];
        label.innerHTML = "Cronómetro";
    }
}

</script>
</head>

<body>

<h2 class="titulo">MI RUTINA</h2> <a href="pdf.php" class="btn-descargar">Descargar PDF</a>


<div class="contenedor">

<?php
if ($categorias->num_rows > 0){
    while($cat = $categorias->fetch_assoc()){
        
        $catId = $cat["id_rutina_categoria"];
        $nombreCat = $cat["nombre_categoria"];

        echo "
        <div class='card' onclick='toggleContent(\"c$catId\")'>
            <h3>$nombreCat</h3>
        </div>

        <div class='contenido' id='c$catId'>

            <div class='barra'>
                <div class='progreso' id='prog$catId'></div>
            </div>
        ";

        // EJERCICIOS
        $sqlEj = "SELECT * FROM rutinas_ejercicios WHERE id_rutina_categoria = $catId";
        $ejercicios = $conn->query($sqlEj);

        if ($ejercicios->num_rows > 0){
            while($ej = $ejercicios->fetch_assoc()){
                $ejId = $ej["id_ejercicio"];
                $txt = $ej["ejercicio_texto"];

                echo "
                <div class='ejercicio cat$catId'>
                    <p class='nombre'>$txt</p>

                    <button class='hecho' onclick='marcarHecho(this, $catId)'>
                        Hecho
                    </button>

                    <button class='crono' id='cr$ejId' onclick='iniciarCrono($ejId)'>
                        Cronómetro
                    </button>
                </div>
                ";
            }
        } else {
            echo "<p class='vacio'>No hay ejercicios.</p>";
        }

        echo "</div>";
    }
} else {
    echo "<p class='vacio'>No tienes categorías en esta rutina.</p>";
}
?>

</div>

</body>
</html>
