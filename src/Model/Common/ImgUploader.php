<?php
namespace App\Model\Common;

use Aws\S3\S3Client;
use RuntimeException;
use Aws\Credentials\Credentials;

class ImgUploader{

    private $logger;

    private $params;
    // アップロード時の画像名
    private $upload_img_prefix = 'cocktail';
    // 扱うファイルの拡張子
    private $ext;
    // 画像保存一時ディレクトリ
    private $tmp_img_dir = '/tmp/upload_img';

    private $env_dir = 'dev';

    private $to_file_name;

    private $tmp_thumbnail_path;

    private $tmp_disp_img_path;
    // 生成するサムネイルのサイズ
    const THUMBNAIL_WIDTH = '150';
    // 生成する表示用画像のサイズ
    const DISP_IMG_WIDTH = '300';
    // S3への接続情報
    private $s3client;
    const REGION = 'ap-northeast-1';
    const S3_BUCKET_NAME = 'cocktails-img-bucket';

    public function __construct($params)
    {
        $this->logger = new Logger();
        $this->params = $params;
        $env = env('CAKE_ENV');
        if(isset($env) && $env == 'heroku'){
            $this->env_dir = 'prd';
        }
    }

    /**
     * 画像をS3へアップロードする
     * @throws FileUploadExecption
     */
    public function execute()
    {
        try {
            if(!file_exists($this->tmp_img_dir) && !mkdir($this->tmp_img_dir, 0700)){
                throw new RuntimeException('Not Found or Not Make tmp_img_dir.');
            }
            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($this->params['img']['error']) || !is_int($this->params['img']['error'])){
                throw new RuntimeException('Invalid parameters.');
            }
            // ファイル拡張子を取得
            if(!mime_content_type($this->params['img']['tmp_name'])){
                throw new RuntimeException('Invalid file format.');
            }
            $this->ext = pathinfo($this->params['img']['name'], PATHINFO_EXTENSION);
            // ファイル名を組み立て
            $this->to_file_name = $this->upload_img_prefix . '_' . date( "YmdHis", time()) . '.' . $this->ext;
            // サムネイルと表示用画像を作成
            $this->createDispAndThumb();

            return $this->upload();

        } catch (\Exception $e){
            throw new FileUploadException($e);
        }
    }

    /**
     * サムネイルと表示用画像を作成する
     * @param $original_file
     * @param $to_file_name
     */
    private function createDispAndThumb()
    {
        // 生成する画像のパスを生成
        $this->tmp_thumbnail_path = $this->tmp_img_dir . '/thumbnail_' . $this->to_file_name;
        $this->tmp_disp_img_path = $this->tmp_img_dir . '/' . $this->to_file_name;
        // サムネイルと表示用画像を作成する
        $this->resizeImg($this->params['img']["tmp_name"], $this->tmp_thumbnail_path, self::THUMBNAIL_WIDTH);
        $this->resizeImg($this->params['img']["tmp_name"], $this->tmp_disp_img_path, self::DISP_IMG_WIDTH);
    }

    /**
     * リサイズ画像を作成する
     * @param $original_file
     * @param $to_file_path
     * @param $width
     */
    private function resizeImg($original_file, $to_file_path, $width)
    {
        list($original_width, $original_height) = getimagesize($original_file);
        // 縦横比はそのままで空の画像を作成
        $height = round( $original_height * $width / $original_width );
        $image = imagecreatetruecolor($width, $height);
        // オリジナルコピー画像を空画像にマージ
        if($this->ext === 'jpg' || $this->ext === 'jpeg') $original_image = imagecreatefromjpeg($original_file);
        if($this->ext === 'png') $original_image = imagecreatefrompng($original_file);
        if($this->ext === 'gif') $original_image = imagecreatefromgif($original_file);
        imagecopyresized($image, $original_image, 0, 0, 0, 0,
            $width, $height, $original_width, $original_height);
        // ディレクトリに画像を保存
        if($this->ext === 'jpg' || $this->ext === 'jpeg') imagejpeg($image, $to_file_path);
        if($this->ext === 'png') imagepng($image, $to_file_path);
        if($this->ext === 'gif') imagegif($image, $to_file_path);
    }

    /**
     * ファイルアップロードし、表示用画像のパスを返却する
     * @return $path
     */
    private function upload()
    {
        $this->s3client = new S3Client([
            'credentials' => new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY')),
            'region' => self::REGION,
            'version' => 'latest',
        ]);
        $this->logger->log('file_name: ' . $this->to_file_name);
        //画像のアップロード
        $this->s3PutObject($this->tmp_thumbnail_path, 'thumbnail_' . $this->to_file_name);
        $result = $this->s3PutObject($this->tmp_disp_img_path, $this->to_file_name);
        // 成功したらディレクトリ配下を削除
        unlink($this->tmp_thumbnail_path);
        unlink($this->tmp_disp_img_path);
        //読み取り用のパスを返す
        return $result['ObjectURL'];
    }

    /**
     * S3へファイルをPUTする
     * @param $image 保存元画像パス
     * @param $to_file_name 保存先画像パス
     * @return $result
     */
    private function s3PutObject($source_file, $to_file_name)
    {
        return $this->s3client->putObject([
                    'Bucket' => self::S3_BUCKET_NAME,
                    'Key' => $this->env_dir . '/' . $to_file_name,
                    'ContentType' => mime_content_type($source_file),
                    'SourceFile' => $source_file,
                    'ACL' => 'public-read',
                ]);
    }

}