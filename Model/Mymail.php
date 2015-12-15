<?php
App::import('Model', 'BcPluginAppModel');

class Mymail extends BcPluginAppModel {

	public $name = 'Mymail';

    public $belongsTo = array('MailContent' =>
        array('className' => 'Mail.MailContent',
            'foreignKey' => 'ox_pg_mail_content_id',
            'fields' => array('id', 'name', 'title')
            )
        );
    

    public function dataMerge(){
        $content_count = $this->MailContent->find('count');
        $my_count = $this->find('count');
        if($content_count != $my_count){
            $contents = $this->MailContent->find('all', array('fields'=>array('id'), 'recursive'=>-1));
            foreach($contents as $content){
                $mymail = $this->find('first', array('conditions'=>array('ox_pg_mail_content_id'=>$content['MailContent']['id'])));
                if(!$mymail){
                    $my['Mymail'] = array('ox_pg_mail_content_id'=>$content['MailContent']['id']);
                    $this->save($my);    
                }
            }
            $mymails = $this->find('all');
            foreach($mymails as $mymail){
                $content = $this->MailContent->find('first', array('conditions'=>array('id'=>$mymail['Mymail']['ox_pg_mail_content_id'])));
                if(!$content){
                    $this->delete($mymail['Mymail']['id']);
                }
            }
        }
    }

    public function saveRole($data){
        $return = true;
        foreach($data['Mymail']['id'] as $id=>$role){
            $my['Mymail'] = array('id'=>$id, 'role'=>$role);
            if(!$this->save($my)) $return = false;
        }
        return $return;
    }

    public function rejection(){
        $mymails = $this->find('all', array(
            'conditions' => array('role'=>1),
            'fields' => array('MailContent.name')
            ));
        return $mymails;
    }

    public function showMypage(){
        $mymails = $this->find('all', array(
            'conditions' => array('role'=>1),
            'fields' => array('MailContent.name', 'MailContent.title')
            ));
        return $mymails;   
    }

}
