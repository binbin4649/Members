<?php 
App::uses('BcPluginAppController', 'Controller');

class MyblogsController extends BcPluginAppController {
  
  public $name = 'Myblogs';

  public $uses = array('Plugin', 'Members.Myblog');

  public $helpers = array('BcPage', 'BcHtml', 'BcTime', 'BcForm');  

  public $components = array('Auth', 'Cookie', 'BcEmail');
  
  public $subMenuElements = array('');

  public function beforeFilter() {
    parent::beforeFilter();

    if (preg_match('/^admin_/', $this->action)) {
      $this->subMenuElements = array('members');
    }
  }

  //管理画面用のデフォルトアクション
  public function admin_index() {
    $this->Myblog->dataMerge();
    $conditions = array();
    if ($this->request->is('post')){
      if($this->Myblog->saveRole($this->request->data)){
        $this->setMessage( '編集しました');
      }else{
        $this->setMessage('エラー', true);
      }
    }
    $this->paginate = array('conditions' => $conditions,
      'order' => 'Myblog.id ASC',
      'limit' => 20
    );
    $my = $this->paginate('Myblog');
    $this->set('my', $my);

    $this->pageTitle = 'ブログ一覧';
    //$this->search = 'users_index';
    //$this->help = 'users_index';
  }

}
 
?>