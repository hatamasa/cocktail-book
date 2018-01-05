<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <table>
    <tr>
        <?php foreach ($results as $key => $value): ?>
        <th><?php echo $key ?></th>
        <?php endforeach; ?>
    </tr>
        <?php foreach ($results as $value): ?>
        <td><?php echo $value ?></td>
        <?php endforeach; ?>
    <tr>
    </tr>
    </table>
  </body>
</html>