<?php

class MylogFixture extends CakeTestFixture {
	
	public $import = array('model' => 'Members.Mylog');
	
	public function init(){
		$this->records = [
			[
				'id' => 1,
				'mypage_id' => 1,
				'user_id' => null,
				'action' => 'message_submit',
				'history' => 'テスト1だよーん',
				'created' => '2018-07-30 14:06:01',
				'modified' => '2018-07-30 14:06:01'
			],
			[
				'id' => 2,
				'mypage_id' => 2,
				'user_id' => null,
				'action' => 'signin',
				'history' => '',
				'created' => date('Y-m-d H:i:s', strtotime('-10 day')),
				'modified' => date('Y-m-d H:i:s', strtotime('-10 day'))
			],
			[
				'id' => 3,
				'mypage_id' => 2,
				'user_id' => null,
				'action' => 'signin',
				'history' => '',
				'created' => date('Y-m-d H:i:s', strtotime('-60 day')),
				'modified' => date('Y-m-d H:i:s', strtotime('-60 day'))
			],
		];
		parent::init();
	}
	

}