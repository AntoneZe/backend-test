<?php


namespace common\grid;


class ActionColumn extends \yii\grid\ActionColumn
{
    public $template = '{view} {update} {delete}';
}