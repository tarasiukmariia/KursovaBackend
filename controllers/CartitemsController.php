<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Cartitems;

class CartitemsController extends Controller
{
    public function actionIndex()
    {
        if ($this->isPost) {
            if ($this->post->action === 'delete') {
                Cartitems::deleteById($this->post->id);
            }
            if ($this->post->action === 'buy') {
                $array = explode('&', $this->post->modelArray);
                foreach($array as $arr){
                    $model = explode('#',$arr);
                    $tableName = '\\models\\' . ucfirst($model[0]);
                    $tableName::countDecrease($model[1]);
                }
                Cartitems::deleteByCondition(['user_id' => $this->post->user_id]);
            }
        }
        $users = Core::get()->session->get('user')['id'];
        $cart = Cartitems::findByCondition(['user_id' => $users]);
        $this->template->setParam('cart', $cart);
        return $this->render();
    }
}