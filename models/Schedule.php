<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Schedule".
 *
 * @property int $id
 * @property int $discipline_id
 * @property int $speciality_id
 * @property int $room_id
 * @property int $teacher_id
 * @property string $is_online
 * @property string $date
 * @property int $num_lesson
 * @property int $week_num
 *
 * @property Discipline $discipline
 * @property Room $room
 * @property Specialty $speciality
 * @property Teacher $teacher
 */
class Schedule extends \yii\db\ActiveRecord implements \Countable
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discipline_id', 'speciality_id', 'room_id', 'teacher_id', 'is_online', 'date', 'num_lesson', 'week_num'], 'required'],
            [['discipline_id', 'speciality_id', 'room_id', 'teacher_id', 'num_lesson', 'week_num'], 'integer'],
            [['date'], 'safe'],
            [['is_online'], 'string', 'max' => 30],
            [['discipline_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['discipline_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['room_id' => 'id']],
            [['speciality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialty::class, 'targetAttribute' => ['speciality_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discipline_id' => 'Discipline ID',
            'speciality_id' => 'Speciality ID',
            'room_id' => 'Room ID',
            'teacher_id' => 'Teacher ID',
            'is_online' => 'Is Online',
            'date' => 'Date',
            'num_lesson' => 'Num Lesson',
            'week_num' => 'Week Num',
        ];
    }

    /**
     * Gets query for [[Discipline]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::class, ['id' => 'discipline_id']);
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }

    /**
     * Gets query for [[Speciality]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpeciality()
    {
        return $this->hasOne(Specialty::class, ['id' => 'speciality_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['id' => 'teacher_id']);
    }

    public function count()
    {
        // TODO: Implement count() method.
    }
}
