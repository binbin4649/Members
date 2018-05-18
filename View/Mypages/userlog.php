<h1 class="h5 border-bottom py-2 mb-3 text-secondary"><?php echo $this->pageTitle ?></h1>
<div class="my-3 mx-1 px-1 px-sm-5">
	
	<?php if($mylog): ?>
	<div class="table-responsive px-0 px-sm-5">
	<small>
	<table class="table table-sm text-nowrap">
		<thead>
			<tr>
				<th scope="col ">Date</th>
				<th scope="col">Action</th>
				<th scope="col">Admin</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($mylog as $log): ?>
			<tr>
			<td><?php echo $log['Mylog']['created']; ?></td>
			<td><?php echo $log['Mylog']['action']; ?></td>
			<td><?php if(!empty($log['Mylog']['user_id'])) echo 'admin'; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</small>
	</div>
	<?php else: ?>
		<p>no data.</p>
	<?php endif; ?>
	<?php $this->BcBaser->pagination('simple'); ?>
</div>
<div class="my-3 mx-3">
	<p>
		<a class="btn btn-outline-secondary btn-sm btn-e" data-toggle="collapse" href="#descriptionOfTable" role="button" aria-expanded="false" aria-controls="collapseExample">
		表：各項目の説明
  		</a>
	</p>
	<div class="collapse" id="descriptionOfTable">
		<small>
		<ul>
			<li>Date：記録した日時</li>
			<li>Action：行った行動</li>
			<li>admin：管理者が編集した場合は「admin」と入ります。</li>
		</ul>
		</small>
	</div>
</div>