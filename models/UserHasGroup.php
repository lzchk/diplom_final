<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_has_group".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_group
 *
 * @property GroupNumber $group
 * @property User $user
 */
class UserHasGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_has_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_group'], 'required'],
            [['id_user', 'id_group'], 'integer'],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => GroupNumber::class, 'targetAttribute' => ['id_group' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_group' => 'Id Group',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(GroupNumber::class, ['id' => 'id_group']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }



}
