<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m220703_014141_supplier
 */
class m220703_014141_supplier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220703_014141_supplier cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('supplier', [
            'id' => Schema::TYPE_PK,
            'name' => "varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''",
            'code' => "char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL",
            't_status' => "enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok'",
        ]);
        $this->createIndex('uk_code', 'supplier', 'code', true);
        $this->batchInsert(
            "supplier",
            ["name", "code", "t_status"],
            [
                ["tom", "aaa", 'ok'],
                ["frank", "bbb", 'hold'],
                ["jack", "ccc", 'hold'],
                ["nick", "ddd", 'ok'],
                ["jerry", "eee", 'hold'],
            ]
        );
    }

    public function down()
    {
        $this->dropTable("supplier");
    }

}
