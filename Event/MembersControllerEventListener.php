<?php
class MembersControllerEventListener extends BcControllerEventListener {
	
	public $events = array('startup', 'Mail.Mail.beforeRender');
	
	public function startup(CakeEvent $event) {
		$Controller = $event->subject();
		App::uses('AuthComponent',  'Controller/Component');
        $user = AuthComponent::user();
        if(!$user){
        	//$user['user_group_id'] = 'none';//notice対策
        	$folder = explode('/', $Controller->request->url);	
			$Myblog = ClassRegistry::init('Members.Myblog');
			$rejections = $Myblog->rejection();
			foreach($rejections as $rejection){
				if($folder[0] == $rejection['BlogContent']['name']){
					$Controller->redirect('/members/mypages/login');
				}
			}
			$Mymail = ClassRegistry::init('Members.Mymail');
			$rejections = $Mymail->rejection();
			foreach($rejections as $rejection){
				if($folder[0] == $rejection['MailContent']['name']){
					$Controller->redirect('/members/mypages/login');
				}
			}
        }
	}
	
	public function mailMailBeforeRender(CakeEvent $event) {
        $Controller = $event->subject();
        App::uses('AuthComponent',  'Controller/Component');
        $user = AuthComponent::user();
        if($user){
        	foreach($Controller->viewVars['mailFields'] as $key=>$field){
        		if($field['MailField']['field_name'] == 'name') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['name'];
        		if($field['MailField']['field_name'] == 'name_1') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['name_1'];
        		if($field['MailField']['field_name'] == 'name_2') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['name_2'];
        		if($field['MailField']['field_name'] == 'name_kana_1') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['name_kana_1'];
        		if($field['MailField']['field_name'] == 'name_kana_2') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['name_kana_2'];
        		if($field['MailField']['field_name'] == 'sex') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['sex'];
        		if($field['MailField']['field_name'] == 'email_1') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['email'];
        		if($field['MailField']['field_name'] == 'email_2') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['email'];
        		if($field['MailField']['field_name'] == 'tel') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['tel'];
        		if($field['MailField']['field_name'] == 'tel_1') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['tel_1'];
        		if($field['MailField']['field_name'] == 'tel_2') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['tel_2'];
        		if($field['MailField']['field_name'] == 'tel_3') $Controller->viewVars['mailFields'][$key]['MailField']['options'] = 'value|'.$user['tel_3'];
        	}

        }
    }
	
}