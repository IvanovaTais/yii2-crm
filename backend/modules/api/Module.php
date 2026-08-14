<?php
declare(strict_types=1);

namespace backend\modules\api;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\api\controllers';

    public function init()
    {
        parent::init();
    }
}

?>