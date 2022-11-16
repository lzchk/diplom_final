<?php

use yii\db\Migration;

/**
 * Class m221115_105806_change_user_table
 */
class m221115_105806_change_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'name',$this->varchar(50)->after('username'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'name',$this->varchar(50)->after('username'));


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }
*/
    public function down()
    {
        $this->dropColumn('user', 'name');
    }

}
