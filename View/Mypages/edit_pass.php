<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-4 mb-md-5 text-secondary">パスワード確認</h1>
<div class="my-3">
		<p><small>パスワードを入力してボタンを押してください。<br />
		</small></p>
		<?php echo $this->BcForm->create('Mypage', array('url' => 'edit_pass', 'class' => 'form-signin')) ?>
		<p>
			会員番号：<?php echo $user['id'] ?>
		</p>
		<p>パスワード：
			<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password')) ?>
		</p>
	<div class="submit">
		<?php echo $this->BcForm->submit('ユーザー編集', array('div' => false, 'class' => 'btn btn-lg btn-primary btn-block mt-4 btn-e')) ?>
	</div>
	<?php echo $this->BcForm->end() ?>
</div>
