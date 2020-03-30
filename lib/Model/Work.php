<?php

namespace MyApp\Model;

class Work extends \MyApp\Model {


public function upload($values) {
  $stmt = $this->db->prepare("insert into work (work, thumbnail, title, category, description, create_user, modified_date, create_date) values (:work, :thumbnail, :title, :category, :description, :create_user, now(), now())");
  $res = $stmt->execute([
    ':work' => $values['work'],
    ':thumbnail' => $values['thumbnail'],
    ':title' => $values['title'],
    ':category' => $values['category'],
    ':description' => $values['description'],
    ':create_user' => $values['create_user']
  ]);

  $lastInsertId = $this->db->lastInsertId();
  $stmt2 = $this->db->query("select * from work where id =" . $lastInsertId);
  $stmt2->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $work = $stmt2->fetch();

  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
  return $work;
}

public function getCategories() {
  $stmt = $this->db->query("select * from categories where delete_flg = 0");
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $categories = $stmt->fetchAll();
  return $categories;
}

public function getMyWork($values) {
  $stmt = $this->db->prepare("select * from work where create_user = :me and delete_flg = 0");
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  track('My Work：' . print_r($works, true));
  return $works;
}

public function getFriendWork($values) {
  $stmt = $this->db->prepare("select work.*, users.id, users.surname, users.givenname, users.slogan, users.profile, users.profile_img, users.banner_img from work inner join users on work.create_user = users.id where work.create_user = :create_user and work.delete_flg = 0 and users.delete_flg = 0");
  $res = $stmt->execute([
    ':create_user' => $values['create_user']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  track('Friend Work：' . print_r($works, true));
  return $works;
}

}