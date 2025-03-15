<?php 

    require_once '../mpdf/vendor/autoload.php';
    require_once "../koneksi.php";

    $idPrint = $_GET['idPrint'];

    $query_print = mysqli_query($conn, "SELECT * FROM resume WHERE id = $idPrint");
    $rowPrint = mysqli_fetch_assoc($query_print);
    $mpdf = new \Mpdf\Mpdf();
    $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume untuk dicetak jadi PDF</title>
</head>
<body>
<table border="1">
    <tr>
        <th>
            Instansi
        </th>
        <td>'. $rowPrint['instansi'] .'
            
        </td>
    </tr>
    <tr>
        <th>
            Jabatan
        </th>
        <td>'. $rowPrint['jabatan'] .
        '</td>   
    </tr>
    <tr>
        <th>
            Deskripsi
        </th>
        <td>'. $rowPrint['deskripsi'] .
        '</td>   
    </tr>
    <tr>
        <th>
            Tahun Awal
        </th>
        <td>'. $rowPrint['tahun_awal'] .
        '</td>
    </tr>
    <tr>
        <th>
            Tahun Akhir
        </th>
        <td>'. $rowPrint['tahun_akhir'] .
        '</td>
    </tr>
    <tr>
     <th>
            Lama Bekerja
        </th>
        <td>'. $rowPrint['tahun_akhir'] - $rowPrint['tahun_awal'] . 
        ' Tahun</td>
    </tr>
</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
