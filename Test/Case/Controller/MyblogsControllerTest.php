<?php

App::uses('MyblogsController', 'Members.Controller');
//App::uses('Message', 'Mail.Model');

//class MyblogsControllerTest extends ControllerTestCase {
class MyblogsControllerTest extends BaserTestCase {
	
	public $fixtures = array(
		'baser.Default.SiteConfig',
		'baser.Default.Page',
	);

	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}

/**
 * [test_index description]
 * @return [type] [description]
 */
	public function test_admin_index() {
		//$result = $this->testAction('/admin/members/myblogs');
	}

}
