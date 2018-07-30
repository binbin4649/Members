<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>

<h1 class="h5 border-bottom py-3 mb-3 text-secondary"><?php echo $this->pageTitle ?></h1>
<div class="my-3 mx-sm-5">
	
	<div class="row mx-1 mx-sm-5 border p-1">
		<div class="col-sm-6"><small>登録日時</small></div>
		<div class="col-sm-6"><small>登録メールアドレス</small></div>
	</div>
	<div class="row mb-4 mx-1 mx-sm-5 border p-2 bg-light">
		<div class="col-sm-6"><?php echo $mypage['Mypage']['created']; ?></div>
		<div class="col-sm-6"><?php echo $mypage['Mypage']['username']; ?></div>
	</div>
	
	<p>新規登録ありがとうございます。<i class="far fa-thumbs-up fa-2x"></i></p>
	<p>現在はまだ仮登録となっています。<br>
		<i class="far fa-hand-point-right"></i>「<?php echo $email; ?>」から、仮登録完了のメールを送信しましたので、メール本文にあるリンクをタップ（クリック）すると本登録となります。<br>
		<small>
		<p>
			もし届いていない場合は、迷惑メールなどに振り分けられている場合もありますのでご確認ください。<br>
			またメール着信までに2〜3分ほど時間がかかる場合もあります。<br>
			それでも届かない場合は、恐れ入りますが今一度、新規登録から入力お願い致します。
		</p>
		<p>
			携帯各社の迷惑メールフィルターの設定については、それぞれ以下をご参照ください。
			<ul>
				<li><a href="https://www.nttdocomo.co.jp/info/spam_mail/spmode/domain/" target="_blank">docomo 受信リスト／拒否リスト設定</a></li>
				<li><a href="https://www.au.com/support/service/mobile/trouble/mail/email/filter/detail/domain/" target="_blank">au 受信リスト設定</a></li>
				<li><a href="https://www.softbank.jp/mobile/support/antispam/settings/whiteblack/" target="_blank">softbank 迷惑メールの受信許可・拒否設定をする</a></li>
			</ul> 
		</p>
		</small>
	</p>
</div>