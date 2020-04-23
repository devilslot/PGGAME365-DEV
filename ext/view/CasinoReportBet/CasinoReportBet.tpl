{extends file='MasterPopup/MasterPopup.tpl'}
{config_load file="CasinoReportBet/CasinoReportBet.conf" section="{$lang}"}
<!-- HTML -->
{block name="body"}
<!-- Main Container -->
<table class="tbCntainer">
    <tbody>
      <tr>
        <td colspan="2">
            <div id="divMainDetail">
                <div class="cardcontainer nomarintop">
                    <div class="boxreport">
                        <div id="load-data-playhistory"></div>
                        <div class="titlereport"><i class="fa fa-angle-double-right fa-2x black" aria-hidden="true"></i> {#bethistory#}</div>
                        <div class="row center">
  <div class="form-inline no-margin  ">
  <b>{#startdate#} : </b>
  <div class="input-group date" id="date-picker-from">
    <input type="text" name="startdate" id="startdate" class="" style="width:100%;min-width:20px;max-width:120px;" data-bind="">
  </div>
  <b>{#enddate#} : </b>
  <div class="input-group date" id="date-picker-to">
    <input type="text" name="enddate" id="enddate" class="" style="width:100%;min-width:20px;max-width:120px;">
  </div>
  <button type="button" id="search" class="btn btn-sm btn-darkgoldenrod" data-bind="click:function(){ Find(); }">
    <i class="fa fa-search bigger-110"></i> {#search#}
  </button>
</div>
                        <div class="">
                            <div id="data-table_wrapper" class="dataTables_wrapper no-footer">
                              <div id="data-table_processing" class="dataTables_processing" style="display: none;">กำลังดำเนินการ...</div>
                              <table class="cell-border dataTable datatables-design stripe hover no-footer" id="data-table" role="grid" aria-describedby="data-table_info" width="100%">
                                <thead>
                                  <tr role="row">
                                    <th class="text-center">{#date#}</th>
                                    <th class="text-center">{#gametype#}<br>{#game#}</th>
                                    <th class="text-center">{#status#}<br>{#odds#}</th>
                                    <th class="text-right">{#amount#}</th>
                                    <th class="text-right">{#reward#}</th>
                                    <th class="text-right">{#commission#}</th>
                                    <th class="text-right">{#commissionreceive#}</th>
                                  </tr>
                                </thead>
                                <tbody data-bind="foreach:DataSource">
                                  <tr class="odd">
                                    <td class="text-center" data-bind="html:moment(date).format('DD MMMM YYYY <br> HH:mm:ss')"></td>
                                    <td class="text-center">
                                      <div data-bind="html:game_provider"></div>
                                      <div data-bind="html:'('+game_name+')'"></div>
                                    </td>
                                    <td> 
                                      <div class="text-center" data-bind="  html:(profit<0)?'เสีย':(profit==0)?'เสมอ':'ได้',
                                                                            style:{ color:(profit<0)?'#F00':(profit==0)?'#F50 ':'#00F' }"></div>
                                      <div class="text-center" data-bind="  html:'('+number_format(profit/bet,2)+')', 
                                                                            style:{ color:(profit<0)?'#F00':(profit==0)?'#F50 ':'#00F' }"></div>
                                    </td>  
                                    <td class="text-right" data-bind="html:number_format(bet,0)"></td>
                                    <td class="text-right" data-bind="style:{ 'color':profit<0?'#F00':'#000' }, html:number_format(profit,0)"></td>
                                    <td class="text-right" data-bind="html:number_format(com,2)"></td>
                                    <td class="text-right" data-bind="html:number_format(com_amount,2)"></td>
                                  </tr>
                                </tbody>

                                <tbody data-bind="visible:!DataSource().length > 0">
                                  <tr class="odd">
                                    <td class="text-center" colspan="7" class="dataTables_empty">{#nodata#}</td>
                                  </tr>
                                </tbody>

                                <tbody data-bind="visible:DataSource().length > 0">
                                  <tr class="odd">
                                    <td class="text-right" style="border-top: 1px solid #161616;" colspan="4">รวม</td>
                                    <td class="text-right" style="border-top: 1px solid #161616;" data-bind="style:{ 'color':DataSumary().profit<0?'#F00':'#000' }, html:number_format(DataSumary().profit,0)"></td>
                                    <td class="text-right" style="border-top: 1px solid #161616;" data-bind="html:number_format(DataSumary().com,2)"></td>
                                    <td class="text-right" style="border-top: 1px solid #161616;" data-bind="html:number_format(DataSumary().com_amount,2)"></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<!-- Template Container -->
{/block}
<!-- JS -->
{block name="script"}
<script type="text/javascript" src="/ext/view/CasinoReportBet/CasinoReportBetVM.js"></script>
{/block}