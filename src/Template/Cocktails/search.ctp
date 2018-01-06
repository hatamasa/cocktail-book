<table class="type1">
    <thead>
	<tr>
		<th>id</th>
		<th>name</th>
		<th>author</th>
	</tr>
	</thead>
    <tbody>
    <?php foreach ($results as $row): ?>
    </tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['u']['name'] ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
