<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login'])==false)
    {
    echo 'ようこそゲスト様';
    echo '<a href="member_login.php">会員ログイン</a><br/>';
    echo '<br/>';
    //- exit();
    }
    else
    {
    echo '<br/>';
    echo '<section class="section__even">';
    echo 'ようこそ';
    echo $_SESSION['member_name'];
    echo '様<br/>';
    echo '<a href="member_logout.php">ログアウト</a><br/>';
    echo '</section">';
    }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サイト名</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap">  
    <link rel="stylesheet" href="./../../../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
  </head>
  <body>
    <div class="site ly_site">
      <header class="st_header">
        <div class="ly_hdr_inner">
          <div class="el_top-logo"><a href="#{siteDomain}"> <img class="img_plncd frm_pln_img" src="#{workDirPath}assetsimagescommonlogologo.png" style="height: 50px;" alt="Home Logo"></a></div>
          <input class="hmbg-btn" type="checkbox" id="hmbg-btn">
          <label class="hmbg-icon" for="hmbg-btn"><span class="hmbg-icon_parts"></span></label>
          <nav class="nav_global el_hdr_nav">
            <ul class="ul_glbnv">
              <li class="li_glbnv"> <a href="#{siteDomain}">Home</a></li>
              <li class="li_glbnv"> <a href="###">情報</a></li>
              <li class="li_glbnv"> <a href="###">商品</a></li>
              <li class="li_glbnv"> <a href="###">注文</a></li>
              <li class="li_glbnv"> <a href="###">登録</a></li>
              <li class="li_glbnv"> <a href="#{siteDomain}/staff">スタッフ</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="st_container lyst_main">
        <main>
          <section class="section__odd">
            <div class="cpnt_title__border">
              <div class="inner_ttlbd__hrzn">
                <h1>ショッピングカート in画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
                try 
                {
                  $pro_code=$_GET['procode'];
                  
                  //カートがセッションに存在するか確認
                  if(isset($_SESSION['cart'])==true)
                  {
                      $cart=$_SESSION['cart'];
                      $kazu=$_SESSION['kazu'];
                  }
                  //存在しない場合は空の配列 [] を初期化
                  else 
                  {
                    $cart = [];
                  }

                  // 商品がカートにすでに存在するか確認
                  if (!in_array($pro_code, $cart)) 
                  {
                    // 商品をカートに追加
                    $cart[] = $pro_code;
                    $kazu[] = 1;
                    $_SESSION['cart'] = $cart;
                    $_SESSION['kazu'] = $kazu;

                    echo 'カートに追加しました。<br/>';
                  }
                  else
                  {
                    echo 'その商品はすでにカートに入っています。<br/>';
                  }
                  
                }
                catch(Exception $e)
                {
                    echo 'データを取得できませんでした。<br/>';
                    echo 'ただいま障害により大変ご迷惑をおかけしております。';
                    exit();
                }
            
            ?>

            <?php
              if (isset($_GET['success']) && $_GET['success'] == 1) {
                  echo '<p>カートに追加しました。</p><br><a href="shop_list.php">商品一覧にもどる</a>';
              }
            ?>
            
            <!-- <p>カートに追加しました。</p> -->
            <br>
            <a href="shop_list.php">商品一覧にもどる</a>
            <br>
            <a href="shop_cartlook.php">カートを見る</a>
          </section>
        </main>
      </div>
      <footer class="st_footer lyst_ftr">
        <hr class="hr_footer-line"><small class="small_copy">&copy;2000 AWD Shop</small>
        <hr class="hr_footer-line">
      </footer>
      
      <script src="https://example.com/assets/js/base.js" charset="utf-8"></script>
      <script src="https://example.com/assets/js/cnpt_table.js" charset="utf-8"></script>
      
    </div>
  </body>
</html>