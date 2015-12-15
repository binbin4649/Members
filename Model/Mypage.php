<?php
App::import('Model', 'BcPluginAppModel');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Mypage extends BcPluginAppModel {

	public $name = 'Mypage';

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
            'notEmpty' => array(
                'rule' => array('notEmpty'),
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
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => '名前を入力して下さい。'),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
                'message' => '名前は100文字以内で入力してください。')
        ),
    );

    public function beforeSave($options = array()) {
        if (isset($this->data['Mypage']['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data['Mypage']['password'] = $passwordHasher->hash($this->data['Mypage']['password']);
        }
        //nameを使わず、name_1_2に分ける場合、合体させる
        if (isset($this->data['Mypage']['name_1'])) {
            if(isset($this->data['Mypage']['name_2'])){
                $this->data['Mypage']['name'] = $this->data['Mypage']['name_1'].' '.$this->data['Mypage']['name_2'];
            }else{
                $this->data['Mypage']['name'] = $this->data['Mypage']['name_1'];
            }
        }
        //telを使わず、tel_1_2_3に分ける場合、合体させる
        if(isset($this->data['Mypage']['tel_1'])){
            $tel = $this->data['Mypage']['tel_1'].$this->data['Mypage']['tel_2'].$this->data['Mypage']['tel_3'];
            $tel = mb_convert_kana($tel, "n");
            $tel = mb_ereg_replace('[^0-9]', '', $tel);
            if(!empty($tel)){
                $this->data['Mypage']['tel'] = $tel;
            }    
        }
        return true;
    }    
    
    public function confirmPassword( $field, $password_confirm) {
        if ($field['password'] === $this->data[$this->name][$password_confirm]) {
            // パスワードハッシュ化
            //$this->data[$this->name]['password'] = Security::hash( $field['password'], 'sha512', true);
            return true;
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

}
