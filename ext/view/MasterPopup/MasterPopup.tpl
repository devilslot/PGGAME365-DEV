{config_load file="MasterPopup/MasterPopup.conf" section="{$lang}"}
<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1072"> 
    <!-- #CSS Links -->
    {foreach $autocss as $css}
    <link rel="stylesheet" type="text/css" media="screen" href="{$css}">
    <!-- End #CSS -->
    {/foreach}
    <link rel="stylesheet" type="text/css" href="/ext/view/MasterPopup/MasterPopup.css">
  </head>
  <body class="rvfs"> 
    <!-- #JS Links -->
    {foreach $autojs as $js}
    <script src="{$js}"></script>
    <!-- End #JS -->
    {/foreach}
    <div id="pages_maindata">
        
        <div class="E_PAGE" data-bind="visible:e_msg()">
          <div class="E_OVERLAY"></div>

          <div class="E_MESSAGE" data-bind="visible:e_msg()=='loading'">
            <span >{#loadingText#}</span>
          </div>

          <div class="E_MESSAGE" data-bind="visible:e_msg()!='loading'" style="display: none;">
            <i class="fa fa-warning"></i>
            <br>
            <span data-bind="html:e_msg()"></span>
            <br>
            <button class="btn-default" data-bind="click:function(){ resetError(); }">{#close#}</button>
          </div>

        </div>

    </div>

    <!-- xxxxxxxxxx -->
    <div class="mainContainer">
        <div class="container_report">
            <div class="headnavigationreport bgheadreport">
                <table class="tbCntainer bgheadreport">
                    <tbody>
                      <tr>
                        <td width="10">
                          <img src="../images/tiger111/logo200.png">
                        </td>
                        <td align="left" class="tdmiddle" style="padding-left: 10px;">
                            <div class="btngroupreport">
                                <a class="btn btn--df btn--yellow" href="/ext/casino_report_bet.php" title="ประวัติการเดิมพัน"><i class="fa fa-history" aria-hidden="true"></i> ประวัติการเดิมพัน</a>
                                <a class="btn btn--df btn--yellow " href="/ext/casino_report_transfer.php" title="ประวัติการโอนเงิน"><i class="fa fa-money" aria-hidden="true"></i> ประวัติการโอนเงิน </a>
                            </div>
                        </td>
                      </tr>
                    </tbody>
                </table>
                <div style="border-bottom: 1px solid #9c9c9c;margin: 0 -9px; margin-top: 9px"></div>
            </div>


            {block "body"}Default body{/block}
        </div>
    </div>
    <!-- xxxxxxxxxx -->

    <input type="hidden" name="lang" id="lang" value="{$lang}">
    <script type="text/javascript" src="/ext/view/MasterPopup/MasterPopupVM.js"></script>
    {block "script"}Java Script{/block}
  </body>
</html> 