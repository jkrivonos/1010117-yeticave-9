<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление лота</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/flatpickr.min.css" rel="stylesheet">
</head>
<body>
        <?php $classname = empty($errors) ? "" : "form--invalid" ?>
        <form class="form form--add-lot container <?= $classname ?>" action="add.php" method="post"
              enctype="multipart/form-data">
            <h2>Добавление лота</h2>
            <div class="form__container-two">

                <div class="form__item <?= isset($errors['lot-name']) ? "form__item--invalid" : "" ?>">
                    <label for="lot-name">Наименование <sup>*</sup></label>
                    <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота"
                           value="<?= isset($formData['lot-name']) ? htmlspecialchars($formData['lot-name']) : "" ?>">
                    <span class="form__error"><?= isset($errors['lot-name']) ? $errors['lot-name'] : "" ?></span>
                </div>


                <div class="form__item <?= isset($errors['category']) ? "form__item--invalid" : "" ?>">
                    <label for="category">Категория <sup>*</sup></label>
                    <select id="category" name="category">
                        <option>Выберите категорию</option>
                        <?php foreach ($categories_list as $key => $item): ?>
                            <option value = "<?php echo intval($item['id']); ?>" <?= isset($formData['category']) && htmlspecialchars($formData['category']) == intval($item['id']) ? 'selected' : '' ?>>
                                <a class="promo__link" href="pages/all-lots.html">
                                    <?php echo $item['name'];  ?>
                                </a>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form__error"><?= $errors['category'] ?></span>
                </div>
            </div>
            <div class="form__item form__item--wide <?=  isset($errors['message']) ? "form__item--invalid" : "" ?>">
                <label for="message">Описание <sup>*</sup></label>
                <textarea
                        id="message"
                        name="message"
                        placeholder="Напишите описание лота"><?=  isset($formData['message']) ? htmlspecialchars($formData['message']) : "" ?></textarea>
                <span class="form__error"><?=  isset($errors['message']) ? $errors['message'] : "" ?></span>
            </div>

            <?php $classname = isset ($errors['file']) ? "form__item--invalid" : "";?>
            <div class="form__item form__item--file <?= $classname ?>">
                <label>Изображение <sup>*</sup></label>
                <div class="form__input-file">
                    <input class="visually-hidden" name="img_lot" type="file" id="lot-img" value="">
                    <label for="lot-img">
                        Добавить
                    </label>
                    <span class="form__error"><?= $errors['file'] ?></span>
                </div>
            </div>
            <div class="form__container-three">
                <div class="form__item form__item--small <?= isset($errors['lot-rate']) ? "form__item--invalid" : "" ?>">
                    <label for="lot-rate">Начальная цена <sup>*</sup></label>
                    <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?= isset($formData['lot-rate']) ? intval($formData['lot-rate']) : "" ?>">
                    <span class="form__error"><?= isset($errors['lot-rate']) ? $errors['lot-rate'] : "" ?></span>
                </div>
                <div class="form__item form__item--small <?= isset($errors['lot-step']) ? "form__item--invalid" : "" ?>">
                    <label for="lot-step">Шаг ставки <sup>*</sup></label>
                    <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?= isset($formData['lot-step']) ? intval($formData['lot-step']) : "" ?>">
                    <span class="form__error"><?= isset($errors['lot-step']) ? $errors['lot-step'] : "" ?></span>
                </div>
                <div class="form__item <?= isset($errors['lot-date']) ? "form__item--invalid" : "" ?>">
                    <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                    <input class="form__input-date" id="lot-date" type="text" name="lot-date"
                           placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= isset($formData['lot-date']) ? htmlspecialchars($formData['lot-date'])  : "" ?>">
                    <span class="form__error"><?= isset($errors['lot-date']) ? $errors['lot-date'] : "" ?></span>
                </div>
            </div>
        </form>
<script src="../flatpickr.js"></script>
<script src="../script.js"></script>
</body>
</html>
