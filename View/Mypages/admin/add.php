<!-- form -->
<?php echo $this->BcForm->create('Mypage') ?>
<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
		
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.name', '名前') ?><span class="required">*</span></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.name', array('type'=>'text')) ?>
			<?php echo $this->BcForm->error('Mypage.name') ?></td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.email', 'EMail') ?><span class="required">*</span></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.email', array('type' => 'text')) ?>
				<br><small>ログインIDになります。</small>
				<?php echo $this->BcForm->error('Mypage.email') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?><span class="required">*</span></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'placeholder' => '最低6文字')) ?><br>
				<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password')) ?>
				<small>【確認】</small>
				<br><small>半角英数6文字以上</small>
				<?php echo $this->BcForm->error('Mypage.password') ?>
			</td>
		</tr>
	</table>
</div>
<!-- button -->
<div class="submit">
<?php echo $this->BcForm->submit('登録', array('div' => false, 'class' => 'button')) ?>
</div>
<?php echo $this->BcForm->end() ?>

<div class="section">
<ul>
	<li></li>
</ul>
</div>
