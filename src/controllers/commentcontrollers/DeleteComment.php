<?php

class DeleteCommentController extends Controller
{
    public function index()
    {
        if (isset($_POST['commentId'])) {
            CommentRepository::deleteComment($_POST['commentId']);
        }
        header("Location: /");
        exit;
    }
}