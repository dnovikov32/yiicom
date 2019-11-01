<?php

namespace yiicom\backend\widgets;

use Yii;
use yii\helpers\Url;
use yii\base\Widget;
use yii\helpers\Html;
use yii\db\ActiveRecord;

/**
 * Admin control buttons widget for CRUD pages
 */
class AdminButtons extends Widget
{
    /**
     * @var null|ActiveRecord model object
     */
	public $model;

    /**
     * @var string Action name (create, update, etc)
     */
	private $_action;

	public function init()
	{
		$this->_action = Yii::$app->controller->action->id;
	}

    public function run()
    {
        $return = Html::beginTag('div', ['class' => 'admin-btns']);

        foreach ($this->buttons() as $button) {
            $return .= ' ' . $this->button($button);
        }

        $return .= Html::endTag('div');

        return $return;
    }

    /**
     * @return array
     */
    private function buttons()
    {
        $buttons = [
            'index' => ['create'],
            'create' => ['index', 'save'],
            'update' => ['index', 'delete', 'create', 'view', 'save'],
        ];

        return $buttons[$this->_action] ?? [];
    }

    /**
     * @param string $name
     * @return string
     */
    private function button(string $name)
    {
        $method = $name . "Button";

        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    /**
     * @return string
     */
    private function indexButton()
    {
        $return = Html::a('<i class="fa fa-list-ul"></i> ' . Yii::t('commerce', 'List'),
            Url::to('index'),
            ['class' => 'btn btn-xs btn-info admin-btns__btn']
        );

        return $return;
    }

    /**
     * @return string
     */
    private function createButton()
    {
        $return = Html::a('<i class="fa fa-plus-square"></i> ' . Yii::t('commerce', 'Create'),
            Url::to('create'),
            ['class' => 'btn btn-xs btn-success admin-btns__btn']
        );

        return $return;
    }

    /**
     * @return string
     */
	private function viewButton()
	{
	    $url = $this->model->url ?? null;

        if (null === $url) {
            return '';
        }

        return Html::a('<i class="fa fa-eye"></i>',
            Yii::getAlias("@frontendWeb/{$url->alias}"),
            [
                'class' => 'btn btn-xs btn-info admin-btns__btn',
                'target' => '_blank',
            ]
        );
	}

    /**
     * @return string
     */
	private function deleteButton()
    {
        if (null === $this->model) {
            return '';
        }

        return Html::a('<i class="fa fa-trash"></i> ' . Yii::t('commerce', 'Delete'),
            Url::to(['delete', 'id' => $this->model->id]),
            [
                'class' => 'btn btn-xs btn-danger admin-btns__btn ',
                'data-confirm' => 'Вы уверены?'
            ]
        );
    }

    /**
     * @return string
     */
    private function saveButton()
    {
        return Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('commerce', 'Save'), [
            'class' => 'btn btn-xs btn-primary admin-btns__btn'
        ]);
    }

}