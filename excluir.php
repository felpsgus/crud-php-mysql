<?php

require __DIR__ .'/vendor/autoload.php';

use App\Entity\Vaga;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id']) ){
  header('Location: index.php?status=error');
  exit;
}

//CONSULTA A VAGA
$obVaga = Vaga::getVaga($_GET['id']);

//VALIDAÇÃO DA VAGA
if(!$obVaga instanceof Vaga){
  header('Location: index.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){

  $obVaga->excluir();

  header('Location: index.php?status=success');
  exit;
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/confirmar-exclusao.php';
include __DIR__ .'/includes/footer.php';

?>