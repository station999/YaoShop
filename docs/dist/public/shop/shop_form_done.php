<?php
    session_start();
    session_regenerate_id(true);
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
                <h1>お客様 ご注文確定画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
                try 
                {
            
            
                    require_once('../common/functions/sanitize.php');
            
                    $post=sanitize($_POST);
            
                    $onamae=$post['onamae'];
                    $email=$post['email'];
                    $postal=$post['postal'];
                    $address=$post['address'];
                    $tel=$post['tel'];
            
                    echo $onamae.'様';
                    echo '<br/>';
                    echo 'ご注文ありがとうございました。';
                    echo '<br/>';
                    echo $email.'にメールをお送り致しましたのでご確認ください。';
                    echo '<br/>';
                    echo '商品は以下の住所へ発送させていただきます。';
                    echo '<br/>';
                    echo $postal;
                    echo '<br/>';
                    echo $address;
                    echo '<br/>';
                    echo $tel;
                    echo '<br/>';
            
            
                    $honbun='';
                    $honbun.=$onamae."様\n\nこの度はご注文ありがとうございました。\n";
                    $honbun.="\n";
                    $honbun.="ご注文商品\n";
                    $honbun.="------------------------------------------------------\n";
            
                    $cart=$_SESSION['cart'];
                    $kazu=$_SESSION['kazu'];
                    $max=count($cart);
            
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
            
                    for($i=0; $i<$max; $i++)
                    {
                        $sql='SELECT name,price FROM mst_product WHERE code=?';
                        $stmt=$dbh->prepare($sql);
                        $data[0]=$cart[$i];
                        $stmt->execute($data);
            
                        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            
                        $name=$rec['name'];
                        $price=$rec['price'];
                        $kakaku[]=$price;
                        $suryo=$kazu[$i];
                        $shokei=$price*$suryo;
            
                        $honbun.='&emsp;&bull;';
                        $honbun.=$name.'&nbsp;';
                        $honbun.=$price.'円 × ';
                        $honbun.=$suryo.'個＝';
                        $honbun.=$shokei."円\n";
            
                    } 
            
                    $sql='LOCK TABLES dat_sales WRITE, dat_sales_product WRITE';
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute();

                    $sql='INSERT INTO dat_sales(code_member,name,email,postal,address,tel)VALUES(?,?,?,?,?,?)';
                    $stmt=$dbh->prepare($sql);
                    $data=array();
                    $data[]=0;
                    $data[]=$onamae;
                    $data[]=$email;
                    $data[]=$postal;
                    $data[]=$address;
                    $data[]=$tel;
                    $stmt->execute($data);
            
                    $sql='SELECT LAST_INSERT_ID()';
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute();
                    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
                    $lastcode=$rec['LAST_INSERT_ID()'];
            
                    for($i=0; $i<$max; $i++)
                    {
                        $sql='INSERT INTO dat_sales_product (code_sales,code_product,price,quantity)VALUES(?,?,?,?)';
                        $stmt=$dbh->prepare($sql);
                        $data=array();
                        $data[]=$lastcode;
                        $data[]=$cart[$i];
                        $data[]=$kakaku[$i];
                        $data[]=$kazu[$i];
                        $stmt->execute($data);
            
                    }
                    
                    $sql='UNLOCK TABLES';
                    $stmt=$dbh->prepare($sql);
                    $stmt->execute();

                    $dbh=null;
                    
                    $honbun.="送料は無料です。\n";
                    $honbun.="------------------------------------------------------\n";
                    $honbun.="\n";
                    $honbun.="代金は以下の口座にお振込み下さい。\n";
                    $honbun.="XXX銀行 &emsp; XXX支店 &emsp; 普通口座1234567\n";
                    $honbun.="入金確認が取れ次第、梱包、発送させていただきます。\n";
                    $honbun.="\n";
                    $honbun.="□□□□□□□□□□□□□□□□□□□□□□□□□□□□\n";
                    $honbun.="　～安心野菜の八百八～\n";
                    $honbun.="　〒123-4567\n";
                    $honbun.="　東京都中央区とうきょう\n";
                    $honbun.="　Tel：090-090-7654\n";
                    $honbun.="　Mail：info@sample.com\n";
                    $honbun.="□□□□□□□□□□□□□□□□□□□□□□□□□□□□\n";
            
            
                    echo '<br/>';
                    echo nl2br($honbun);
            
            
                    $title='ご注文ありがとうございます。';
                    $header='FROM:info@sample.com';
                    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
                    mb_language('Japanese');
                    mb_internal_encoding('UTF-8');
                    mb_send_mail($email,$title,$honbun,$header);
            
                    $title='お客様からご注文がありました。';
                    $header='FROM:'.$email;
                    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
                    mb_language('Japanese');
                    mb_internal_encoding('UTF-8');
                    mb_send_mail('info@sample.com',$title,$honbun,$header);
            
                }
                catch(Exception $e)
                {
                    echo $onamae;
                    echo '様の注文を登録できませんでした。<br/>';
                    echo 'ただいま障害により大変ご迷惑をおかけしております。';
                    exit();
                }
            
            ?>

                        
            <table class="table_contact-form">
              <tr class="tr_cttfm">
                <th class="th_cttfm">
                  <label for="botton">-</label>
                </th>
                <td class="td_cttfm"><a href="./shop_list.php">商品画面にもどる</a></td>
              </tr>
            </table>

            
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