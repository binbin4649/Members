<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php
if ($this->Session->check('Message.auth')) {
	$this->Session->flash('auth');
}
?>
<?php $this->BcBaser->flash() ?>
<div id="AlertMessage" class="message" style="display:none"></div>
<h1 class="h5 border-bottom py-3 mb-5 text-secondary"><?php echo $this->pageTitle ?></h1>

<?php echo $this->BcForm->create('Mypage', array('url' => 'edit', 'class' => 'form-group')) ?>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.id', '会員番号') ?>
	</div>
	<div class="col-md-8">
		<?php echo $user['id']; ?>
	</div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.name', '名前') ?>
	</div>
	<div class="col-md-8">
		<?php echo $this->BcForm->input('Mypage.name', array('type'=>'text', 'value'=>$user['name'], 'class' => 'form-control')) ?>
		<?php echo $this->BcForm->error('Mypage.name') ?>
	</div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.sex', '性別') ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->BcForm->input('Mypage.sex', array('type'=>'select', 'value'=>$user['sex'], 'class' => 'form-control', 'empty' => '',
			'options'=>array('male'=>'男性','female'=>'女性', 'unknown'=>'不明', 'unapplicable'=>'適用外')
		)) ?>
		<?php echo $this->BcForm->error('Mypage.sex') ?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.age', '生年月日') ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->BcForm->input('Mypage.age', array('type'=>'text', 'value'=>$user['age'], 'class' => 'form-control')) ?>
		<?php echo $this->BcForm->error('Mypage.age') ?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.job', '職業') ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->BcForm->input('Mypage.job', array('type'=>'text', 'value'=>$user['job'], 'class' => 'form-control')) ?>
		<?php echo $this->BcForm->error('Mypage.job') ?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.zip', '郵便番号') ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->BcForm->input('Mypage.zip', array('type'=>'text', 'value'=>$user['zip'], 'class' => 'form-control')) ?>
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.address_1', '住所') ?>
	</div>
	<div class="col-md-8">
		<?php echo $this->BcForm->input('Mypage.address_1', array('type'=>'text', 'value'=>$user['address_1'], 'class' => 'form-control')) ?>
	</div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.address_2', '建物・部屋番号') ?>
	</div>
	<div class="col-md-8">
		<?php echo $this->BcForm->input('Mypage.address_2', array('type'=>'text', 'value'=>$user['address_2'], 'class' => 'form-control')) ?>
	</div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.tel', '電話番号') ?>
	</div>
	<div class="col-md-8">
		<?php echo $this->BcForm->input('Mypage.tel', array('type'=>'text', 'value'=>$user['tel'], 'class' => 'form-control')) ?>
		<?php echo $this->BcForm->error('Mypage.tel') ?>
	</div>
</div>
<?php if($user['magiclink'] == 'active'): ?>
	<div class="row mb-3">
		<div class="col-md-4 text-md-right">
			<?php echo $this->BcForm->label('Mypage.magiclink', 'マジックリンク') ?>
		</div>
		<div class="col-md-8 form-inline">
			<?php echo $this->BcForm->input('Mypage.magiclink', array('type'=>'checkbox', 'class' => 'form-control')) ?>
			<label class="ml-2">無効にする。</label>
		</div>
	</div>
<?php endif; ?>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.email', 'メールアドレス<small>（ログインID）</small>') ?>
	</div>
	<div class="col-md-8">
		<?php echo $this->BcForm->input('Mypage.email', array('type'=>'email', 'value'=>$user['email'], 'class' => 'form-control')) ?>
		<small class="form-text text-muted">メールアドレスを変更すると、確認メールが送信されます。受信できていない場合はアドレスが間違えている恐れがあります。受信できなかった場合は再度修正してください。</small>
		<?php echo $this->BcForm->error('Mypage.email') ?>
	</div>
</div>
<div class="row mb-3">
	<div class="col-md-4 text-md-right">
		<?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?>
	</div>
	<div class="col-md-8">
		<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'placeholder' => '最低6文字', 'class' => 'form-control mb-2')) ?>
		<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'placeholder' => '確認の為、2回入力してください。', 'class' => 'form-control')) ?>
		<small class="form-text text-muted">変更する場合のみ、新しいパスワードを入力してください。</small>
		<?php echo $this->BcForm->error('Mypage.password') ?>
	</div>
</div>
<div class="text-center my-3 pt-3">
	<?php echo $this->BcForm->submit('送信', array('div' => false, 'class' => 'btn btn-lg btn-primary', 'id' => 'BtnLogin')) ?>
</div>
<?php echo $this->BcForm->end() ?>
