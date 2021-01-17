<?php

namespace common\db;

use yii\behaviors\TimestampBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public static string $nameColumn = 'title';
    
    public function behaviors(): array
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }


    public static function getList(): array
    {
        return self::queryForGetList()->column();
    }

    public static function queryForGetList(): \yii\db\ActiveQuery
    {
        return self::find()->asArray()->select([self::$nameColumn])->indexBy('id');
    }
}