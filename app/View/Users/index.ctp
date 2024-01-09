<h3>User List</h3>
<hr>

<div class="container" id="UserListSection" data-user-list-url="<?= Router::url(['controller' => 'users', 'action' => 'listUsers']) ?>">

</div>

<?php echo $this->Html->script('Users/index'); ?>