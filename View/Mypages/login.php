<?php $this->BcBaser->flash() ?>
<h1><?php $this->BcBaser->contentsTitle() ?></h1>
<div id="AlertMessage" class="message" style="display:none"></div>
<?php echo $this->BcForm->create('Mypage', array('action' => 'login', 'url' => array())) ?>
<table cellpadding="0" cellspacing="0" class="row-table-01">
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage' . '.username', 'メールアドレス') ?></th>
		<td class="col-input"><?php echo $this->BcForm->input('Mypage' . '.username', array('type' => 'text', 'size' => 16, 'tabindex' => 1)) ?></td>
	</tr>
	<tr>
		<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage' . '.password', 'パスワード') ?></th>
		<td class="col-input"><?php echo $this->BcForm->input('Mypage' . '.password', array('type' => 'password', 'size' => 16, 'tabindex' => 2)) ?></td>
	</tr>
</table>
<div class="submit" style="margin-top:10px;">
<?php echo $this->BcForm->submit('ログイン', array('div' => false, 'class' => 'btn-red button', 'id' => 'BtnLogin', 'tabindex' => 4)) ?>
</div>
<div class="more">
<?php echo $this->BcForm->input('Mypage' . '.saved', array('type' => 'checkbox', 'label' => 'ログイン状態を保存する', 'tabindex' => 3)) ?>
</div>
<div class="more">
<?php $this->BcBaser->link('パスワードを忘れた場合はこちら', array('action' => 'reset_password'), array('rel' => 'popup')) ?>
</div>
<?php echo $this->BcForm->end() ?>

<div class="submit">
<a href="/members/Mypages/signup"><button class="button">新規登録はこちら</button></a>
</div>
