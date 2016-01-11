<?php
App::uses('Mylog', 'Members.Model');

class MylogTest extends BaserTestCase {
    public $fixtures = array(
        'plugin.members.Default/Mylog',
    );

    public function setUp() {
        parent::setUp();
        $this->Mylog = ClassRegistry::init('Members.Mylog');
    }

    public function testRecord(){
        $result = $this->Mylog->record('1', 'test');
        $this->assertTrue($result);
    }

}