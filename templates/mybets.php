<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
<!--        --><?php //var_dump($bets)?>
            <?php foreach ($bets as $bet): ?>
        <tr class="rates__item">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="../<?php echo $bet['betImage']?>" width="54" height="40" alt="Сноуборд">
                </div>
                <h3 class="rates__title"><a href="lot.html"><?php echo $bet['lot_name']?></a></h3>
            </td>
            <td class="rates__category">
                <?=$bet['betCategory']?>
            </td>
            <td class="rates__timer">
<!--                --><?php //var_dump($bet['expDate']); $tempDate = $bet['expDate']?>
<!--                <div class="timer timer--finishing">--><?php //echo betTime('2019-06-24 19:22:18') ?><!--    </div>-->
            </td>
            <td class="rates__price">
                <?php echo $bet['price']; ?>
            </td>
            <td class="rates__time">
                <?php echo $bet['creation_time']; ?>
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</section>
