
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php
                $countCategories = count($categories);
                while ($index < $countCategories): ?>
                    <li class="promo__item promo__item--boards">
                        <a class="promo__link" href="pages/all-lots.html"><?php echo $categories[$index]; ?></a>
                    </li>
                <?php $index++; ?>
            <?php endwhile; ?>
    </ul>
</section>

<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--список из массива с товарами-->
        <?php
        echo $formatPrice
        ?>
        <?php foreach ($advertisements as $val): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?php echo $val['imgUrl']?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?php echo $val['category']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html">
                        <? echo htmlspecialchars($val['title']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                                <span class="lot__amount"></span>
                            <span class="lot__amount"></span>

                            <span class="lot__cost"><?php echo formatPrice($val['price']); ?></span>
                        </div>
                        <div class="lot__timer timer">
                            12:23
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>