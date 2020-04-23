// Viewmodel
function DetectBrowser(a)
{
     if(/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))){
      return true;
     }else{
      return false;
     }
}
// Validation
function MasterPageVM(){
  var self = this;
  
  this.returnError;

  this.e_msg          = ko.observable(null);
  this.isLoading      = ko.observable(false);
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
    }, 500);
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
    }, 500);
  };

  this.resetError = function(){
    self.e_msg(null);
    if( jQuery.isFunction( self.returnError ) ){
      self.returnError();
    }
  };

}

function casino_pages_open(url) {
	window.open(url,'_blank');
  // Window1 = window.open( url, 'rules', 'scrollbars=1,menubar=0,resizable=no,width=' + (screen.width-20) + ',height=' + (screen.height-200) + ',left=0,top=0');
}

function casino_popup_open(url) {
	window.open(url,'_blank');
  // Window1 = window.open( url, 'rules', 'scrollbars=0,menubar=0,resizable=no,width=640,height=460,left=0,top=0');
  // Window1.mainWindow = window;
}

moment.locale($("#lang").val());

$(".numeric").inputmask({ 'alias' : 'decimal',digits: 0, rightAlign: true, 'groupSeparator': '.','autoGroup': true });
$(".decimal").inputmask({ 'alias' : 'decimal',digits: 2, rightAlign: true, 'groupSeparator': '.','autoGroup': true });
