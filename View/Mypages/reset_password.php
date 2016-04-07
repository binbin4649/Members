<?php
/**
 * [ADMIN] パスワードリセット画面
 *
 * baserCMS :  Based Website Development Project <http://basercms.net>
 * Copyright 2008 - 2014, baserCMS Users Community <http://sites.google.com/site/baserusers/>
 *
 * @copyright		Copyright 2008 - 2014, baserCMS Users Community
 * @link			http://basercms.net baserCMS Project
 * @package			Baser.View
 * @since			baserCMS v 0.1.0
 * @license			http://basercms.net/license/index.html
 */
?>
<?php echo $this->Session->flash(); ?>
<div class="baser-form baser-form-input">
<div class="section">
	<p>パスワードを忘れた方は、登録されているメールアドレスを送信してください。<br />
		新しいパスワードをメールでお知らせします。</p>
		<?php echo $this->BcForm->create('Mypage', array('action' => 'reset_password')) ?>
	<div class="submit">
		<?php echo $this->BcForm->input('Mypage' . '.email', array('type' => 'text', 'size' => 30)) ?>
		<?php echo $this->BcForm->submit('送信', array('div' => false, 'class' => 'btn btn-lg btn-primary form-submit')) ?>
	</div>
	<?php echo $this->BcForm->end() ?>
</div>
</div>