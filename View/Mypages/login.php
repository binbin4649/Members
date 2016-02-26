<div class="baser-form baser-form-input">
<?php $this->BcBaser->flash() ?>
<div id="AlertMessage" class="message" style="display:none"></div>
<?php echo $this->BcForm->create('Mypage', array('action' => 'login', 'class' => 'form-horizontal', 'url' => array())) ?>

<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage' . '.username', 'メールアドレス') ?></div>
<div class="col-sm-9">
	<div class="control-body"><?php echo $this->BcForm->input('Mypage' . '.username', array('type' => 'text', 'size' => 16, 'tabindex' => 1, 'class' => 'form-control form-control-md')) ?></div>
</div>
</div>
<div class="form-group">
<div class="col-sm-3 control-label"><?php echo $this->BcForm->label('Mypage' . '.password', 'パスワード') ?></div>
<div class="col-sm-9">
	<div class="control-body"><?php echo $this->BcForm->input('Mypage' . '.password', array('type' => 'password', 'size' => 16, 'tabindex' => 2, 'class' => 'form-control form-control-md')) ?></div>
</div>
</div>

<div class="submit">
<?php echo $this->BcForm->submit('ログイン', array('div' => false, 'class' => 'btn btn-lg btn-primary form-submit', 'id' => 'BtnLogin', 'tabindex' => 4)) ?>
</div>
<div class="more">
<?php echo $this->BcForm->input('Mypage' . '.saved', array('type' => 'checkbox', 'label' => 'ログイン状態を保存する', 'tabindex' => 3)) ?>
</div>
<?php echo $this->BcForm->end() ?>

<P><?php $this->BcBaser->link('パスワードを忘れた場合はこちら', array('action' => 'reset_password'), array('rel' => 'popup')) ?></P>
<p><a href="<?php echo BC_BASE_URL; ?>members/Mypages/signup" class="btn btn-lg btn-block btn-primary"><i class="fa fa-thumbs-o-up"></i> 新規登録はこちら</a></p>

</div>