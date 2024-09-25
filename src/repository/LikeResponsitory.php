<?php

class LikeRepository extends Db
{
    public static function addLike($userId, $targetId, $type)
    {
        $db = self::getInstance();
        $query = "INSERT INTO likes (userId, targetId, type) VALUES (:userId, :targetId, :type)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':targetId', $targetId, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $result = $stmt->execute();
        self::disconnect();
        return $result;
    }

    public static function removeLike($userId, $targetId, $type)
    {
        $db = self::getInstance();
        $query = "DELETE FROM likes WHERE userId = :userId AND targetId = :targetId AND type = :type";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':targetId', $targetId, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $result = $stmt->execute();
        self::disconnect();
        return $result;
    }

    public static function getLikeCount($targetId, $type)
    {
        $db = self::getInstance();
        $query = "SELECT COUNT(*) as count FROM likes WHERE targetId = :targetId AND type = :type";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':targetId', $targetId, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        self::disconnect();
        return $result['count'];
    }

    public static function hasUserLiked($userId, $targetId, $type)
    {
        $db = self::getInstance();
        $query = "SELECT COUNT(*) as count FROM likes WHERE userId = :userId AND targetId = :targetId AND type = :type";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':targetId', $targetId, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        self::disconnect();
        return $result['count'] > 0;
    }
}