<?php
// Mypage.status [0=有効アクティベート済み, 1=無効未アクティベート, 2=退会]

App::import('Model', 'AppModel');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Mypage extends AppModel {

	public $name = 'Mypage';
	
	public $hasMany = [
		'Mylog' => [
			'className' => 'Members.Mylog',
			'foreignKey' => 'mypage_id',
			'order' => 'Mylog.created DESC',
			'limit' => 10
	]];

	public $validate = array(
        'username' => array(
            'validEmail' => array( 
                'rule' => array( 'email', true), 
                'message' => 'メールアドレスが正しくありません。'),
            'emailExists' => array( 
                'rule' => 'isUnique', 
                'message' => '既に登録されています'),
        ),
        'password' => array(
            'minLength' => array(
                'rule' => array('minLength', 6), 
                'message' => 'パスワードは6文字以上で入力してください。', 'allowEmpty' => false),
            'maxLength' => array(
                'rule' => array('maxLength', 50),
                'message' => 'パスワードは50文字以内で入力してください。'),
            'alphaNumeric' => array(
                'rule' => 'alphaNumericPlus',
                'message' => 'パスワードは半角英数字とハイフン、アンダースコアのみで入力してください。'),
            'match' => array( 
                'rule' => array( 'confirmPassword', 'password_confirm'), 
                'message' => 'パスワードが一致しません。'),
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Eメールを入力して下さい。'),
            'email' => array(
                'rule' => array('email', true),
                'message' => 'Eメールの形式が不正です。',
                'allowEmpty' => true),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => 'Eメールは255文字以内で入力してください。'),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'このメールアドレスは既に登録されています。')
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => '名前を入力して下さい。'),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '名前は100文字以内で入力してください。')
        ),
    );
    
    public function beforeValidate($options = array()){
	    if(isset($this->data[$this->name]['tel'])){
		    $this->data[$this->name]['tel'] = $this->numbersOnly($this->data[$this->name]['tel']);
	    }
	    return true;
    }
    
    public function numbersOnly($data){
	    $data = mb_convert_kana($data, 'n');
	    $data = preg_replace('/[^0-9]/', '', $data);
	    return $data;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data['Mypage']['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data['Mypage']['password'] = $passwordHasher->hash($this->data['Mypage']['password']);
        }
        return true;
    }    
    
    public function confirmPassword( $field, $password_confirm) {
        if ($field['password'] === $this->data[$this->name][$password_confirm]) {
            // パスワードハッシュ化
            //$this->data[$this->name]['password'] = Security::hash( $field['password'], 'sha512', true);
            return true;
        }else{
	        return false;
        }
    }

	public function getActivationHash() {
	    // ユーザIDの有無確認
	    if (!isset($this->id)) {
	        return false;
	    }
        //1日経ってたらアウト。逆に1日経ってたらアカウント削除する処理を入れないと、メールアドレスがかぶって、もう一度登録できない。
        /*
        $past = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d')-1, date('Y')));
        if($past > $this->field('modified')){
            return false;
        }
        */
	    // 更新日時をハッシュ化
	    return Security::hash( $this->field('modified'), 'md5', true);
	}

    public function Reregistration($email){
        //既に登録があって、未認証だったら一旦削除する
        $mypages = $this->find('first', array('conditions' => array('status'=>1, 'username'=>$email)));
        if($mypages) $this->delete($mypages['Mypage']['id']);
        return true;
    }
    
    public function getMagiclinkPass($password){
	    $key = Configure::read('Security.salt');
		$crypt_pass = openssl_encrypt($password, 'AES-256-ECB', $key);
		$url_pass = rawurlencode($crypt_pass);
		return $url_pass;
    }
    
    //退会、削除
    public function withdrawal($user){
	    if(empty($user['id']) && empty($user['email'])) return false;
	    if(empty($user['username'])) $user['username'] = $user['email'];
	    $mypage['Mypage']['id'] = $user['id'];
	    $mypage['Mypage']['status'] = 2;
	    $mypage['Mypage']['username'] = $user['username'].date('YmdHis');//再入会できるようにする。
	    $mypage['Mypage']['email'] = $user['email'].date('YmdHis');
	    if($this->save($mypage, false)){
		    $this->Mylog->record($user['id'], 'withdrawal');
		    return true;
	    }else{
		    return false;
	    }
    }
    
    // 有効無効を返す。
     // status. 0 = 有効, 1 = アクティベート前, 2 = 退会
    public function mypageAvailable($id){
	    $mypage = $this->findById($id, null, null, -1);
	    if($mypage['Mypage']['status'] == 0){
		    return '有効';
	    }else{
		    return '無効';
	    }
    }
    

}
