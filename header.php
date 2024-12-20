<div id="header">
  <div class="container">
    <h1 id="logo"><a href="?mod=home" title="Xem Phim">Xem phim</a></h1>
    <div id="search">
      <form method="post" action="?mod=search">
        <input type="text" autocomplete="off" name="kw" placeholder="Tìm phim..." class="keyword">
        <button type="submit" class="submit"></button>
      </form>
    </div>
    <div id="sign">
      <?php if (empty($_SESSION["username"])) { ?>
        <div class="login"><a rel="nofollow" id="log">Đăng nhập</a>
          <div class="login-form" id="login-form" style="display: none;">
            <form method="post" action="login.php">
              <div>
                <input type="text" placeholder="Tên đăng nhập" class="input username" name="username">
              </div>
              <div>
                <input type="password" placeholder="Mật khẩu" class="input password" name="password">
              </div>
              <div>
                <label class="remember">
                  <input type="checkbox" checked="checked" class="checkbox" name="remember"> Remember
                </label>
                <button type="submit" class="submit" name="btn_login">Đăng nhập</button>
              </div>
            </form>
          </div>
        </div>
        <div class="links"><a rel="nofollow" href="register.php">Đăng ký thành viên</a></div>

      <?php } else { ?>
        <form method="post" action="">
          <button id="logout" name="log_out">Đăng xuất</button>
          <a rel="nofollow" href="info_account.php">Thay đổi thông tin</a>
    </div>
    <span type="text" style="margin-top:10px">&nbsp&nbsp Xin chào <?php echo $_SESSION["username"] ?>
      </form>
    <?php } ?>
    <style>
      #logout {
        background-position: 0 -41px;
        background-repeat: no-repeat;
        cursor: pointer;
        display: inline-block;
        font-weight: 700;
        height: 39px;
        line-height: 30px;
        text-align: center;
        width: 97px;
        background: black;
        color: #fff;
        margin-right: 10px;
      }
    </style>

  </div>
</div>
</div>
<script type="text/javascript">
  var x = document.getElementById("login-form");
  $('#log').on('click', function() {
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  });
</script>

<?php
if (isset($_POST["log_out"])) {

  unset($_SESSION['username']);
  session_unset();
  session_destroy();
  // header('Location:index.php');
  echo "<script>alert('Đăng xuất thành công')</script>";
  echo "<script>window.location.href='index.php';</script>";
}
?>
<!-- Van modified ↑↑ -->
<div id="nav">
  <ul class="container menu">
    <li class="home"><a href="index.php" title=""></a></li>
    <?php
    $sql = 'select * from `nav-menu` where id != 2';
    $query = $link->query($sql);
    while ($r = $query->fetch_assoc()) {
    ?>
      <li class=""><a><?php echo $r['name']; ?></a>
        <ul class="sub-menu" style="width: 260px; display: none;">
          <?php
          $handle = $r['handle'];
          $sql = 'select * from `' . $handle . '`';
          $query1 = $link->query($sql);
          while ($r1 = $query1->fetch_assoc()) {
          ?>
            <?php
            if ($handle == 'category' or $handle == 'nation') {
              echo '<li class=""><a href="?mod=list&type=' . $handle . '&id=' . $r1['id'] . '">' . $r1['name'] . '</a></li>';
            } else {
              echo '<li class=""><a href="?mod=list&type=' . $handle . '&year=' . $r1['year'] . '">' . $r1['name'] . '</a></li>';
            }
            ?>
          <?php
          }
          ?>
        </ul>
      </li>
    <?php
    }
    ?>
    <li class=""><a href="ticket.php" title="">Vé của bạn</a></li>
  </ul>
</div>