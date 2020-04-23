{config_load file="MasterPage/MasterPage.conf" section="{$lang}"}
<script type="text/javascript">
	Settings = {
      lang: '{$lang}',
      error_check_minprice: '',
      error_check_maxprice: '',
      error_check_nullprice: '',
      lastcall: '',
      lift: '',
      line_type: '',
      w_control: ''
    }

    $("#shownodata").remove();
   // $(".boxloading").remove();
</script>
<!-- #CSS Links -->
{foreach $autocss as $css}
<link rel="stylesheet" type="text/css" media="screen" href="{$css}">
<!-- End #CSS -->
{/foreach}
<link rel="stylesheet" type="text/css" href="/ext/view/MasterPage/MasterPage.css">
<!-- #JS Links -->
{foreach $autojs as $js}
<script src="{$js}"></script>
<!-- End #JS -->
{/foreach}
<div id="pages_maindata" style="width: 845px;">

  <div class="text-center bg-dark"  id="main-data">
    
    <div class="E_PAGE" data-bind="visible:e_msg()">
      <div class="E_OVERLAY"></div>

      <div class="E_MESSAGE" data-bind="visible:e_msg()=='loading'">
        <span >{#loadingText#}</span>
      </div>

      <div class="E_MESSAGE" data-bind="visible:e_msg()!='loading'">
        <i class="fa fa-warning"></i>
        <br>
        <span data-bind="html:e_msg()"></span>
        <br>
        <button class="btn-default" data-bind="click:function(){ resetError(); }">{#close#}</button>
      </div>

    </div>

    {block "body"}Default body{/block}
  </div>

</div>
<input type="hidden" name="lang" id="lang" value="{$lang}">
<script type="text/javascript" src="/ext/view/MasterPage/MasterPageVM.js"></script>
{block "script"}Java Script{/block}