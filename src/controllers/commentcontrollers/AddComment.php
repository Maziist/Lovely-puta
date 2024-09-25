<?php

class AddCommentController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = $_POST['content'];
            $userId = $_SESSION['user_id'];
            $postId = $_POST['postId'];
            
            CommentRepository::addComment($content, $userId, $postId);
        }
        header("Location: /");
        exit;
    }
}