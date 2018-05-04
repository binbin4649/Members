<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>

<div class="my-3">
<?php echo $this->Session->flash(); ?>
<p><small>本登録できなかった場合は、改めて新規登録からおねがいします。</small></p>
<ul>
	<li><?php echo $this->Html->link( '新規登録へ', '/members/mypages/signup'); ?></li>
	<li><?php echo $this->Html->link( 'ログイン画面へ', '/members/mypages/login'); ?></li>
</ul>
</div>