<?php
namespace App\Model\Cocktail;

class CocktailSearch
{

    private $conn;

    private $params;

    public function __construct($conn, $params){
        $this->conn = $conn;
        $this->params = $params;
    }

    /*
     * 検索条件でカクテルを検索する
     */
    public function fetchCocktailByKeyword(){

        $sql = "SELECT * FROM cocktail";

        // 検索項目に合わせてSQLを作成
        if(!empty($this->params)){
            $sql .= " WHERE";
            foreach ($this->params as $key => $value){
                $sql .= " " . $key . " = :" . $key . " AND";
            }
            // 末尾のANDを削除
            $sql = substr($sql,0,-3);
        }

        $stmt = $this->conn->prepare($sql);

        // 検索項目をセット
        foreach ($this->params as $key => $value){
            var_dump($key);
            var_dump($value);
            $stmt->bindValue($key, $value);
        }

        return $stmt->fetchAll();
    }

}