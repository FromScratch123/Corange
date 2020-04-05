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

public function getMyWorks($values, $order = 'modified_date', $in = 'ASC') {
  $stmt = $this->db->prepare("select * from work where create_user = :me and delete_flg = 0 order by " . $order . " " . $in);
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function getFriendWorks($values, $order = 'modified_date', $in = 'DESC') {
  $stmt = $this->db->query("select work.*, users.id, users.surname, users.givenname, users.slogan, users.profile, users.profile_img, users.banner_img from work inner join users on work.create_user = users.id where " . $values['create_user'] . " and work.delete_flg = 0 and users.delete_flg = 0 order by " . $order . " " . $in);

  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function getWork($values) {
  $stmt = $this->db->prepare("select work.*, categories.name from work inner join categories on work.category = categories.id where work_id = :work_id");
  $res = $stmt->execute([
    ':work_id' => $values['work_id']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $work = $stmt->fetch();
  return $work;
}

public function search($values, $order = 'modified_date', $in = 'DESC') {
  $stmt = $this->db->prepare("select work.*, users.id, users.surname, users.givenname, users.slogan, users.profile, users.profile_img, users.banner_img from work inner join users on work.create_user = users.id where work.create_user like :search and work.delete_flg = 0 and users.delete_flg = 0 or work.title like :search and work.delete_flg = 0 and users.delete_flg = 0 or work.description like :search and work.delete_flg = 0 and users.delete_flg = 0 or users.surname like :search and work.delete_flg = 0 and users.delete_flg = 0 or users.givenname like :search and work.delete_flg = 0 and users.delete_flg = 0 order by " . $order . " " . $in);
  $res = $stmt->execute([
    ':search' => "%" . $values['search'] . "%",
  ]);

  track(print_r($stmt, true));

  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $works = $stmt->fetchAll();
    if (!$works) {
      return false;
    } else {
      return $works;
    }
}

}