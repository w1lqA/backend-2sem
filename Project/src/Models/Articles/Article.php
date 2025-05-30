<?php

namespace src\Models\Articles;
use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $title;
    protected $text;
    protected $authorId;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setAuthor(User $author)
    {
        $this->authorId = $author->getId(); 
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}