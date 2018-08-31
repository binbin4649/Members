<?php $device = $this->Mypage->mobileDetect(); ?>
<?php $this->BcBaser->css(array('Members.members'), array('inline' => false)); ?>
<?php echo $this->Session->flash(); ?>
<script>
    function copyToClipboard() {
        // コピー対象をJavaScript上で変数として定義する
        var copyTarget = document.getElementById("copyTarget");
        // コピー対象のテキストを選択する
        copyTarget.select();
        // 選択しているテキストをクリップボードにコピーする
        document.execCommand("Copy");
        // コピーをお知らせする
        alert("マジックリンクをコピーしました。 : " + copyTarget.value);
    }
</script>

<h1 class="h5 border-bottom py-3 mb-4 mb-md-5 text-secondary">マジックリンク</h1>
<div class="my-3">
	<div class="container">
	    <div class="form-group row mt-3">
	        <input class="border rounded text-secondary form-control-plaintext col-10" id="copyTarget" type="text" value="<?php echo $magic_link ?>" readonly>
	        <button type="button" class="btn btn-secondary col btn-e" onclick="copyToClipboard()" data-toggle="tooltip" data-placement="top" title="Copy to Clipboard.">
	            <i class="fas fa-clipboard"></i>
	        </button>
	    </div>
	</div>
	<div class="border border-warning rounded p-4 mb-3">
		<?php if($device == 'ios'): ?>
			<p><strong>アイコンをホーム画面に追加</strong><br>
				<small>(iPhone:safari)</small>
			</p>
			<p>
			<?php $this->BcBaser->img('Members.iphone_step1.png', ['class'=>'img-fluid']); ?><br>
				<small>1) このページを開いたまま、画面下にあるこのボタンをタップ。</small>
			</p>
			<p>
			<?php $this->BcBaser->img('Members.iphone_step2.png', ['class'=>'img-fluid']); ?><br>
				<small>2) ホーム画面に追加をタップ。</small>
			</p>
			<p>
			<?php $this->BcBaser->img('Members.iphone_step3.png', ['class'=>'img-fluid']); ?><br>
				<small>3) 画面上にある、追加をタップ</small>
			</p>
			<p>これでホーム画面にアイコンが追加され、次回からアイコンをタップすることでログインできます。</p>
		<?php elseif($device == 'android'): ?>
			<p>
		<strong>アイコンをホーム画面に追加</strong><br>
			<small>(Android:chrome)</small>
		</p>
		<p>
		<?php $this->BcBaser->img('Members.android_step1.png', ['class'=>'img-fluid']); ?><br>
			<small>1) このページを開いたまま、メニューボタンをタップ、メニューを開く。メニューボタンが他にある機種もあります。	</small>
		</p>
		<p>
		<?php $this->BcBaser->img('Members.android_step2.png', ['class'=>'img-fluid']); ?><br>
			<small>2) ホーム画面に追加をタップ。	</small>
		</p>
		<p>
		<?php $this->BcBaser->img('Members.android_step3.png', ['class'=>'img-fluid']); ?><br>
			<small>3) 追加をタップ。</small>
		</p>
		<p>これでホーム画面にアイコンが追加され、次回からアイコンをタップすることでログインできます。<br>
			<small>機種・ブラウザなどによりやり方が異なる場合があります。</small>
		</p>
		<?php else: ?>
			このページのアドレスがマジックリンクになっています。<br>
			このページを表示したまま「<strong>お気に入り</strong>」「<strong>ブックマーク</strong>」等に入れていただくと、次回からID・パスワードなしでログインできます。
		<?php endif; ?>
	</div>
	<div class="border rounded bg-light p-3">
	<small>
	<ul>
		<li><span class="text-danger">マジックリンクはパスワード以上に重要なものです。厳重な管理をお願い致します。</span></li>
		<li>パスワードを変更するとマジックリンクも変更され、変更前のマジックリンクは無効になります。</li>
		<li>マジックリンクの発行するとマジックリンクが有効となり、ユーザー情報の編集に毎回パスワードが必要になります。</li>
		<li>ユーザー編集から、マジックリンクでのログイン自体を無効にすることができます。</li>
	</ul>
	</small>
	</div>
</div>
