<?php require(dirname(__DIR__).'/header.php'); ?>

<div class="card mt-3" style="max-width: 50rem; margin: 0 auto">
  <div class="card-body">
    <h5 class="card-title"><?= $article->getTitle(); ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?= $article->getAuthor()->getNickname(); ?></h6>
    <p class="card-text"><?= $article->getText(); ?></p>
    <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId(); ?>/edit" class="card-link">Изменить</a>
    <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId(); ?>/delete" class="card-link">Удалить</a>
  </div>
</div>

<?php foreach ($comments as $comment): ?>
  <div id="comment<?= $comment->getId(); ?>" class="card mt-3" style="max-width: 40rem; margin: 0 auto">
    <div class="card-body">
      <h6 class="card-subtitle mb-2 text-muted">
        <?= $comment->getAuthor()->getNickname(); ?> — <?= $comment->getCreatedAt(); ?>
      </h6>
      <p class="card-text"><?= nl2br(htmlspecialchars($comment->getText())); ?></p>
        <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comments/<?= $comment->getId(); ?>/edit" class="card-link">Редактировать</a>
    </div>
  </div>
<?php endforeach; ?>


<form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId(); ?>/comments" method="post" class="mt-3" style="max-width: 50rem; margin: 0 auto">
  <div class="mb-3">
    <label for="text" class="form-label">Оставить комментарий</label>
    <textarea name="text" id="text" class="form-control" rows="3" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>
