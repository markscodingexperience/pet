<?php
class Bookmark extends CI_Model {
     function get_all_bookmarks()
     {
         return $this->db->query("SELECT * FROM bookmarks")->result_array();
     }
     function get_bookmark_by_id($bookmark_id)
     {
         return $this->db->query("SELECT * FROM bookmarks WHERE id = ?", array($bookmark_id))->row_array();
     }
     function delete_bookmark($bookmark_id){
         return $this->db->delete("bookmarks", array('id' => $bookmark_id));
     }
     function add_bookmark($bookmark)
     {
         $query = "INSERT INTO bookmarks(name, url, folder, created_at, updated_at) VALUES (?,?,?,?,?)";
         $values = array($bookmark['name'], $bookmark['url'], $bookmark['folder'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s")); 
         return $this->db->query($query, $values);
     }
}