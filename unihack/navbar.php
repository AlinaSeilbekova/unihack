<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Merriweather:wght@900&family=Roboto+Condensed&family=Roboto+Slab&display=swap" rel="stylesheet">

<style>
  body{
    margin:0;
    font-family: 'Bebas Neue', cursive;
    font-family: 'Merriweather', serif;
    font-family: 'Roboto Condensed', sans-serif;
    font-family: 'Roboto Slab', serif;
  }
  .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #2c3e50;
  padding: 10px 20px;
  position: relative;
  z-index: 1;
}

.navbar-logo img {
  width: 100px;
  height: auto;
}

.navbar-toggle {
  display: none;
  border: none;
  background-color: transparent;
  cursor: pointer;
}

.navbar-toggle-icon {
  display: block;
  width: 20px;
  height: 2px;
  background-color: #fff;
  margin: 4px;
  transition: transform 0.2s ease-in-out;
}

.navbar-links {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navbar-links li {
  margin-left: 20px;
}

.navbar-links li:first-child {
  margin-left: 0;
}

.navbar-links a {
  text-decoration: none;
  color: #fff;
  transition: color 0.2s ease-in-out;
}

.navbar-links a:hover {
  color: #f39c12;
}

@media (max-width: 768px) {
  .navbar-toggle {
    display: block;
  }
  
  .navbar-links {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #2c3e50;
    padding: 20px;
  }
  
  .navbar-links li {
    margin: 10px 0;
  }
  
  .navbar-links a {
    font-size: 18px;
  }
  
  .navbar-links a:hover {
    color: #fff;
  }
  
  .navbar-toggle.active .navbar-toggle-icon:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
  }
  
  .navbar-toggle.active .navbar-toggle-icon:nth-child(2) {
    opacity: 0;
  }
  
  .navbar-toggle.active .navbar-toggle-icon:nth-child(3) {
    transform: rotate(-45deg) translate(5px, -5px);
  }
  
  .navbar-toggle.active ~ .navbar-links {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
}
</style>
<?php
  if (!session_id()) {
    session_start();
}

?>
<nav class="navbar">
  <div class="navbar-logo">
    <a href="#"><img src="img/unihack.png" alt="Unihack Logo"></a>
  </div>
  <button class="navbar-toggle">
    <span class="navbar-toggle-icon"></span>
  </button>
  <ul class="navbar-links">
    <li><a href="home.php">Home</a></li>
    <li><a href="academy.php">Academy</a></li>
    <li><a href="checkSessionLabs.php">Labs</a></li>
    <li><a href="checkSessionProfile.php">Profile</a></li>
    <?php
      if(isset($_SESSION['username'])) {
        echo '<li><a href="logout.php">Logout</a></li>';
      } else {
        echo '<li><a href="login.php">Login</a></li>';
      }
    ?>
    
  </ul>
</nav>
