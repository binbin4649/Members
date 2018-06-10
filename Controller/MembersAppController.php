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

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('user', $this->BcAuth->user());
		
		// サブサイト用の設定値なのかな？ない時はとりあえず0を入れておく。
		//サブサイト用の設定だとしたらMembersプラグインはサブサイトに対応してない。ということになるんだと思う。
		if(empty($this->request->params['Content'])) {
			$this->request->params['Site']['id'] = 0;
		}
	}
}
