<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Тестовое</title>
  </head>
  <body>
  	<div class="container">
  		<nav class="nav">
		  <a class="nav-link active" href="/">Главная</a>
		  <a class="nav-link" href="/create">Добавить</a>
      <?php 
      if ( isset($username)) {  
          if ($username != '') {  
            echo '<a class="nav-link" href="/logout">Выйти</a>';
          } else {
            echo '<a class="nav-link" href="/login">Войти</a>';
          }
      }
      ?>
		</nav>
  	</div>
      <div class="container">
        <?php include '../app/views/'.$content.$expansion; ?>    
      </div>
    
    <!-- Большое модальное окно -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Имя пользователя</th>
              <th scope="col">E-mail</th>
              <th scope="col">Текст задачи</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p class="username"></p></td>
              <td><p class="email"></p></td>
              <td><p class="text"></p></td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>

    <!-- Coockie -->  
    <script src="js/coockie.js"></script>
    <script src="js/script.js"></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>