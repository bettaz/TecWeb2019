<?php
class convertitor{

    public $serverName= "localhost";
    public $dbUsername= "root";
    public $dbPassword= "";
    public $dbName= "preventivo";

    public $bara="";
    public $cremazione="";
    public $urna="";
    public $auto="";
    public $composizione="";

    function __construct($bara,$cremazione,$urna,$auto,$composizione)
    {
        $this->bara= $bara;
        $this->cremazione= $cremazione;
        $this->urna= $urna;
        $this->auto= $auto;
        $this->composizione= $composizione;
    }

    private function connect(){
        $conn= new mysqli($this->serverName,$this->dbUsername,$this->dbPassword,$this->dbName);
        return $conn;
    }

    public function getConnection(){
        return $this->conn;
    } 

    function getBaraPrice(){
        if($this->bara == "---"){
            echo "nessuna bara ";
            return " 0";
        }
        if(!$this->connect()->connect_errno){//connessione avvenuta
            $string= str_split($this->bara);
            $prefixVersione= $string[0];
            $versione= "";
            if($prefixVersione=='A'){
                $versione="Abete";
            }
            if($prefixVersione=='M'){
                $versione= "Mogano";
            }
            if($prefixVersione=='B'){
                $versione= "Betulla";
            }
            $materiale= "";
            $count= 1;
            while($count < count($string)){//riconverto l'array la stringa senza il prefisso 
                $materiale= $materiale.$string[$count];
                $count++;
            }
            echo $versione." ".$materiale." ";
            $sql= "SELECT * FROM bara WHERE versione='".$versione."' AND materiale='".$materiale."';";
            $result= $this->connect()->query($sql);
            if($result){
                while($row= $result->fetch_assoc()){
                    return intval($row['costoBase']);
                }
            }else{
                return "no result";
            }            
        }else{
            echo "unable to connect ";
            return "null";
        }
    }

    function getUrnaPrice(){
        if($this->urna == "---"){
            echo "nessun urna";
            return " 0";
        }
        if(!$this->connect()->connect_errno){//connessione avvenuta
            $string= str_split($this->urna);
            $prefixVersione= $string[0];
            $versione= "";
            if($prefixVersione=='M'){
                $versione="Marmo";
            }
            if($prefixVersione=='A'){
                $versione= "Acciaio";
            }
            if($prefixVersione=='V'){
                $versione= "Vetro";
            }
            $materiale= "";
            $count= 1;
            while($count < count($string)){//riconverto l'array la stringa senza il prefisso 
                $materiale= $materiale.$string[$count];
                $count++;
            }
            echo $versione." ".$materiale." ";
            $sql= "SELECT * FROM urna WHERE versione='".$versione."' AND materiale='".$materiale."';";
            $result= $this->connect()->query($sql);
            if($result){
                while($row= $result->fetch_assoc()){
                    return intval($row['costoBase']);
                }
            }else{
                return "no result";
            }            
        }else{
            echo "unable to connect ";
            return "null";
        }
    }

    function getAutoPrice(){
        if($this->auto == "---"){
            echo "nessun auto";
            return " 0";
        }
        if(!$this->connect()->connect_errno){//connessione avvenuta
            $string= str_split($this->auto);
            $prefixVersione= $string[0];
            $versione= "";
            if($prefixVersione=='B'){
                $versione="BMW";
            }
            if($prefixVersione=='E'){
                $versione= "Bentley";
            }            
            if($prefixVersione=='A'){
                $versione= "Audi";
            }
            if($prefixVersione=='M'){
                $versione= "Mercedes-Benz";
            }
            if($prefixVersione=='F'){
                $versione= "Fiat";
            }
            $materiale= "";
            $count= 1;
            while($count < count($string)){//riconverto l'array la stringa senza il prefisso 
                $materiale= $materiale.$string[$count];
                $count++;
            }
            echo $versione." ".$materiale." ";
            $sql= "SELECT * FROM auto WHERE marca='".$versione."' AND modello='".$materiale."';";
            $result= $this->connect()->query($sql);
            if($result){
                while($row= $result->fetch_assoc()){
                    return intval($row['costoBase']);
                }
            }else{
                return "no result";
            }            
        }else{
            echo "unable to connect ";
            return "null";
        }
    }

}
?>
