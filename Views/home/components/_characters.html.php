<section class="characters" id="characters">
    <h2 class="main_title_master">Informations sur les personnages</h2>
    <div class="characters__container">
        <div class="characters__scroll">
            <table class="character__tableau">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th></th>
                        <th>Oeil divin</th>
                        <th>Arme</th>
                        <th>Région</th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($character_icon as $char_icon) : ?>
                    <tbody>
                        <tr>
                            <td>
                                <p><?= $char_icon['name']; ?></p>
                            </td>
                            <td>
                                <div class="character__img">
                                    <img src="<?= $char_icon['image']; ?>" alt="<?= $char_icon['name']; ?>">
                                </div>
                            </td>
                            <td>
                                <div class="character__element">
                                    <img src="<?= element_icon($char_icon['element']) ?>" alt="<?= $char_icon['element']; ?>">
                                </div>
                            </td>
                            <td><?= $char_icon['weapon']; ?></td>
                            <td><?= $char_icon['city']; ?></td>
                            <td><a href="/html/character.php?#<?= $char_icon['name']; ?>"><img src="/assets/img/icons/plus.png" alt="icon plus"></a></td>
                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</section>