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
                <h1>スタッフ ログイン画面</h1>
              </div>
            </div>
          </section>
          <section class="section__even">
            <h2>スタッフログイン</h2>
            <form class="form_contact" method="post" action="staff_login_check.php">
              <table class="table_contact-form">
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="code">スタッフ コード</label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_input" type="text" name="code">
                  </td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="pass">パスワード</label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_input" type="text" name="pass">
                  </td>
                </tr>
                <tr class="tr_cttfm">
                  <th class="th_cttfm">
                    <label for="botton">-</label>
                  </th>
                  <td class="td_cttfm">
                    <input class="dta_select" type="submit" value="ログイン">
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