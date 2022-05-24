<?php
class User extends CI_Model {
     function get_all_contacts()
     {
         return $this->db->query("SELECT * FROM phones")->result_array();
     }
     function get_contact_by_id($phonebook_id)
     {
         return $this->db->query("SELECT * FROM phones WHERE id = ?", array($phonebook_id))->row_array();
     }
     function delete_contact($phonebook_id){
         return $this->db->delete("phones", array('id' => $phonebook_id));
     }
     function add_user($user){
         $query = "INSERT INTO users(first_name, last_name, contact, 
         password, salt, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
         $values = array($user['first_name'], $user['last_name'], $user['contact'], 
         $user['password'], $user['salt'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
         return $this->db->query($query, $values);
     }
     function update_contact($phonebook){
        $data = array(
            'name' => $phonebook['name'],
            'contact' => $phonebook['contact'],
            'updated_at' =>  date("Y-m-d, H:i:s")
        );
        $this->db->where('id', $phonebook['id']);
        $this->db->update('phones', $data);
     }
     function login_user($contact){
        return $this->db->query("SELECT * FROM users WHERE contact = ?", array($contact))->row_array();
     }
     function get_password($contact){
         return $this->db->query("SELECT password FROM users WHERE contact = ?", $contact)->row()->password;
     }
     function get_salt($contact){
        return $this->db->query("SELECT salt FROM users WHERE contact = ?", $contact)->row()->salt;
     }
}