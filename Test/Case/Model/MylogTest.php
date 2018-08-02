<?php
App::uses('Mylog', 'Members.Model');

class MylogTest extends BaserTestCase {
    public $fixtures = array(
        'plugin.members.Default/Mylog',
    );

    public function setUp() {
        $this->Mylog = ClassRegistry::init('Members.Mylog');
        parent::setUp();
    }
    
    public function tearDown(){
	    unset($this->Mylog);
	    parent::tearDown();
    }

    public function testTrueRecord(){
        $result = $this->Mylog->record('1', 'test');
        $this->assertTrue($result);
    }
    
    public function testFalseRecord(){
	    $result = $this->Mylog->record();
        $this->assertFalse($result);
    }
    
    public function testLastLog(){
	    $result = $this->Mylog->lastLog(1);
	    $this->assertEquals('none', $result['Mylog']['action']);
    }

}