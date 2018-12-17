<?php
require ("ayar.php");
//Faz a conexão com o banco de dados e executa a query



while($r = mysqli_fetch_assoc($listecustomer)) {
    //$dados[]= $r['idcontatos'];
    $dados[]= $r;    
    }
    // free result set
    $liste->close();


    // close connection
  //  mysqli_close($liste);


    echo json_encode($dados);
?>
