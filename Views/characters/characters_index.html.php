<div class="container">
    <h1>La page de characters</h1>
    <h1>La page de characters</h1>
    <h1>La page de characters</h1>
    <h1>La page de characters</h1>

    <?php foreach($characters as $character): ?>
        <article>
            <div><?=$character->character_name;?></div>
            <h2><a href="/characters/read/<?=$character->character_id;?>"><?=$character->character_name;?></a></h2>
        </article>
    <?php endforeach; ?>
</div>