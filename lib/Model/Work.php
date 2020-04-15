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
  $stmt2 = $this->db->query("select * from work where work_id =" . $lastInsertId);
  $stmt2->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $work = $stmt2->fetch();

  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
  return $work;
}

public function modifiedWork($values) {
  $stmt = $this->db->prepare("update work set title = :title, category = :category, description = :description, modified_date = now() where work_id = :work_id and delete_flg = 0 ");
  $res = $stmt->execute([
    ':title' => $values['title'],
    ':category' => $values['category'],
    ':description' => $values['description'],
    ':work_id' => $values['work_id']
  ]);

  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
}

public function delete($values) {
  $stmt = $this->db->prepare("update work set delete_flg = 1, modified_date = now() where work_id = :work_id and create_user = :me");
  $res = $stmt->execute([
    ':work_id' => $values['work_id'],
    ':me' => $values['me']
  ]);
  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
}

public function getCategories() {
  $stmt = $this->db->query("select * from categories where delete_flg = 0");
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $categories = $stmt->fetchAll();
  return $categories;
}

public function getAllWorks($values, $order = 'create_date', $in = 'ASC', $offset = 0) {
  $stmt = $this->db->prepare("select work.*, users.id, users.surname, users.givenname, users.profile_img from work inner join users on work.create_user = users.id where create_user not in(:me) and work.delete_flg = 0 and users.delete_flg = 0 order by " . $order . " " . $in . " limit 10 offset " . $offset);
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function getMyWorks($values, $order = 'modified_date', $in = 'ASC') {
  $stmt = $this->db->prepare("select work.*, users.id, users.surname, users.givenname, users.profile_img from work inner join users on work.create_user = users.id where create_user = :me and work.delete_flg = 0 and users.delete_flg = 0 order by " . $order . " " . $in);
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function getFriendWorks($values, $order = 'create_date', $in = 'DESC') {
  $stmt = $this->db->query("select work.*, users.id, users.surname, users.givenname, users.slogan, users.profile, users.profile_img, users.banner_img from work inner join users on work.create_user = users.id where " . $values['create_user'] . " and work.delete_flg = 0 and users.delete_flg = 0 order by " . $order . " " . $in);

  track(print_r($stmt, true));
  if ($stmt) {
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $works = $stmt->fetchAll();
    return $works;
  } else {
    return false;
  }
}

public function getWork($values) {
  $stmt = $this->db->prepare("select work.*, categories.name from work inner join categories on work.category = categories.id where work.work_id = :work_id");
  $res = $stmt->execute([
    ':work_id' => $values['work_id']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $work = $stmt->fetch();
  return $work;
}

public function isMyWork($values) {
  $stmt = $this->db->prepare("select count(work_id) from work where work_id = :work_id and create_user = :me and delete_flg = 0");
  $res = $stmt->execute([
    ':work_id' => $values['work_id'],
    ':me' => $values['me']
  ]);

  $count = $stmt->fetchColumn();
  if ($count == 0) {
    return 0;
  } else {
    return 1;
  }
}

public function getComment($values) {
  $stmt = $this->db->prepare("select comment.comment, comment.post_user, users.id, users.surname, users.givenname, users.profile_img from comment inner join users on comment.post_user = users.id where work_id = :work_id and comment.delete_flg = 0 and users.delete_flg = 0");
  $res = $stmt->execute([
    ':work_id' => $values['work_id']
  ]);
  if (!$res) {
    return false;
  } 
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $comment = $stmt->fetchAll();
  return $comment;
}

public function search($values, $order = 'create_date', $in = 'DESC') {
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

public function insertComment($values, $open_flg = 0) {
  $stmt = $this->db->prepare("insert into comment (work_id, comment, post_user, open_flg, modified_date, create_date) values (:work_id, :comment, :post_user, " . $open_flg . ", now(), now())");
  $res = $stmt->execute([
    ':work_id' => $values['work_id'],
    ':comment' => $values['comment'],
    ':post_user' => $values['post_user']
  ]);
  track(print_r($stmt, true));
  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
  return;
}

public function insertFavorite($values) {
  $stmt = $this->db->prepare("insert into favorite (register_user, create_user, work_id, create_date, modified_date) values (:register_user, :create_user, :work_id, now(), now())");
  $res = $stmt->execute([
    ':register_user' => $values['register_user'],
    ':create_user' => $values['create_user'],
    ':work_id' => $values['work_id']
  ]);
  track(print_r($stmt, true));
  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
  return;
}

public function deleteFavorite($values) {
  $stmt = $this->db->prepare("delete from favorite where register_user = :register_user and create_user = :create_user and work_id = :work_id");
  $res = $stmt->execute([
    ':register_user' => $values['register_user'],
    ':create_user' => $values['create_user'],
    ':work_id' => $values['work_id']
  ]);
  track(print_r($stmt, true));
  if (!$res) {
    throw new \MyApp\Exception\Query();
  }
  return;
}

public function isFavorite($values) {
  $stmt = $this->db->prepare("select count(favorite_id) from favorite where register_user = :me and work_id = :work_id");
  $res = $stmt->execute([
    ':me' => $values['me'],
    ':work_id' => $values['work_id']
  ]);
    
    $count = $stmt->fetchColumn();
    if ($count == 0) {
      return 0;
    } else {
      return $count;
    }
}

public function getMyFavorite($values, $order = 'create_date', $in = 'DESC') {
  $stmt = $this->db->prepare("select work.*, users.id, users.surname, users.givenname, users.profile_img from work inner join favorite on work.work_id = favorite.work_id inner join users on work.create_user = users.id where favorite.register_user = :me and work.delete_flg = 0 and users.delete_flg = 0 order by " . $order . " " . $in);
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function favoriteNum($values) {
  $stmt = $this->db->prepare("select count(favorite_id) from favorite where work_id = :work_id");
  $res = $stmt->execute([
    ':work_id' => $values['work_id']
  ]);
  $count = $stmt->fetchColumn();
  if ($count == 0) {
    return 0;
  } else {
    return $count;
  }
}

public function getNewFavorite($values) {
  $stmt = $this->db->prepare("select work.work_id, work.work, work.thumbnail, work.title, work.category, work.description, work.create_user, favorite.favorite_id, favorite.register_user, favorite.create_user, favorite.work_id, favorite.open_flg, favorite.create_date, users.id, users.surname, users.givenname, users.profile_img from work inner join favorite on work.work_id = favorite.work_id inner join users on favorite.register_user = users.id where work.create_user = :me and work.delete_flg = 0 and favorite.open_flg = 0 and users.delete_flg = 0");
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  track(print_r($stmt, true));
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $favorites = $stmt->fetchAll();
    if (!$favorites) {
      return false;
    } else {
      return $favorites;
    }
}

public function getWorkByCategory($values, $order = 'work.create_date', $in = 'ASC', $offset = 0) {
  $stmt = $this->db->prepare("select categories.id, categories.name, work.*, users.id, users.surname, users.givenname, users.profile_img from categories inner join work on categories.id = work.category inner join users on work.create_user = users.id where categories.id = :id and categories.delete_flg = 0 and work.delete_flg = 0 order by " . $order . " " . $in . " limit 10 offset " . $offset);
  $res = $stmt->execute([
    ':id' => $values['id']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function getNewComment($values) {
  $stmt = $this->db->prepare("select work.work_id, work.work, work.thumbnail, work.title, work.category, work.description, work.create_user, comment.comment_id, comment.work_id, comment.comment, comment.post_user, comment.open_flg, comment.modified_date, comment.create_date, users.id, users.surname, users.givenname, users.profile_img, users.banner_img from work inner join comment on work.work_id = comment.work_id inner join users on comment.post_user = users.id where work.create_user = :me and comment.post_user not in(:me) and work.delete_flg = 0 and comment.open_flg = 0 and comment.delete_flg = 0 and users.delete_flg = 0");
  $res = $stmt->execute([
    ':me' => $values['me']
  ]);
  track(print_r($stmt, true));
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $comments = $stmt->fetchAll();
    if (!$comments) {
      return false;
    } else {
      return $comments;
    }
}

public function getTrash($values, $order = 'modified_date', $in = 'DESC') {
  $stmt = $this->db->prepare("select work.*, users.id, users.surname, users.givenname, users.profile_img from work inner join users on work.create_user = users.id where create_user = :me and work.delete_flg = 1 and users.delete_flg = 0 order by " . $order . " " . $in);
  $res = $stmt->execute([
    'me' => $values['me']
  ]);
  $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
  $works = $stmt->fetchAll();
  return $works;
}

public function checkedCommentNote($values) {
  $stmt = $this->db->prepare("update comment set open_flg = 1, modified_date = now() where comment_id = :comment_id");
  track(print_r($stmt, true));
  $res = $stmt->execute([
    ':comment_id' => $values['comment_id']
  ]);

  if (!$res) {
    throw new \MyApp\Exception\Query();
  } else {
    return;
  }

}

public function checkedFavoritetNote($values) {
  $stmt = $this->db->prepare("update favorite set open_flg = 1, modified_date = now() where favorite_id = :favorite_id");
  track(print_r($stmt, true));
  $res = $stmt->execute([
    ':favorite_id' => $values['favorite_id']
  ]);

  if (!$res) {
    throw new \MyApp\Exception\Query();
  } else {
    return;
  }

}

public function getNewCommentNum($values) {
  $stmt = $this->db->prepare("select count(comment_id) from comment inner join work on comment.work_id = work.work_id where work.create_user = :me and work.delete_flg = 0 and comment.open_flg = 0 and comment.delete_flg = 0" );
  $res = $stmt->execute([
    ':me'  => $values['me']
  ]);
  $count = $stmt->fetchColumn();
  if ($count == 0) {
    return 0;
  } else {
    return $count;
  }
}

public function getNewFavoriteNum($values) {
  $stmt = $this->db->prepare("select count(favorite_id) from favorite where create_user = :me and open_flg = 0" );
  $res = $stmt->execute([
    ':me'  => $values['me']
  ]);
  $count = $stmt->fetchColumn();
  if ($count == 0) {
    return 0;
  } else {
    return $count;
  }
}

}