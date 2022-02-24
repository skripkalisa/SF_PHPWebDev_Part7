<h1>Portfolio</h1>
<p>
<table class="table table-striped">
  Все проекты в следующей таблице являются вымышленными, поэтому даже не пытайтесь перейти по приведенным ссылкам.
  <tr>
    <th>Год</th>
    <th>Проект</th>
    <th>Описание</th>
  </tr>
  <?php

  foreach ($data as $row) {
      echo '<tr><td>' . $row['Year'] . '</td><td>' . $row['Site'] . '</td><td>' . $row['Description'] . '</td></tr>';
  }

  ?>
</table>
</p>