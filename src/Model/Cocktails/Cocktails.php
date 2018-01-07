<?php
namespace App\Model\Cocktails;

class Cocktails
{

    private $params;

    private $messages = [];

    public function __construct($params){
        $this->params = $params;
    }

    /**
     * バリデーションを実行する
     * @return array
     */
    public function validate(){

        if(empty(trim($this->params['name'])) && count($this->params) <= 1){
            $this->messages[] = "検索条件を入力してください";
        }

        return $this->messages;
    }
}