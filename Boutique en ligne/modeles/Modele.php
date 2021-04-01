<?php
abstract class Modele
{
    private static $bdd;

    private static function getBdd()
    {
        $en_ligne = false;
        
        if (self::$bdd === NULL)
        {
            try{
                self::$bdd = new PDO("mysql:host=localhost;dbname=boutique;charset=UTF8", "root", "");
                self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                exit;
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
