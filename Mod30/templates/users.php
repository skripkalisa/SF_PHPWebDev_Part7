<?php if (isAdmin()): ?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Email</th>
      <th scope="col">Зарегистрирован</th>
    </tr>
  </thead>
  <tbody>
    <?php $users = getUsersList(); ?>
    <?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
    <?php echo ($user['id']%2 !== 0) ?  '<tr>' :  '<tr class="table-light">' ;?>
    <th scope=" row"><?= $user['id'] ?>
    </th>
    <td><?= $user['name'] ?>
    </td>
    <td><?= $user['email'] ?>
    </td>
    <td><?= $user['created_at'] ?>
    </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
<?php else: ?>
<h2>No content</h2>
<?php endif;
