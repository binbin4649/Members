<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-4 mb-md-5 text-secondary">パスワード入力</h1>
<div class="my-3">
		<p>マジックリンクとは、ログインID・パスワードを入力せずにログインできる、特殊なリンクです。<br>
			このマジックリンクを「ホーム画面に追加」「ブックマークに追加」などしていただくと、次回から簡単にログインできます。
		</p>
		<p><small>パスワードを入力して生成ボタンを押してください。<br />
			次の画面でマジックリンク（簡易ログイン）をご案内します。
		</small></p>
		<?php echo $this->BcForm->create('Mypage', array('url' => 'magiclink_pass', 'class' => 'form-signin')) ?>
		<p>
			会員番号：<?php echo $user['id'] ?>
		</p>
		<p>パスワード：
			<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password')) ?>
		</p>
	<div class="submit">
		<?php echo $this->BcForm->submit('マジックリンク生成', array('div' => false, 'class' => 'btn btn-lg btn-primary btn-block mt-4 btn-e')) ?>
	</div>
	<?php echo $this->BcForm->end() ?>
</div>
