<?php

namespace modules\commerce\backend\models;

use yii\db\ActiveQuery;

class AdminUserQuery extends ActiveQuery
{
    /**
     * @param string $login
     * @return $this
     */
    public function byLogin(string $login)
    {
        $this->andWhere(['login' => $login]);

        return $this;
    }
}