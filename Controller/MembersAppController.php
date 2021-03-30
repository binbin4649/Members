<?php
/*
* Membersプラグイン
* 基底コントローラー
*/

/**
* Include files
*/
App::uses('AppController', 'Controller');

/**
* 基底コントローラー
*
* 
*/
class MembersAppController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Security->blackHoleCallback = 'blackhole';
		
		//ログイン画面：デフォルトだとUserControllerになってしまうので強制的に変更する。
		$prefix = '';
		if(!empty($this->request->params['prefix'])){
			$prefix = $this->request->params['prefix'];
		}
		if($prefix != 'admin'){
			//$this->BcAuth->loginAction = array('plugin' => 'members', 'controller' => 'mypages', 'action' => 'login');
			$this->BcAuth->loginRedirect = array('plugin' => 'members', 'controller' => 'mypages', 'action' => 'index');
		}
		$this->set('user', $this->BcAuth->user());
		
		// サブサイト用の設定値なのかな？ない時はとりあえず0を入れておく。
		//サブサイト用の設定だとしたらPointsプラグインはサブサイトに対応してない。ということになるんだと思う。
		if(empty($this->request->params['Content'])) {
			$this->request->params['Site']['id'] = 0;
		}
	}
	
	public function blackhole($type) {
	    if($type == 'auth'){
		    $this->setMessage('認証エラー', true);
		    $this->redirect('/');
	    }
	    if($type == 'csrf'){
		    $this->setMessage('エラー:csrf', true);
		    $this->redirect('/');
	    }
	    if($type == 'secure'){
		    $this->setMessage('セキュリティエラー', true);
		    $this->redirect('/');
	    }
	}
}
