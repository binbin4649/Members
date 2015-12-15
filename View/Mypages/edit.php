<?php
if ($this->Session->check('Message.auth')) {
	$this->Session->flash('auth');
}
?>
<?php $this->BcBaser->flash() ?>
<h1><?php $this->BcBaser->contentsTitle() ?></h1>
<div id="AlertMessage" class="message" style="display:none"></div>
<?php echo $this->BcForm->create('Mypage', array('action' => 'edit', 'url' => array())) ?>
<table cellpadding="0" cellspacing="0" class="row-table-01">
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.id', '会員番号') ?></th>
		<td class="col-input"><?php echo $user['id']; ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.name', '名前') ?></th>
		<td class="col-input">
		[姓]<?php echo $this->BcForm->input('Mypage.name_1', array('type'=>'text', 'size'=>8, 'tabindex'=>1, 'maxlength'=>'100', 'value'=>$user['name_1'])) ?>
		[名]<?php echo $this->BcForm->input('Mypage.name_2', array('type'=>'text', 'size'=>8, 'tabindex'=>2, 'maxlength'=>'100', 'value'=>$user['name_2'])) ?>
		<?php echo $this->BcForm->error('Mypage.name') ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.name_kana', 'フリガナ') ?></th>
		<td class="col-input">
		[姓]<?php echo $this->BcForm->input('Mypage.name_kana_1', array('type'=>'text', 'size'=>8, 'tabindex'=>3, 'maxlength'=>'100', 'value'=>$user['name_kana_1'])) ?>
		[名]<?php echo $this->BcForm->input('Mypage.name_kana_2', array('type'=>'text', 'size'=>8, 'tabindex'=>4, 'maxlength'=>'100', 'value'=>$user['name_kana_2'])) ?>
		<?php echo $this->BcForm->error('Mypage.name_kana') ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.sex', '性別') ?></th>
		<td class="col-input">
		<?php echo $this->BcForm->input('Mypage.sex', array('type'=>'radio', 'tabindex'=>5, 'value'=>$user['sex'],'options'=>array('1'=>'男性','2'=>'女性'))) ?>
		<?php echo $this->BcForm->error('Mypage.sex') ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.tel', '電話番号') ?></th>
		<td class="col-input">
		<?php echo $this->BcForm->input('Mypage.tel_1', array('type'=>'text', 'size'=>4, 'tabindex'=>6, 'maxlength'=>'10', 'value'=>$user['tel_1'])) ?>
		- <?php echo $this->BcForm->input('Mypage.tel_2', array('type'=>'text', 'size'=>4, 'tabindex'=>7, 'maxlength'=>'10', 'value'=>$user['tel_2'])) ?>
		- <?php echo $this->BcForm->input('Mypage.tel_3', array('type'=>'text', 'size'=>4, 'tabindex'=>8, 'maxlength'=>'10', 'value'=>$user['tel_3'])) ?>
		<?php echo $this->BcForm->error('Mypage.tel') ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.email', 'メールアドレス') ?></th>
		<td class="col-input"><?php echo $this->BcForm->input('Mypage.email', array('type'=>'email', 'size'=>25, 'tabindex'=>9, 'maxlength'=>'100', 'value'=>$user['email'])) ?>
		<?php echo $this->BcForm->error('Mypage.email') ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?></th>
		<td class="col-input"><small>変更する場合のみ、新しいパスワードを入力してください。</small><br>
		<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'size' => 16, 'tabindex' => 10, 'maxlength' => '20', 'placeholder' => '最低6文字')) ?><br>
		<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'size' => 16, 'tabindex' => 11, 'maxlength' => '20', 'placeholder' => '確認の為、2回入力してください。')) ?>
		<small>【確認】</small>
		<?php echo $this->BcForm->error('Mypage.password') ?></td>
	</tr>
</table>
<div class="submit" style="margin-top:10px;">
<?php echo $this->BcForm->submit('送信', array('div' => false, 'class' => 'btn-red button', 'id' => 'BtnLogin', 'tabindex' => 4)) ?>
</div>
<?php echo $this->BcForm->end() ?>
<div class="section">
<p>メールアドレスを変更すると、確認メールが送信されます。受信できていない場合はアドレスが間違えている恐れがあります。受信できなかった場合は再度修正してください。<br>
また、ログイン時のメールアドレスも同時に変更されます。</p>
</div>