
<h1>Page de profil</h1>
<section class="profil users">

    <div class="container__profil">

        <h1>Profil</h1>

        <div class="container__profil-box">
            <div class="profil__box-text">
                <p>Pseudo : <?=$profils->pseudo;?></p>
                <p>Prenom : <?=$profils->first_name;?></p>
                <p>Nom : <?=$profils->last_name;?></p>
                <p>Email : <?=$profils->email;?></p>
            </div>

            <div class="profil__box-img">
                <p><img src="<?=$profils->avatar;?>" alt=""></p>
            </div>
            <a href="/users/deleteUser/<?=$profils->id;?>">Suprimer le profil</a>
        </div>

    </div>

</section>
