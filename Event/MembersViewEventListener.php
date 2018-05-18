<?php

class MembersViewEventListener extends BcViewEventListener {

	public $events = array(
		'header',
		//'Mail.Mail.beforeElement'
		);
	
	public function Header(CakeEvent $event) {
		App::uses('BcAuthComponent',  'Controller/Component');
        $user = BcAuthComponent::user();
        if($user){
	        $event->data = str_replace('/login', '/members/mypages/', $event->data);
	        $event->data = str_replace('ログイン', 'マイページ', $event->data);
        }
	}
	
/*
	public function mailMailBeforeElement(CakeEvent $event){
		//var_dump($event->subject()->MailField->data);
		var_dump($event->subject()->MailField);
		//var_dump($event->viewVars);
		//var_dump($event->data);
		die;
		
	}
*/
}