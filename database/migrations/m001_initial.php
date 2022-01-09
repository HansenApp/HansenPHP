<?php

namespace Hansen\database\migrations;

class m001_initial extends \Hansen\system\Database\Migrations
{
    public function up()
    {
        $db = $this->addTable("users");
        $db->addColumn("name", "string");
        $db->addColumn("email", "string");
        $db->addColumn("password", "string");
        $db->addColumn("created_at", "timestamp");
    }

    public function down()
    {
        $this->removeTable("users");
    }
}