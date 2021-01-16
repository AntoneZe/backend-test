<?php
/**
 * Created by PhpStorm.
 * User: danjudex
 * Date: 26.05.2017
 * Time: 21:09
 */

namespace common\grid;


use Yii;
use yii\helpers\Url;

class IsPublishedColumn extends BooleanColumn
{
    public $attribute = 'is_published';

    public $headerOptions = [
        'style' => 'width: 1px; white-space: nowrap;',
    ];

    public $contentOptions = [
        'style' => 'vertical-align: middle; text-align: center;',
    ];

    public function init()
    {
        $this->toggleUrl = Url::to(['toggle-is-published']);
        $this->header = Yii::t('app', 'Is Published');

        parent::init();
    }
}