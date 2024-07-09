<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login'])==false)
    {
    echo 'ようこそゲスト様';
    echo '<a href="member_login.php">会員ログイン</a><br/>';
    echo '<br/>';
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
                <h1>ショッピングカート 商品画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
          <?php
              try 
              {
                    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
                    $max=count($cart);
                    $kazu=$_SESSION['kazu'];                    

                    if ($max == 0) {
                      echo 'カートに商品がありません。<br>';
                      echo '<a href="./shop_list.php">商品一覧にもどる</a>';
                      exit();
                    }
                    
                    // DB connect 
                    $dsn='mysql:host=mysql;dbname=ASWD_shop;charset=utf8';
                    $user='ad03';
                    $password='Pw12345@user-A';
                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ];
                    $dbh=new PDO($dsn,$user,$password,$options);
            
                    $pro_name = [];
                    $pro_price = [];
                    $pro_gazou = [];
            
                    foreach($cart as $key => $val)
                    {
                      $sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
                      $stmt=$dbh->prepare($sql);
                      $data[0]=$val;
                      $stmt->execute($data);
            
                      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            
                      $pro_name[]=$rec['name'];
                      $pro_price[]=$rec['price'];
                      if($rec['gazou']=='')
                      {
                        $pro_gazou[]='';
                      }
                      else
                      {
                        $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
                      }
                    }
                    $dbh=null;
            
                }
                catch(Exception $e)
                {
                    echo 'データを取得できませんでした。<br/>';
                    echo 'ただいま障害により大変ご迷惑をおかけしております。';
                    exit();
                }
            
            ?>
            
            
            <h2>カートの中身</h2>
            <br>

            <table clas="tabl_pro">
            <thead class="thead_tblpro">
            <tr class="tr_tblpro__head">
                <th class="th_tblpro">商品画像</th>
                <th class="th_tblpro">商品</th>
            </tr>

            <form method="post" action="kazu_change.php" class="form_contact">

              <?php for($i=0;$i<$max;$i++)  {  ?>
                <tr class="tr_tblpro">
                  <td rowspan="5" class="td_tblpro" style="width:200px">
                    <?php  echo $pro_gazou[$i]; ?>       
                  </td>
                  <td class="td_tblpro">
                    <?php  echo $pro_name[$i]; ?>       
                  </td>
                </tr>
                <tr class="tr_tblpro">
                  <td class="td_tblpro">
                    <?php  echo $pro_price[$i].'円'; ?>
                  </td>
                </tr>
                <tr class="tr_tblpro">
                  <td class="td_tblpro">
                    <input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>">
                    <?php  echo '個 '; ?>
                  </td>
                </tr>
                <tr class="tr_tblpro">
                  <td class="td_tblpro">
                    <?php  echo '小計'.$pro_price[$i]*$kazu[$i].'円'; ?>
                  </td>
                </tr>
                <tr class="tr_tblpro">
                  <td class="td_tblpro">
                    <?php  echo ' 削除'; ?>
                    <input type="checkbox" name="sakujo<?php echo $i; ?>">
                  </td>
                </tr>                  
              <?php  }  ?>
              </table>
                  
              <table class="table_contact-form">
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm">
                    <input type="hidden" name="max" value="<?php echo $max; ?>">
                    <input type="submit" value="変更内容 反映"><br/>
                  </td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm"><a href="./shop_form.php">ご購入手続きへ進む</a></td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm"><a href="./shop_list.php">商品一覧にもどる</a></td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm"><a href="./clear_cart.php">カートを空にする</a></td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_select" type="button" onclick="history.back()" value="戻る">
                  </td>
                </tr>
              </table>
            </form>
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