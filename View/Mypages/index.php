<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<?php if($myblogs): ?>
<div class="section">
<h4>会員専用ブログ</h4>
<ul>
	<?php foreach($myblogs as $myblog): ?>
	<li><?php echo $this->Html->link($myblog['BlogContent']['title'], '/'.$myblog['BlogContent']['name']);?></li>
	<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<?php if($mymails): ?>
<div class="section">
<h4>会員専用Mailフォーム</h4>
<ul>
	<?php foreach($mymails as $mymail): ?>
	<li><?php echo $this->Html->link($mymail['MailContent']['title'], '/'.$mymail['MailContent']['name']);?></li>
	<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<div class="section">
<ul>
	<li><?php echo $this->Html->link( 'ユーザー編集', '/members/mypages/edit');?></li>
	<li><?php echo $this->Html->link( 'ログアウト', '/members/mypages/logout');?></li>
</ul>
</div>