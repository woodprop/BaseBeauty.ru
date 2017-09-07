<?php
use yii\db\Migration;
use app\models\User;
/**
 * Handles the creation of table `user`.
 */
class m170907_121746_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(64)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string(64)->notNull()->unique(),
        ]);
// -------------------------------Test User ---------------------------------------------------------

        //ToDo УБРАТЬ В ПРОДАКШЕНЕ
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@admin.admin';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save();
// --------------------------------------------------------------------------------------------------
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}