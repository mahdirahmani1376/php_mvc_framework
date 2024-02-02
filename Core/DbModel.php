<?php

namespace App\Core;

abstract class DbModel extends Model
{
    abstract public function tableName();
    abstract public function attributes();

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attribute) => ":$attributes", $attributes);
        $statement = self::prepare(
            "INSERT INTO $tableName (" .
            implode(',', $attributes).
            ") values (".
            implode(',', $params).
            ");"
        );

        foreach ($attributes as $attribute){
            $statement->bindValue("$attribute",$this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}