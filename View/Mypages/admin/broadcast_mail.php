<?php echo $this->BcForm->create('Mypage', ['url'=>'broadcast_mail']) ?>
<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
		<tr>
			<th class="col-head">件名</th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.title', array('type' => 'text', 'class' => 'full-width')) ?>
			</td>
		</tr>
		<tr>
			<th class="col-head">本文</th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.body', array('type' => 'textarea', 'rows' => '10', 'class' => 'full-width')) ?>
			</td>
		</tr>
		<tr>
			<th class="col-head">送信先</th>
			<td class="col-input">
				<?php 
					$options = ['admin_only'=>'管理者のみ', 'broadcast'=>'一斉送信'];
					echo $this->BcForm->input('Mypage.submit_check', array('type' => 'radio', 'options' => $options));
				?>
			</td>
		</tr>
	</table>
<div class="submit">
<?php echo $this->BcForm->submit('送信', array('div' => false, 'class' => 'button')) ?>
</div>
<?php echo $this->BcForm->end() ?>

<div class="section">
<ul>
	<li>一斉送信：アカウント状態[有効]の会員全員と管理者を対象にメールが一斉送信されます。</li>
	<li>管理者のみ：確認用テストメールとして、管理者のみにメールを送信します。</li>
	<li>結果の配信数に管理者は含まれていません。</li>
	<li>当メール一斉送信は簡易的な位置づけです。たぶん100通くらいが上限値です。</li>
	<li>システム管理のSMTP設定で設定されたSMTPを利用してメールが送信されます。送信の上限値はSMTPサーバの管理者にお尋ねください。</li>
</ul>
</div>
</div>