<?php

use yii\db\Schema;
use yii\db\Migration;

class m150209_080510_create_events_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('events', [
            'id' => Schema::TYPE_PK,
            'title_th' => Schema::TYPE_STRING . '(250) NOT NULL',
            'title_en' => Schema::TYPE_STRING . '(250) NOT NULL',
            'detail_th' => Schema::TYPE_TEXT . ' NOT NULL',
            'detail_en' => Schema::TYPE_TEXT .' NOT NULL',
            'imageThumb' => Schema::TYPE_STRING . '(250) NOT NULL',
            'created' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated' => Schema::TYPE_DATETIME . ' NOT NULL',
            'create_user' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'event_type_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ]);
    }

    public function safeDown()
    {
        echo "m150209_080510_create_events_table cannot be reverted.\n";

        return false;
    }
}
