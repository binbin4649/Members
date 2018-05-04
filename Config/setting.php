<?php
 
$config['BcApp.adminNavi.members'] = array(
  'name' => 'Membersプラグイン',
  'contents' => array(
    array('name' => '会員一覧', 'url' => array('admin' => true, 'plugin' => 'members', 'controller' => 'mypages', 'action' => 'index')),
  )
);
 
?>