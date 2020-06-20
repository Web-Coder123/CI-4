<!-- <nav class="auth-menu">
    <?= lang('Auth.loggedInWelcome', [session('userData.name')]) ?> &nbsp;|&nbsp;
    <a href="<?= site_url('logout') ?>"><?= lang('Auth.logout') ?> &rarr;</a>
</nav> -->

    <header>
      <nav class="menu-nav">
        <a href="index.php">
          <img  class="logo" src="<?php echo base_url();?>/assets/Pictures/Logo.png" alt="DSMS">
        </a>
        <div class="burger">
          <div class="burger-line1"> </div>
          <div class="burger-line2"> </div>
          <div class="burger-line3"> </div>
        </div>
        <ul class="menu-ul">
          <li class="menu-li"><a class="menu-a" href="#">Data Protection</a>
            <ul class="menu-ul2">
              <li class="menu-li2"><a class="menu-a2" href="#">Records of processing activities (controller)</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Records of processing activities (processor)</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">DPIA</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">DPA and SSA, Transfer of personal data</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Rights of data subjects</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Data breach</a></li>
            </ul>
          </li>
          <li class="menu-li"><a class="menu-a" href="#">Reporting</a>
            <ul class="menu-ul2">
              <li class="menu-li2"><a class="menu-a2" href="dashboard.php">Dashboard</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Reports</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Open tasks</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Changelog</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Wiki</a></li>
            </ul>
          </li>
          <li class="menu-li"><a class="menu-a" href="#">Master Data</a>
            <ul class="menu-ul2">
              <li class="menu-li2"><a class="menu-a2" href="#">Technical and organisational measures</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Categories of personal data</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Categories of data subjects</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Categories of recipients</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Legal basis</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Guarantees</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Purposes</a></li>
            </ul>
          </li>
          <li class="menu-li"><a class="menu-a" href="#">Administration</a>
            <ul class="menu-ul2">
              <li class="menu-li2"><a class="menu-a2" href="#">User and rights management</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Company structure</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Templates</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Data export</a></li>
              <li class="menu-li2"><a class="menu-a2" href="#">Data import</a></li>
              <li class="menu-li2"><a class="menu-a2" href="settings.php">Settings</a></li>
            </ul>
          </li>
          <li class="menu-li"><a class="menu-a" href="<?= site_url('logout') ?>"><?= lang('Auth.logout') ?> &rarr;</a>
          </li>
        </ul>
      </nav>
    </header>