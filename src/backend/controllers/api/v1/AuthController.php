<?php

namespace yiicom\backend\controllers\api\v1;

use Yii;
use yii\rest\Controller;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;
use yiicom\backend\forms\LoginForm;
use yiicom\backend\models\AdminUser;

class AuthController extends Controller
{
    /**
     * @return LoginForm
     * @throws ServerErrorHttpException
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->post(), '');

        if ($model->login()) {
            //TODO: add loginAt, remove User model
            $response = Yii::$app->getResponse();
            $response->getHeaders()->set('Authorization', $model->getUser()->authKey);
        } elseif (! $model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }

    public function actionLogout()
    {
        $token = str_replace('Bearer ', '', Yii::$app->getRequest()->getHeaders()->get('Authorization'));

        /* @var AdminUser $user */
        $user = AdminUser::findIdentityByAccessToken($token);

        if ($user) {
            $user->releaseAuthKey();
            $user->save();
        }

        return ['status' => 'success'];
    }

    public function actionRefresh()
    {
        // TODO: add token expire check

        if (1 == 2) {
            throw new UnauthorizedHttpException('Your request was made with invalid credentials.');
        }

        return ['status' => 'success'];
    }

    public function actionUser()
    {
        // TODO: add fetch user data
//        $user = User::find(Auth::user()->id);
//        return response([
//            'status' => 'success',
//            'data' => $user
//        ]);
    }


}
