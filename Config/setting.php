<?php
 
$config['BcApp.adminNavi.members'] = array(
  'name' => 'Membersプラグイン',
  'contents' => array(
    array('name' => '会員一覧', 'url' => array('admin' => true, 'plugin' => 'members', 'controller' => 'mypages', 'action' => 'index')),
    array('name' => '会員ブログ', 'url' => array('admin' => true, 'plugin' => 'members', 'controller' => 'myblogs', 'action' => 'index')),
    array('name' => '会員メール', 'url' => array('admin' => true, 'plugin' => 'members', 'controller' => 'mymails', 'action' => 'index')),
  )
);
 
?>