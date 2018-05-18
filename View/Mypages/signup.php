<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php
if ($this->Session->check('Message.auth')) {
	$this->Session->flash('auth');
}
?>
<?php $this->BcBaser->flash() ?>
<div id="AlertMessage" class="message" style="display:none"></div>

<h1 class="h5 border-bottom py-3 mb-4 mb-md-5 text-secondary">会員登録</h1>
<div class="my-1 my-sm-3">
	<?php echo $this->BcForm->create('Mypage', array('class' => 'form-signin', 'url' => 'signup')) ?>
	  <?php echo $this->BcForm->label('Mypage.username', 'メールアドレス', array('class'=>'form-label')) ?>
	  <?php echo $this->BcForm->input('Mypage.username', array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address', 'value' => $Mypage['username'])) ?>
	  <?php echo $this->BcForm->error('Mypage.username') ?>
	  
	  <?php echo $this->BcForm->label('Mypage.password', 'パスワード', array('class'=>'mt-3 form-label')) ?>
	  <?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'value' => $Mypage['password'])) ?>
	  <?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Retype password', 'value' => $Mypage['password_confirm'])) ?>
	  <?php echo $this->BcForm->error('Mypage.password') ?>
	  <div class="form-description">半角英数、6文字以上。<br>確認の為、2回入力してください。</div>
	  
	  <div class="form-check form-check-inline my-3">
		  <?php echo $this->BcForm->input('Mypage.user_policy', array('type' => 'checkbox', 'class' => 'form-check-input mr-3')) ?>
		  <label class="form-check-label"><?php $this->bcBaser->link('利用規約', '/user_policy') ?>に同意します。</label>
	  </div>
	  
	  <?php echo $this->BcForm->submit('会員登録', array('div' => false, 'class' => 'btn btn-lg btn-primary btn-block mt-4 btn-e')) ?>
	<?php echo $this->BcForm->end() ?>
</div>
<p class="pt-3">「<?php echo $email; ?>」から、仮登録完了のメールが送信されます。<br>
※もし届いていない場合は、迷惑メールフィルターなどを確認し、再登録して下さい。<br>
メール本文にあるURLをクリックすると、本登録となりログインできるようになります。
</p>