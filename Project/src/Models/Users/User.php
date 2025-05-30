<?php

namespace src\Models\Users;

use src\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $role = 'user';
    protected $passwordHash;

    protected static function getTableName(): string
    {
        return 'users';
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }
}