<?php
 
// BcPluginAppControllerを継承する前の準備
App::uses('BcPluginAppController', 'Controller');
class MembersController extends BcPluginAppController {
  
  // nameプロパティにコントローラー名をちゃんと定義します【重要】
  public $name = 'Members';
  // 管理画面接続時にログイン認証を行う設定です
  public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure');
  
// この関数はコントローラの各アクションの前に実行されます
  public function beforeFilter() {
    parent::beforeFilter();
  
    // フロント側のindexアクションの際は認証しないようにします
    $this->BcAuth->allow('index');
  }
 
  //管理画面用のデフォルトアクション
  public function admin_index() {
  }
  
  // フロント画面用のデフォルトアクション
  public function index() {     
  }
  
}
 
?>