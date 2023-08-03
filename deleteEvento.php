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