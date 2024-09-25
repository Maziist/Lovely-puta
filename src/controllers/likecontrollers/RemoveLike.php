<?php

class RemoveLikeController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['targetId']) && isset($_POST['type'])) {
            $userId = $_SESSION['user_id'];
            $targetId = $_POST['targetId'];
            $type = $_POST['type']; // 'post' ou 'comment'

            LikeRepository::removeLike($userId, $targetId, $type);
        }
        header("Location: /");
        exit;
    }
}