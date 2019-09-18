<?php

namespace yiicom\commerce\console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\ExitCode;
use yii\console\Controller;

class StorageController extends Controller
{
    /**
     * Creates symlinks to public
     * @return int
     */
    public function actionCreatePublicLinks()
    {
        $publicDir = Yii::getAlias('@storage/public');

        Console::output("Public path: $publicDir");

        $dirs = [
            Yii::getAlias("@frontendWebroot/storage"),
            Yii::getAlias("@backendWebroot/storage"),
        ];

        foreach ($dirs as $dir) {
            if (is_dir($dir)) {
                Console::output(Console::ansiFormat("Already exists: $dir", [Console::FG_YELLOW]));

                continue;
            }

            symlink($publicDir, $dir);
        }

        Console::output(Console::ansiFormat("Success", [Console::FG_GREEN]));

        return ExitCode::OK;
    }

    /**
     * Creates symlink to temp
     * @return int
     */
    public function actionCreateTempLink()
    {
        $tempDir = Yii::getAlias('@storage/temp');
        $targetDir = Yii::getAlias("@backendWebroot/temp");

        Console::output("Temp path: $tempDir");

        if (is_dir($targetDir)) {
            Console::output(Console::ansiFormat("Already exists: $tempDir", [Console::FG_YELLOW]));
        } else {
            symlink($tempDir, $targetDir);
        }

        Console::output(Console::ansiFormat("Success", [Console::FG_GREEN]));

        return ExitCode::OK;
    }
}