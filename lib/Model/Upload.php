<?php

namespace MyApp\Model;

class Upload extends \MyApp\Model {

private $_imageFileName;

public function save($file) {
  //MIMEタイプの確認
  $imageType = @exif_imagetype($file['tmp_name']);
  //拡張子取得
  $ext = image_type_to_extension($imageType);
  track('拡張子:' . $ext);
  //ファイル名作成(現在時刻+一意の乱数)
  $this->_imageFileName = sprintf(
    '%s_%s.%s',
    time(),
    sha1(uniqid(mt_rand(), true)),
    $ext
  );
  //ファイル保存先の指定
  $savePath = UPLOAD_DIR . '/' . $this->_imageFileName;
  //ファイルを一時保存先からファイル保存先へ移動
  $res = move_uploaded_file($file['tmp_name'], $savePath);
  if (!$res) {
    throw new \MyApp\Exception\SaveFailure();
  } else {
    //権限の変更(所有者:rw- その他:r--)
    chmod($savePath, 0644);
    return $savePath;
  }
}

public function upload($table, $column, $filePath, $id) {
  $stmt = $this->db->prepare('update ' . $table . ' set ' . $column . ' = :' . $filePath . ', modified_date = now()  where id = :id');
  $res = $stmt->execute([
    ':' . $filePath => $filePath,
    ':id' => $id
  ]);
}

}