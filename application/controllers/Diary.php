<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diary extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('dt_library');
    }
    public function index()
    {
        $this->load->view('head');
        if($this->dt_library->is_login()==FALSE) $this->load->view('main');
        else
        {
            $this->load->model('post_model');
            $posts=$this->post_model->get_post_all_page(0);
            $this->load->view('diary',array(
                'posts'=>$posts
            ));
        }
        $this->load->view('footer');
    }
    public function mydiary()
    {
        if($this->dt_library->is_login()==FALSE)
        {
            redirect('/');
        }
        $this->load->model('post_model');
        $posts=$this->post_model->get_post_by_user_id($this->session->userdata('id'));

        $this->load->view('head');
        $this->load->view('mydiary',array(
            'posts'=>$posts
        ));
        $this->load->view('footer');
    }
    public function get()
    {
        $page=$this->input->get('page');
        if($page<0) echo json_encode(array('status'=>false, 'message'=>'Wrong page call'));
        else
        {
            $this->load->model('post_model');
            $posts=$this->post_model->get_post_all_page($page);
            if($posts==NULL)
            {
                echo json_encode(array(
                    'status'=>false,
                    'message'=>'마지막 페이지입니다.'
                ));
            }
            else
            {
                echo json_encode(array(
                    'status'=>true,
                    'posts'=>$posts
                ));
            }
        }
    }
    public function write()
    {
        if($this->dt_library->is_login()==FALSE)
        {
            echo json_encode(array(
                'status'=>false,
                'message'=>'No login session'
            ));
        }
        else
        {
            $this->load->library('table_library');
            $this->load->model('post_model');

            $context=$this->input->post('context');
            $target=array("<script>","</script>");
            $newone=array("&lt;script&gt;","&lt;/script&gt;");
            $context=str_replace($target,$newone,$context);
            $post=new Post();
            $post->context=$context;
            $post->user_id=$this->session->userdata('id');

            $this->post_model->save_post($post);
            echo json_encode(array(
                'status'=>true
            ));
        }
    }
    public function delete()
    {
        $this->load->model('post_model');
        $post_id=$this->input->post('post_id');
        $post=$this->post_model->get_post_by_id($post_id);
        if($this->dt_library->is_login()==FALSE)
        {
            echo json_encode(array(
                'status'=>false,
                'message'=>'No login session'
            ));
        }
        else if($post==NULL)
        {
            echo json_encode(array(
                'status'=>false,
                'message'=>'존재하지 않는 글입니다.'
            ));
        }
        else if($post->user_id!=$this->session->userdata('id'))
        {
            echo json_encode(array(
                'status'=>false,
                'message'=>'권한이 없습니다.'
            ));
        }
        else
        {
            $this->post_model->delete_like_by_post_id($post_id);
            $this->post_model->delete_post_by_id($post_id);
            echo json_encode(array(
                'status'=>true
            ));
        }
    }
    public function like()
    {
        $this->load->model('post_model');
        $post_id=$this->input->post('post_id');
        if($this->dt_library->is_login()==FALSE)
        {
            echo json_encode(array(
                'status'=>false,
                'message'=>'No login session'
            ));
        }
        else if($this->post_model->get_post_by_id($post_id)==NULL)
        {
            echo json_encode(array(
                'status'=>false,
                'message'=>'존재하지 않는 글입니다.'
            ));
        }
        else
        {
            $user_id=$this->session->userdata('id');
            $like=$this->post_model->get_like_by_user_id_post_id($user_id,$post_id);
            if($like==NULL)
            {
                $this->load->library('table_library');
                $like=new Like();
                $like->user_id=$user_id;
                $like->post_id=$post_id;
                $this->post_model->save_like($like);
                $this->post_model->like_post_by_id($post_id);
                echo json_encode(array(
                    'status'=>true,
                    'message'=>'공감했습니다.'
                ));
            }
            else
            {
                $this->post_model->delete_like_by_id($like->id);
                $this->post_model->dislike_post_by_id($post_id);
                echo json_encode(array(
                    'status'=>true,
                    'message'=>'공감을 취소했습니다.'
                ));
            }
        }
    }
    public function signin()
    {
        if($this->dt_library->is_login()) redirect('/');
        $this->load->view('head');
        $this->load->view('signin');
        $this->load->view('footer');
    }
    public function signout()
    {
        $this->dt_library->unset_login_session();
        redirect('/');
    }
}