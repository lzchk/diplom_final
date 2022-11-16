<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specialty".
 *
 * @property int $id
 * @property string $name
 * @property string $number_group
 * @property int $id_department Это спец  код подразделения для вывода расписания по времени
 *
 * @property Discipline $department
 * @property DiscipHasSpeciality[] $discipHasSpecialities
 * @property Schedule[] $schedules
 * @property User[] $users
 */
class Specialty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number_group', 'id_department'], 'required'],
            [['id_department'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['number_group'], 'string', 'max' => 10],
            [['id_department'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['id_department' => 'id']],
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
            'number_group' => 'Number Group',
            'id_department' => 'Id Department',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Discipline::class, ['id' => 'id_department']);
    }

    /**
     * Gets query for [[DiscipHasSpecialities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipHasSpecialities()
    {
        return $this->hasMany(DiscipHasSpeciality::class, ['id_spec' => 'id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::class, ['speciality_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_spec' => 'id']);
    }
}
