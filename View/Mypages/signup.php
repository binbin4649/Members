<?php
if ($this->Session->check('Message.auth')) {
	$this->Session->flash('auth');
}
?>
<?php $this->BcBaser->flash() ?>
<h1><?php $this->BcBaser->contentsTitle() ?></h1>
<div id="AlertMessage" class="message" style="display:none"></div>
<?php echo $this->BcForm->create('Mypage', array('action' => 'signup', 'url' => array())) ?>
<table cellpadding="0" cellspacing="0" class="row-table-01">
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.username', 'メールアドレス') ?></th>
		<td class="col-input"><?php echo $this->BcForm->input('Mypage.username', array('type' => 'email', 'size' => 16, 'tabindex' => 1, 'maxlength' => '255')) ?>
		<?php echo $this->BcForm->error('Mypage.username') ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?></th>
		<td class="col-input"><small>確認の為、2回入力してください。</small><br>
		<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'size' => 16, 'tabindex' => 2, 'maxlength' => '20', 'placeholder' => '最低6文字')) ?><br>
		<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'size' => 16, 'tabindex' => 2, 'maxlength' => '20')) ?>
		<small>【確認】</small>
		<?php echo $this->BcForm->error('Mypage.password') ?></td>
	</tr>
</table>
<div class="submit" style="margin-top:10px;">
<?php echo $this->BcForm->submit('新規登録', array('div' => false, 'class' => 'btn-red button', 'id' => 'BtnLogin', 'tabindex' => 4)) ?>
</div>
<?php echo $this->BcForm->end() ?>
<div class="section">
<p>「<?php echo $email; ?>」から、仮登録完了のメールが送信されます。<br>
※もし届いていない場合は、迷惑メールフィルターなどを確認し、再登録して下さい。<br>
メール本文にあるURLをクリックすると、本登録となりログインできるようになります。
</p>
</div>