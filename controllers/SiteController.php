<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    const TBL_NAME = 'wonderful_item';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access_token' => [
                'class' => \app\components\CheckTokenBehavior::className(),
                'except' => [ 'index', 'fault' ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
           /* 'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->view->registerJsFile("app.js", [ "depends" => \yii\web\JqueryAsset::class ]);
        return $this->render('index');
    }

    public function actionGet() {
        $sql = "SELECT * FROM " . self::TBL_NAME;
        $items = \Yii::$app->db->createCommand($sql)->queryAll(\PDO::FETCH_ASSOC);

        $res = [
            "success" => 1,
            "status" => "OK",
            "data" => $items
        ];

        return json_encode($res, JSON_PRETTY_PRINT);
    }

    public function actionItem() {
        $id = \Yii::$app->getRequest()->get("id", 0);
        $res = [];

        if ($id) {
            $sql = "SELECT * FROM " . self::TBL_NAME . " WHERE id=" . $id . " LIMIT 1";
            $item = \Yii::$app->db->createCommand($sql)->queryOne(\PDO::FETCH_ASSOC);

            $res = [
                "success" => 1,
                "status" => "OK",
                "data" => $item
            ];
        } else {
            $res = [
                "success" => 0,
                "status" => "Error",
                "message" => "No ID given"
            ];
        }

        return json_encode($res, JSON_PRETTY_PRINT);
    }

    public function actionDelete() {
        $id = \Yii::$app->getRequest()->post("id", 0);
        $res = [];
        
        if ($id) {
            $sql = "DELETE FROM " . self::TBL_NAME . " WHERE id=" . $id . " LIMIT 1";
            $affected = \Yii::$app->db->createCommand($sql)->execute();

            $res = $affected
                ? [ "success" => 1, "status" => "OK", "message" => "Item # " . $id . " was deleted" ]
                : [ "success" => 0, "status" => "Error", "message" => "Item # " . $id . " was not found [ " . $sql . "]" ];
        } else {
            $res = [
                "success" => 0,
                "status" => "Error",
                "message" => "No ID given"
            ];
        }

        return json_encode($res, JSON_PRETTY_PRINT);
    }

    public function actionAdd()
    {
        $request = \Yii::$app->getRequest();
        $data = $request->post();

        $res = [];
        $title = $request->post("title");

        if (!$title) {
            $res = [
                "success" => 0,
                "status" => "Error",
                "message" => "Title field required"
            ];
        } else {
            try {
                \Yii::$app->db->createCommand()->insert(self::TBL_NAME, [
                    'id' => $request->post("id"),
                    'title' => $request->post("title"),
                    'description' => $request->post("description")
                ])->execute();

                $res = [
                    "success" => 1,
                    "status" => "OK",
                    "message" => "Item was added"
                ];
            } catch (\Exception $ex) {
                $res = [
                    "success" => 0,
                    "status" => "Error",
                    "message" => $ex->getMessage()
                ];
            }
        }

        return json_encode($res, JSON_PRETTY_PRINT);
    }

    public function actionFault()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $message = $exception->getMessage();

            $res = [
                "success" => 0,
                "status" => "Error",
                "message" => $message
            ];

            return json_encode($res, JSON_PRETTY_PRINT);
        }

        return "OK";
    }
}
