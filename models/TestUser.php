<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $id_role
 * @property int|null $id_spec
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property string|null $username
 * @property string|null $password
 * @property string|null $avatar
 * @property string|null $name
 *
 * @property Role $role
 * @property Specialty $spec
 * @property UserHasGroup[] $userHasGroups
 * @property Work[] $works
 */
class TestUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_role', 'id_spec'], 'integer'],
            [['auth_key', 'access_token', 'username'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 70],
            [['avatar'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 50],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['id_role' => 'id']],
            [['id_spec'], 'exist', 'skipOnError' => true, 'targetClass' => Specialty::class, 'targetAttribute' => ['id_spec' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_role' => 'Id Role',
            'id_spec' => 'Id Spec',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'username' => 'Username',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'id_role']);
    }

    /**
     * Gets query for [[Spec]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpec()
    {
        return $this->hasOne(Specialty::class, ['id' => 'id_spec']);
    }

    /**
     * Gets query for [[UserHasGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasGroups()
    {
        return $this->hasMany(UserHasGroup::class, ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Works]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::class, ['id_created_by' => 'id']);
    }
}
