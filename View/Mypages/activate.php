<div class="section">
<?php echo $this->Session->flash(); ?>
<p><small>本登録できなかった場合は、改めて新規登録からおねがいします。</small></p>
<p><?php echo $this->Html->link( '新規登録へ', '/members/mypages/signup'); ?></p>
<p><?php echo $this->Html->link( 'ログイン画面へ', '/members/mypages/login'); ?></p>
</div>