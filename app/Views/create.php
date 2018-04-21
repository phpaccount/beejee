<?php if (empty($action)) { $action = '/task/store';} ?>
<form method="POST" action="<?=$action?>" enctype="multipart/form-data">
  <div class="form-group">
    <label for="username">Имя пользователя:</label>
    <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($username) ? $username: ""; ?>">
  </div>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($email) ? $email: ""; ?>">
  </div>
  <div class="form-group">
    <label for="text">Текст задачи:</label>
    <textarea class="form-control" name="text" id="text"><?php echo isset($text) ? $text: ""; ?></textarea>
  </div>
  <div class="form-group">
    <label for="text">Картинка:</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" name="file" id="file" accept="image/jpeg,image/png,image/gif">
      <label class="custom-file-label" for="file">Выберите файл</label>
    </div>    
  </div>
  <div class="form-group">
    <?php if (isset($img)) {
      echo '<img src="/files/'.$img.'">';
      echo '<input type="hidden" name="id" value="' . $id . '">';
    }  ?>
    <br>
  </div>
  <div class="form-group"><?php if (empty($img)) {
    echo '<button type="button" class="btn btn-outline-success" onclick="view()" data-toggle="modal" data-target=".bd-example-modal-lg">Предварительный просмотр</button>';
  } ?>
    <button type="submit" class="btn btn-primary">Сохранить</button>
  </div>
</form>