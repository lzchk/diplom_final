<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_number".
 *
 * @property int $id
 * @property string $name
 *
 * @property UserHasGroup[] $userHasGroups
 */
class GroupNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[UserHasGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasGroups()
    {
        return $this->hasMany(UserHasGroup::class, ['id_group' => 'id']);
    }
}
