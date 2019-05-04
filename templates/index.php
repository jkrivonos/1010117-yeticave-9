
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->
        <?php foreach ($categories as $cat): ?>
                    <li class="promo__item promo__item--<?php echo $cat['code']; ?>">
                        <a class="promo__link" href="pages/all-lots.html">
                            <?php echo $cat['name']; ?></a>
                    </li>
            <?php endforeach; ?>
    </ul>
</section>

<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--список из массива с товарами-->
        <?php
            echo $formatPrice;

        ?>
        <?php foreach ($advertisements as $val):  ?>
            <a href = "lot.php?id=<?php echo $val['id'];?> ">
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?php echo $val['img_link']?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?php echo $val['category_name'];?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html">
                        <? echo htmlspecialchars($val['title']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                                <span class="lot__amount"></span>
                            <span class="lot__amount"></span>

                            <span class="lot__cost"><?php echo formatPrice($val['max_price']); ?></span>
                        </div>
                        <div>
                            <?php
                            echo formatTime();

                            ?>
                        </div>
                    </div>
                </div>
            </li>
            </a>
        <?php endforeach; ?>
    </ul>
</section>