<!--------------------- NAVBAR --------------------->

<nav class="navbar">

    <a href="#" class="navbar__icon" aria-label="visit homepage" aria-current="page">
        <img src="/assets/img/logos/Genshin_Impact_logo.svg" alt="logo genshin impact">
        <span>Genshin Impact</span>
    </a>
    
    <div class="main__navlinks">

        <button class="navbar__hamburger" type="button" aria-label="Toggle navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="navlinks__container">
            <a href="/main" aria-current="page">Home</a>
            <a href="#">Services</a>
            <a href="#">Pricing</a>
            <a href="#">Community</a>
            <a href="/contact">Contact</a>
        </div>

    </div>

    <div class="navbar__authentication">
        <a href="#" class="sign__user" aria-label="Sign in page">
            <img src="/assets/img/icons/man-user.svg" alt="icon user">
        </a>
        <div class="sign__btns">
            <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
                <?php if(isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN',$_SESSION['user']['roles'])): ?>
                    <button class="sign__button"><a href="/admin">Admin</a></button>
                <?php endif; ?>
                    <button class="sign__button"><a href="/users/profil">Profil</a></button>
                    <button class="sign__button"><a href="/users/logout">Déconnexion</a></button>
            <?php else: ?>
                    <button class="sign__button"><a href="/users/register">Inscription</a></button>
                    <button class="sign__button"><a href="/users/login">Connection</a></button>
            <?php endif; ?>
        </div>

    </div>

</nav>
