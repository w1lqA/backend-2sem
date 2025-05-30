<?php

namespace src\Models;

use src\Services\Db;

abstract class ActiveRecordEntity 
{
    protected $id;

    public function getId(): int 
    {
        return $this->id;
    }

    public function __set(string $name, $value): void 
    {
        $propertyName = $this->snakeToCamel($name);
        $this->$propertyName = $value;
    }

    private function snakeToCamel(string $input): string 
    {
        return lcfirst(str_replace('_', '' , ucwords($input, '_')));
    }

    private function camelToSnake(string $input): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $input));
    }

    public static function findAll(): array 
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM `' . static::getTableName() . '`';
        return $db->query($sql, [], static::class);
    }

    public static function getById(int $id): ?self 
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id',
            [':id' => $id],
            static::class
        );
        return $result ? $result[0] : null;
    }

    public function save(): void
    {
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    private function update(): void
    {
        $properties = $this->mapPropertiesToDb();
        
        $columnsToParams = [];
        $paramsToValues = [];
        foreach ($properties as $column => $value) {
            $param = ':' . $column;
            $columnsToParams[] = "`$column` = $param";
            $paramsToValues[$param] = $value;
        }

        $sql = 'UPDATE `' . static::getTableName() . '` 
                SET ' . implode(', ', $columnsToParams) . ' 
                WHERE id = :id';
        
        Db::getInstance()->query($sql, $paramsToValues);
    }

    private function insert(): void
    {
        $properties = $this->mapPropertiesToDb();
        unset($properties['id']);

        $columns = array_keys($properties);
        $params = array_map(fn($col) => ":$col", $columns);
        
        $sql = 'INSERT INTO `' . static::getTableName() . '` 
                (' . implode(', ', $columns) . ') 
                VALUES (' . implode(', ', $params) . ')';
        
        Db::getInstance()->query($sql, $properties);
        $this->id = Db::getInstance()->getLastInsertId();
    }
    protected function mapPropertiesToDb(): array
    {
        $result = [];
        $reflector = new \ReflectionObject($this);
        
        foreach ($reflector->getProperties() as $property) {
            $propertyName = $property->getName();
            $dbColumnName = $this->camelToSnake($propertyName);
            $result[$dbColumnName] = $this->$propertyName;
        }
        
        return $result;
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE id = :id';
        Db::getInstance()->query($sql, [':id' => $this->id]);
        $this->id = null;
    }
    abstract protected static function getTableName(): string;
}
