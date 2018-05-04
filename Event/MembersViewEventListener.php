<?php

class MembersViewEventListener extends BcViewEventListener {

	public $events = array(
		'header'
		);
	
	public function Header(CakeEvent $event) {
		App::uses('BcAuthComponent',  'Controller/Component');
        $user = BcAuthComponent::user();
        if($user){
	        $event->data = str_replace('/login', '/members/mypages/', $event->data);
	        $event->data = str_replace('ログイン', 'マイページ', $event->data);
        }
	}
}