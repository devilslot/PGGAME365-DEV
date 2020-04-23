<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    set_time_limit(18000);
    // error_reporting(E_ALL);
    
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);

require_once "../ext/private/route/bootstart.php";
require_once "../model/utility.php";
loadfilelang();

use app\casino\Controller\CasinoLobbyController;

/* Session league */ 
$_SESSION["sport_id"] = 0;
$_SESSION['mixparlay']=FALSE;
$_SESSION['casino']=TRUE;

$memberCasino = CasinoLobbyController::Get();

?>
<style type="text/css">
    .maindatamulticontents{        
        margin: 0 5px;
        min-height: 40px;
        overflow: hidden;
    }
    .casino_bg{
      background-image: url('../images/casino/lobby/banner/bg.jpg');
      background-repeat: no-repeat;
      background-position: center top;
      min-height: 500px !important;
      text-align: left;
      padding: 10px;
    }
    #credit_remain,#casino_remain,#desposit{
      padding: 5px;
    }
    .btncasinoheader{
      margin: 5px;
    }
    .prv_list{
      /*text-align: center;*/
    }
    .prv_list .boxcasino{
      display: inline-block;
      margin: 10px;
    }

    .ribb-inverse span{
      background: linear-gradient(#0B6623 0%,#3F704D 100%)
    }

    .casino_banner{
      width:100%;
      margin-bottom:5px;
    }
    
    .casino_banner img{
      width:100%;
    }

    .btn--casino {
      border: none;
      outline: none;
      padding: 10px 16px;
      background-color: #aaa;
      cursor: pointer;
    }

    .btn--casino.active {
      background-color: #666;
      color: white;
    }

    .btn--casino.btn:hover {
      background-color: #444;
      color: white;
    }

</style>
<div class="maindatamulticontents">
    <div class="casino_banner">
      <img src="../images/casino/lobby/banner/pg.jpg?v=15">
      <img src="../images/casino/lobby/banner/button.png?v=15" style="width:210px; margin-top:-170px; cursor:pointer;" onclick="StartFromClass('provider_pg');">
    </div>

    <?php if($memberCasino->casino_live_block != 0 && $memberCasino->casino_sa_block != 0 && $memberCasino->casino_pg_block != 0  && $memberCasino->casino_awc_block != 0 ){ ?>
    <div id="pages_maindata">
      <table class="table_account b" style="width: 100%;">
          <tbody id="member_casino_block" >
              <tr style="line-height: 80px; background-color: #FFF !important;">
                  <td class="text-center" colspan="3">
                    <button class="btn btn--lg"><?=$langStr["casino_soon"]?></button>
                  </td>
              </tr>
          </tbody>              
      </table>
    </div>
    <?php }else{ ?>
      <div id="pages_maindata">
        <div class="btngroupreport text-center" style="margin-top: 10px;margin-bottom: 10px;">
          <a class="btn btn--lg btn--casino" id="desktop_mode" href="javascript:void(0);" style="padding: 15px; width: 403px" onclick="switch_mode(0);">
            <i class="fa fa-desktop" style="font-size: 3em;"></i>
            <p>Desktop</p>
          </a> 
          <a class="btn btn--lg btn--casino" id="mobile_mode" href="javascript:void(0);" style="padding: 15px; width: 403px" onclick="switch_mode(1);">
            <i class="fa fa-mobile" style="font-size: 3em;"></i>
            <p>Tablet or Mobile</p>
          </a>
        </div>
        <?php foreach ($memberCasino->game_lists as $key => $value) { ?>
          <?php if($key==0){ ?>
            <div class="boxtitleaccount bdtop bdbottom">
              <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tbody>
                  <tr> 
                      <td height="30" valign="midlle" class="tdmiddle">
                          <i><div class="iconpersonac iconleft icon-iosperson"></div></i>
                          <div class="bold"><span>คาสิโน สด</span></div>
                      </td> 
                  </tr>
                  </tbody>
              </table>
            </div>
          <?php }else{ ?>
            <div class="boxtitleaccount bdtop bdbottom">
              <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tbody>
                  <tr> 
                      <td height="30" valign="midlle" class="tdmiddle">
                          <i><div class="iconpersonac iconleft icon-iosperson"></div></i>
                          <div class="bold"><span>สล็อต & เกม</span></div>
                      </td> 
                  </tr>
                  </tbody>
              </table>
            </div>
          <?php } ?>

            <?php foreach ($value AS $item => $source){ ?>
              <?php if($item==0){ ?><div class="prv_list"><?php } ?>
              <div class="boxcasino <?=($source->not_mobile==1)?'not_mobile':''?> ">
                <div class="gCasino">
                  <?php if( count($source->game_resume)>0 ){ ?>
                    <div class="ribb ribb-inverse"><span>RESUME</span></div>
                  <?php }else if($source->game_provider == 'pg' || $source->game_provider == 'awc'){ ?>
                    <div class="ribb"><span>New</span></div>
                  <?php }?>
                  <img class="cursor imgcasino_left mCS_img_loaded" src="<?=$source->game_img?>">
                  <div class="overlay"></div>
                  <button class="gCasino_btn lang_play_now provider_<?=$source->game_provider?>"
                          onclick="StartGame(
                            '<?=$source->game_provider?>',
                            '<?=$source->game_code?>',
                            '<?=$source->game_url?>',
                            '<?=$source->game_mobile?>'
                            );
                          "><?=$langStr["casino_start_games"]?></button>
                </div> 
                <div class="tCasino text-center">
                  <?=$source->game_name?>
                </div>
            </div>
            <?php if($item==count($value)-1){ ?></div><?php } ?>
    <?php }}} ?>
</div>
<script type="text/javascript">
  var site_mode = 0;

  if( DetectBrowser(navigator.userAgent||navigator.vendor||window.opera) ){
      switch_mode(1);
  }else{
      switch_mode(0);
  }

  function switch_mode(mode){
    if(mode==0){
      $("#desktop_mode").addClass('active');
      $("#mobile_mode").removeClass('active');
      $(".not_mobile").show();
    }else{
      $("#desktop_mode").removeClass('active');
      $("#mobile_mode").addClass('active');
      $(".not_mobile").hide();
    }
    site_mode = mode;
  }

  function StartFromClass(clss){
    console.log(clss);
    if( $("."+clss).length > 0 ){
      $("."+clss).click();
    }else{
      return false;
    }
  }

  function StartGame(provider,code,url,url_mobile){
    switch(provider){
      case 'live' :
        if(site_mode==0){ code = url; }else{ code = url_mobile; }
        $.ajax({
          dataType : "json",
          url : '/ext/casino_live_lobby.php?request=GetURL',
          data : {code : code, mobile : site_mode},
          success : function(result){
            window.open(result.url,'_blank');
          },
          error : function(data){
            alert(data.responseText);
          }
        });
        break;
      case 'sa' :
        $.ajax({
          dataType : "json",
          url : '/ext/casino_sa_lobby.php?request=GetURL',
          data : {code : code, mobile : site_mode},
          success : function(result){
            window.open(result.GameURL,'_blank');
          },
          error : function(data){
            alert(data.responseText);
          }
        });
        break;
      case 'awc' :
        $.ajax({
          dataType : "json",
          url : '/ext/casino_awc_lobby.php?request=GetURL',
          data : {code : code, mobile : site_mode},
          success : function(result){
            window.open(result.url,'_blank');
          },
          error : function(data){
            alert('System error !!');
            //alert(data.responseText);
          }
        });
        break;
      case 'pg' :
        if(site_mode==0){
          window.open(url,'_blank');
        }else{
          window.open(url_moblie,'_blank');
        }
        break;
      default :
        if(site_mode==0){
          window.open(url,'_blank');
        }else{
          window.open(url_moblie,'_blank');
        }
        break;
    }
  }

  function showError(responseText){
    swal({
      title: "<?=$langStr["casino_cmd_error"]?>", 
      text: responseText,
      type: "error",
      confirmButtonColor: "#2c6554",
    });
  }

  function DetectBrowser(a){
       if(/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))){
        return true;
       }else{
        return false;
       }
  }
</script>