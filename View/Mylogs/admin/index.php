
<div style="margin-bottom: 15px;">
<?php echo $this->BcForm->create('Mylog') ?>
mypage_id:<?php echo $this->BcForm->input('Mylog.mypage_id', array('type'=>'text', 'size'=>2)) ?>　
created:<?php echo $this->BcForm->datepicker('Mylog.created_st', array('type'=>'text', 'size'=>11)) ?>
- <?php echo $this->BcForm->datepicker('Mylog.created_end', array('type'=>'text', 'size'=>11)) ?>　
action:<?php echo $this->BcForm->input('Mylog.action', array('type'=>'text', 'size'=>7)) ?>　
<?php echo $this->BcForm->input('Mylog.like', array('type'=>'select', 'options'=>['partial'=>'部分一致', 'perfect'=>'完全一致'])) ?>　
csv:<?php echo $this->BcForm->input('Mylog.csv', array('type'=>'checkbox')) ?>　
<?php echo $this->BcForm->submit('検索', array('div' => false, 'class' => 'button', 'style'=>'padding:4px;')) ?>
<?php echo $this->BcForm->end() ?>
</div>

<div id="DataList">
<?php $this->BcBaser->element('pagination') ?>
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
<thead>
	<tr>
		<th>mypage_id</th>
		<th>created</th>
		<th>action</th>
	</tr>
</thead>
<tbody>
	<?php if (!empty($mylog)): ?>
		<?php foreach ($mylog as $log): ?>
			<tr>
				<td><?php echo $log['Mylog']['mypage_id'] ?></td>
				<td><?php echo $log['Mylog']['created'] ?></td>
				<td><?php echo $log['Mylog']['action'] ?></td>
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