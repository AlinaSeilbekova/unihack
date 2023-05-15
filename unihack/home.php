<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unihack Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Merriweather:wght@900&family=Roboto+Condensed&family=Roboto+Slab&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Bebas Neue', cursive;
            font-family: 'Merriweather', serif;
            font-family: 'Roboto Condensed', sans-serif;
            font-family: 'Roboto Slab', serif;
        }
        .main-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .text-section {
            flex-basis: 45%;
            text-align: left;
        }

        .image-section {
            flex-basis: 45%;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
          .main-section {
            flex-direction: column;
            align-items: center;
          }

          .text-section,
          .image-section {
            flex-basis: 100%;
          }
        }

    </style>
</head>
<body>
  <?php include('navbar.php'); ?>
  <div class="main-section">
  <div class="text-section">
    <h2>Learn and Practice at Your Convenience</h2>
    <p>Our platform supports flexible scheduling and is available 24/7 so you can learn and practice at your convenience. Join Unihack today and gain the knowledge and skills you need to become a successful pentester. Protect yourself, your projects, and your clients from cyber attacks by joining our exciting and important community.</p>
  </div>
  <div class="image-section">
  <img src="img/pentest_icon.png">
</div>
</div>

<div class="main-section">
  <div class="image-section">
    <img src="img/pentest_icon2.png">
  </div>
  <div class="text-section">
    <h2>Join Unihack Today</h2>
    <p>Unihack is an online platform designed specifically to help students, programmers, and engineers develop their pentesting skills. Our platform offers both basic and advanced methods and techniques in the field of penetration testing, giving you valuable experience and knowledge that you can apply in practice.</p>
  </div>
</div>
</body>
</html>