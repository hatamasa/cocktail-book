<?php
namespace App\Model\Common;

use RuntimeException;

class ImgUploader{

    // アップロード時の画像名
    private $upload_img_prefix = 'cocktail';
    // 扱うファイルの拡張子
    private $ext;
    // 画像保存一時ディレクトリ
    private $tmp_img_dir = '/tmp/upload_img';

    private $to_file_name;

    private $thumbnail_path;

    private $disp_img_path;
    // 生成するサムネイルのサイズ
    const THUMBNAIL_WIDTH = '150';
    // 生成する表示用画像のサイズ
    const DISP_IMG_WIDTH = '300';
    // S3への接続情報
    private $s3client;
    const AWS_ACCESS_KEY_ID ='IAMユーザーのAccessKey';
    const AWS_SECRET_ACCESS_KEY = 'IAMユーザーのSecretAccessKey';
    const S3_BUCKET_NAME = '設定したS3バケット名';

    /**
     * 画像をS3へアップロードする
     * @throws FileUploadExecption
     */
    public function execute()
    {
        try {
            if(!file_exists($this->tmp_img_dir)){
                throw new RuntimeException('指定のディレクトリがありません。');
            }
            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($this->params['img']['error']) || is_array($this->params['img']['error'])){
                throw new RuntimeException('Invalid parameters.');
            }
            // ファイル拡張子を取得
            if(!$this->ext = mime_content_type($this->params['img']['tmp_name'])){
                throw new RuntimeException('Invalid file format.');
            }
            // ファイル名を組み立て
            $this->to_file_name = $this->upload_img_prefix . '_' . date( "YmdHis", time()) . '.' . $this->ext;
            // サムネイルと表示用画像を作成
            $this->createDispAndThumb();

            return $this->upload();

        } catch (\Exception $e){
            throw new FileUploadException($e);
        }
        return ;
    }

    /**
     * サムネイルと表示用画像を作成する
     * @param $original_file
     * @param $to_file_name
     */
    private function createDispAndThumb()
    {
        // 生成する画像のパスを生成
        $this->thumbnail_path = $this->tmp_img_dir . '/thumbnail_' . $this->to_file_name;
        $this->disp_img_path = $this->tmp_img_dir . '/' . $this->to_file_name;
        // サムネイルと表示用画像を作成する
        $this->resizeImg($this->params['img']["tmp_name"], $this->thumbnail_path, self::THUMBNAIL_WIDTH);
        $this->resizeImg($this->params['img']["tmp_name"], $this->disp_img_path, self::DISP_IMG_WIDTH);
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
        if($this->ext === 'jpg') $original_image = imagecreatefromjpeg($original_file);
        if($this->ext === 'png') $original_image = imagecreatefrompng($original_file);
        if($this->ext === 'gif') $original_image = imagecreatefromgif($original_file);
        magecopyresized($image, $original_image, 0, 0, 0, 0,
            $width, $height, $original_width, $original_height);
        // ディレクトリに画像を保存
        if($this->ext === 'jpg') imagejpeg($image, $to_file_path);
        if($this->ext === 'png') imagepng($image, $to_file_path);
        if($this->ext === 'gif') imagegif($image, $to_file_path);
    }

    /**
     * ファイルアップロードし、表示用画像のパスを返却する
     * @return $path
     */
    private function upload()
    {
        // TODO ファイルアップロードを実装
        $this->s3client = new Aws\S3\S3Client([
            'credentials' => [
                'key' => self::AWS_ACCESS_KEY_ID,
                'secret' => self::AWS_SECRET_ACCESS_KEY,
            ],
            'region' => 'us-east-2',
            'version' => 'latest',
        ]);
        //画像のアップロード
        $this->s3PutObject(fopen($this->thumbnail_path,'rb'));
        $result = $this->s3PutObject(fopen($this->disp_img_path,'rb'));

        //読み取り用のパスを返す
        return $result['ObjectURL'];
    }

    /**
     * S3へファイルをPUTする
     * @param $image 元画像パス
     * @return $result
     */
    private function s3PutObject($image)
    {
        return $this->s3client->putObject([
                    'Bucket' => self::S3_BUCKET_NAME,
                    'Key' => $this->to_file_name,
                    'SourceFile' => $image,
                    'ACL' => 'public-read',
                ]);
    }

}