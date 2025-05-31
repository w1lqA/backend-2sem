<?php require(dirname(__DIR__).'/header.php'); ?>

<div class="card mt-3" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Редактирование комментария</h5>
    <form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comments/<?= $comment->getId(); ?>/update" method="post">
      <div class="mb-3">
        <label for="text" class="form-label">Текст комментария</label>
        <textarea name="text" id="text" class="form-control" rows="5" required><?= htmlspecialchars($comment->getText()); ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Сохранить</button>
      <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $comment->getArticle()->getId(); ?>" class="btn btn-secondary">Отмена</a>
    </form>
  </div>
</div>
