<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-0 mb-md-3 text-secondary"><?php echo $this->pageTitle ?></h1>
<div class="my-3 container">
	<small>
	<div class="bg-light rounded border border-warning mb-4 p-2">
		<div class="row">
			<div class="col-sm">
				<span class="text-muted">会員番号：</span><?php echo $user['id'] ?>
			</div>
			<div class="col-sm">
				<span class="text-muted">お名前：</span><?php echo $user['name'] ?>
			</div>
		</div>
	</div>
	</small>
	
	<div class="my-2">
		<?php echo $this->BcBaser->link( 'ユーザー編集', '/members/mypages/edit', ['class'=>'btn btn-outline-primary btn-e']);?>
	</div>
	<div class="my-2">
		<?php echo $this->BcBaser->link( 'マジックリンク', '/members/mypages/magiclink_pass', ['class'=>'btn btn-outline-primary btn-e']);?>
		<small><span class="text-muted">（簡易ログイン）</span></small>
	</div>
	<div class="my-2">
		<?php echo $this->BcBaser->link( '退会', '/members/mypages/withdrawal', ['class'=>'btn btn-outline-primary btn-e']);?>
	</div>
	<div class="my-2">
		<?php echo $this->BcBaser->link( 'ユーザーログ', '/members/mypages/userlog', ['class'=>'btn btn-outline-primary btn-e']);?>
	</div>
	<div class="my-2">
		<?php echo $this->BcBaser->link( 'ログアウト', '/members/mypages/logout', ['class'=>'btn btn-outline-primary btn-e']);?>
	</div>
<?php if($pointPlugin): ?>
	<div class="my-2">
		<?php echo $this->BcBaser->link( 'ポイント購入', '/point/point_users/payselect', ['class'=>'btn btn-outline-primary btn-e']);?>
	</div>
	<div class="my-2">
		<?php echo $this->BcBaser->link( 'ポイント履歴', '/point/point_books/', ['class'=>'btn btn-outline-primary btn-e']);?>
	</div>
<?php endif; ?>
</div>