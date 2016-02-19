<?php
App::import('Model', 'BcPluginAppModel');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Mylog extends BcPluginAppModel {

	public $name = 'Mylog';

    public function record($mypage_id, $action, $user_id = null){
        if(empty($mypage_id)) return false;
        if(empty($action)) return false;
        $mylog['Mylog'] = array(
                'mypage_id' => $mypage_id,
                'action' => $action,
                'user_id' => $user_id
            );
        if($this->save($mylog)){
            return true;
        }else{
            return false;
        }
    }    

}
