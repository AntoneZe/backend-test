<?php

namespace backend\components;


use common\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Class View
 * @package backend\components
 * @property string $h1
 */
class View extends \yii\web\View
{
    public $bodyOptions = [];

    public $breadcrumbs = [];

    public $sidebarItems = [];

    public $showHeader = true;

    protected $_h1;


    public function btnCreate()
    {
        return Html::submitButton(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary btn-save']);
    }

    public function btnSave()
    {
        return Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success btn-save']);
    }

    public function btnSaveAndClose()
    {
        return Html::submitButton(Yii::t('app', 'Сохранить и выйти'),
            [
                'class' => 'btn btn-primary btn-save-and-close',
                'name' => 'saveAndClose',
                'value' => 1,
            ]);
    }

    public function btnClose()
    {
        return Html::a(Yii::t('app', 'Закрыть'), Url::previous(),
            ['class' => 'btn btn-danger btn-close']);
    }

    public function formSubmit($isNewRecord)
    {
        return Html::tag('div', ($isNewRecord ? $this->btnCreate() : $this->btnSave())
            . ' ' . (!$isNewRecord ? $this->btnSaveAndClose() : '') . ' ' . $this->btnClose(), [
            'class' => 'inline-group',
        ]);
    }

}