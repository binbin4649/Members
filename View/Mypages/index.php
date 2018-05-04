<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-5 text-secondary"><?php echo $this->pageTitle ?></h1>
<div class="my-3">
<ul>
	<li>会員番号：<?php echo $user['id'] ?></li>
	<li><?php echo $this->BcBaser->link( 'ユーザー編集', '/members/mypages/edit');?></li>
	<li><?php echo $this->BcBaser->link( 'マジックリンク（簡易ログイン）', '/members/mypages/magiclink_pass');?></li>
	<li><?php echo $this->BcBaser->link( '退会', '/members/mypages/withdrawal');?></li>
	<li><?php echo $this->BcBaser->link( 'ログアウト', '/members/mypages/logout');?></li>
</ul>
</div>