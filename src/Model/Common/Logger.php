<?php
namespace App\Model\Common;

/**
 * ログの出力クラス
 * @author m-hatano
 */
class Logger
{

    /**
     * ログを出力する
     * 出力先は環境によって異なるため設定を確認。
     * @param string 出力メッセージ
     * @param string ログレベル
     */
    public function log(string $str, $log_level = LOG_INFO)
    {
        // heroku環境は標準出力でheroku logsへ出力
        if (isset($_ENV['CAKE_ENV']) && $log_level !== LOG_ERR) {
            if ($log_level === LOG_ERR) {
                $stdout = fopen('php://stderr', 'w');
            } else {
                $stdout = fopen('php://stdout', 'w');
            }
            fwrite($stdout, $str);
        } else {
            // ローカル環境はcakelogでlogsへ出力
            $this->log($str, $log_level);
        }
    }
}