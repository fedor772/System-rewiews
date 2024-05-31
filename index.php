<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/mdui@2/mdui.css">
    <script src="https://unpkg.com/mdui@2/mdui.global.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Система отзывов</title>
  </head>
  <body>
    <mdui-top-app-bar style="position: relative;">
    <mdui-top-app-bar-title>Система отзывов</mdui-top-app-bar-title>
  </mdui-top-app-bar>
    <form method="POST">
      <input name="name" placeholder="Имя" />
      <input name="login" placeholder="Email или номер телефона" />
      <input name="rewiew" placeholder="Отзыв" />
      <button type=submit>Отправить</button>
      <div class="rating-area">
	<input type="radio" id="star-5" name="rating" value="5">
	<label for="star-5" title="Оценка «5»"></label>	
	<input type="radio" id="star-4" name="rating" value="4">
	<label for="star-4" title="Оценка «4»"></label>    
	<input type="radio" id="star-3" name="rating" value="3">
	<label for="star-3" title="Оценка «3»"></label>  
	<input type="radio" id="star-2" name="rating" value="2">
	<label for="star-2" title="Оценка «2»"></label>    
	<input type="radio" id="star-1" name="rating" value="1">
	<label for="star-1" title="Оценка «1»"></label>
      </div>
    </form>
    <mdui-card>
    <div>Информация про логин остаётся конфиденциальной</div>
    <br>
<?php
$name = "не определено";
$login = "не определено";
$rewiew = "не определено";
if(isset($_POST["name"])){
    $name = $_POST["name"];
}
if(isset($_POST["login"])){
    $login = $_POST["login"];
}
if(isset($_POST["rewiew"])){
    $rewiew = $_POST["rewiew"];
}
  $rating = "";
  $stars = "";
  if(isset($_POST["rating"])) {
    $rating = $_POST["rating"];
    for ($i = 0; $i < $rating; $i++) {
      $stars = $stars . "&#9733";
    }
  }
    if ($name !== "не определено" && $login !== "не определено" && $rewiew !== "не определено" && $stars !== "") {
      echo "Имя: $name <br> Отзыв: $rewiew <br> Логин: $login";
      file_put_contents("data.txt", "Имя: $name \n<br>Отзыв: $rewiew \n<br>Оценка: <span class=starsrewiew>$stars</span>\n<br>-------------\n<br>", FILE_APPEND);
    } else {
      echo "Вы ещё не оставили свой отзыв";
    }
?>
      </mdui-card>
    <div>Все отзывы:</div>
<?php
$file = fopen("data.txt", "r");
$text = "";
while (!feof($file)) {
  $text .= fgets($file);
}
fclose($file);

echo "-------------<br>$text";
?>

</html>