<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_library
{

}

class User
{
    public $id;
    public $name;
    public $facebook_user_id;
    public $created_at;
}
class Post
{
    public $id;
    public $user_id;
    public $context;
    public $like_count;
    public $created_at;
}
class Like
{
    public $id;
    public $user_id;
    public $post_id;
    public $created_at;
}