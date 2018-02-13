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
            case self::SAVE_SUCCESS:
                $message = '保存しました。';
                break;
            case self::VALIDATE_ERROR:
                $message = 'エラーを確認してください。';
                break;
            case self::SAVE_ERROR:
                $message = '処理中にエラーが発生しました。';
                break;
        }
        return $message;
    }

}