<?php 

require_once 'connection.php';
$db = getConnection();


if(!empty($_POST['nomeDoEvento']) && 
    !empty($_POST['descricao']) && 
    !empty($_POST['iniciodata']) && 
    !empty($_POST['fimdata']) && 
    !empty($_POST['cliente'])
){

    $nomeDoEvento = $_POST['nomeDoEvento'];
    $descricao = $_POST['descricao'];
    $iniciodata = $_POST['iniciodata'];
    $fimdata = $_POST['fimdata'];
    $cliente = $_POST['cliente'];

    $sql = "INSERT INTO consultoria(data_inicial, data_final, titulo, descricao, cliente) VALUES(:iniciodata, :fimdata, :nomeDoEvento, :descricao, :cliente)";
        
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':iniciodata', $iniciodata );
    $stmt->bindParam(':fimdata', $fimdata );
    $stmt->bindParam(':nomeDoEvento', $nomeDoEvento );
    $stmt->bindParam(':descricao', $descricao );
    $stmt->bindParam(':cliente', $cliente );


    $result = $stmt->execute();
    
    if (!$result){
        header('Location: /FestaDeChurrasco?msg=error');
        exit;
    }

    header('Location: /FestaDeChurrasco?msg=success');
    exit;
} else {
    header('Location: /FestaDeChurrasco?msg=warning');
}
exit;

?>