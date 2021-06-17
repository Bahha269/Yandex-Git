<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

/**
 * Description of CheckTokenBehavior
 *
 * @author ksf
 */
class CheckTokenBehavior extends \yii\base\ActionFilter {
    public function beforeAction($action) {
        /* @var $request \yii\web\Request */
        $request = \Yii::$app->getRequest();
        $headers = $request->getHeaders();

        if (empty($headers['x-testapi-token']) || $headers['x-testapi-token'] != \Yii::$app->params['accessToken']) {
            throw new \yii\web\ForbiddenHttpException('Bad token');
        }

        return parent::beforeAction($action);
    }
}
