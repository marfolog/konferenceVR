
<html>
    
    <head>
        <Title>Konference VR</Title>
        <script type="text/javascript" src="../public/js/jquery.js"></script>
        <script src="../public/js/bootstrap.js"></script>
        <link rel="stylesheet" href="../public/css/bootstrap.css">
        <link rel="stylesheet" href="../public/css/bootstrap-theme.css">
        <link rel="stylesheet" href="../public/css/own_style.css">
        
    </head>
    
    <body>
    <nav class="navbar navbar-inverse nav_own">
      <div class="container-fluid nav_own">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><img src="../public/pictures/logo.png" class="img-circle" height="50" alt="Logo"></li>
            <li><a href="index.php?page=index">Příspěvky</a></li>
            

            <?php Session::init(); 
            if(Session::readSession('LoginStatus') == 'user_logged'){ ?>

                <?php if (CurrentUser::getStatusCurrentUser() != null && CurrentUser::getStatusCurrentUser() == "admin") { ?>
                    <li><a href="index.php?page=users">Správa uživatelů</a></li>
                <?php } else if (CurrentUser::getStatusCurrentUser() != null && CurrentUser::getStatusCurrentUser() == "autor"){ ?>
                    <li><a href="index.php?page=myarticles">Moje příspěvky</a></li>
                    <li><a href="index.php?page=article/add">Přidání příspěvku</a></li>
                <?php } ?>
            <?php }?>
          
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php Session::init(); 
            if(Session::readSession('LoginStatus') == 'user_logged'){ ?>
                <li><a><span class="glyphicon glyphicon-user"></span> Přihlášen: <?php echo CurrentUser::getNameCurrentUser(); ?> <?php echo "(".CurrentUser::getStatusStringCurrentUser().")"?></a></li>
                <li><a></a></li>
                <li><a href="index.php?page=login/logoutUser"><span class="glyphicon glyphicon-log-out"></span> Odhlásit</a></li>
            <?php } else{ ?>
              <li><a href="index.php?page=login"><span class="glyphicon glyphicon-log-in"></span> Přihlásit</a> </li>
              <li><a href="index.php?page=register">Registrace</a></li>
            <?php }?>
          </ul>
        </div>
      </div>
    </nav> 
        
        
        
        
        
    <div class="container " >    
