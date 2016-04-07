<?php 

class MymailsController extends MembersAppController {
  
  public $name = 'Mymails';

  public $uses = array('Plugin', 'Members.Mymail');
  
  public $subMenuElements = array('');

  public function beforeFilter() {
    parent::beforeFilter();

    if (preg_match('/^admin_/', $this->action)) {
      $this->subMenuElements = array('members');
    }
  }

  //管理画面用のデフォルトアクション
  public function admin_index() {
    $this->Mymail->dataMerge();
    $conditions = array();
    if ($this->request->is('post')){
      if($this->Mymail->saveRole($this->request->data)){
        $this->setMessage( '編集しました');
      }else{
        $this->setMessage('エラー', true);
      }
    }
    $this->paginate = array('conditions' => $conditions,
      'order' => 'Mymail.id ASC',
      'limit' => 20
    );
    $my = $this->paginate('Mymail');
    $this->set('my', $my);

    $this->pageTitle = 'Mailフォーム一覧';
    //$this->search = 'users_index';
    //$this->help = 'users_index';
  }

}
 
?>