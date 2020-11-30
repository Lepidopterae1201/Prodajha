<?php
abstract class Modele
{
    static $bdd;

    private static function getBdd()
    {
        if (self::$bdd === NULL)
        {
            self::$bdd = new PDO("mysql:host=127.0.0.1;dbname=boutique;charset=UTF8", "root", "");
        }
        return self::$bdd;
    }

    protected function execRequete(string $sql, array $param = NULL)
    {
        if ($param === NULL)
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