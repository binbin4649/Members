<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>
<div class="baser-form baser-form-input">
<div class="section">
	<p>退会の注意事項<br>
		退会するとログインできません。
	</p>
		<?php echo $this->BcForm->create('Mypage', array('url' => 'withdrawal')) ?>
	<div class="submit">
		<?php echo $this->BcForm->input('Mypage.withdrawal', array('type' => 'hidden', 'value' => 'bin')) ?>
		<?php echo $this->BcForm->submit('退会する', array('div' => false, 'class' => 'btn btn-lg btn-primary form-submit')) ?>
	</div>
	<?php echo $this->BcForm->end() ?>
</div>
</div>