<?php $classname = empty($errors) ? "" : "form--invalid" ?>
<form class="form container"  <?= $classname ?>" action="" method="post" autocomplete="off"> <!-- form--invalid -->
<h2>Регистрация нового аккаунта</h2>
<div class="form__item <?= isset($errors['email']) ? "form__item--invalid" : "" ?>">
    <label for="email">E-mail <sup>*</sup></label>
    <input id="email" type="text" name="email" placeholder="Введите e-mail"
           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "" ?>">
    <span class="form__error"><?= isset($errors['email']) ? $errors['email'] : "" ?></span>
</div>
<div class="form__item <?= isset($errors['password']) ? "form__item--invalid" : "" ?>">
    <label for="password">Пароль <sup>*</sup></label>
    <input id="password" type="password" name="password" placeholder="Введите пароль">
    <span class="form__error"><?= isset($errors['password']) ? $errors['password'] : "" ?></span>
</div>
<div class="form__item <?= isset($errors['name']) ? "form__item--invalid" : "" ?>">
    <label for="name">Имя <sup>*</sup></label>
    <input id="name" type="text" name="name" placeholder="Введите имя"
           value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "" ?>">
    <span class="form__error"><?= isset($errors['name']) ? $errors['name'] : "" ?></span>
</div>
<div class="form__item <?= isset($errors['message']) ? "form__item--invalid" : "" ?>">
    <label for="message">Контактные данные <sup>*</sup></label>
    <textarea
            id="message"
            name="message"
            placeholder="Напишите как с вами связаться"><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : "" ?></textarea>
    <span class="form__error"><?= isset( $errors['message']) ? $errors['message'] : "" ?></span>
</div>
<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
<button type="submit" class="button">Зарегистрироваться</button>
<a class="text-link" href="#">Уже есть аккаунт</a>
</form>
