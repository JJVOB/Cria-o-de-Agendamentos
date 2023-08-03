<?php 
require_once 'connection.php';
$db = getConnection();

if(!empty($_POST['nomeDoEventoEdit']) && 
    !empty($_POST['descricaoEdit']) && 
    !empty($_POST['iniciodataEdit']) && 
    !empty($_POST['fimdataEdit']) && 
    !empty($_POST['clienteEdit']) && 
    !empty($_POST['idEdit'])
){

    $nomeDoEvento = $_POST['nomeDoEventoEdit'];
    $descricao = $_POST['descricaoEdit'];
    $iniciodata = $_POST['iniciodataEdit'];
    $fimdata = $_POST['fimdataEdit'];
    $cliente = $_POST['clienteEdit'];
    $id = $_POST['idEdit'];

    $sql = "UPDATE consultoria SET data_inicial = :iniciodata, data_final = :fimdata, titulo = :nomeDoEvento, descricao = :descricao, cliente = :cliente WHERE id = :id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':iniciodata', $iniciodata );
    $stmt->bindParam(':fimdata', $fimdata );
    $stmt->bindParam(':nomeDoEvento', $nomeDoEvento );
    $stmt->bindParam(':descricao', $descricao );
    $stmt->bindParam(':cliente', $cliente );
    $stmt->bindParam(':id', $id );

    $result = $stmt->execute();
    
    if (!$result){
        header('Location: /Levex?msg=error');
        exit;
    }

    header('Location: /Levex?msg=success');
    exit;
} else {
    header('Location: /Levex?msg=warning');
}
exit;

?>