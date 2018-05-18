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
<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-4 mb-md-5 text-secondary">パスワード再発行</h1>
<div class="my-3">
	<?php echo $this->BcForm->create('Mypage', array('class' => 'form-signin', 'url' => 'reset_password')) ?>
	  <label for="inputEmail" class="sr-only">メールアドレス</label>
	  <?php echo $this->BcForm->input('Mypage.email', array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address')) ?>
	  <?php echo $this->BcForm->submit('送信', array('div' => false, 'class' => 'btn btn-lg btn-primary btn-block btn-e')) ?>
	<?php echo $this->BcForm->end() ?>
</div>
<p>パスワードを忘れた方は、登録されているメールアドレスを送信してください。<br />
新しいパスワードをメールでお知らせします。</p>