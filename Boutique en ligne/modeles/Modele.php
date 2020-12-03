<?php
abstract class Modele
{
    static $bdd;

    private static function getBdd()
    {
        if (self::$bdd === NULL)
        {
            try{
                self::$bdd = new PDO("mysql:host=localhost;dbname=boutique;charset=UTF8", "root", "");
                self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Message d'erreur : ".$e->getMessage();
            }
        }
        return self::$bdd;
    }

    protected function execRequete(string $sql, array $param = null)
    {
        if ($param === null)
        {
            $resultat = self::getBdd()->query($sql);
        }else{
            $resultat = self::getBdd()->prepare($sql);
            $resultat->execute($param);
        }
        return $resultat;
    }
}
?>