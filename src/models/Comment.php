<?php

class Comment
{
    private $id;
    private $content;
    private $userId;
    private $postId;
    private $createdAt;

    public function __construct($id, $content, $userId, $postId, $createdAt = null)
    {
        $this->id = $id;
        $this->content = $content;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->createdAt = $createdAt ?: date('Y-m-d H:i:s');
    }

    // Getters and setters
    public function getId() { return $this->id; }
    public function getContent() { return $this->content; }
    public function getUserId() { return $this->userId; }
    public function getPostId() { return $this->postId; }
    public function getCreatedAt() { return $this->createdAt; }

    public function setContent($content) { $this->content = $content; }
}