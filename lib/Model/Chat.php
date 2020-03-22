<?php

namespace MyApp\Model;

class Chat extends \MyApp\Model {


  public function createRoom($values) {
    $stmt = $this->db->prepare("insert into room (host_user, invited_user, create_date, modified_date) values (:host_user, :invited_user, now(), now()");
    $res = $stmt->execute([
      ':host_user' => $values['host_user'],
      ':invited_user' => $values['invited_user']
    ]);

    if (!$res) {
      throw new \MyApp\Exception\Query();
    }
    return;
  }

  public function insertMsg($values) {
    $stmt = $this->db->prepare("insert into message (room_id, from_user, to_user, msg, created_date, modified_date) values (:room_id, :from_user, :to_user, :msg, now(), now())");
    $res = $stmt->execute([
      ':room_id' => $values['room_id'],
      ':from_user' => $values['from_user'],
      ':to_user' => $values['to_user'],
      ':msg' => $values['msg']
    ]);

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

  public function getMsg($room_id, $orderby = 'id', $in = 'ASC' ) {
    $stmt = $this->db->prepare("select * from message where room_id = :room_id and delete_flg = 0 order by " . $orderby . " " . $in);
    $res = $stmt->execute([
        ':room_id' => $room_id,
      ]);

    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      $msg = $stmt->fetchAll();
      if (!$msg) {
        throw new \MyApp\Exception\Query();
      } else {
        return $msg;
      }
  }

  

  

}