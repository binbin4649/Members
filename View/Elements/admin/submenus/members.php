<tr>
  <th>会員管理メニュー</th>
  <td>
    <ul class="cleafix">
      <li>
        <?php $this->bcBaser->link('会員一覧', array('controller' => 'mypages', 'action' => 'index')) ?>
      </li>
      <li>
        <?php $this->bcBaser->link('会員ブログ', array('controller' => 'myblogs', 'action' => 'index')) ?>
      </li>
      <li>
        <?php $this->bcBaser->link('会員メール', array('controller' => 'mymails', 'action' => 'index')) ?>
      </li>
    </ul>
  </td>
</tr>