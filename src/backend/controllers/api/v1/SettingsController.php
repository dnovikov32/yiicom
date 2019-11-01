<?php

namespace yiicom\backend\controllers\api\v1;

use yiicom\backend\base\ApiController;
use yiicom\common\models\ActiveRecord;
use modules\files\common\models\Preset;
use modules\pages\common\models\Category;

class SettingsController extends ApiController
{
    public function actionIndex()
    {
        $settings['backendWeb'] = getenv('BACKEND_WEB');
        $settings['frontendWeb'] = getenv('FRONTEND_WEB');

        $settings['statusesList'] = (new ActiveRecord)->statusesList();

        // TODO: move to pages module
        $settings['pages'] = [];
        $settings['pages']['categories'] = (new Category)->getList();

        // TODO: move to file module
        $settings['presets'] = [];
        $settings['presets']['default'] = Preset::findOne(['isDefault' => true]);
        $settings['presets']['actions'] = (new Preset)->actionsList();

        return $settings;
    }
}