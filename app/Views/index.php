<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col"><a href="#" onclick="sort('username')">Имя пользователя</a></th>
      <th scope="col"><a href="#" onclick="sort('email')">E-mail</a></th>
      <th scope="col">Текст задачи</th>
      <th scope="col">Каринка</th>
      <th scope="col"><a href="#" onclick="sort('checked')">Статус</a></th>
    </tr>
  </thead>
  <tbody>
    <?php
	foreach ($data as $row) {
		echo '<tr>';
		  echo '<td>' . $row['id'] . '</td>';
		  echo '<td>' . $row['username'] . '</td>';
		  echo '<td>' . $row['email'] . '</td>';
		  echo '<td>' . $row['text'] . '</td>';
		  echo '<td><img src="files/' . $row['file'] . '" alt=""></td><td>';
			  if ( $row['checked'] == 0 ) {			  	
			  	echo '<p class="text-secondary">Не проверен</p>';
			  	if ( $username != '' ) {
			  		echo '<form method="POST" action="/task/check">';
				  	echo '<button type="submit" class="btn btn-outline-success">Проверен</button>';
				  	echo '<input type="hidden" name="checked" value="' . $row['id'] . '">';
				  	echo '</form><br>';

				  	echo '<a href="/task/edit?t=' . $row['id'] . '"><button type="button" class="btn btn-outline-primary">Изменить</button></a>';

				} 
			  } else {
			  	echo '<p class="text-success">Проверен</p>';
			  }			  
		echo '</td></tr>';
	}
	?>
  </tbody>
</table>

	<nav>
	  <ul class="pagination">
		<?php
		if (isset($pagination->total)) {
			for ($i = 1; $i <= $pagination->total; $i++) { 
				echo '<li class="page-item"><a class="page-link" href="task?page=' . $i . '">' . $i . '</a></li>';
			}
		}			
		?>
	  </ul>
	</nav>