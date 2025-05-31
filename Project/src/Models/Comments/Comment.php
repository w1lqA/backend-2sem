<?php

namespace src\Models\Comments;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Models\Articles\Article;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'comments';
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setAuthor(User $user): void
    {
        $this->authorId = $user->getId();
    }

    public function setArticle(Article $article): void
    {
        $this->articleId = $article->getId();
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
}
