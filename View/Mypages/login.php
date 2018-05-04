<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php $this->BcBaser->flash() ?>
<div id="AlertMessage" class="message" style="display:none"></div>

<div class="my-3">
	 <h1 class="h3 mb-3 font-weight-normal border-bottom">Login</h1>
	<?php echo $this->BcForm->create('Mypage', array('class' => 'form-signin', 'url' => 'login')) ?>
	  <label for="inputEmail" class="sr-only">メールアドレス、またはログインID</label>
	  <?php echo $this->BcForm->input('Mypage.username', array('type' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address')) ?>
	  
	  <label for="inputPassword" class="sr-only">パスワード</label>
	  <?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password')) ?>
	  <div class="checkbox mb-3">
	    <label>
	      <?php echo $this->BcForm->input('Mypage.saved', array('type' => 'checkbox', 'label' => '<small>ログイン状態を保存する</small>')) ?>
	    </label>
	  </div>
	  <?php echo $this->BcForm->submit('ログイン', array('div' => false, 'class' => 'btn btn-lg btn-primary btn-block')) ?>
	<?php echo $this->BcForm->end() ?>
</div>
<div class="pt-3">
	<ul>
		<li><?php $this->BcBaser->link('パスワードを忘れた場合はこちら', array('action' => 'reset_password')) ?></li>
		<li><?php $this->BcBaser->link('新規登録はこちら', array('action' => 'signup')) ?></li>
	</ul>
</div>

