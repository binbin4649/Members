<div class="baser-form baser-form-input">
<?php
if ($this->Session->check('Message.auth')) {
	$this->Session->flash('auth');
}
?>
<?php $this->BcBaser->flash() ?>
<div id="AlertMessage" class="message" style="display:none"></div>
<?php echo $this->BcForm->create('Mypage', array('action' => 'edit', 'url' => array(), 'class' => 'form-horizontal')) ?>

<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.id', '会員番号') ?></div>
<div class="col-sm-9">
	<div class="control-body"><?php echo $user['id']; ?></div>
</div>
</div>
<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.name', '名前') ?></div>
<div class="col-sm-9">
	<div class="control-body">
		[姓]<?php echo $this->BcForm->input('Mypage.name_1', array('type'=>'text', 'size'=>8, 'tabindex'=>1, 'maxlength'=>'100', 'value'=>$user['name_1'], 'class' => 'form-control form-control-sm')) ?>
		[名]<?php echo $this->BcForm->input('Mypage.name_2', array('type'=>'text', 'size'=>8, 'tabindex'=>2, 'maxlength'=>'100', 'value'=>$user['name_2'], 'class' => 'form-control form-control-sm')) ?>
		<?php echo $this->BcForm->error('Mypage.name') ?></div>
</div>
</div>
<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.name_kana', 'フリガナ') ?></div>
<div class="col-sm-9">
	<div class="control-body">
		[姓]<?php echo $this->BcForm->input('Mypage.name_kana_1', array('type'=>'text', 'size'=>8, 'tabindex'=>3, 'maxlength'=>'100', 'value'=>$user['name_kana_1'], 'class' => 'form-control form-control-sm')) ?>
		[名]<?php echo $this->BcForm->input('Mypage.name_kana_2', array('type'=>'text', 'size'=>8, 'tabindex'=>4, 'maxlength'=>'100', 'value'=>$user['name_kana_2'], 'class' => 'form-control form-control-sm')) ?>
		<?php echo $this->BcForm->error('Mypage.name_kana') ?></div>
</div>
</div>
<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.sex', '性別') ?></div>
<div class="col-sm-9">
	<div class="control-body"><?php echo $this->BcForm->input('Mypage.sex', array('type'=>'radio', 'tabindex'=>5, 'value'=>$user['sex'],'options'=>array('1'=>'男性','2'=>'女性'), 'class' => 'form-control')) ?>
		<?php echo $this->BcForm->error('Mypage.sex') ?></div>
</div>
</div>
<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.tel', '電話番号') ?></div>
<div class="col-sm-9">
	<div class="control-body">
	<?php echo $this->BcForm->input('Mypage.tel_1', array('type'=>'text', 'size'=>3, 'tabindex'=>6, 'maxlength'=>'10', 'value'=>$user['tel_1'], 'class' => 'form-control form-control-sm')) ?>
		- <?php echo $this->BcForm->input('Mypage.tel_2', array('type'=>'text', 'size'=>3, 'tabindex'=>7, 'maxlength'=>'10', 'value'=>$user['tel_2'], 'class' => 'form-control form-control-sm')) ?>
		- <?php echo $this->BcForm->input('Mypage.tel_3', array('type'=>'text', 'size'=>3, 'tabindex'=>8, 'maxlength'=>'10', 'value'=>$user['tel_3'], 'class' => 'form-control form-control-sm')) ?>
		<?php echo $this->BcForm->error('Mypage.tel') ?></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.email', 'メールアドレス') ?></div>
<div class="col-sm-9">
	<div class="control-body"><?php echo $this->BcForm->input('Mypage.email', array('type'=>'email', 'size'=>25, 'tabindex'=>9, 'maxlength'=>'100', 'value'=>$user['email'], 'class' => 'form-control form-control-md')) ?>
		<?php echo $this->BcForm->error('Mypage.email') ?></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?></div>
<div class="col-sm-9">
	<div class="control-body"><small>変更する場合のみ、新しいパスワードを入力してください。</small><br>
		<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'size' => 16, 'tabindex' => 10, 'maxlength' => '20', 'placeholder' => '最低6文字', 'class' => 'form-control form-control-md')) ?><br>
		<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'size' => 16, 'tabindex' => 11, 'maxlength' => '20', 'placeholder' => '確認の為、2回入力してください。', 'class' => 'form-control form-control-md')) ?>
		<small>【確認】</small>
		<?php echo $this->BcForm->error('Mypage.password') ?></div>
</div>
</div>

<div class="submit">
<?php echo $this->BcForm->submit('送信', array('div' => false, 'class' => 'btn btn-lg btn-primary form-submit', 'id' => 'BtnLogin', 'tabindex' => 4)) ?>
</div>
<?php echo $this->BcForm->end() ?>
<div class="section">
<p>メールアドレスを変更すると、確認メールが送信されます。受信できていない場合はアドレスが間違えている恐れがあります。受信できなかった場合は再度修正してください。<br>
また、ログイン時のメールアドレスも同時に変更されます。</p>
</div>
</div>