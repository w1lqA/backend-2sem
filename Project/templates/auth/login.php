<?php require(dirname(__DIR__).'/header.php');?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <h2>Вход</h2>
            <form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/login" method="post">
                <div class="mb-3">
                    <label for="nickname" class="form-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="nickname" name="nickname" required>

                    <label for="password" class="form-label">Пароль:</label>
                    <input type="password" name="password" class="form-control" required>

                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </div>
</div>