<?php
class Text extends CI_Model{
    public function add_message($data){
        $query = 'INSERT INTO dashboard_messages(message, created_at, updated_at, user_id, posted_by) VALUES (?,NOW(),NOW(), ?, ?)';
        return $this->db->query($query, $data);
    }
    public function add_comment($data){
        $query = 'INSERT INTO dashboard_comments(comment, created_at, updated_at, message_id, posted_by) VALUES (?,NOW(),NOW(), ?, ?)';
        return $this->db->query($query, $data);
    }
    public function get_messages_by_id($id){
        $query = "SELECT dashboard_messages.id, dashboard_messages.message,
         dashboard_messages.created_at, posters.first_name, posters.last_name FROM dashboard_messages JOIN dashboard_users AS posters ON dashboard_messages.posted_by = posters.id WHERE user_id = ? ORDER BY dashboard_messages.created_at DESC";
        return $this->db->query($query, array($id))->result_array();
    }
    public function get_comments_by_message_id($message_id){
        $query = "SELECT dashboard_comments.comment, dashboard_comments.created_at, posters.first_name, posters.last_name
        FROM dashboard_comments JOIN dashboard_users AS posters ON dashboard_comments.posted_by = posters.id WHERE message_id = ?
        ORDER BY dashboard_comments.created_at DESC";
        return $this->db->query($query, array($message_id))->result_array();
    }
}
 ?>
