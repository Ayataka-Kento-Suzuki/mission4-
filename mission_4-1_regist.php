<html>
<head>
<meta charset="UTF-8">
<title>掲示板</title>
</head>
<body>
<form action="mission_4-1_regist.php" method="post">
新規登録<br>
<input type="text" name="name" placeholder="名前"><br>
<input type="text" name="comment" placeholder="コメント"><br>
<input type="text" name="pas" placeholder="パスワード">
<input type="submit" value="送信"><br>
<input type="hidden" name="flag"><br>
削除<br>
<input type="text" name="delete" placeholder="削除番号"><br>
<input type="text" name="delpas" placeholder="パスワード">
<input type="submit" value="削除"><br><br>
編集<br>
<input type="text" name="edit" placeholder="編集番号"><br>
<input type="text" name="new_name" placeholder="名前"><br>
<input type="text" name="new_comment" placeholder="コメント"><br>
<input type="text" name="editpas" placeholder="パスワード">
<input type="submit" value="編集"><br>
</form>

<?php
$dsn = 'データベース名';
$user = 'ユーザ名';
$password = 'パスワード;
$pdo = new PDO($dsn,$user,$password);

//新規登録
if(!empty($_POST['name'])){
  if(!empty($_POST['comment'])){
    if(!empty($_POST['pas'])){
$sql = $pdo -> prepare("INSERT INTO ayataka7 (name,comment,ntime,pas) VALUES(:name,:comment,:ntime,:pas)");
$sql -> bindParam(':name',$name,PDO::PARAM_STR);
$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
$sql -> bindParam(':ntime',$ntime,PDO::PARAM_STR);
$sql -> bindParam(':pas',$pas,PDO::PARAM_STR);
$timestamp = time() + (60*60*24)*7;
$ntime = date('Y/n/m/d H:i:s',$timestamp);
$name = $_POST['name'];
$comment = $_POST['comment'];
$pas = $_POST['pas'];
$sql -> execute();
}
}
}

//削除
$delete = $_POST['delete'];
$delpas = $_POST['delpas'];
$ds_sql = "SELECT id,pas FROM ayataka7 where '$delete'";
$ds_result = $pdo -> query($ds_sql);
if(!empty($_POST['delete'])){
  if(!empty($_POST['delpas'])){
    foreach ($ds_result as $row) {
      if($delpas == $row['pas']){
        $d_sql = "delete from ayataka7 where id=$delete";
        $d_result = $pdo->query($d_sql);
}
}
}
}

//編集
$edit = $_POST['edit'];
$editpas = $_POST['editpas'];
$new_name = $_POST['new_name'];
$new_comment = $_POST['new_comment'];
$es_sql = "SELECT id,pas FROM ayataka7 where '$edit'";
$es_result = $pdo -> query($es_sql);
if(!empty($_POST['edit'])){
  if(!empty($_POST['editpas'])){
    foreach ($es_result as $row) {
      if($editpas == $row['pas']){
        $e_sql = "update ayataka7 set name='$new_name' , comment='$new_comment' where id = $edit";
        $e_result = $pdo->query($e_sql);
    }
}
}
}

//画面表示
$s_sql= 'SELECT * FROM ayataka7';
$results = $pdo -> query($s_sql);
foreach($results as $row){
echo $row['id'].',';
echo $row['name'].',';
echo $row['comment'].',';
echo $row['ntime'].'<br>';

}
?>

</body>
</html>
