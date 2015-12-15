<?php
App::import('Model', 'BcPluginAppModel');

class Myblog extends BcPluginAppModel {

	public $name = 'Myblog';

    public $belongsTo = array('BlogContent' =>
        array('className' => 'Blog.BlogContent',
            'foreignKey' => 'ox_pg_blog_content_id',
            'fields' => array('id', 'name', 'title')
            )
        );
    

    public function dataMerge(){
        $content_count = $this->BlogContent->find('count');
        $my_count = $this->find('count');
        if($content_count != $my_count){
            $contents = $this->BlogContent->find('all', array('fields'=>array('id'), 'recursive'=>-1));
            foreach($contents as $content){
                $myblog = $this->find('first', array('conditions'=>array('ox_pg_blog_content_id'=>$content['BlogContent']['id'])));
                if(!$myblog){
                    $my['Myblog'] = array('ox_pg_blog_content_id'=>$content['BlogContent']['id']);
                    $this->save($my);    
                }
            }
            $myblogs = $this->find('all');
            foreach($myblogs as $myblog){
                $content = $this->BlogContent->find('first', array('conditions'=>array('id'=>$myblog['Myblog']['ox_pg_blog_content_id'])));
                if(!$content){
                    $this->delete($myblog['Myblog']['id']);
                }
            }
        }
    }

    public function saveRole($data){
        $return = true;
        foreach($data['Myblog']['id'] as $id=>$role){
            $my['Myblog'] = array('id'=>$id, 'role'=>$role);
            if(!$this->save($my)) $return = false;
        }
        return $return;
    }

    public function rejection(){
        $myblogs = $this->find('all', array(
            'conditions' => array('role'=>1),
            'fields' => array('BlogContent.name')
            ));
        return $myblogs;
    }

    public function showMypage(){
        $myblogs = $this->find('all', array(
            'conditions' => array('role'=>1),
            'fields' => array('BlogContent.name', 'BlogContent.title')
            ));
        return $myblogs;   
    }

}
