<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
            <?php foreach ($bets as $bet): ?>
        <tr class="rates__item">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="../<?php echo $bet['betImage']?>" width="54" height="40" alt="Сноуборд">
                </div>
                <h3 class="rates__title"><a href="lot.html"><?php echo $bet['lot_name']?></a></h3>
            </td>
            <td class="rates__category">
                Доски и лыжи
            </td>
            <td class="rates__timer">
                <div class="timer timer--finishing"> <?php echo $bet['creation_time']; ?></div>
            </td>
            <td class="rates__price">
                <?php echo $bet['price']; ?>
            </td>
            <td class="rates__time">
                5 минут назад
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</section>
