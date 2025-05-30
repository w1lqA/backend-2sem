<?php
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>

<?php require(dirname(__DIR__).'/header.php');?>

<table class="table" style="max-width: 70rem; margin: 0 auto">
  <thead>
    <tr>
      <th scope="col">№</th>
      <th scope="col">Дата</th>
      <th scope="col">Название</th>
      <th scope="col">Описание</th>
      <th scope="col">Автор</th>
      <th scope="col">Действие</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $articleNumber = 1;
    foreach($articles as $article):?> 
    <tr>
      <th scope="row"><?=$articleNumber++;?></th>
      <td><?=$article->getCreatedAt();?></td>
      <td><a href="<?=$basePath?>/article/<?=$article->getId();?>"><?=$article->getTitle();?></a></td>
      <td><?=$article->getText();?></td>
      <td><?=$article->getAuthor()->getNickname();?></td>
      <td style="display: inline-flex; gap: .5rem">
        <a href="<?=$basePath?>/article/<?=$article->getId();?>/edit" class="btn btn-primary btn-sm">Изменить</a>
        <form action="<?=$basePath?>/article/<?=$article->getId();?>/delete" method="post">
          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены, что хотите удалить эту статью?');">Удалить</button>
        </form>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

