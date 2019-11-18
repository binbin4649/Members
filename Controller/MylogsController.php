<?php 

class MylogsController extends MembersAppController {
  
  public $name = 'Mylogs';

  public $uses = array('Plugin', 'User', 'Members.Mypage', 'Members.Mylog');
  
  public $helpers = array('BcPage', 'BcHtml', 'BcTime', 'BcForm', 'Members.Mypage');
  
  public $components = ['BcAuth', 'Cookie', 'BcAuthConfigure'];
  
  public $subMenuElements = array('');

  public $crumbs = array(
    array('name' => 'マイページトップ', 'url' => array('controller' => 'mypages', 'action' => 'index')),
  );

  public function beforeFilter() {
    parent::beforeFilter();
  
    $this->BcAuth->allow();
    $this->BcAuth->authenticate = array(
        'Form' => array(
            'userModel' => 'Members.Mypage',
            'scope' => array( 'Mypage.status' => 0)
        ));
    //ログイン画面：デフォルトだとUserControllerになってしまうので強制的に変更する。
    $this->BcAuth->loginAction = array( 'controller' => 'mypages', 'action' => 'login');
    $this->BcAuth->loginRedirect = array( 'controller' => 'mypages', 'action' => 'index');
	
    if (preg_match('/^admin_/', $this->action)) {
      $this->subMenuElements = array('members');
    }
  }

  
  public function admin_index() {
	$conditions = array();
	if ($this->request->is('post')){
		$data = $this->request->data;
		if($data['Mylog']['mypage_id']){
			$conditions[] = array('Mylog.mypage_id' => $data['Mylog']['mypage_id']);
		}
		if($data['Mylog']['created_st']){
			$conditions[] = array('Mylog.created >=' => $data['Mylog']['created_st'].' 00:00:00');
		}
		if($data['Mylog']['created_end']){
			$conditions[] = array('Mylog.created <=' => $data['Mylog']['created_end'].' 23:59:59');
		}
		if($data['Mylog']['action']){
			if($data['Mylog']['like'] == 'perfect'){
				$conditions[] = array('Mylog.action' => $data['Mylog']['action']);
			}else{
				$conditions[] = array('Mylog.action like' => '%'.$data['Mylog']['action'].'%');
			}
		}
	}
    $this->paginate = array('conditions' => $conditions,
      'order' => 'Mylog.created DESC',
      'limit' => 50
    );
    $mylog = $this->paginate('Mylog');
    $this->set('mylog', $mylog);
    $this->pageTitle = 'Mylog';
    if ($this->request->is('post')){
	    if($data['Mylog']['csv'] == '1'){
		    return $this->csv_download($mylog);
	    }
    }
  }
  	
  	public function csv_download($mylog){
		$this->autoRender = false;
		$this->response->type('csv');
		$this->response->download("mylog.csv");
		$fp = fopen('php://output','w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932', STREAM_FILTER_WRITE);
		$head = ['mypage_id', 'created', 'action'];
		fputcsv($fp, $head);
		foreach($mylog as $log){
		  $output = [];
		  $output['mypage_id'] = $log['Mylog']['mypage_id'];
		  $output['created'] = $log['Mylog']['created'];
		  $output['action'] = $log['Mylog']['action'];
		  fputcsv($fp, $output);
		}
		fclose($fp);
	}
	
	


}




?>