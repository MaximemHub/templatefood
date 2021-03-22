<?php

//connexion
try
{
  $connexion = new PDO('mysql:host=localhost;dbname=reservation', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e)
{ 
  echo 'Erreur : ' . $e->getMessage();
}

//requetes
if($connexion)
{
  $requete = "CREATE TABLE IF NOT EXISTS `reservation`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `lastname` VARCHAR(30) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `phone` INT NOT NULL,
    `resdate` DATETIME NOT NULL,
    `hour` VARCHAR(5) NOT NULL,
    `person` INT NOT NULL,
    `special` TEXT
  )";

    $connexion->prepare($requete)->execute();
}



try
{
  $lastname = $_POST["lastname"];
  $email = $_POST["mail"];
  $phone = $_POST["phone"];
  $resdate = $_POST["resdate"];
  $hour = $_POST["hour"];
  $person = $_POST["person"];
  $special = $_POST["request"];

  $requete2 = $connexion->prepare("INSERT INTO `reservation`(lastname, email, phone, resdate, hour, person, special)
               VALUES(:lastname , :email, :phone, :resdate, :hour, :person, :special)");
  $requete2->bindParam(':lastname',$lastname);
  $requete2->bindParam(':email', $email);
  $requete2->bindParam(':phone', $phone);
  $requete2->bindParam(':resdate', $resdate);
  $requete2->bindParam(':hour', $hour);
  $requete2->bindParam(':person', $person);
  $requete2->bindParam(':special', $special);
  
  $requete2->execute();

  header("location:index.html");
}
catch(PDOException $er)
{
  echo 'Erreur : ' . $er->getMessage();
}




