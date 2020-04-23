// Viewmodel
function CasinoReportTransferVM(){
  var self = this;
  MasterPopupVM.apply(this, arguments);

  self.DataSource            = ko.observableArray();
  self.provider              = ko.observable();

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
      provider : self.provider(),
    };
  };

  self.Find();

}

var MyFunction = new CasinoReportTransferVM;

ko.applyBindings(MyFunction, document.getElementById('main-data') );