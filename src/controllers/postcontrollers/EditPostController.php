<?php

class EditPostController extends Controller {
    public function index(){
        Post::editPost($_POST['postId'],$_POST['title'], $_POST['content']);
        header("Location:/");
    }
}