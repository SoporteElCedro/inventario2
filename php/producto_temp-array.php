<?php
  date_default_timezone_set('America/Mexico_City');
  $fecha=date('y/m/d h:i:s');
  
  require_once "./php/main.php";
  
  echo $cantidad=$_POST['stock']."<br>";
  echo $fecha."<br>";
  echo $idusu=$_SESSION['id']."<br>";
  echo $prodid=$_POST['idprod']."<br>";
  echo $personal=$_POST['lista-personal']."<br>";
  echo $eco=$_POST['lista-unidad']."<br>";
  echo $obse=$_POST['obs']."<br>";
  $tipo="herramienta";

  $conexion=conexion();
  $persona_pres=$conexion->query("SELECT personal_nombre");

  $array_temp=$conexion->query("SELECT temp_idprod, temp_cantidad FROM temp_producto");
  $array_temp=$array_temp->fetchAll();




?>