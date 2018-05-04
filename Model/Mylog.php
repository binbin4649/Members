<?php
App::import('Model', 'BcPluginAppModel');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Mylog extends BcPluginAppModel {

	public $name = 'Mylog';
	
	public $belongsTo = [
		'Mypage' => [
			'className' => 'Members.Mypage',
			'foreignKey' => 'mypage_id']
	];
	
	// $user 変更する前のユーザーデータ
    public function record($mypage_id, $action, $user_id = null, $user = null){
        if(empty($mypage_id)) return false;
        if(empty($action)) return false;
        $serial_user = '';
        if($user){
	        $serial_user = serialize($user);
        }
        $mylog['Mylog'] = array(
                'mypage_id' => $mypage_id,
                'action' => $action,
                'user_id' => $user_id,
                'history' => $serial_user
            );
        if($this->save($mylog)){
            return true;
        }else{
            return false;
        }
    }
    

}
