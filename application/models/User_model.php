<?php
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_all()
    {
        $query=$this->db->get('users');
        return $query->result();
    }
    public function get_user_by_id($user_id)
    {
        $query=$this->db->get_where('users',array('id'=>$user_id));
        return $query->row();
    }
    public function get_user_by_facebook_user_id($facebook_user_id)
    {
        $query=$this->db->get_where('users',array('facebook_user_id'=>$facebook_user_id));
        return $query->row();
    }

    public function save_user($user)
    {
        if(isset($user->id))
        {
            $this->db->update('users',array('id'=>$user->id));
        }
        else
        {
            $this->db->insert('users',$user);
        }
    }

    public function delete_user_by_id($user_id)
    {
        $this->db->delete('users',array('id'=>$user_id));
    }
}
?>