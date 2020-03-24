<?php

namespace MyApp\Model;

class Friend extends \MyApp\Model {


  public function beFriend($values) {
    $stmt = $this->db->prepare("insert into friend (follow_user, followed_user, create_date, modified_date) values (:follow_user, :followed_user, now(), now())");
    $res = $stmt->execute([
      ':follow_user' => $values['follow_user'],
      ':followed_user' => $values['followed_user']
    ]);
      track(print_r($stmt, true));
    if (!$res) {
      throw new \MyApp\Exception\Query();
    }
    return;
  }

  public function isFriend($values) {
    $stmt = $this->db->prepare("select count(id) from friend where follow_user = :me and followed_user = :client and accept_flg = 1 or follow_user = :client and followed_user = :me and accept_flg = 1");
    $res = $stmt->execute([
      ':me' => $values['me'],
      ':client' => $values['client']
    ]);
      
      $count = $stmt->fetchColumn();
      if ($count == 0) {
        return false;
      } else {
        return true;
      }
  }

  public function isAsked($values) {
    $stmt = $this->db->prepare("select count(id) from friend where follow_user = :me and followed_user = :client and accept_flg = 0 or follow_user = :client and followed_user = :me and accept_flg = 0" );
    $res = $stmt->execute([
      ':me' => $values['me'],
      ':client' => $values['client']
    ]);

    $count = $stmt->fetchColumn();
    if ($count == 0) {
      return false;
    } else {
      return true;
    }
  }

  public function createRoom($values) {
    $stmt = $this->db->prepare("insert into room (host_user, invited_user, create_date, modified_date) values (:host_user, :invited_user, now(), now()");
    $res = $stmt->execute([
      ':host_user' => $values['host_user'],
      ':invited_user' => $values['invited_user']
    ]);

    if (!$res) {
      throw new \MyApp\Exception\Query();
    }

    $lastInsertId = $this->db->lastInsertId();
    $stmt2 = $this->db->query("select * from room where id =" . $lastInsertId);
    $stmt2->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $room = $stmt2->fetch();
    return $room;
  }


  public function delete($values) {

    $stmt = $this->db->prepare("delete from friend where follow_user = :me and followed_user = :friend or follow_user = :friend and followed_user = :me");
    $res = $stmt->execute([
      ':me' => $values['me'],
      ':friend' => $values['friend']
    ]);

    if (!$res) {
       throw new \MyApp\Exception\Query();
    }
    return;
  }

  public function accept($values) {
      $stmt = $this->db->prepare('update friend set accept_flg = 1,  modified_date = now() where follow_user = :follow_user and followed_user = :followed_user and delete_flg = 0');
      $res = $stmt->execute([
        ':follow_user' => $values['follow_user'],
        ':followed_user' => $values['followed_user']
        ]);   
        track(print_r($stmt));
      if (!$res) {
        throw new \MyApp\Exception\Query();
      }
  }

  public function getFriend($id, $orderby = 'id', $in = 'ASC') {
    $stmt = $this->db->prepare("select friend.delete_flg, friend.follow_user, friend.followed_user, friend.accept_flg, users.id, users.surname, users.givenname, users.profile_img from friend inner join users on friend.follow_user = users.id or friend.followed_user = users.id where users.id not in (" . $id . ") and friend.follow_user = :follow_user or friend.followed_user = :followed_user and users.id not in (" . $id . ") and users.delete_flg = 0 order by " . $orderby . " " . $in);
    track(print_r($stmt,true));
    $res = $stmt->execute([
        ':follow_user' => $id,
        ':followed_user' => $id
      ]);

    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $friends = $stmt->fetchAll();
      if (!$friends) {
        throw new \MyApp\Exception\Query();
      } else {
        return $friends;
      }
  }


}