<?php
App::uses('Myblog', 'Members.Model');

class MyblogTest extends BaserTestCase {
    public $fixtures = array(
        'plugin.members.Default/Myblog',
        'plugin.blog.Default/BlogContent',
        'plugin.blog.Default/BlogPost',
        'plugin.blog.Default/BlogCategory',
    );

    public function setUp() {
        parent::setUp();
        $this->Myblog = ClassRegistry::init('Members.Myblog');
    }

    public function testDataMerge(){
        //削除側だけテストしてる。deleteの返値(true)だけを判定している。
        //fixtureのrecordを一つ減らせば、failを再現できる。
        $result = $this->Myblog->dataMerge();
        $this->assertTrue($result);
    }

    public function testSaveRole(){
    	$data['Myblog']['id'][1] = '0';
        $result = $this->Myblog->saveRole($data);
        $this->assertTrue($result);
    }

    public function testRejection(){
        $result = $this->Myblog->rejection();
        $this->assertTrue(is_array($result));
    }

    public function testShowMypage(){
        $result = $this->Myblog->showMypage();
        $this->assertTrue(is_array($result));
    }

}