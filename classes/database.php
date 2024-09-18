<?php
class Database
{
    private $dbcon;

    function __construct()
    {
        $this->dbcon = $this->connect();
    }

    // connect to db
    private function connect()
    {

        $string = "mysql:host=localhost;dbname=chartup;";
        try
        {
        $con = new PDO($string,DBUSER,DBPASS,);
        return $con;
        }catch(PDOException $e)
        {
            echo $e->getMessage();
            die;
        }

        return false;
    }

    // write to db
    public function write($query, $dataArr=[])
    {
       $con =  $this->dbcon;
       $stmt =  $con->prepare($query);
      
      $check = $stmt->execute($dataArr);
      if($check)
      {
        return true;
      }

      return false;
    }

    // read from db
    public function read($query, $dataArr=[])
    {
       $con =  $this->dbcon;
       $stmt =  $con->prepare($query);
      
      $check = $stmt->execute($dataArr);
      if($check)
      {
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if(is_array($result) && count($result) > 0)
        {
            return $result;
        }
        return false;
      }

      return false;
    }

     // read from db
     public function getUser($userid)
     {
        $con =  $this->dbcon;
        $arr['userid'] = $userid;
        $query = "SELECT * FROM `users` WHERE userid = :userid LIMIT 1";
        $stmt =  $con->prepare($query);
       
       $check = $stmt->execute($arr);
       if($check)
       {
         $result = $stmt->fetchAll(PDO::FETCH_OBJ);
         if(is_array($result) && count($result) > 0)
         {
             return $result[0];
         }
         return false;
       }
 
       return false;
     }

    // generate userid
    public function generateId($max)
    {
        $rand ='';
        $randCount = rand(4,$max);
        for($i=0; $i < $randCount; $i++)
        {
            $r = rand(0,9);
            $rand .= $r;
        }

        return $rand;
    }
    
}


?>