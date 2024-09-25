<?php

class EditCommentController extends Controller {
    public function index(){
        if(isset($_POST['commentId']) && isset($_POST['content'])) {
            CommentRepository::editComment($_POST['commentId'], $_POST['content']);
        }
        header("Location: /");
        exit;
    }
}