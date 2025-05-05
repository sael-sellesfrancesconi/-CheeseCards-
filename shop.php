<?php include("./utils/ini_session.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    
     <!-- Styles / config -->
    <title>CheeseCards - Shop</title>
    <link rel="stylesheet" href="./public/styles_barre.css">
    <link rel="stylesheet" href="./public/styles_header.css">
    <link rel="stylesheet" href="./public/styles_shop.css">
    <link rel="stylesheet" href="./public/styles_paypal.css">
    
    <?php include("./utils/common_head.php"); ?>
    <script src="https://www.paypal.com/sdk/js?client-id=BAAM6TuI8d7tM7ifW38oyGiJ_n_Ky4Z99a_VS4N9GitATSuHPN4h3tNgvA5b14sGum2HNertBxVGPlk9Tw&components=hosted-buttons&disable-funding=venmo&currency=EUR"></script>
</head>
<body class="cheese">
    
    <!-- Header -->
    <?php include("./parts/header_shop.php"); ?>
    
    <!-- Contenu -->
    <main>
        <h3> Une fois le paiement effectué, appuyez sur le bouton de redirection de la popup, sinon vous n'aurez pas votre carte. Si vous avez un problème, joignez un admin, qui vous aidera. Aucune information banquaire n'est conservé par le site. Aucune transaction ne sera remboursé. </h3>
        <?php include("./utils/show_cheeses_shop.php"); ?>
    </main>
    <div id="paypal-container">
    </div>

    <!-- Scripts -->
    <script>
      const buttons = document.querySelectorAll('.acheter-btn');
      const container = document.getElementById('paypal-container');

      buttons.forEach(btn => {
        btn.addEventListener('click', () => {
          const prix = btn.dataset.prix;
          const cheeseId = btn.dataset.id;

          fetch('./utils/set_cheese_id.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `cheese_id=${cheeseId}`
          });

          container.innerHTML = '';

          let hostedButtonId = '';
          if (prix === '1.99') hostedButtonId = '27WE8X8D58VK2';
          else if (prix === '2.99') hostedButtonId = 'G49S8PKTX3HYU';
          else if (prix === '5.99') hostedButtonId = 'BAX6AK75KREGJ';

          if (hostedButtonId) {
            container.style.display = 'block';
            paypal.HostedButtons({ hostedButtonId }).render('#paypal-container');
        }
          
        });
      });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
    
</body>
</html>


