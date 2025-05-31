<?php

namespace src\Models\Users;

use src\Models\ActiveRecordEntity;
use src\Exceptions\InvalidArgumentException;

class User extends ActiveRecordEntity
{
    protected $nickname;
    protected $email;
    protected $role = 'user';
    protected $passwordHash;
    protected $authToken; 

    protected static function getTableName(): string
    {
        return 'users';
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }
    
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }
    
    public static function login(array $loginData): self
    {
        if (empty($loginData['nickname'])) {
            throw new InvalidArgumentException('Nickname is required');
        }
    
        $user = static::findOneByColumn('nickname', $loginData['nickname']);
        if ($user === null) {
            throw new InvalidArgumentException('User not found');
        }
    
        $user->generateAuthToken();
        $user->save();
    
        return $user;
    }
    
    public function generateAuthToken(): void
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = \src\Services\Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1';
        $result = $db->query($sql, [':value' => $value], static::class);
        return $result ? $result[0] : null;
    }
}