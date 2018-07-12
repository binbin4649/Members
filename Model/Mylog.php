<?php
App::import('Model', 'AppModel');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Mylog extends AppModel {

	public $name = 'Mylog';
	
	public $belongsTo = [
		'Mypage' => [
			'className' => 'Members.Mypage',
			'foreignKey' => 'mypage_id']
	];
	
	// 第4引数の$user = 変更する前のユーザーデータ
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
    
    //最後から2番めのログを返す。login だと今ログインしたログを返してしまうため
    public function lastLog($mypage_id){
	    $mylogs = $this->find('all', array(
        	'conditions' => array('Mylog.mypage_id'=>$mypage_id),
			'order' => array('Mylog.created DESC'),
			'recursive' => -1,
			'limit' => 2
		));
		if(!empty($mylogs[1])){
			return $mylogs[1];
		}else{
			return ['Mylog' => ['created'=>'---', 'action'=>'none']];
		}
    }
    

}
