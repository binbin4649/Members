<!-- form -->
<?php echo $this->BcForm->create('Mypage') ?>
<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.id', '会員番号') ?></th>
			<td class="col-input">
				<?php echo $mypage['Mypage']['id']; ?>
				<?php echo $this->BcForm->input('Mypage.id', array('type' => 'hidden')) ?>
			</td>
		</tr>

		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.name', '名前') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.name', array('type'=>'text', 'value'=>$mypage['Mypage']['name'])) ?>
			<?php echo $this->BcForm->error('Mypage.name') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.username', 'ログインID') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.username', array('type'=>'text', 'value'=>$mypage['Mypage']['username'])) ?>
			<?php echo $this->BcForm->error('Mypage.username') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.sex', '性別') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.sex', array('type'=>'radio', 'value'=>$mypage['Mypage']['sex'],
				'options'=>array('male'=>'男性','female'=>'女性', 'unknown'=>'不明', 'unapplicable'=>'適用外')
				)) 
			?>
			<?php echo $this->BcForm->error('Mypage.sex') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.age', '生年月日') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.age', array('type'=>'text', 'value'=>$mypage['Mypage']['age'])) ?>
			<?php echo $this->BcForm->error('Mypage.age') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.job', '職業') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.job', array('type'=>'text', 'value'=>$mypage['Mypage']['job'])) ?>
			<?php echo $this->BcForm->error('Mypage.job') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.tel', '電話番号') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.tel', array('type'=>'text', 'value'=>$mypage['Mypage']['tel'])) ?>
			<?php echo $this->BcForm->error('Mypage.tel') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.zip', '郵便番号') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.zip', array('type'=>'text', 'value'=>$mypage['Mypage']['zip'])) ?>
			<?php echo $this->BcForm->error('Mypage.zip') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.address_1', '住所1') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.address_1', array('type'=>'text', 'value'=>$mypage['Mypage']['address_1'])) ?>
			<?php echo $this->BcForm->error('Mypage.address_1') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.address_2', '住所2') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.address_2', array('type'=>'text', 'value'=>$mypage['Mypage']['address_2'])) ?>
			<?php echo $this->BcForm->error('Mypage.address_2') ?></td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.email', 'EMail') ?>&nbsp;<span class="required">*</span></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.email', array('type' => 'text', 'value'=>$mypage['Mypage']['email'])) ?>
				<?php echo $this->BcForm->error('Mypage.email') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.myadmin', '管理者') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.myadmin', array('type'=>'radio', 'options'=>array('admin'=>'管理者', 'user'=>'非管理者'), 'value'=>$mypage['Mypage']['myadmin'])) ?>
				<?php echo $this->BcForm->error('Mypage.myadmin') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.myadmin_id', '管理者ID') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.myadmin_id', array('type' => 'text', 'value'=>$mypage['Mypage']['myadmin_id'])) ?>
				<?php echo $this->BcForm->error('Mypage.myadmin_id') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.magiclink', '簡易ログイン') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.magiclink', array('type'=>'radio', 'options'=>array('invalid'=>'無効', 'available'=>'有効'), 'value'=>$mypage['Mypage']['magiclink'])) ?>
				<?php echo $this->BcForm->error('Mypage.magiclink') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.editpass', '編集パスワード') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.editpass', array('type'=>'radio', 'options'=>array('invalid'=>'無効', 'available'=>'有効'), 'value'=>$mypage['Mypage']['editpass'])) ?>
				<?php echo $this->BcForm->error('Mypage.editpass') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.status', 'アカウント状態') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.status', array('type'=>'radio', 'options'=>array('0'=>'有効', '1'=>'無効', '2'=>'退会'), 'value'=>$mypage['Mypage']['status'])) ?>
				<?php echo $this->BcForm->error('Mypage.status') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?></th>
			<td class="col-input">
				<small>変更する場合のみ入力。</small><br>
				<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'placeholder' => '最低6文字')) ?><br>
				<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password')) ?>
				<small>【確認】</small>
				<?php echo $this->BcForm->error('Mypage.password') ?>
			</td>
		</tr>
	</table>
</div>
<!-- button -->
<div class="submit">
<?php echo $this->BcForm->submit('編集', array('div' => false, 'class' => 'button')) ?>
</div>
<?php echo $this->BcForm->end() ?>

<div class="section">
<ul>
	<li>無効にすると削除扱いとなり、ログインできなくなります。</li>
	<li>新規登録から入力した段階では仮登録「無効」で登録され、認証URLをクリックすると本登録「有効」になります。認証URLは一度しか使えません。</li>
	<li></li>
</ul>
</div>

<div id="DataList">
<?php $this->BcBaser->element('pagination') ?>
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('action', array('asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')) . ' Action', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')) . ' Action'), array('escape' => false, 'class' => 'btn-direction')) ?></th>
		<th><?php echo $this->Paginator->sort('created', array('asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')) . ' Created', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')) . ' Created'), array('escape' => false, 'class' => 'btn-direction')) ?></th>
	</tr>
</thead>
<tbody>
	<?php if (!empty($mylog)): ?>
		<?php foreach ($mylog as $data): ?>
			<tr>
				<td><?php echo $data['Mylog']['action'] ?></td>
				<td><?php echo $this->BcTime->format('Y-m-d H:i:s (l)', $data['Mylog']['created']) ?></td>
			</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<tr>
			<td colspan="8"><p class="no-data">データが見つかりませんでした。</p></td>
		</tr>
	<?php endif; ?>
</tbody>
</table>
</div>