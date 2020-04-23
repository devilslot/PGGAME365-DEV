{extends file='MasterPopup/MasterPopup.tpl'}
{config_load file="CasinoReportTransfer/CasinoReportTransfer.conf" section="{$lang}"}
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
                        <div class="titlereport"><i class="fa fa-angle-double-right fa-2x black" aria-hidden="true"></i> {#transferhistory#}</div>
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
    <!-- <b>{#transfer_provider#} : </b>
    <div class="input-group">
      <select style="padding: 3px;" data-bind="value:provider">
        <option value="">ทั้งหมด</option>
        <option value="RNG Casino">RNG Casino</option>
        <option value="Live Casino">Live Casino</option>
      </select>
    </div> -->
    <button type="button" id="search" class="btn btn-sm btn-darkgoldenrod" data-bind="click:function(){ Find(); }">
      <i class="fa fa-search bigger-110"></i> {#search#}
    </button>
  </div>

  </div>
                        <div class="">
                            <div id="data-table_wrapper" class="dataTables_wrapper no-footer">
                              <div id="data-table_processing" class="dataTables_processing" style="display: none;">กำลังดำเนินการ...</div>
                              <table class="cell-border dataTable datatables-design stripe hover no-footer" id="data-table" role="grid" aria-describedby="data-table_info" width="100%">

      <thead>
        <tr role="row">
          <th class="text-center">{#date#}</th>
          <th class="text-center">{#transfer_provider#}</th>
          <th class="text-center">{#transfertype#}</th>
          <th class="text-right">{#amount#}</th>
        </tr>
      </thead>
      <tbody data-bind="foreach:DataSource">
        <tr class="odd">
          <td class="text-center" data-bind="html:moment(transfer_date).format('DD MMMM YYYY HH:mm:ss')"></td>
          <td class="text-center" data-bind="html:transfer_provider"></td>
          <td class="text-center" data-bind="html:transfer_type=='IN'?'{#deposit#}':'{#withdraw#}'"></td>
          <td class="text-right" data-bind="style:{ 'color':transfer_type=='IN'?'#F00':'#000' },html:transfer_type=='IN'? number_format((transfer_remain*-1),0) : number_format(transfer_remain,0) "></td>
        </tr>
      </tbody>

      <tbody data-bind="visible:!DataSource().length > 0">
        <tr class="odd">
          <td valign="top" colspan="4" class="dataTables_empty">{#nodata#}</td>
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
<script type="text/javascript" src="/ext/view/CasinoReportTransfer/CasinoReportTransferVM.js"></script>
{/block}