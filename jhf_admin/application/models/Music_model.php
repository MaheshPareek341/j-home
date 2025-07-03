<?php
class Music_model extends CI_Model {
	/*Insert*/
	function get_result($select,$from,$where='',$group_by='')
	{
	    $this->db->select($select);
	    $this->db->from($from);
		if($where!=''){
	    	$this->db->where($where);
		}
		if($group_by!=''){
	    	$this->db->group_by($group_by);
		}
	   	$query=$this->db->get();
		return $query->result();
	}
	
	function add($table, $data) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function update($table, $data, $where){
		return $this->db->update($table, $data, $where );
	}

	// function user_register($user_data) {
	// 	return $this->db->insert('registered_users', $user_data);
	// }


	// function update_profile( $data , $where )
    // {
    //     return $this->db->update( 'registered_users' ,$data, $where );
    // }
    
    public function getAllSongs(){
        return $this->db->select("songs.song_id, songs.cat_id, songs.youtube_url, songs.song_name, songs.song_url, songs.treanding_song, songs.top_song, songs.featured_song, songs.new_release_song, category.cat_name")
             ->from('songs')
             ->join('category', 'category.cat_id = songs.cat_id', 'left')  // Adjust 'categories.id' if the category table has a different column for the ID
             ->where('songs.song_status', 1)
             ->get()
             ->result();
    }
    
    function getAllCategory(){
            return $this->db->select("cat_id, cat_name, cat_url")->where('cat_status',1)->get('category')->result();
    }
}
?>