<?php

namespace MyApp\Model;

class Chat extends \MyApp\Model {


  public function createRoom($values) {
    $stmt = $this->db->prepare("insert into room (host_user, invited_user, create_date, modified_date) values (:host_user, :invited_user, now(), now())");
    $res = $stmt->execute([
      ':host_user' => $values['host_user'],
      ':invited_user' => $values['invited_user']
    ]);
      track('SQL文: ' . print_r($stmt, true));
    if (!$res) {
      throw new \MyApp\Exception\Query();
    }
    $lastInsertId = $this->db->lastInsertId();
    return $lastInsertId;
  }

  public function insertMsg($values) {
    track('$valuesの中身:' . print_r($values, true));
    $stmt = $this->db->prepare("insert into message (room_id, from_user, to_user, msg, create_date, modified_date) values (:room_id, :from_user, :to_user, :msg, now(), now())");
    $res = $stmt->execute([
      ':room_id' => $values['room_id'],
      ':from_user' => $values['from_user'],
      ':to_user' => $values['to_user'],
      ':msg' => $values['msg']
    ]);
    track(print_r($stmt, true));
    if (!$res) {
      throw new \MyApp\Exception\Query();
    }
    return;
  }



  public function delete($table, $where, $values) {

    $stmt = $this->db->prepare("update " . $table . " set delete_flg = 1 where " . $where . " = : " . $where . " and delete_flg = 0");
    $res = $stmt->execute([
      ':' . $where => $values[$where]
    ]);

    if (!$res) {
       throw new \MyApp\Exception\Query();
    }
    return;
  }

  public function modifyMsg($values) {
      $stmt = $this->db->prepare('update message set msg = :msg,  modified_date = now() where id = :id and delete_flg = 0');
      $res = $stmt->execute([
        ':msg' => $values['msg'],
        ':id' => $values['id']
        ]);   

      if (!$res) {
        throw new \MyApp\Exception\Query();
      }
  }

  public function getrooms($id, $orderby = 'id', $in = 'ASC') {
    $stmt = $this->db->prepare("select * from room where host_user = :user_id or invited_user = :user_id and delete_flg = 0 order by " . $orderby . " " . $in);
    $res = $stmt->execute([
        ':user_id' => $id
      ]);

    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $rooms = $stmt->fetchAll();
      if (!$rooms) {
        throw new \MyApp\Exception\Query();
      } else {
        return $rooms;
      }
  }

  public function getRoom($values) {
    $stmt = $this->db->prepare("select * from room where id = :id and delete_flg = 0");
    $res = $stmt->execute([
        ':id' => $values['id']
      ]);
      track(print_r($stmt, true));
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $room = $stmt->fetch();
      if (!$room) {
        throw new \MyApp\Exception\Query();
      } else {
        return $room;
      }
  }

  public function isExistRoom($values) {
    $stmt = $this->db->prepare("select id, host_user, invited_user from room where host_user = :me and invited_user = :friend or host_user = :friend and invited_user = :me and delete_flg = 0");
    $res = $stmt->execute([
      ':me' => $values['me'],
      ':friend' => $values['friend']
    ]);

    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $room = $stmt->fetchAll();
    if (!$room) {
      return false;
    } else {
      return $room;
    }
  }

  public function isBelonged($values) {
    $stmt = $this->db->prepare("select count(id) from room where id = :id and host_user = :me and delete_flg = 0 or id = :id and invited_user = :me and delete_flg = 0");
    $res = $stmt->execute([
      ':id' => $values['id'],
      ':me' => $values['me']
    ]);
    $count = $stmt->fetchColumn();
    if ($count == 0) {
      return false;
    } else {
      return true;
    }
  }


  public function getMsg($room_id, $orderby = 'id', $in = 'ASC' ) {
    $stmt = $this->db->prepare("select * from message where room_id = :room_id and delete_flg = 0 order by " . $orderby . " " . $in);
    $res = $stmt->execute([
        ':room_id' => $room_id,
      ]);
    track(print_r($stmt, true));
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $msg = $stmt->fetchAll();
      if (!$msg) {
        return false;
      } else {
        return $msg;
      }
  }

  

  

}