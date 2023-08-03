<?php 
require_once 'connection.php';
$db = getConnection();

if(!empty($_POST['idDelete'])){

    $id = $_POST['idDelete'];

    $sql = "DELETE FROM consultoria WHERE id = :id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id );

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