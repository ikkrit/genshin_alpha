<?php require_once ROOT.'/Views/layouts/_head.html.php';?>

        
    <div class="main__scene">

        <div class="scene__moon"></div>
        <img src="/assets/img/main/forest.png" class="scene__forest" alt="forest">
        <img src="/assets/img/main/cloud1.png" class="scene__cloud1" alt="cloud">
        <img src="/assets/img/main/cloud2.png" class="scene__cloud2" alt="cloud">
        <img src="/assets/img/main/cloud3.png" class="scene__cloud3" alt="cloud">
        <img src="/assets/img/main/cloud1.png" class="scene__cloud4" alt="cloud">
        <img src="/assets/img/main/cloud2.png" class="scene__cloud5" alt="cloud">
        <img src="/assets/img/main/cloud3.png" class="scene__cloud6" alt="cloud">

    </div>

    <script type="text/javascript">
        let stars = () => {

            let count = 500;
            let scene = document.querySelector('.main__scene');
            let i = 0;

            while(i < count) {

                let star = document.createElement("i");
                let x = Math.floor(Math.random() * window.innerWidth);
                let y = Math.floor(Math.random() * window.innerHeight);
                let duration = Math.random() * 10;
                let size = Math.random() * 2;

                star.style.left = x + 'px';
                star.style.top = y + 'px';
                star.style.width = 1 + size + 'px';
                star.style.height = 1 + size + 'px';

                star.style.animationDuration = 5 + duration + 's';
                star.style.animationDelay = duration + 's';

                scene.appendChild(star);
                i++;
            }
        }

        stars();
    </script>
</body>

</html>