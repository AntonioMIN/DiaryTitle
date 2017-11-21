<?php
class Post_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_post_all()
    {
        $query=$this->db->get('posts');
        return $query->result();
    }
    public function get_post_by_id($post_id)
    {
        $query=$this->db->get_where('posts',array('id'=>$post_id));
        return $query->row();
    }
    public function get_post_all_page($page)
    {
        $page=$page*15;
        $query=$this->db->query("SELECT users.name, `posts`.`id`, `posts`.`context`, `posts`.`created_at`, `posts`.`like_count` FROM `posts` LEFT JOIN `users` AS users ON users.id=`posts`.`user_id` ORDER BY `posts`.created_at DESC LIMIT ".$page.", 15");
        return $query->result();
    }
    public function get_post_by_user_id($user_id)
    {
        $query=$this->db->query("SELECT users.name, `posts`.`id`, `posts`.`context`, `posts`.`created_at`, `posts`.`like_count` FROM `posts` LEFT JOIN `users` AS users ON users.id=`posts`.`user_id` WHERE `posts`.user_id=".$user_id." ORDER BY `posts`.created_at DESC");
        return $query->result();
    }

    public function save_post($post)
    {
        if(isset($post->id))
        {
            $this->db->update('posts',array('id'=>$post->id));
        }
        else
        {
            $this->db->query("INSERT INTO `posts`(`user_id`, `context`) VALUES (".$post->user_id.", \"".$post->context."\")");
        }
    }
    public function like_post_by_id($post_id)
    {
        $this->db->set('like_count', 'like_count+1',FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');
    }
    public function dislike_post_by_id($post_id)
    {
        $this->db->set('like_count', 'like_count-1',FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');
    }

    public function delete_post_by_id($post_id)
    {
        $this->db->delete('posts',array('id'=>$post_id));
    }
    public function delete_post_by_user_id($user_id)
    {
        $this->db->delete('posts',array('user_id'=>$user_id));
    }

    public function get_like_by_user_id_post_id($user_id,$post_id)
    {
        $query=$this->db->get_where('likes',array('user_id'=>$user_id,'post_id'=>$post_id));
        return $query->row();
    }

    public function save_like($like)
    {
        if(isset($like->id))
        {
            $this->db->update('likes',$like,array('id'=>$like->id));
        }
        else
        {
            $this->db->query("INSERT INTO `likes`(`user_id`, `post_id`) VALUES (".$like->user_id.", \"".$like->post_id."\")");
        }
    }

    public function delete_like_by_id($id)
    {
        $this->db->delete('likes',array('id'=>$id));
    }
    public function delete_like_by_user_id_post_id($user_id,$post_id)
    {
        $this->db->delete('likes',array('user_id'=>$user_id,'post_id'=>$post_id));
    }
    public function delete_like_by_post_id($post_id)
    {
        $this->db->delete('likes',array('post_id'=>$post_id));
    }
}
?>