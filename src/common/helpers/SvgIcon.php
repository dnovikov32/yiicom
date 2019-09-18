<?php

namespace modules\commerce\common\helpers;

use yii\helpers\Html;

class SvgIcon
{
    private $id;
    private $class;
    private $prefix = 'icon';

    public function __construct(string $id, string $class = '')
    {
        $this->id = $id;
        $this->class = $class;
    }

    public function __toString()
    {
        $class = $this->prefix;

        if ($this->class) {
            $class .= " {$this->prefix}--{$this->class}";
        }

        $html = Html::beginTag('svg', ['class' => $class]);
        $html .= Html::tag('use', '', ['xlink:href' => "#{$this->prefix}-{$this->id}"]);
        $html .= Html::endTag('svg');

        return $html;
    }

    public function prefix(string $prefix = 'icon')
    {
        $this->prefix = $prefix;

        return $this;
    }
}
