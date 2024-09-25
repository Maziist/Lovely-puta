<?php

class CommentRepository extends Db
{
    public static function addComment($content, $userId, $postId)
    {
        $db = self::getInstance();
        $query = "INSERT INTO comments (content, userId, postId) VALUES (:content, :userId, :postId)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $result = $stmt->execute();
        self::disconnect();
        return $result;
    }

    public static function getComments($postId)
    {
        $db = self::getInstance();
        $query = "SELECT * FROM comments WHERE postId = :postId ORDER BY createdAt DESC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        self::disconnect();
        return $comments;
    }
    public static function editComment($id, $content)
    {
        $db = self::getInstance();
        $query = "UPDATE comments SET content = :content WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $result = $stmt->execute();
        self::disconnect();
        return $result;
    }

    public static function deleteComment($id)
    {
        $db = self::getInstance();
        $query = "DELETE FROM comments WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        self::disconnect();
        return $result;
    }
}