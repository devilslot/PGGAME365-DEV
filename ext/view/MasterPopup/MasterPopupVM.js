// Validation
function MasterPopupVM(){
  var self = this;
  
  this.returnError;

  this.e_msg          = ko.observable('loading');
  this.isLoading      = ko.observable(true);
  this.isLoading.subscribe(function(e){
    if(e){
      self.e_msg('loading');
    }else{
      self.e_msg(null);
    }
  });


  this.UserAuthentication = function(result,callback = null){
    if(result && result.code == 99){
      alert('Sesion is expired.');
      window.close();
    }else{
      if( jQuery.isFunction( callback ) ){
        callback(result);
      }
    }
  };

  this.ajaxProc = function(params){
    self.isLoading(true);
    setTimeout(function(){
      $.ajax({
        url: params.url,
        async: false,
        data: params.data,
        dataType: 'json',
        method: 'POST',
        success: function( result ) {
          // Success
          self.UserAuthentication(result,params.success);
          self.returnError = null;
        },
        error: function( data ) {
          // Error
          self.e_msg( data.responseText );
          self.returnError = params.error;
        }
      });
    },500);
    
  };

  this.ajaxJson = function(params){
    self.isLoading(true);
    setTimeout(function(){
      $.ajax({
        url: params.url,
        async: false,
        data: params.data,
        dataType: 'json',
        method: 'POST',
        success: function( result ) {
          // Success
          self.UserAuthentication(result,params.success);
          setTimeout(function(){
            self.returnError = null;
            self.isLoading(false);
          }, 1000);
        },
        error: function( data ) {
          // Error
          self.e_msg( data.responseText );
          self.returnError = params.error;
        }
      });
    },500);
  };

  this.resetError = function(){
    self.e_msg(null);
    if( jQuery.isFunction( self.returnError ) ){
      self.returnError();
    }
  };

  $(window).load(function(){
    setTimeout(function(){
      self.isLoading(false);
    }, 1000);
  });
}

var mainWindow;
function casino_pages_open(url) {
  if( mainWindow != undefined ){
    mainWindow.get_credit();
  }
  window.location = url;
  window.resizeTo( (screen.width-20) , (screen.height-200) );
}

function casino_popup_open(url) {
  if( mainWindow != undefined ){
    mainWindow.get_credit();
  }
  window.location = url;
  window.resizeTo(640, 460);
}


moment.locale($("#lang").val());
$(".E_MESSAGE").show();

$(".numeric").inputmask({ 'alias' : 'decimal',digits: 0, rightAlign: true, 'groupSeparator': '.','autoGroup': true });
$(".decimal").inputmask({ 'alias' : 'decimal',digits: 2, rightAlign: true, 'groupSeparator': '.','autoGroup': true });

