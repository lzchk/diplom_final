<?php

namespace app\controllers;

use Codeception\Constraint\Page;
use yii\helpers\VarDumper;
use app\models\Calendar;
use app\models\Schedule;
use app\models\Work;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\UserIdentity;
use app\models\UserHasGroup;


use function Psy\debug;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if( $model ->load(Yii::$app->request->post()) && $model->validate()){
            $user = new UserIdentity();


            $user->username = $model->username;
            $user->password = $model->password;
            $user->save();
            $group = new UserHasGroup();
            $group->id_user=$user->id;
            $group->id_group=$model->group_id;
            var_dump($group);
            $group->save();
            VarDumper::dump($user->errors,10,true);

//            $user ->password = Yii::$app->security->generatePasswordHash($model->password);
            if($user->save()){
              Yii::$app->user->login($user);
//                 var_dump(  $user->password );
//
                return $this->goHome();

            }


        }

        return $this->render('signup',['model' => $model]);

    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }else{
           /* запуск проверки сдо*/
          /*  его данные форму
            модель сингап
            передам сохраню*/
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {
                $ch = curl_init();
//                $model->load(Yii::$app->request->post()) && $model->login();
                curl_setopt($ch, CURLOPT_URL, 'https://portal.petrocollege.ru/');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
                curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, true);

                curl_setopt($ch, CURLOPT_USERPWD, ($model['username'] . ':' . $model['password']));
//
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                } elseif ($result == "") {
                    echo '<script>alert("Введите логин/пароль от СДО")</script>';
                } else {
                    echo '<script>alert("Добро пожаловать")</script>';
                    $user_sdo = new UserIdentity();
//
                    if(!UserIdentity::findByUsername($model['username'])){
                        $user_sdo->username = $model['username'];
                        $user_sdo->password = $model->password;
                        $user_sdo->name = $model->name;
                        $user_sdo->save();
                        $group = new UserHasGroup();
                        $group->id_user=$user_sdo->id;
                        $group->id_group=$model->group_id;
                        $group->save();
                        if ($model->load(Yii::$app->request->post()) && $model->login()) {
                            return $this->goHome();
                        }
                    }  if ($model->load(Yii::$app->request->post()) && $model->login()) {
                        return $this->goHome();
                    }
                }
                curl_close($ch);
            }
        }

       return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProfile()
    {
        $schedule = Schedule::find()->where(['speciality_id' => 1] )->andWhere(['date' => new Expression('CURDATE()')])->all();
        $calendarString = Calendar::getMonth(date('n'), date('Y'), Calendar::$events);
        $monthArr = Calendar::$months;
        $deadlineWork = Work::find()->where('date_by > NOW()')->orderBy("date_by")->one();
        $weekArr = Calendar::$week;
        $dayOfTheWeek = Calendar::$week[date('w')];
        $dayOfTheMonth = Calendar::$months[date('m')];
        //date("Y-m-d")
        return $this->render('profile', [
            'calendarString' => $calendarString,
            'schedule' => $schedule,
            'month' => $monthArr,
            'dayOfTheWeek' => $dayOfTheWeek,
            'dayOfTheMonth' => $dayOfTheMonth,
            'deadlineWork' => $deadlineWork
        ]);
    }
}
