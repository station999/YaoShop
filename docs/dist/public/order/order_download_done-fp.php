<?php
    session_start();
?>
<?php
    session_regenerate_id(true);
    if(isset($_SESSION['login'])==false)
    {
    echo 'ログインされていません。<br/>';
    echo '<a href="./staff_login.php">ログイン画面へ</a>';
    exit();
    }
    else
    {
    echo '<br/>';
    echo '<section class="section__even">';
    echo $_SESSION['staff_name'];
    echo 'さんログイン中<br/>';
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
      <header class="stHeader">
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
                <h1>CSV 画面 </h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <?php
              //  ///////////////////////////
              require_once('../common/functions/sanitize.php');            
              $post=sanitize($_POST);
              $year=$post['year'];
              $month=$post['month'];
              $day=$post['day'];

              //  ///////////////////////////
              $dsn='mysql:host=mysql;dbname=ASWD_shop;charset=utf8';
              $user='ad03';
              $password='Pw12345@user-A';
              $options = [
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  PDO::ATTR_EMULATE_PREPARES => false,
              ];
              try 
              {
                $dbh=new PDO($dsn,$user,$password,$options);
              }
              catch(Exception $e)
              {
                echo 'リストを表示出来ませんでした。<br/>';
                echo 'ただいま障害により大変ご迷惑をおかけしております。';
                exit();
              }

              //  ///////////////////////////
              $sql='
                  SELECT
                      dat_sales.code,
                      dat_sales.date,
                      dat_sales.code_member,
                      dat_sales.name AS dat_sales_name,
                      dat_sales.email,
                      dat_sales.postal,
                      dat_sales.address,
                      dat_sales.tel,
                      dat_sales_product.code_product,
                      mst_product.name AS mst_product_name,
                      dat_sales_product.price,
                      dat_sales_product.quantity
                  FROM 
                      dat_sales
                  INNER JOIN 
                      dat_sales_product ON dat_sales.code = dat_sales_product.code_sales
                  INNER JOIN 
                      mst_product ON dat_sales_product.code_product = mst_product.code
                  WHERE 
                      substr(dat_sales.date,1,4)=?
                      AND substr(dat_sales.date,6,2)=?
                      AND substr(dat_sales.date,9,2)=?
              ';
              $stmt=$dbh->prepare($sql);
              $data = [$year, $month, $day];
              $stmt->execute($data);
              $resultsSql=$stmt->fetchALL();
              
              //  ///////////////////////////
              $csvFileName='export.csv';
              $csvFilePath='../tmp/' . $csvFileName;
              $csv=fopen($csvFilePath,'w');
              if($csv===FALSE){
                throw new Exception('ファイルの書き込みに失敗しました。');
              }

              $dataHeader=['注文CODE','注文DATE','会員番号','お名前','MAIL','郵便番号','住所','TEL','商品CODE','商品名','価格','数量'];
              $exportHeader =[];
              foreach($dataHeader as $val){
                $exportHeader[]=mb_convert_encoding($val,'SJIS-win','auto');
              }

              // fputcsv($csv,$exportHeader);

              foreach($resultsSql as $row){
                mb_convert_variables('SJIS-win','auto',$row);
                fputcsv($csv,$row);
              }

              fclose($csv);

              $dbh=null;

              echo '<br/>';
              echo 'CSVファイルが正常に作成されました。';
              echo '<br/>';
              echo '<br/>';
              echo '<p>サンプルデータ</p>';
              if (file_exists($csvFilePath)) {
                $fileContents=file_get_contents($csvFilePath);
                // $fileContents=mb_convert_variables('UTF-8','SJIS-win',$fileContents);
                echo nl2br($fileContents);
              } 
              else{
                echo 'CSVファイルが存在しません。';
              }

            ?>
            <br>
            <a href="order_download_csv.php"  download>抽出データのダウンロード</a>
            <br>
            <a href="order_download.php">日付選択へ</a>
            <br>
            <br>
            <a href="../staff_login/staff_top.php">トップメニュー へ</a>
            <br>
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