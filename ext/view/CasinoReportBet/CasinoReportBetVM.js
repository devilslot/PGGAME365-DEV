// Viewmodel
function CasinoReportBetVM(){
  var self = this;
  MasterPopupVM.apply(this, arguments);

  self.DataSource           = ko.observableArray();
  self.DataSumary           = ko.observableArray();
  self.DataSource.subscribe(function(e){
    var xx = [];
    for( i=0;i<=e.length;i++ ){
      if(e[i]){
        $.each(e[i],function(index,value){
          if( $.inArray(index,["com","com_amount","profit"]) != -1 ){
            if( !( xx[index] ) ){ xx[index] = 0; }
            xx[index] += ToNumber(value);
          }
        });
      }  
    } self.DataSumary(xx);
  });

  self.GameLists             = ko.observableArray();
  GetEnum('?request=GetGameLists',function(result){
    self.GameLists(result);
  });

  $('#startdate').datetimepicker({
      format: 'DD MMMM YYYY',
      locale: $('#lang').val()=='th'?'th':'en' ,
      defaultDate: moment().subtract( 1 , 'days' ) ,
  });

  $('#enddate').datetimepicker({
      format: 'DD MMMM YYYY',
      locale: $('#lang').val()=='th'?'th':'en' ,
      defaultDate: moment() ,
  });

  self.Find = function(){
    self.ajaxJson({
      url : '?request=Find',
      data : self.CreateSearchCriteria(),
      success : function(result){
        self.DataSource(result);
      },
      error : function(){
        window.close();
      }
    });
  };

  self.CreateSearchCriteria = function(){
    return {
      startdate : $('#startdate').data("DateTimePicker").date().format('YYYY-MM-DD'),
      enddate : $('#enddate').data("DateTimePicker").date().format('YYYY-MM-DD'),
    };
  };

  self.Find();

}

var MyFunction = new CasinoReportBetVM;

ko.applyBindings(MyFunction, document.getElementById('main-data') );