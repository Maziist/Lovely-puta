<?php
class MainController extends Controller {
    public function index($params = []) {
        if(!isset($_SESSION['user_id'])) {
            header("Location: /login");
            die();
        }
        $postDb = Post::getPost();
        $posts = [];
        foreach ($postDb as $post){
            $objectPost = new Post($post['id'], $post['title'], $post['content'], $post['userid']);
            array_push($posts, $objectPost);
        }
       
        require_once(__DIR__.'/../../views/main.php');
    }
}