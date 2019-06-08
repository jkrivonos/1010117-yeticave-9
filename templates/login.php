<?php $classname = empty($errors) ? "" : "form--invalid" ?>
<form class="form container" action="" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?= isset($errors['email']) ? "form__item--invalid" : "" ?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail"
               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "" ?>">
        <span class="form__error"><?= isset($errors['email']) ? $errors['email'] : "" ?></span>
    </div>
    <div class="form__item form__item--last <?= isset($errors['password']) ? "form__item--invalid" : "" ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль"
               value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : "" ?>">
        <span class="form__error"><?= isset($errors['password']) ? $errors['password'] : "" ?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>