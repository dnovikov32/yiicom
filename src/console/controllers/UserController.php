<?php

namespace modules\commerce\console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\ExitCode;
use yii\console\Controller;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use modules\commerce\backend\models\AdminUser;

class UserController extends Controller
{
    /**
     * Creates admin user
     * @param string $login
     * @param string $password
     * @return int
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionCreate(string $login, string $password)
    {
        $admin = AdminUser::find()->byLogin($login)->one();

        if ($admin) {
            Console::output(Console::ansiFormat("Admin user with this login already exists", [Console::FG_YELLOW]));

            return ExitCode::OK;
        }
        
        $model = new AdminUser;
        $model->login = $login;
        $model->password = Yii::$app->security->generatePasswordHash($password);
        $model->status = AdminUser::STATUS_ACTIVE;

        if (! $model->save()) {
            Console::output(
                Console::ansiFormat(
                    "Failed to create admin user: "  . implode(', ', $model->getFirstErrors()),
                    [Console::FG_RED]
                )
            );

            return ExitCode::UNSPECIFIED_ERROR;
        }

        Console::output(Console::ansiFormat("Admin user created successfully", [Console::FG_GREEN]));
        
        return ExitCode::OK;
    }
}