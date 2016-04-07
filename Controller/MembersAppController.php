<?php
/*
* Membersプラグイン
* 基底コントローラー
*
* PHP 5.6.x
*
* @copyright    Hideichi Saito
* @link         https://github.com/binbin4649/BaserCMS-Plugin-Members/
* @package      BaserCMS-Plugin-Members
* @since        ver.0.0.2
*/

/**
* Include files
*/
App::uses('BcPluginAppController', 'Controller');

/**
* 基底コントローラー
*
* 
*/
class MembersAppController extends BcPluginAppController {

	public $helpers = array('BcPage', 'BcHtml', 'BcTime', 'BcForm');  

  	public $components = array('Auth', 'Cookie', 'BcEmail');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('user', $this->Auth->user());
	}
}
