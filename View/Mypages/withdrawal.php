<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-4 mb-md-5 text-secondary">退会</h1>

<div class="my-3">
	<p>退会すると以後のログインはできません。<br>
		よろしければ退会ボタンを押してください。
	</p>
	<?php echo $this->BcForm->create('Mypage', array('class' => 'form-signin', 'url' => 'withdrawal')) ?>
	  <?php echo $this->BcForm->input('Mypage.withdrawal', array('type' => 'hidden', 'value' => 'bin')) ?>
	  <?php echo $this->BcForm->submit('退会する', array('div' => false, 'class' => 'btn btn-sm btn-outline-dark btn-block btn-e')) ?>
	<?php echo $this->BcForm->end() ?>
</div>
