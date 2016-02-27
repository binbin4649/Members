<div class="baser-form baser-form-input">
<?php
if ($this->Session->check('Message.auth')) {
	$this->Session->flash('auth');
}
?>
<?php $this->BcBaser->flash() ?>
<div id="AlertMessage" class="message" style="display:none"></div>
<?php echo $this->BcForm->create('Mypage', array('action' => 'signup', 'url' => array(), 'class' => 'form-horizontal')) ?>

<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.username', 'メールアドレス') ?></div>
<div class="col-sm-9">
	<div class="control-body">
		<?php echo $this->BcForm->input('Mypage.username', array('type' => 'email', 'size' => 16, 'tabindex' => 1, 'maxlength' => '255', 'class' => 'form-control form-control-md')) ?>
		<?php echo $this->BcForm->error('Mypage.username') ?>
	</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?></div>
<div class="col-sm-9">
	<div class="control-body">
		<small>確認の為、2回入力してください。</small><br>
		<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'size' => 16, 'tabindex' => 2, 'maxlength' => '20', 'placeholder' => '最低6文字', 'class' => 'form-control form-control-md')) ?><br>
		<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'size' => 16, 'tabindex' => 3, 'maxlength' => '20', 'class' => 'form-control form-control-md')) ?>
		<small>【確認】</small>
		<?php echo $this->BcForm->error('Mypage.password') ?>
	</div>
</div>
</div>


<div class="submit">
<?php echo $this->BcForm->submit('新規登録', array('div' => false, 'class' => 'btn btn-lg btn-primary form-submit', 'id' => 'BtnLogin', 'tabindex' => 4)) ?>
</div>
<?php echo $this->BcForm->end() ?>
<div class="section">
<p>「<?php echo $email; ?>」から、仮登録完了のメールが送信されます。<br>
※もし届いていない場合は、迷惑メールフィルターなどを確認し、再登録して下さい。<br>
メール本文にあるURLをクリックすると、本登録となりログインできるようになります。
</p>
</div>
</div>