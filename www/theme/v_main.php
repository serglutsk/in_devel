<?php
//головний шаблон
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
     <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">Web-technology</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <li class="active"><a href="index.php"><?php echo  c_base::tr('Home', $this->language);?></a></li>
              <li><a href="index.php?c=news"><?php echo  c_base::tr('News', $this->language);?></a></li>
              <li><a href="index.php?c=contact"><?php echo  c_base::tr('Contact', $this->language);?></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo  c_base::tr('Language', $this->language);?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <form action="index.php" method="POST">
                            <input type="hidden" value="ru" name="lang">
                            <input type="hidden" value="<?=$_SERVER["REQUEST_URI"]; ?>" name="url">
                            <input type="submit" name="lan_ru" value="Руский">
                        </form></li>
                  <li><form action="index.php" method="POST">
                            <input type="hidden" value="en" name="lang">
                            <input type="hidden" value="<?=$_SERVER["REQUEST_URI"]; ?>" name="url">
                            <input type="submit" name="lan_en" value="English">
                        </form></li>
                  
                </ul>
              </li>
            </ul>
              <div class="nav pull-right">
                  <?php
                  
                  if(!empty($this->user)){?>
                  <a href='index.php?c=logout' class="btn btn-inverse"><?php echo  c_base::tr('Logout', $this->language);?>(<?=$this->user;?>)</a>
                 <?php }else{ ?>
                  
                 
                      
                      <a href='index.php?c=registration' class="btn btn-inverse"><?php echo  c_base::tr('Registration', $this->language);?></a>
                 
              
              <?php 
              if($_GET['c']=='login'  ){}else{?>
                    <form class="navbar-form pull-right" action="index.php" method="POST">
                          <input class="span2" type="text"  name="login" placeholder="Login">
                          <input class="span2" type="password" name="password" placeholder="Password">
                          <input class="btn btn-inverse" name="log" type="submit" value="<?php echo  c_base::tr('Send', $this->language);?>">
                  </form>
              
                  <?php
            }
              
              }
                 if($this->id_role==1){?>  
                <a href='index.php?c=admin' class="btn btn-inverse"><?php echo  c_base::tr('Admin', $this->language);?></a>
                 <?php }?><!--/.nav-collapse -->
        </div></div>
      </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
          <h1>WEB-<?php echo  c_base::tr('technology', $this->language);?></h1>
        <?=$content?>
       
      </div>


      <hr>

      <footer>
          <p style="text-align: center">&copy; Company 2014</p>
      </footer>

    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
   
    </div>
  </body>
</html>


