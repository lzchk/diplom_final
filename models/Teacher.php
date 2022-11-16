<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Teacher".
 *
 * @property int $id
 * @property string $Surname
 * @property string $Name
 * @property string|null $Middle_name
 *
 * @property Schedule[] $schedules
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Surname', 'Name'], 'required'],
            [['Surname', 'Name', 'Middle_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Surname' => 'Surname',
            'Name' => 'Name',
            'Middle_name' => 'Middle Name',
        ];
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::class, ['teacher_id' => 'id']);
    }
}
