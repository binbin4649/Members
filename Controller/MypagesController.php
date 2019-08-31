<?php 

class MypagesController extends MembersAppController {
  
  public $name = 'Mypages';

  public $uses = array('Plugin', 'User', 'Members.Mypage', 'Members.Mylog');
  
  public $helpers = array('BcPage', 'BcHtml', 'BcTime', 'BcForm', 'Members.Mypage');
  
  public $components = ['BcAuth', 'Cookie', 'BcAuthConfigure'];
  
  public $subMenuElements = array('');

  public $crumbs = array(
    array('name' => 'マイページトップ', 'url' => array('controller' => 'mypages', 'action' => 'index')),
  );

  public function beforeFilter() {
    parent::beforeFilter();
  
    $this->BcAuth->allow('login', 'signup', 'activate', 'reset_password', 'user_policy', 'ml', 'thanks');
    $this->BcAuth->authenticate = array(
        'Form' => array(
            'userModel' => 'Members.Mypage',
            'scope' => array( 'Mypage.status' => 0)
        ));
    //ログイン画面：デフォルトだとUserControllerになってしまうので強制的に変更する。
    $this->BcAuth->loginAction = array( 'controller' => 'mypages', 'action' => 'login');
    $this->BcAuth->loginRedirect = array( 'controller' => 'mypages', 'action' => 'index');
	
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
	  $this->pageTitle = '会員-編集';
    if (empty($id)) {
      $this->setMessage('無効なIDです。', true);
      $this->redirect(array('action' => 'index'));
    }
    $user = $this->BcAuth->user();
	if(empty($this->request->data)){
		$mypage = $this->Mypage->findById($id);
	}else{
      if(empty($this->request->data['Mypage']['password'])){
        unset($this->request->data['Mypage']['password']);
      }
      unset($this->Mypage->validate['username']);//ログインIDのバリデート外す。メールアドレス以外の入力も受付る。
      unset($this->Mypage->validate['email']);
      if( $this->Mypage->save($this->request->data)){
        $this->Mylog->record($id, 'edit', $user['id'], $user);
        $this->setMessage( '編集しました');
        $this->redirect(array('action' => 'index'));
      }else{
	    $mypage = $this->Mypage->findById($id);
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
    unset($mypage['Mypage']['password']);
    $this->request->data = $mypage;
  }
  
  public function admin_add(){
	  $this->pageTitle = '会員-新規登録';
	  if($this->request->data){
		  $this->request->data['Mypage']['username'] = $this->request->data['Mypage']['email'];
		  if( $this->Mypage->save($this->request->data)){
			  $name = $this->request->data['Mypage']['name'];
			  $this->setMessage( $name.' さんを登録しました。');
			  $this->redirect(array('action' => 'index'));
		  }else{
			  $this->setMessage('入力エラー', true);
		  }
	  }
  }
  
  //メール一斉送信
  public function admin_broadcast_mail(){
	  $this->pageTitle = 'メール一斉送信';
	  if($this->request->data){
		  $data = $this->request->data['Mypage'];
		  if(empty($data['title'])) $this->setMessage('件名を入力してください。', true);
		  if(empty($data['body'])) $this->setMessage('本文を入力してください。', true);
		  if(empty($data['submit_check'])) $this->setMessage('送信先にチェックを入れてください。', true);
		  if(!empty($data['title']) && !empty($data['body']) && !empty($data['submit_check'])){
			  if($data['submit_check'] == 'broadcast'){
				  $conditions['conditions'] = ['Mypage.status'=>'0'];
				  $conditions['recursive'] = '-1';
				  $mypages = $this->Mypage->find('all', $conditions);
				  $success = $fail = 0;
				  foreach($mypages as $mypage){
					  if($this->sendMail($mypage['Mypage']['email'], $data['title'], $data, array('template'=>'Members.broadcast', 'layout'=>'default'))){
						  $success++;
					  }else{
						  $fail++;
					  }
				  }
				  $this->setMessage('成功：'.$success.' 失敗：'.$fail.' 一斉送信が完了しました。');
			  }
			  if($this->sendMail($this->siteConfigs['email'], $data['title'], $data, array('template'=>'Members.broadcast', 'layout'=>'default'))){
				  $this->setMessage('管理者にメールを送信しました。');
			  }else{
				  $this->setMessage('管理者へのメール送信に失敗しました。', true);
			  }
		  }
	  }
  }
  
  
  // フロント画面用のデフォルトアクション
  public function index() {
    $this->pageTitle = 'マイページトップ';
    $user = $this->BcAuth->user();
    
/* nos で問題ないことを確認してから削除
    // Pointプラグインが入っているか確認
    $Point = $this->Plugin->findByName('Point');
    if(empty($Point)){
	    $pointPlugin = false;
    }else{
	    $PointUser = ClassRegistry::init('Point.PointUser');
	    $pointPlugin = $PointUser->findByMypageId($user['id'], null, null, 1);
    }
    $this->set('pointPlugin', $pointPlugin);
    
    // $userが PointManagerプラグインに入っているか確認
    $PM = $this->Plugin->findByName('PointManager');
    if(empty($PM)){
	    $PmPlugin = false;
    }else{
	    $Pmpage = ClassRegistry::init('PointManager.Pmpage');
	    $PmPlugin = $Pmpage->findByMypageId($user['id'], null, null, -1);
    }
    $this->set('PmPlugin', $PmPlugin);
*/
    
    $mylog = $this->Mylog->lastLog($user['id']);
    $this->set('mylog', $mylog);
    
    //name がメールアドレスの場合はアラート出す。新規登録時はメールアドレスが入るため
	if(filter_var($user['name'], FILTER_VALIDATE_EMAIL)){
		$this->setMessage('ユーザー編集から、ユーザー名を修正してください。', true);
	}
  }

  public function edit($editpass = null){
    $user = $this->BcAuth->user();
    if($this->request->data){
      if(empty($this->request->data['Mypage']['password'])){
        unset($this->request->data['Mypage']['password']);
      }
      $this->request->data['Mypage']['id'] = $user['id'];
      if(isset($this->request->data['Mypage']['magiclink'])){
	      if($this->request->data['Mypage']['magiclink'] == 1){
		     $this->request->data['Mypage']['magiclink'] = null;
	      }else{
		      $this->request->data['Mypage']['magiclink'] = 'active';
	      }
      }
      if($this->request->data['Mypage']['email'] != $user['email']){
        $this->request->data['Mypage']['username'] = $this->request->data['Mypage']['email'];
        if($this->Mypage->save($this->request->data)){
          $body['email'] = $this->request->data['Mypage']['email'];
          $body['name'] = $this->request->data['Mypage']['name'];
          if (!$this->sendMail($body['email'], 'メールアドレスが変更されました。', $body, array('template'=>'Members.edit_mail', 'layout'=>'default'))) {
            $this->setMessage('メール送信時にエラーが発生しました。', true);
            return;
          }
          $this->setMessage( 'メールアドレスが変更され、確認のメールを送信しました。');
          $this->Mylog->record($user['id'], 'edit with email', null, $user);
          $user = $this->Mypage->findById($user['id']);
          $this->Session->write('BcAuth', $user['Mypage']);
          $this->BcAuth->login($user['Mypage']);
          $this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
        }else{
          $this->setMessage('エラー', true);
        }
      }else{
        if( $this->Mypage->save($this->request->data)){
          $this->setMessage( 'ユーザー情報を編集しました。');
          $this->Mylog->record($user['id'], 'edit', null, $user);
          $user = $this->Mypage->findById($user['id']);
          $this->Session->write('BcAuth', $user['Mypage']);
          $this->BcAuth->login($user['Mypage']);
          $this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
        }else{
          $this->setMessage('エラー', true);
        }
      }
    }
    if($user['magiclink'] == 'active'){
	    if($editpass != null){
			$this->Mypage->id = $user['id'];
			$url_pass = $this->Mypage->getActivationHash();
			if($editpass != $url_pass){
				$this->setMessage('不正なアクセス:pass faild.', true);
				$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
			}
	    }else{
		    // edit_pass が無かったらパスワード入力へリダイレクト
		    $this->redirect(array( 'controller' => 'mypages', 'action' => 'edit_pass'));
	    }
    }
    $this->pageTitle = 'ユーザー編集';
    $this->set('user', $user);
  }
  
  public function edit_pass(){
	$this->pageTitle = 'パスワード確認';
	$user = $this->BcAuth->user();
	if($this->request->data){
		$this->BcAuth->logout();
		$this->request->data['Mypage']['username'] = $user['username'];
		if($this->BcAuth->login()){
			$key = Configure::read('Security.salt');
			$this->Mypage->id = $user['id'];
			$url_pass = $this->Mypage->getActivationHash();
			$this->Mylog->record($user['id'], 'edit pass');
			$this->setMessage('パスワード認証しました。ユーザー編集できます。');
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'edit/'.$url_pass));
		}else{
			$this->setMessage('パスワードが間違っています。再ログインしてください。', true);
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
		}
	}

  }

  public function login($username = null){
    if ($this->request->data) {
	    $this->request->data['Mypage']['username'] = trim($this->request->data['Mypage']['username']);
	    $this->request->data['Mypage']['password'] = trim($this->request->data['Mypage']['password']);
      if($this->BcAuth->login()){
        //ログイン成功したときの処理
        if (!empty($this->request->data['Mypage']['saved'])) {
          unset( $this->request->data['Mypage']['saved']);
          $cookie = $this->request->data;
          $this->Cookie->write( 'BcAuth.Members', $cookie, true, '+3 weeks');
        }else{
          $this->Cookie->destroy('BcAuth.Members');
        }
        $user = $this->BcAuth->user();
        $this->setMessage("ようこそ、" . $user['name'] . "　さん。");
        $this->Mylog->record($user['id'], 'login');
        $this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
      }else{
        //ログイン失敗したときの処理
        $user = $this->Mypage->findByUsername($this->request->data['Mypage']['username']);
        if($user and $user['Mypage']['status'] == 1){
          $this->setMessage('メールのURLをクリックして、本登録してください。', true);
        }elseif($user and $user['Mypage']['status'] == 2){
	      $this->setMessage('退会済みです。', true);
        }else{
          $this->setMessage('アカウント名、またはパスワードが間違っています。', true);
        }
      }
    }elseif($this->Cookie->check('BcAuth.Members')){
      $this->request->data = $this->Cookie->read('BcAuth.Members');
      if($this->BcAuth->login()){
        $user = $this->BcAuth->user();
        $this->setMessage("ようこそ、" . $user['name'] . "　さん");
        $this->Mylog->record($user['id'], 'login');
        $this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
      }else{
        $this->Cookie->destroy('BcAuth.Members');
      }
    }
    $this->request->data['Mypage']['username'] = $username;
    	/* 表示設定 */
  	$this->crumbs = array();
  	$this->subMenuElements = '';
  	$this->pageTitle = 'ログイン';
  }
  
  public function logout(){
    $user = $this->BcAuth->user();
    $this->Cookie->destroy('BcAuth.Members');
    $this->BcAuth->logout();
    $this->setMessage('ログアウトしました');
    $this->Mylog->record($user['id'], 'logout');
    $this->redirect(array( 'controller' => 'mypages', 'action' => 'login'));
  }

  public function signup(){
	$this->crumbs = array();
    if (!empty($this->request->data)){
	    $Mypage = $this->request->data['Mypage'];
	    if($this->request->data['Mypage']['user_policy'] == 0){
		    $this->setMessage('利用規約にチェックが入っていません。', true);
	    }else{
		    //  保存
	        $this->request->data['Mypage']['name'] = $this->request->data['Mypage']['username'];
	        $this->request->data['Mypage']['email'] = $this->request->data['Mypage']['username'];
	        $this->Mypage->Reregistration($this->request->data['Mypage']['email']); //未認証だったら一旦削除、再登録
	        if( $this->Mypage->save($this->request->data)){
		        $mypage_id = $this->Mypage->getLastInsertID();
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
	            if (!$this->sendMail($email, '仮登録しました。', $body, array('template'=>'Members.welcome_mail', 'layout'=>'default'))) {
	              $this->Mypage->delete($this->Mypage->id); //失敗したら登録したのを削除
	              $this->setMessage('メール送信時にエラーが発生しました。', true);
	              return;
	            }
	            $this->setMessage( 'メールを送信しました。メール本文にあるリンクをタップすると本登録になります。');
	            $this->Mylog->record($this->Mypage->id, 'signup');
	            $this->redirect(array( 'controller' => 'mypages', 'action' => 'thanks/'.$mypage_id));
	        } else {
	            //  バリデーションエラーメッセージを渡す
	            $this->setMessage('入力エラー', true);
	        }
	    }
    }else{
	    $Mypage = ['username'=>'', 'password'=>'', 'password_confirm'=>''];
    }
    $this->pageTitle = '新規登録';
    $this->set('email', $this->siteConfigs['email']);
    $this->set('Mypage', $Mypage);
  }
  
  
  public function thanks($mypage_id = null){
	  $this->pageTitle = '仮登録完了';
	  if($mypage_id){
		  $mypage = $this->Mypage->findById($mypage_id, ['Mypage.username', 'Mypage.created', 'Mypage.status']);
		  //仮登録中だけ表示 status=1
		  if($mypage['Mypage']['status'] != 1) $this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
		  $this->set('mypage', $mypage);
	  }
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
          $mypage = $this->Mypage->findById($mypage_id, ['Mypage.username']);
          $username = rawurlencode($mypage['Mypage']['username']);
          $this->redirect(array( 'controller' => 'mypages', 'action' => 'login/'.$username));
      }else{
      // 本登録に無効なURL
        $this->setMessage( 'エラー、または本登録済みです。');
      }
  }

  public function reset_password() {
	$this->crumbs = array();
    $this->pageTitle = 'パスワードのリセット';
    if ($this->request->data) {
      if (empty($this->request->data['Mypage']['email'])) {
        $this->setMessage('メールアドレスを入力してください。', true);
        return;
      }
      $email = trim($this->request->data['Mypage']['email']);
      $user = $this->Mypage->findByEmail($email);
      if (!$user) {
        $this->setMessage('送信されたメールアドレスは登録されていません。', true);
        return;
      }
      $password = $this->generatePassword(6);
      $user['Mypage']['password'] = $password;
      $user['Mypage']['password_confirm'] = $password;
      $this->Mypage->set($user);
      if (!$this->Mypage->save()) {
        $this->setMessage('新しいパスワードをデータベースに保存できませんでした。', true);
        return;
      }
      $body['siteUrl'] = Configure::read('BcEnv.siteUrl');
      $body['body'] = $email . ' の新しいパスワードは、 ' . $password . ' です。';
      if (!$this->sendMail($email, 'パスワードを変更しました', $body, array('template'=>'Members.reset_password', 'layout'=>'default'))) {
        $this->setMessage('メール送信時にエラーが発生しました。', true);
        return;
      }
      //$this->Session->setFlash($email . ' 宛に新しいパスワードを送信しました。');
      $this->setMessage($email . ' 宛に新しいパスワードを送信しました。', true);
      $this->Mylog->record($user['Mypage']['id'], 'reset password');
      $this->request->data = array();
    }
  }
  
  public function withdrawal(){
	$this->pageTitle = '退会';
	$user = $this->BcAuth->user();
	if($this->request->data){
		if (!empty($this->request->data['Mypage']['withdrawal'] == 'bin')) {
			if($this->Mypage->withdrawal($user)){
				$this->Cookie->destroy('BcAuth.Members');
			    $this->BcAuth->logout();
			    $this->setMessage('退会しました。ご利用ありがとうございました。');
			    $this->redirect(array( 'controller' => 'mypages', 'action' => 'login'));
			}else{
				$this->setMessage('ERROR: MypageController.php withdrawal save error.');
			}
		}
	}	
	$this->set('user', $user);
  }
  
  public function magiclink_pass(){
	$this->pageTitle = 'マジックリンク（簡易ログイン）';
	$user = $this->BcAuth->user();
	if($this->request->data){
		$this->BcAuth->logout();
		$this->request->data['Mypage']['username'] = $user['username'];
		if($this->BcAuth->login()){
			//パスワード暗号化
			$url_pass = $this->Mypage->getMagiclinkPass($this->request->data['Mypage']['password']);
			//マジックリンクをアクティブにする
			$this->Mypage->id = $user['id'];
			$this->Mypage->saveField('magiclink', 'active');
			$this->Mylog->record($user['id'], 'magiclink active');
			$this->setMessage('マジックリンクを有効にしました。');
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'ml/'.$user['id'].'/'.$url_pass));
		}else{
			$this->setMessage('パスワードが間違っています。再ログインしてください。', true);
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
		}
	}
	$this->set('user', $user);
  }
  
  public function ml($id, $pass, $p1=null, $p2=null, $p3=null, $p4=null, $p5=null, $p6=null, $p7=null, $p8=null){
	if(!empty($p1)) $pass = $pass.'/'.$p1;
	if(!empty($p2)) $pass = $pass.'/'.$p2;
	if(!empty($p3)) $pass = $pass.'/'.$p3;
	if(!empty($p4)) $pass = $pass.'/'.$p4;
	if(!empty($p5)) $pass = $pass.'/'.$p5;
	if(!empty($p6)) $pass = $pass.'/'.$p6;
	if(!empty($p7)) $pass = $pass.'/'.$p7;
	if(!empty($p8)) $pass = $pass.'/'.$p8;
	$this->layout = 'ml';
	$this->pageTitle = 'Magic Link Login';
	$user = $this->BcAuth->user();
	if(!$user){
		$mypage = $this->Mypage->findById($id);
		if(!$mypage){
			$this->setMessage('ユーザーが不明です。', true);
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
		}
		if($mypage['Mypage']['magiclink'] != 'active'){
			$this->setMessage('マジックリンクが無効です。', true);
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
		}
		$this->log($pass);
		$key = Configure::read('Security.salt');
		//$url_pass = urldecode($pass);//半角スペースが混じるからとりあえず削除
		$password = @openssl_decrypt($pass, 'AES-256-ECB', $key);
	  	$this->request->data['Mypage']['password'] = $password;
	  	$this->request->data['Mypage']['username'] = $mypage['Mypage']['username'];
	  	if($this->BcAuth->login()){
		  	$user = $this->BcAuth->user();
		  	$this->setMessage("ようこそ、" . $user['name'] . "　さん。");
		  	$this->Mylog->record($user['id'], 'magiclink login');
		  	$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
	  	}else{
		  	$this->setMessage('エラー：ログイン後、マジックリンクを再取得してください。', true);
			$this->redirect(array( 'controller' => 'mypages', 'action' => 'index'));
	  	}
	}
	$uri = Configure::read('BcEnv.siteUrl');
	$pass = rawurlencode($pass);
	$magic_link = $uri.'members/mypages/ml/'.$id.'/'.$pass;
	$this->set('magic_link', $magic_link);
	//スマホのホーム画面に設置した時用。ドメインを取り出してタイトルにする。
	$urls = parse_url($uri);
	$domains = explode(".", $urls['host']);
	if($domains[0] == 'www'){
		$ml_title = $domains[1];
	}else{
		$ml_title = $domains[0];
	}
	$this->set('ml_title', $ml_title);
  }

  	public function userlog(){
	  	$this->pageTitle = 'ユーザーログ';
	  	$user = $this->BcAuth->user();
		$this->paginate = array(
			'conditions' => array('Mylog.mypage_id'=>$user['id']),
			'order' => 'Mylog.created DESC',
			'limit' => 30
		);
		$mylog = $this->paginate('Mylog');
		$this->set('mylog', $mylog);
	}



}




?>