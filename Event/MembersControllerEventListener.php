<?php
class MembersControllerEventListener extends BcControllerEventListener {

/*
	public $events = array(
		'Mail.Mail.beforeRender'
		);
	
	public function mailMailBeforeRender(CakeEvent $event) {
		if (BcUtil::isAdminSystem()) {
			return;
		}
		App::uses('BcAuthComponent',  'Controller/Component');
        $user = BcAuthComponent::user();
        $Controller = $event->subject();
        if($user && !empty($Controller->viewVars['mailFields'])){
	        foreach($Controller->viewVars['mailFields'] as $key => $field){
		        if($field['MailField']['field_name'] == 'name'){
			        $Controller->viewVars['mailFields'][$key]['MailField']['value'] = $user['name'];
		        }
		        if($field['MailField']['field_name'] == 'email'){
			        $Controller->viewVars['mailFields'][$key]['MailField']['value'] = $user['email'];
		        }
		        if($field['MailField']['field_name'] == 'mypage_id'){
			        $Controller->viewVars['mailFields'][$key]['MailField']['value'] = $user['id'];
		        }
	        }
        }
	}
*/
}