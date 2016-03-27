<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <!-- Navbar collapse on mobile -->
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" type="button" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <?php echo $settings->getSetting('site_title'); ?>
      </a>
    </div>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php
            if ($login->loggedIn) {
                $echo = <<<HTML
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" role="button" area-haspopup="true" area-expanded="false">
            <!-- LOGIN_USERNAME --> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="/settings">Settings</a></li>
            <li><a href="/view">View Tickets</a></li>
            <li><a href="#" id="logoutButton">Logout</a></li>
          </ul>
        </li>
HTML;
                $echo = str_replace(
                    '<!-- LOGIN_USERNAME -->',
                    $login->accountInfo['email'],
                    $echo
                );

                echo $echo;
            } else {
                echo '<li><a href="/login">Login</a></li>';
            }
        ?>
      </ul>
    </div>
  </div>
</nav>
