<?php

namespace app\models;
use yii\base\Model;
use yii\web\IdentityInterface;

class SignupForm extends Model  {

    public $username;
    public $password;
    public $group_id;

    public function rules(){
        return [
            [['username','password'],'required'],
            [['group_id'],'integer'],
             [['username'],'unique', 'targetClass' => User::class, 'targetAttribute' => 'username'],
             [['password'],'unique', 'targetClass' => User::class, 'targetAttribute' => 'password']



        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'ФИО',
            'password' => 'Пароль',
            'group_id' => 'Группа',


        ];
    }

}