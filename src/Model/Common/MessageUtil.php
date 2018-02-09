<?php
namespace App\Model\Common;

class MessageUtil{

    const SAVE_SUCCESS = '10';
    const VALIDATE_ERROR = '20';
    const SAVE_ERROR = '21';

    public static function getMsg($code, $s = null)
    {
        $message = '';
        switch ($code){
            case SAVE_SUCCESS:
                $message = '保存しました。';
                break;
            case VALIDATE_ERROR:
                $message = 'エラーを確認してください。';
                break;
            case SAVE_ERROR:
                $message = '処理中にエラーが発生しました。';
                break;
        }
        return $message;
    }

}