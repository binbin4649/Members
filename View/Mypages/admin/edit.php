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
			[姓]<?php echo $this->BcForm->input('Mypage.name_1', array('type'=>'text', 'size'=>8, 'tabindex'=>1, 'maxlength'=>'100', 'value'=>$mypage['Mypage']['name_1'])) ?>
			[名]<?php echo $this->BcForm->input('Mypage.name_2', array('type'=>'text', 'size'=>8, 'tabindex'=>2, 'maxlength'=>'100', 'value'=>$mypage['Mypage']['name_2'])) ?>
			<?php echo $this->BcForm->error('Mypage.name') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.name_kana', 'フリガナ') ?></th>
			<td class="col-input">
			[姓]<?php echo $this->BcForm->input('Mypage.name_kana_1', array('type'=>'text', 'size'=>8, 'tabindex'=>3, 'maxlength'=>'100', 'value'=>$mypage['Mypage']['name_kana_1'])) ?>
			[名]<?php echo $this->BcForm->input('Mypage.name_kana_2', array('type'=>'text', 'size'=>8, 'tabindex'=>4, 'maxlength'=>'100', 'value'=>$mypage['Mypage']['name_kana_2'])) ?>
			<?php echo $this->BcForm->error('Mypage.name_kana') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.sex', '性別') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.sex', array('type'=>'radio', 'tabindex'=>5, 'value'=>$mypage['Mypage']['sex'],'options'=>array('1'=>'男性','2'=>'女性'))) ?>
			<?php echo $this->BcForm->error('Mypage.sex') ?></td>
		</tr>
		<tr>
			<th class="col-head" width="150"><?php echo $this->BcForm->label('Mypage.tel', '電話番号') ?></th>
			<td class="col-input">
			<?php echo $this->BcForm->input('Mypage.tel_1', array('type'=>'text', 'size'=>4, 'tabindex'=>6, 'maxlength'=>'10', 'value'=>$mypage['Mypage']['tel_1'])) ?>
			- <?php echo $this->BcForm->input('Mypage.tel_2', array('type'=>'text', 'size'=>4, 'tabindex'=>7, 'maxlength'=>'10', 'value'=>$mypage['Mypage']['tel_2'])) ?>
			- <?php echo $this->BcForm->input('Mypage.tel_3', array('type'=>'text', 'size'=>4, 'tabindex'=>8, 'maxlength'=>'10', 'value'=>$mypage['Mypage']['tel_3'])) ?>
			<?php echo $this->BcForm->error('Mypage.tel') ?></td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.email', 'EMail') ?>&nbsp;<span class="required">*</span></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.email', array('type' => 'text', 'tabindex'=>9, 'size' => 40, 'maxlength' => 255, 'value'=>$mypage['Mypage']['email'])) ?>
				<?php echo $this->BcForm->error('Mypage.email') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.status', 'アカウント状態') ?></th>
			<td class="col-input">
				<?php echo $this->BcForm->input('Mypage.status', array('type'=>'radio', 'tabindex'=>10, 'options'=>array('0'=>'有効', '1'=>'無効'), 'value'=>$mypage['Mypage']['status'])) ?>
				<?php echo $this->BcForm->error('Mypage.status') ?>
			</td>
		</tr>
		<tr>
			<th class="col-head"><?php echo $this->BcForm->label('Mypage.password', 'パスワード') ?></th>
			<td class="col-input">
				<small>変更する場合のみ入力。</small><br>
				<?php echo $this->BcForm->input('Mypage.password', array('type' => 'password', 'tabindex'=>11, 'size' => 16, 'maxlength' => '20', 'placeholder' => '最低6文字')) ?><br>
				<?php echo $this->BcForm->input('Mypage.password_confirm', array('type' => 'password', 'tabindex'=>12, 'size' => 16, 'maxlength' => '20')) ?>
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