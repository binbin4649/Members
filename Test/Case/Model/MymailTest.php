<?php
App::uses('Mymail', 'Members.Model');

class MymailTest extends BaserTestCase {
    public $fixtures = array(
        'plugin.members.Default/Mymail',
        'plugin.mail.Default/MailContent',
        'plugin.mail.Default/MailField',
    );

    public function setUp() {
        parent::setUp();
        $this->Mymail = ClassRegistry::init('Members.Mymail');
    }

    public function testDataMerge(){
        //削除側だけテストしてる。deleteの返値(true)だけを判定している。
        //fixtureのrecordを一つ減らせば、failを再現できる。
        $result = $this->Mymail->dataMerge();
        $this->assertTrue($result);
    }

    public function testSaveRole(){
    	$data['Mymail']['id'][1] = '0';
        $result = $this->Mymail->saveRole($data);
        $this->assertTrue($result);
    }

    public function testRejection(){
        $result = $this->Mymail->rejection();
        $this->assertTrue(is_array($result));
    }

    public function testShowMypage(){
        $result = $this->Mymail->showMypage();
        $this->assertTrue(is_array($result));
    }

}