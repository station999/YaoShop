<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['login'])) {
    echo 'ログインされていません。<br/>';
    echo '<a href="./staff_login.php">ログイン画面へ</a>';
    exit();
} else {
    echo '<br/>';
    echo '<section class="section__even">';
    echo $_SESSION['staff_name'];
    echo 'さんログイン中<br/>';
    echo '</section>';
}

require_once('../common/functions/sanitize.php');
$post = sanitize($_POST);
$year = $post['year'];
$month = $post['month'];
$day = $post['day'];

$dsn = 'mysql:host=mysql;dbname=ASWD_shop;charset=utf8';
$user = 'ad03';
$password = 'Pw12345@user-A';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $dbh = new PDO($dsn, $user, $password, $options);

    $sql = '
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
    $stmt = $dbh->prepare($sql);
    $data = [$year, $month, $day];
    $stmt->execute($data);
    $resultsSql = $stmt->fetchALL();

    $csvFileName = 'export.csv';
    $csvFilePath = '../tmp/' . $csvFileName;
    $dataHeader = ['注文CODE', '注文DATE', '会員番号', 'お名前', 'MAIL', '郵便番号', '住所', 'TEL', '商品CODE', '商品名', '価格', '数量'];
    $exportHeader = [];

    foreach ($dataHeader as $val) {
        $exportHeader[] = mb_convert_encoding($val, 'SJIS-win', 'auto');
    }

    if (touch($csvFilePath)) {
        $objFile = new SplFileObject($csvFilePath, 'w');
        if ($objFile === FALSE) {
            throw new Exception('ファイルの書き込みに失敗しました。');
        }

        $objFile->fputcsv($exportHeader);

        foreach ($resultsSql as $row) {
            mb_convert_variables('SJIS-win', 'auto', $row);
            $objFile->fputcsv($row);
        }
    } else {
        throw new Exception('ファイルの作成に失敗しました。');
    }

    $dbh = null;

    echo '<br/>';
    echo 'CSVファイルが正常に作成されました。';
    echo '<br/><br/>';

    if (file_exists($csvFilePath)) {
        $fileContents = file_get_contents($csvFilePath);
        echo nl2br($fileContents);
    } else {
        echo 'CSVファイルが存在しません。';
    }

} catch (ErrorException $ex) {
    print('ErrorException: ' . $ex->getMessage());
} catch (PDOException $ex) {
    print('PDOException: ' . $ex->getMessage());
} catch (Exception $ex) {
    print('Exception: ' . $ex->getMessage());
}

?>
<br>
<a href="order_download_csv.php" download>抽出データのダウンロード</a>
<br>
<a href="order_download.php">日付選択へ</a>
<br>
<br>
<a href="../staff_login/staff_top.php">トップメニュー へ</a>
