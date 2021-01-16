<?php
/**
 * Created by PhpStorm.
 * User: danjudex
 * Date: 26.05.2017
 * Time: 19:28
 */

namespace common\grid;


use yii\grid\Column;
use yii\helpers\Html;
use yii\helpers\Url;

class BooleanColumn extends Column
{
    public $attribute;

    public $iconTrue = 'fa fa-check';

    public $iconFalse = 'fa fa-times';

    public $headerOptions = [
        'style' => 'width: 1px; white-space: nowrap;',
    ];

    public $contentOptions = [
        'style' => 'vertical-align: middle; text-align: center;',
    ];

    protected $_toggleUrl;

    /**
     * @return mixed
     */
    public function getToggleUrl()
    {
        if (!$this->_toggleUrl) {
            $this->_toggleUrl = Url::to(['boolean-toggle', 'attribute' => $this->attribute]);
        }

        return $this->_toggleUrl;
    }

    /**
     * @param mixed $toggleUrl
     */
    public function setToggleUrl($toggleUrl)
    {
        $this->_toggleUrl = $toggleUrl;
    }


    protected function renderDataCellContent($model, $key, $index)
    {
        $trueIcon = Html::tag('i', '', ['class' => $this->iconTrue . ' icon-true']);

        $falseIcon = Html::tag('i', '', ['class' => $this->iconFalse . ' icon-false']);

        return Html::tag('div', $trueIcon . $falseIcon, [
            'class' => 'boolean-column ' . ($model->{$this->attribute} ? 'true' : 'false'),
            'data' => [
                'toggle-url' => $this->toggleUrl,
                'key' => $key,
            ]
        ]);
    }
}