<?php
session_start();
include("conexion.php");
require('fpdf184/fpdf.php');

// ID usuario logueado
$id_usuario = $_SESSION["id_usuario"] ?? 3;

// Obtener rutina
$sqlRutina = "SELECT id_rutina FROM rutinas WHERE id_usuario = $id_usuario LIMIT 1";
$resRutina = $conn->query($sqlRutina);
if ($resRutina->num_rows == 0) die("No tienes rutina asignada.");

$id_rutina = $resRutina->fetch_assoc()["id_rutina"];

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Mi Rutina',0,1,'C');
$pdf->Ln(5);

// Obtener categorías
$sqlCat = "
    SELECT rc.id_rutina_categoria, c.nombre_categoria
    FROM rutinas_categoria rc
    INNER JOIN categorias c ON c.id_categoria = rc.id_categoria
    WHERE rc.id_rutina = $id_rutina
";
$categorias = $conn->query($sqlCat);

$pdf->SetFont('Arial','',12);

while($cat = $categorias->fetch_assoc()){
    $catId = $cat["id_rutina_categoria"];
    $nombreCat = $cat["nombre_categoria"];
    
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,8,$nombreCat,0,1);

    // Ejercicios
    $sqlEj = "SELECT * FROM rutinas_ejercicios WHERE id_rutina_categoria = $catId";
    $ejercicios = $conn->query($sqlEj);
    
    $pdf->SetFont('Arial','',12);
    if ($ejercicios->num_rows > 0){
        while($ej = $ejercicios->fetch_assoc()){
            $txt = $ej["ejercicio_texto"];
            $pdf->MultiCell(0,6,"- $txt");
        }
    } else {
        $pdf->Cell(0,6,"No hay ejercicios.",0,1);
    }

    $pdf->Ln(3);
}

// Descargar PDF
$pdf->Output('D', 'Rutina.pdf');
