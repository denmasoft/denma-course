function validateNif(value, element) {
  if(/^([0-9]{8})*[a-zA-Z]+$/.test(value)){
    var numero = value.substr(0,value.length-1);
    var let = value.substr(value.length-1,1).toUpperCase();
    numero = numero % 23;
    var letra='TRWAGMYFPDXBNJZSQVHLCKET';
    letra = letra.substring(numero,numero+1);
    if (letra==let) return true;
  }
  return false;
}
function validateNie( value, element ) {
  "use strict";
  value = value.toUpperCase();
  if ( !value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)') ) {
    return false;
  }
  if ( /^[T]{1}/.test( value ) ) {
    return ( value[ 8 ] === /^[T]{1}[A-Z0-9]{8}$/.test( value ) );
  }
  if ( /^[XYZ]{1}/.test( value ) ) {
    return (
      value[ 8 ] === "TRWAGMYFPDXBNJZSQVHLCKE".charAt(
        value.replace( 'X', '0' )
          .replace( 'Y', '1' )
          .replace( 'Z', '2' )
          .substring( 0, 8 ) % 23
      )
    );
  }
  return false;
}
function validateCif( value, element ) {
  "use strict";
  var sum,
    num = [],
    controlDigit;
  value = value.toUpperCase();
  if ( !value.match( '((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)' ) ) {
    return false;
  }
  for ( var i = 0; i < 9; i++ ) {
    num[ i ] = parseInt( value.charAt( i ), 10 );
  }
  sum = num[ 2 ] + num[ 4 ] + num[ 6 ];
  for ( var count = 1; count < 8; count += 2 ) {
    var tmp = ( 2 * num[ count ] ).toString(),
      secondDigit = tmp.charAt( 1 );
    sum += parseInt( tmp.charAt( 0 ), 10 ) + ( secondDigit === '' ? 0 : parseInt( secondDigit, 10 ) );
  }
  if ( /^[ABCDEFGHJNPQRSUVW]{1}/.test( value ) ) {
    sum += '';
    controlDigit = 10 - parseInt( sum.charAt( sum.length - 1 ), 10 );
    value += controlDigit;
    return ( num[ 8 ].toString() === String.fromCharCode( 64 + controlDigit ) || num[ 8 ].toString() === value.charAt( value.length - 1 ) );
  }
  return false;
}
jQuery(document).ready(function($){
  $.validator.addMethod("Dni", function(value, element) {
    if(validateNif(value,element)==true || validateNie(value,element)==true || validateCif(value,element)==true)
    {
      return true;
    }
    return this.optional(element);
  }, 'Error');
  $.validator.addMethod("phone", function(value, element) {
    return this.optional(element) || /^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/.test(value);
  }, 'Error');
  $.validator.addMethod("validDate", function(value, element) {
    return this.optional(element) || moment(value, "DD/MM/YYYY").isValid();
  }, 'Error');
});
