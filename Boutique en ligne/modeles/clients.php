<?php
require_once "Modele.php";
 
Class clients extends Modele{
  public function sendMessage(int $id_client, string $sujet, string $contenu){ //envoie le message envoyé au support
    $sql = "INSERT INTO message(id_client, sujet, contenu, date) VALUES (?,?,?,NOW())";
    return $this->execRequete($sql,[$id_client,$sujet,$contenu]);
  }
 
}
 
?> 