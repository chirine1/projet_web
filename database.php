<?php
class Database
{
  private static $connection = null;
  private static $dbhost = "localhost";
  private static $dbName = "burger_code";
  private static $dbUser="root";
  private static $dbUserpassword = "";
  public static function connect (){
    try{
      self::$connection=new PDO("mysql:host=".self::$dbhost. ";dbName". self::$dbName,self::$dbUser,self::$dbUserpassword);
    }
    catch(PDOException $e){
      die ($e-> getMessage());
    }
    return self::$connection;
  }
  public static function disconnect(){
    self::$connection= null;
  }
 
}
?>