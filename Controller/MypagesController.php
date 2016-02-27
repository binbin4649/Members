<?php 
App::uses('BcPluginAppController', 'Controller');

class MypagesController extends BcPluginAppController {
  
  public $name = 'Mypages';

  public $uses = array('Plugin', 'User', 'Members.Mypage', 'Members.Mylog', 'Members.Myblog', 'Members.Mymail');

  public $helpers = array('BcPage', 'BcHtml', 'BcTime', 'BcForm');  

  public $components = array('Auth', 'Cookie', 'BcEmail');
  
  public $subMenuElements = array('');

  public $crumbs = array(
    array('name' => 'マイページトップ', 'url' => array('controller' => 'mypages', 'action' => 'index')),
  );

  public function beforeFilter() {
    parent::beforeFilter();
  
    $this->Auth->allow('login', 'signup', 'activate', 'reset_password');
    $this->Auth->authenticate = array(
        'Form' => array(
            'userModel' => 'Members.Mypage',
            'scope' => array( 'Mypage.status' => 0)
        ));
    //ログイン画面：デフォルトだとUserControllerになってしまうので強制的に変更する。
    $this->Auth->loginAction = array( 'controller' => 'mypages', 'action' => 'login');
    $this->Auth->loginRedirect = array( 'controller' => 'mypages', 'action' => 'index');
    //$this->BcAuth->logoutRedirect = array( 'controller' => 'Mypages', 'action' => 'logout');

    if (preg_match('/^admin_/', $this->action)) {
      $this->subMenuElements = array('members');
    }
  }

  //管理画面用のデフォルトアクション
  public function admin_index() {
    $conditions = array();
    if ($this->request->is('post')){
      $data = $this->request->data;
      if($data['Mypage']['id']) $conditions[] = array('Mypage.id' => $data['Mypage']['id']);
      if($data['Mypage']['name']) $conditions[] = array('Mypage.name like' => '%'.$data['Mypage']['name'].'%');
      if($data['Mypage']['email']) $conditions[] = array('Mypage.email like' => '%'.$data['Mypage']['email'].'%');
    }
    
    $this->paginate = array('conditions' => $conditions,
      'order' => 'Mypage.id ASC',
      'limit' => 20
    );
    $mypage = $this->paginate('Mypage');
    $this->set('mypage', $mypage);

    $this->pageTitle = '会員一覧';
    //$this->search = 'users_index';
    //$this->help = 'users_index';
  }

  public function admin_edit($id = null){
    if (empty($id)) {
      $this->setMessage('無効なIDです。', true);
      $this->redirect(array('action' => 'index'));
    }
    $mypage = $this->Mypage->findById($id);
    if (empty($mypage)) {
      $this->setMessage('無効なIDです。', true);
      $this->redirect(array('action' => 'index'));
    }
    if ($this->request->is('post')){
      if(empty($this->request->data['Mypage']['password'])){
        unset($this->request->data['Mypage']['password']);
      }
      $this->request->data['Mypage']['username'] = $this->request->data['Mypage']['email'];
      $this->request->data['Mypage']['id'] = $id;
      if( $this->Mypage->save($this->request->data)){
        $user = $this->Auth->user();
        $this->Mylog->record($id, 'edit', $user['id']);
        $this->setMessage( '編集しました');
        $this->redirect(array('action' => 'index'));
      }else{
        $this->setMessage('エラー', true);
      }
    }

    $this->paginate = array(
      'conditions' => array('Mylog.mypage_id'=>$id),
      'order' => 'Mylog.created DESC',
      'limit' => 10
    );
    $mylog = $this->paginate('Mylog');
    $this->set('mylog', $mylog);
    
    $this->pageTitle = 'Members 編集';
    $this->set('mypage', $mypage);
  }
  
  // フロント画面用のデフォルトアクション
  public function index() {
    $user = $this->Auth->user();

    $this->set('mymails', $this->Mymail->showMypage());
    $this->set('myblogs', $this->Myblog->showMypage());    
  }

  public function edit(){
    $user = $this->Auth->user();
    if($this->request->data){
      if(empty($this->request->data['Mypage']['password'])){
        unset($this->request->data['Mypage']['password']);
      }
      $this->request->data['Mypage']['id'] = $user['id'];
      if($this->request->data['Mypage']['email'] != $user['email']){
        $this->request->data['Mypage']['username'] = $this->request->data['Mypage']['email'];
        if($this->Mypage->save($this->request->data)){
          $body['email'] = $this->request->data['Mypage']['email'];
          $body['name'] = $this->request->data['Mypage']['name'];
          if (!$this->sendMail($body['email'], 'メールアドレスが変更されました。', $body, array('template'=>'Members.edit_mail'))) {
            $this->setMessage('メール送信時にエラーが発生しました。', true);
            return;
          }
          $this->setMessage( 'メールアドレスが変更され、確認のメールを送信しました。');
          $this->Mylog->record($user['id'], 'edit with email');
          $user = $this->Mypage->findById($user['id']);
          $this->Session->write('Auth', $user['Mypage']);
          $this->Auth->login($user['Mypage']);
          $this->redirect(array( 'controller' => 'Mypages', 'action' => 'index'));
        }else{
          $this->setMessage('エラー', true);
        }
      }else{
        if( $this->Mypage->save($this->request->data)){
          $this->setMessage( 'ユーザー情報を編集しました。');
          $this->Mylog->record($user['id'], 'edit');
          $user = $this->Mypage->findById($user['id']);
          $this->Session->write('Auth', $user['Mypage']);
          $this->Auth->login($user['Mypage']);
          $this->redirect(array( 'controller' => 'Mypages', 'action' => 'index'));
        }else{
          $this->setMessage('エラー', true);
        }
      }
    }
    $this->pageTitle = 'ユーザー編集';
    $this->set('user', $user);
  }

  public function login(){
    if ($this->request->data) {
      if($this->Auth->login()){
        //ログイン成功したときの処理
        if (!empty($this->request->data['Mypage']['saved'])) {
          unset( $this->request->data['Mypage']['saved']);
          $cookie = $this->request->data;
          $this->Cookie->write( 'Auth.Members', $cookie, true, '+3 weeks');
        }else{
          $this->Cookie->destroy('Auth.Members');
        }
        $user = $this->Auth->user();
        $this->setMessage("ようこそ、" . $user['name'] . "　さん。");
        $this->Mylog->record($user['id'], 'login');  
        $this->redirect(array( 'controller' => 'Mypages', 'action' => 'index'));
      }else{
        //ログイン失敗したときの処理
        $user = $this->Mypage->findByUsername($this->request->data['Mypage']['username']);
        if($user and $user['Mypage']['status'] == 1){
          $this->setMessage('メールのURLをクリックして、本登録してください。', true);
        }else{
          $this->setMessage('アカウント名、パスワードが間違っています。', true);
        }
      }
    }elseif($this->Cookie->check('Auth.Members')){
      $this->request->data = $this->Cookie->read('Auth.Members');
      if($this->Auth->login()){
        $user = $this->Auth->user();
        $this->setMessage("ようこそ、" . $user['name'] . "　さん。");
        $this->Mylog->record($user['id'], 'login');  
        $this->redirect(array( 'controller' => 'Mypages', 'action' => 'index'));
      }else{
        $this->Cookie->destroy('Auth.Members');
      }
    }
    	/* 表示設定 */
  	$this->crumbs = array();
  	$this->subMenuElements = '';
  	$this->pageTitle = 'ログイン';
  }
  
  public function logout(){
    $user = $this->Auth->user();
    $this->Cookie->destroy('Auth.Members');
    $this->Auth->logout();
    $this->setMessage('ログアウトしました');
    $this->Mylog->record($user['id'], 'logout');
    $this->redirect(array( 'controller' => 'Mypages', 'action' => 'login'));
  }

  public function signup(){
    if (!empty($this->request->data)){
        //  保存
        $this->request->data['Mypage']['name'] = $this->request->data['Mypage']['username'];
        $this->request->data['Mypage']['email'] = $this->request->data['Mypage']['username'];
        $this->Mypage->Reregistration($this->request->data['Mypage']['email']); //未認証だったら一旦削除、再登録
        if( $this->Mypage->save($this->request->data)){
            // ユーザアクティベート(本登録)用URLの作成
            $url = 
                DS . 'members' .
                DS . strtolower($this->name) .          // コントローラ
                DS . 'activate' .                       // アクション
                DS . $this->Mypage->id .                  // ユーザID
                DS . $this->Mypage->getActivationHash();  // ハッシュ値
            $url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与
            //  メール送信
            $body['url'] = $url;
            $email = $this->data['Mypage']['username'];
            if (!$this->sendMail($email, '仮登録しました。', $body, array('template'=>'Members.welcome_mail'))) {
              $this->Mypage->delete($this->Mypage->id); //失敗したら登録したのを削除
              $this->setMessage('メール送信時にエラーが発生しました。', true);
              return;
            }
            $this->setMessage( '仮登録成功。メール送信しました。');
            $this->Mylog->record($this->Mypage->id, 'signup');
        } else {
            //  バリデーションエラーメッセージを渡す
            $this->setMessage('入力エラー', true);
        }
    }
    $this->pageTitle = '新規登録';
    $this->set('email', $this->siteConfigs['email']);
  }

  public function activate( $mypage_id = null, $in_hash = null) {
      // UserモデルにIDをセット
      $this->Mypage->id = $mypage_id;
      if ($this->Mypage->exists() && $in_hash == $this->Mypage->getActivationHash()) {
      // 本登録に有効なURL
          // statusフィールドを0に更新
          $this->Mypage->saveField( 'status', 0);
          $this->setMessage( '本登録完了。ログインしてください。');
          $this->Mylog->record($mypage_id, 'activate');
          $this->redirect(array( 'controller' => 'Mypages', 'action' => 'login'));
      }else{
      // 本登録に無効なURL
          //$this->setMessage( '本登録済み、または24時間以上経過しています。');
        $this->setMessage( 'エラー、または本登録済みです。');
      }
  }

  public function reset_password() {
    $this->pageTitle = 'パスワードのリセット';
    if ($this->request->data) {
      if (empty($this->request->data['Mypage']['email'])) {
        $this->Session->setFlash('メールアドレスを入力してください。');
        return;
      }
      $email = trim($this->request->data['Mypage']['email']);
      $user = $this->Mypage->findByEmail($email);
      if (!$user) {
        $this->Session->setFlash('送信されたメールアドレスは登録されていません。');
        return;
      }
      $password = $this->generatePassword(6);
      $user['Mypage']['password'] = $password;
      $user['Mypage']['password_confirm'] = $password;
      $this->Mypage->set($user);
      if (!$this->Mypage->save()) {
        $this->Session->setFlash('新しいパスワードをデータベースに保存できませんでした。');
        return;
      }
      $body['siteUrl'] = Configure::read('BcEnv.siteUrl');
      $body['body'] = $email . ' の新しいパスワードは、 ' . $password . ' です。';
      if (!$this->sendMail($email, 'パスワードを変更しました', $body, array('template'=>'Members.reset_password'))) {
        $this->Session->setFlash('メール送信時にエラーが発生しました。');
        return;
      }
      $this->Session->setFlash($email . ' 宛に新しいパスワードを送信しました。');
      $this->Mylog->record($user['Mypage']['id'], 'reset password');
      $this->request->data = array();
    }
  }

}
 
?>