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
        if (empty($loginData['nickname']) || empty($loginData['password'])) {
            throw new \src\Exceptions\InvalidArgumentException('Поля не должны быть пустыми');
        }
    
        $user = self::findOneByColumn('nickname', $loginData['nickname']);
    
        if ($user === null) {
            throw new \src\Exceptions\InvalidArgumentException('Пользователь не найден');
        }
    
        if (!password_verify($loginData['password'], $user->passwordHash)) {
            throw new \src\Exceptions\InvalidArgumentException('Неверный пароль');
        }
    
        $user->refreshAuthToken();
    
        return $user;
    }
    
    
    public function generateAuthToken(): void
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    public function refreshAuthToken(): void
    {
        $this->generateAuthToken(); 
        $this->save(); 
    }
    
    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = \src\Services\Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1';
        $result = $db->query($sql, [':value' => $value], static::class);
        return $result ? $result[0] : null;
    }
}