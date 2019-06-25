<section class="lot-item container">
    <h2><?php echo htmlspecialchars($current_lot['title']) ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="../<?php echo htmlspecialchars($current_lot['img_link']) ?>" width="730" height="548"
                     alt="картинка">
            </div>
            <p class="lot-item__category">Категория:
                <span><?php echo htmlspecialchars($current_lot['category_name']) ?></span></p>
            <p class="lot-item__description"><?php echo htmlspecialchars($current_lot['description']) ?></p>
        </div>
        <?php if (isset($_SESSION['user'])): ?>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div>
                    <?php echo formatTime(); ?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?php echo htmlspecialchars($current_lot['cur_price']) ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?php echo htmlspecialchars($current_lot['min_betprice']) ?></span>
                    </div>
                </div>
                <?php $classname = empty($errors) ? "" : "form--invalid"?>
                <div class="form__item form__item--file<?= isset($errors['cost']) ? "form__item--invalid" : "" ?> ">
                    <form class="lot-item__form <?= $classname ?>" action="" method="post" autocomplete="off">
                        <div class="lot-item__form-item form__item <?= isset($errors['cost']) ? "form__item--invalid" : "" ?>">
                            <label for="cost">Ваша ставка</label>
                            <input id="cost" type="text" name="cost" placeholder=""
                                   value="<?= isset($_POST['cost']) ? intval($_POST['cost']) : "" ?>"
                            <span class="form__error"><?= isset($errors['cost']) ? $errors['cost'] : "" ?></span>
                        </div>
                        <button type="submit" class="button">Сделать ставку</button>
                    </form>
                </div>
                <?php endif; ?>
                <div class="history">
                    <h3>История ставок (<span>10</span>)</h3>
                    <table class="history__list">
                        <tr class="history__item">
                            <td class="history__name">Иван</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">5 минут назад</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Константин</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">20 минут назад</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Евгений</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">Час назад</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Игорь</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 08:21</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Енакентий</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 13:20</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Семён</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 12:20</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Илья</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 10:20</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Енакентий</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 13:20</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Семён</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 12:20</td>
                        </tr>
                        <tr class="history__item">
                            <td class="history__name">Илья</td>
                            <td class="history__price">10 999 р</td>
                            <td class="history__time">19.03.17 в 10:20</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</section>