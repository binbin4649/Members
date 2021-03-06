<?php
App::uses('Mypage', 'Members.Model');

class MypageTest extends BaserTestCase {
    public $fixtures = array(
        'plugin.members.Default/Mypage',
        'plugin.members.Default/Mylog'
    );

    public function setUp() {
        $this->Mypage = ClassRegistry::init('Members.Mypage');
        $this->Mylog = ClassRegistry::init('Members.Mylog');
        parent::setUp();
    }
    
    public function tearDown(){
	    unset($this->Mypage);
	    parent::tearDown();
    }
    
    public function testNotActivation(){
	    $this->Mypage->notActivation();
	    $mypage_id = '4';
	    $action = 'not_activate';
	    $r = $this->Mylog->lastActionLog($mypage_id, $action);
	    $this->assertTrue(!empty($r));
    }

    public function testValidateFalse(){
	    $this->Mypage->create([
		    'Mypage' => [
			    'name' => '',
			    'username' => '',
			    'password' => '',
			    'email' => '' 
		    ]
	    ]);
	    $this->assertFalse($this->Mypage->validates());
	    $this->assertArrayHasKey('name', $this->Mypage->validationErrors);
	    $this->assertEquals('名前を入力して下さい。', current($this->Mypage->validationErrors['name']));
	    $this->assertArrayHasKey('username', $this->Mypage->validationErrors);
	    $this->assertEquals('メールアドレスが正しくありません。', current($this->Mypage->validationErrors['username']));
	    $this->assertArrayHasKey('password', $this->Mypage->validationErrors);
	    $this->assertEquals('パスワードは6文字以上で入力してください。', current($this->Mypage->validationErrors['password']));
	    $this->assertArrayHasKey('email', $this->Mypage->validationErrors);
	    $this->assertEquals('Eメールを入力して下さい。', current($this->Mypage->validationErrors['email']));
    }
    
    public function testValidateTrue(){
	    $this->Mypage->create(['Mypage' => [
		    'name' => 'テスト',
		    'username' => 'test@test.com',
		    'email' => 'test@test.com',
		    'password' => '111222',
		    'password_confirm' => '111222'
	    ]]);
	    $this->assertTrue($this->Mypage->validates());
    }
    
    public function testgetActivationHash(){
	    $this->Mypage->id = 1;
	    $this->assertEmpty(!$this->Mypage->getActivationHash());
    }
    
    public function testReregistration(){
	    $this->assertTrue($this->Mypage->Reregistration('test2@test.com'));
    }
    
    public function testGetMagiclinkPass(){
	    $this->assertEmpty(!$this->Mypage->getMagiclinkPass('111222'));
    }
    
    public function testSendEmail(){
	    Configure::write('MccPlugin.TEST_MODE', true);
	    $to = 'test';
	    $title = 'test';
	    $body = 'test';
	    $options = 'test';
	    $r = $this->Mypage->sendEmail($to, $title, $body, $options);
	    $this->assertTrue($r);
    }
    

}