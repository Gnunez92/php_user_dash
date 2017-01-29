<?php
class User extends CI_Model{
    public function get_all_users(){
        $query="SELECT id, email, first_name,last_name,created_at,user_level FROM dashboard_users";
        return $this->db->query($query)->result_array();
    }
    public function get_user_by_email($email){
        $query = "SELECT * FROM dashboard_users WHERE email = ?";
        return $this->db->query($query,array($email))->row_array();
    }
    public function get_user_profile($id){
        $query = "SELECT id, email, first_name, last_name, description, created_at FROM dashboard_users WHERE id = ?";
        return $this->db->query($query,array($id))->row_array();
    }
    public function get_user_by_id($id){
        $query = "SELECT id, email, first_name, last_name, description, user_level FROM dashboard_users WHERE id = ?";
        return $this->db->query($query,array($id))->row_array();
    }
    public function add_user($data){
        $query = "INSERT INTO dashboard_users (email, first_name, last_name, password, user_level, created_at, updated_at)  VALUES (?,?,?,?,?,?,NOW())";
        return $this->db->query($query,$data);
    }
    public function check_empty_table(){
        $query = "SELECT id FROM dashboard_users";
        return $this->db->query($query)->result_array();
    }
    public function update_desc($desc){
        $query = "UPDATE dashboard_users SET description = ?, updated_at = ? WHERE id = ?";
        return $this->db->query($query,$desc);
    }
    public function update_info($data){
        $query = "UPDATE dashboard_users SET email = ?, first_name = ?, last_name = ?, updated_at = ? WHERE id = ?";
        return $this->db->query($query,$data);
    }
    public function update_password($pass){
        $query = "UPDATE dashboard_users SET password = ?, updated_at = ? WHERE id = ?";
        return $this->db->query($query,$pass);
    }
    public function change_user_level($data){
        $query = "UPDATE dashboard_users SET user_level = ?, updated_at = ? WHERE id = ?";
        return $this->db->query($query,$data);
    }
    public function delete_user($id){
        $query = "DELETE FROM dashboard_users WHERE id = ?";
        return $this->db->query($query,array($id));
    }
}
