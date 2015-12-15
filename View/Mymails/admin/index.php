<div id="DataList">
<?php $this->BcBaser->element('pagination') ?>
<?php echo $this->BcForm->create('Mymail') ?>
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
<thead>
	<tr>
		<th>権限</th>
		<th><?php echo $this->Paginator->sort('id', array('asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')) . ' ID', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')) . ' ID'), array('escape' => false, 'class' => 'btn-direction')) ?></th>
		<th><?php echo $this->Paginator->sort('name', array('asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')) . ' Mailフォームアカウント', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')) . ' Mailフォームアカウント'), array('escape' => false, 'class' => 'btn-direction')) ?></th>
		<th><?php echo $this->Paginator->sort('title', array('asc' => $this->BcBaser->getImg('admin/blt_list_down.png', array('alt' => '昇順', 'title' => '昇順')) . ' Mailフォームタイトル', 'desc' => $this->BcBaser->getImg('admin/blt_list_up.png', array('alt' => '降順', 'title' => '降順')) . ' Mailフォームタイトル'), array('escape' => false, 'class' => 'btn-direction')) ?></th>
	</tr>
</thead>
<tbody>
	<?php if (!empty($my)): ?>
		<?php foreach ($my as $data): ?>
			<tr>
				<td>
				<?php echo $this->BcForm->select('Mymail.id.'.$data['Mymail']['id'], array('1'=>'会員限定'),array('value'=>$data['Mymail']['role'], 'empty'=>array('0'=>'誰でも回覧可'))) ?>
				</td>
				<td><?php echo $data['MailContent']['id'] ?></td>
				<td><?php echo $data['MailContent']['name'] ?></td>
				<td><?php echo $data['MailContent']['title'] ?></td>
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
<div class="submit">
<?php echo $this->BcForm->submit('編集', array('div' => false, 'class' => 'button')) ?>
</div>
<?php echo $this->BcForm->end() ?>
