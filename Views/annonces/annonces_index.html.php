<h1>Les annonces</h1>
<?php foreach($annonces as $annonce): ?>
    <article>
        <h2><a href="/annonces/read/<?= $annonce->id;?>"><?=$annonce->titre;?></a></h2>
        <div><?=$annonce->description;?></div>
    </article>
<?php endforeach; ?>