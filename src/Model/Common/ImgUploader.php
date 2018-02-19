<?php
namespace App\Model\Common;

use RuntimeException;

class ImgUploader{

    // アップロード時の画像名
    private $upload_img_name = 'cocktail';
    // 画像保存一時ディレクトリ
    private $tmp_img_dir = '/tmp/upload_img';

    private $thumbnail_path;

    private $disp_img_path;

    private $thumbnail_width = '150';

    private $disp_img_width = '300';

    /**
     * 画像をS3へアップロードする
     *
     * @throws FileUploadExecption
     */
    public function executeUpload()
    {
        $tmp_dir = $this->tmp_img_dir;
        try {
            if(!file_exists($tmp_dir)){
                throw new RuntimeException('指定のディレクトリがありません。');
            }
            // 未定義、複数ファイル、破損攻撃のいずれかの場合は無効処理
            if (!isset($this->params['img']['error']) || is_array($this->params['img']['error'])){
                throw new RuntimeException('Invalid parameters.');
            }
            // ファイル拡張子を取得
            if (false === $this->params['img']["img_ext"]){
                throw new RuntimeException('Invalid file format.');
            }
            // ファイル名を組み立て
            $to_file_name = $this->upload_img_name . '_' . date( "YmdHis", time()) . '.' . $this->params['img']['img_ext'];
            // 一時ディレクトリにファイルを移動
            //             move_uploaded_file($this->params['img']["tmp_name"], $tmp_dir . '/' . $to_file_name);
            //             $original_file = $tmp_dir . '/' . $to_file_name;
            // サムネイルと表示用画像を作成
            $this->hundleResizeImg($this->params['img']["tmp_name"], $to_file_name);

            $this->s3FileUpload();

        } catch (\Exception $e){
            throw new FileUploadException($e);
        }
        return ;
    }

    /**
     * リサイズされた画像を作成
     * @param $original_file
     * @param $thumb_width
     */
    private function hundleResizeImg($original_file, $to_file_name)
    {
        // 生成するが画像のパスを生成
        $this->thumbnail_path = 'thumbnail_' . $this->tmp_img_dir . $to_file_name;
        $this->disp_img_path = $this->tmp_img_dir . $to_file_name;
        // サムネイルと表示用画像を作成する
        $this->resizeImg($original_file, $this->thumbnail_path, $this->thumbnail_width);
        $this->resizeImg($original_file, $this->disp_img_path, $this->disp_img_width);
    }

    /**
     * リサイズ画像を作成する
     * @param $original_file
     * @param $to_file_path
     * @param $thumb_width
     */
    private function resizeImg($original_file, $to_file_path, $thumb_width)
    {
        list($original_width, $original_height) = getimagesize($original_file);

        $thumb_height = round( $original_height * $thumb_width / $original_width );
        $thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);

        if($this->params['img']["img_ext"] === 'jpg') $original_image = imagecreatefromjpeg($original_file);
        if($this->params['img']["img_ext"] === 'png') $original_image = imagecreatefrompng($original_file);
        if($this->params['img']["img_ext"] === 'gif') $original_image = imagecreatefromgif($original_file);

        magecopyresized($thumb_image, $original_image, 0, 0, 0, 0,
            $thumb_width, $thumb_height,
            $original_width, $original_height);

        if($this->params['img']["img_ext"] === 'jpg') imagejpeg($thumb_image, $to_file_path);
        if($this->params['img']["img_ext"] === 'png') imagepng($thumb_image, $to_file_path);
        if($this->params['img']["img_ext"] === 'gif') imagegif($thumb_image, $to_file_path);
    }

    private function s3FileUpload()
    {
        // TODO ファイルアップロードを実装
    }

}