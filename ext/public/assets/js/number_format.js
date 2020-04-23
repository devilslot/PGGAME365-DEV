// number format
/*
 number_format( 1000 , 2); => { 1,000.00 }
 number_format( 1000 , 2 , ' : ') => { 1,000 : 00 }
 number_format( 1000 , 2 , ' : ' , ' ') => { 1 000 : 00 }
 */
function number_format(number, decimals = 2, dec_point = '.', thousands_sep = ',') {
    number = parseFloat(number);
    var StrValue = "";
    if(number < 0){
			number = number*-1;
			StrValue = "-";
		}
    var n = number.toFixed(decimals);
    if( !isNaN(n) ){
      var split = (n.toString()).split('.');
      var mod = parseInt( split[0].length % 3 );
      var diff = parseInt( split[0].length / 3 );
      var StrNumber = (split[0].slice(0,mod)).toString();

      for( x = diff; x > 0; x-- ){
        xxx = split[0].slice( split[0].length - (3*x) , split[0].length - ( 3*(x-1) ) );
        if( StrNumber !== '' && StrNumber !== null ){
          StrNumber += thousands_sep + xxx.toString();
        }else{
          StrNumber += xxx.toString();
        }
      }

      if( decimals > 0 ){
        return StrValue + StrNumber + dec_point + (split[1].slice(0,decimals)).toString();
      }else{
        return StrValue + StrNumber;
      }

    }else{
      return 0;
    }
};

function ToNumber(data){
  if( data != null ){
    if( !( $.isNumeric( data ) ) ){
      data = data.replace(/,/g , '');
      return parseFloat(data);
    }else{
      return parseFloat(data);
    }
  }else{
    return null;
  }
};
