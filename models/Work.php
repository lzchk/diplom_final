<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property int $id_type_work
 * @property int $id_discipline
 * @property string $topic
 * @property string $date_since
 * @property string $date_by
 * @property string $loading
 * @property int $id_mark
 * @property int $id_status
 * @property int $id_created_by
 *
 * @property User $createdBy
 * @property Discipline $discipline
 * @property Mark $mark
 * @property Status $status
 * @property TypeWork $typeWork
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_type_work', 'id_discipline', 'topic', 'date_since', 'date_by', 'loading', 'id_mark', 'id_status', 'id_created_by'], 'required'],
            [['id_type_work', 'id_discipline', 'id_mark', 'id_status', 'id_created_by'], 'integer'],
            [['date_since', 'date_by', 'loading'], 'safe'],
            [['topic'], 'string', 'max' => 100],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_discipline'], 'exist', 'skipOnError' => true, 'targetClass' => Discipline::class, 'targetAttribute' => ['id_discipline' => 'id']],
            [['id_mark'], 'exist', 'skipOnError' => true, 'targetClass' => Mark::class, 'targetAttribute' => ['id_mark' => 'id']],
            [['id_created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_created_by' => 'id']],
            [['id_type_work'], 'exist', 'skipOnError' => true, 'targetClass' => TypeWork::class, 'targetAttribute' => ['id_type_work' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_type_work' => 'Тип работы',
            'id_discipline' => 'Дисциплина',
            'topic' => 'Название',
            'date_since' => 'Дата с',
            'date_by' => 'Дата по',
            'loading' => 'Загружена',
            'id_mark' => 'Оценка',
            'id_status' => 'Статус',
            'id_created_by' => 'Сделана',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'id_created_by']);
    }

    /**
     * Gets query for [[Discipline]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiscipline()
    {
        return $this->hasOne(Discipline::class, ['id' => 'id_discipline']);
    }

    /**
     * Gets query for [[Mark]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMark()
    {
        return $this->hasOne(Mark::class, ['id' => 'id_mark']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'id_status']);
    }

    /**
     * Gets query for [[TypeWork]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeWork()
    {
        return $this->hasOne(TypeWork::class, ['id' => 'id_type_work']);
    }
}
