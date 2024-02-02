<?php

namespace Migrations;

use App\Core\Application;

class m0002_add_password_field
{
    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    public function up()
    {

        $this->db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL");

    }

    public function down()
    {
        $this->db->pdo->exec("ALTER TABLE users DROP COLUMN password;");
    }
}