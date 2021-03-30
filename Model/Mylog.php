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
	
	// user_id 管理者が変更した場合に入れる
	// 第4引数の$user = 変更する前のユーザーデータ
    public function record($mypage_id = null, $action = null, $user_id = null, $user = null, $history = null){
        if(empty($mypage_id)) return false;
        if(empty($action)) return false;
        if($user){
	        $serial_user = serialize($user);
        }else{
	        // message対応で追加
	        $serial_user = $history;
        }
        $mylog['Mylog'] = array(
                'mypage_id' => $mypage_id,
                'action' => $action,
                'user_id' => $user_id,
                'history' => $serial_user
            );
        $this->create();
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
    
    // 指定actionの最後を返す
    public function lastActionLog($mypage_id, $action){
	    $mylog = $this->find('first', array(
        	'conditions' => array(
        		'Mylog.mypage_id' => $mypage_id,
        		'Mylog.action' => $action
        	),
			'order' => array('Mylog.created DESC'),
			'recursive' => -1,
		));
		return $mylog;
    }
    
    // 指定actionの、今日からの経過日数を返す
    public function lastActionDays($mypage_id, $action){
	    $mylog = $this->lastActionLog($mypage_id, $action);
	    if($mylog){
		    $log_date = new DateTime($mylog['Mylog']['created']);
		    $now = new DateTime('now');
		    $diff = $log_date->diff($now);
		    return $diff->days;
	    }else{
		    return false;
	    }
    }
    
    
    // マイページトップに、任意のタイミングでフラッシュメッセージを表示
    // Mylog.action => 'message_submit' の history をフラッシュメッセージで表示する
    // 一度表示したら、Mylog.action => 'message_done' に変更する
    public function isMessage($mypage_id){
	    $mylogs = $this->find('all', array(
        	'conditions' => [
        		'Mylog.mypage_id' => $mypage_id,
        		'Mylog.action' => 'message_submit'
        	],
			'recursive' => -1,
		));
		foreach($mylogs as $log){
			$log['Mylog']['action'] = 'message_done';
			$this->create();
			$this->save($log);
		}
		return $mylogs;
    }
    
    

}
