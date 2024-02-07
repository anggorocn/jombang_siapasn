function CekNumber(id)
	{
		var txt = document.getElementById(id);
		var a = txt.value;//.charAt(txt.value.length-1);
		
		var tmpA;
		var jmlKoma = 0;	
		//while(isNaN(a))
		{
			tmpA = '';
			for(var i=0;i<a.length;i++)
			{	
				if((a.charAt(i)>='0' && a.charAt(i)<='9')||(a.charAt(i)==',' ))
				{					
					tmpA = tmpA+a.charAt(i);
				}
			}
			a = tmpA;
			txt.value = a;
		}
	}
 
function CekDouble(id)
	{
		var txt = document.getElementById(id);
		var a = txt.value;//.charAt(txt.value.length-1);
		
		var tmpA;
		var jmlKoma = 0;	
		//while(isNaN(a))
		{
			tmpA = '';
			for(var i=0;i<a.length;i++)
			{	
				if((a.charAt(i)>='0' && a.charAt(i)<='9') || (i>0 && a.charAt(i)=='.'))
				{					
					tmpA = tmpA+a.charAt(i);
				}
			}
			a = tmpA;
			txt.value = a;
		}
	}
	
function ReplaceString(oldS,newS,fullS) 
{
	 
// Replaces oldS with newS in the string fullS   
	for (var i=0; i<fullS.length; i++) 
	{      
		if (fullS.substring(i,i+oldS.length) == oldS) 
		{         
			fullS = fullS.substring(0,i)+newS+fullS.substring(i+oldS.length,fullS.length)      
		}   
	}   
	return fullS
}

/*function FormatCurrency(num) 
{
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	{
		num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
	}
	if(cents != "00")
		return (((sign)?'':'-') +  num + ',' + cents);
	else
		return (((sign)?'':'-') +  num);
}
*/
function FormatCurrency(num) 
{
	num = num.toString().replace(/\$|\,/g,'');
	
	if(isNaN(num))
		num = "0";
		
	sign = (num == (num = Math.abs(num)));
	
	num_str = num.toString();
	cents = 0;
	
	if(num_str.indexOf(".")>=0)
	{
		num_str = num.toString();
		angka = num_str.split(".");
		cents = angka[1];
	}
	
	num = Math.floor(num).toString();
	
		
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	{
		num = num.substring(0,num.length-(4*i+3))+'.'+num.substring(num.length-(4*i+3));
	}
	
	if(cents != "00")
		return (((sign)?'':'-') +  num + ',' + cents);
	else
		return (((sign)?'':'-') +  num);
}
    
function CekJam(id)
{
        CekNumber(id);
        var txt = document.getElementById(id);
        if (txt.value == "")
            txt.value = "00"; 
		var a = parseFloat(txt.value);
        if (a > 23)
        {
            txt.value = '00';
        }
        else
        {
            if (a<10)
                txt.value = '0' + a;
            else
                txt.value = a;    
        }
}

function CekMenit(id)
{
        CekNumber(id);
        var txt = document.getElementById(id);
        if (txt.value == "")
            txt.value = "00"; 
		var a = parseFloat(txt.value);
        if (a > 59)
        {
            txt.value = '00';
        }
        else
        {
            if (a<10)
                txt.value = '0' + a;
            else
                txt.value = a;    
        }
}

function FormatUang(id)
{
        CekNumber(id);
        var txt = document.getElementById(id);
		var a = parseFloat(txt.value);
        var nilai = FormatCurrency(a);
        txt.value = nilai;    

}

function FormatUang1(id)
{
        CekNumber(id);
        var txt = document.getElementById(id);
		var num = txt.value;
		num = num.toString().replace(",",".");

		var aPosition = num.indexOf(".");
		if(((aPosition+1)<num.length)||(aPosition<0))
		{
			var a = parseFloat(num);
			var nilai = FormatCurrencyBaru(a);
			txt.value = nilai;    
		}
}

function FormatAngka(id)
{
		//alert(id+':adasd');
        var txt = document.getElementById(id);
		var a = txt.value;
        var nilai = ReplaceString('.','',a);
        txt.value = nilai;    
}

function FormatAngkaNumber(value)
{

		var a = value;
        var nilai = ReplaceString('.','',a);
        var nilai = ReplaceString(',','.',nilai);
        return nilai;    
}

function getWaktuSisa(startTime, endTime, diff)
{
	//var TargetDate = "03/31/2009 5:30:00 PM";//Format waktu yang dipakai
	//var TargetDate = "04/14/2009 14:50:54";//Format waktu yang dipakai
    //startTime, dipakai jika anda menentukan waktu awal sendiri
	//End time: waktu akhir
	//diff = 	perbedaan waktu server dan waktu client. javascript bekerja menggunakan waktu client.
	//			sehingga perlu dihitung selisihnya.
	var sisa = 0;
	var dstart = new Date(startTime);//Di sini tidak digunakan
	var dthen = new Date(endTime);
	var dnow = new Date();
	var diff = Math.floor((dthen-dnow + diff)/1000);
	if (diff > 0){ 
		var hrsDiff = Math.floor(diff/60/60); 
		diff -= hrsDiff*60*60;
		var minsDiff = Math.floor(diff/60);
		diff -= minsDiff*60;
		var secsDiff = diff;  
		if (hrsDiff <10)
		{
			hrsDiff = '0'+ hrsDiff;
		}
		if (minsDiff <10)
		{
			minsDiff = '0' + minsDiff;
		} 
		if (secsDiff <10)
		{
			secsDiff = '0'+ secsDiff;
		}
		sisa = hrsDiff+' : '+minsDiff+' : '+secsDiff;
		//Format Return : HH : MM : SS
	}
	return sisa;
}

function validateEmpty(value, Name) {
    var error = "";
    if (value.length == 0) {
        error = Name + " belum di isi\n";
    } 
    return error;  
}
function validateRadio(radio, Name) 
{
     var error = "";
     var myOption = -1;
    for (i=radio.length-1; i > -1; i--) {
        if (radio[i].checked) {
            myOption = i; i = -1;
        }
    }
        if (myOption == -1) 
            error = Name + " belum di pilih\n";
     return error;     
}
function CekEnter(evt)
{
    evt = (evt) ? evt : event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	//If Press Enter the begin Search
	if(charCode==13){
        return true;
    }
    return false;
}

function hidediv(elementID) {

	document.getElementById(elementID).style.display = 'none';

	document.getElementById(elementID).setAttribute('display', 'none');

}

function showdiv(elementID) {

	document.getElementById(elementID).style.display = 'block';

	document.getElementById(elementID).setAttribute('display', 'block');
}

function CekNumberGrid(a)
	{
		isAngka = '1';
		for(var i=0;i<a.length;i++)
		{	
			if((a.charAt(i)>='0' && a.charAt(i)<='9'))
			{					
				isAngka = isAngka;
			}
			else
			{
				isAngka = '0';
			}
		}
			return isAngka;		
	}

function format_npwp(event, nama_text) {
	var arr_regex = new Array('\\d','\\d','[.]','\\d','\\d','\\d','[.]','\\d','\\d','\\d','[.]','\\d','[-]','\\d','\\d','\\d','[.]','\\d','\\d','\\d');
	var current_value = document.getElementById(nama_text).value;            
	var len = document.getElementById(nama_text).value.length;       
	var result_value = '';
	var current_regex = '';
	var i=0;
	for (i=0; i<len; i++) {
	  current_regex += arr_regex[i];
	}
			
	if (!current_value.match(current_regex)) {
	  if (!isNaN(current_value.substring(len-1, len))) {
		if(arr_regex[len-1] == '[.]')
		  current_value = current_value.substring(0,len-1) + '.' + current_value.substring(len-1, len);                  
		else if(arr_regex[len-1] == '[-]')
		  current_value = current_value.substring(0,len-1) + '-' + current_value.substring(len-1, len);                  
		  document.getElementById(nama_text).value = current_value;      
	  } else {        
		current_value = current_value.substring(0,len-1);                  
		document.getElementById(nama_text).value = current_value;      
	  }
	}    
}
								  
function format_menit(event, nama_text) {
  	//var arr_regex = new Array('\\d','\\d','[-]','\\d','\\d','[-]','\\d','\\d','\\d','\\d');
    var arr_regex = new Array('\\d','\\d','[:]','\\d','\\d');
    var current_value = document.getElementById(nama_text).value;            
    var len = document.getElementById(nama_text).value.length;       
    var result_value = '';
    //alert(current_value);
    var current_regex = '';
    var i=0;
    for (i=0; i<len; i++) {
      current_regex += arr_regex[i];
      //alert(arr_regex[i]);
    }
            
    if (!current_value.match(current_regex)) {
        //alert(arr_regex[len-1]+'---');
      if (!isNaN(current_value.substring(len-1, len))) {
        if(arr_regex[len-1] == '[:]')
          current_value = current_value.substring(0,len-1) + ':' + current_value.substring(len-1, len);
        /* else if(arr_regex[len-1] == '[-]')
          current_value = current_value.substring(0,len-1) + '-' + current_value.substring(len-1, len);*/
          document.getElementById(nama_text).value = current_value;
      } else {        
        current_value = current_value.substring(0,len-1);                  
        document.getElementById(nama_text).value = current_value;      
      }
    }    
  }

function format_date(event, nama_text) {        
    var arr_regex = new Array('\\d','\\d','[-]','\\d','\\d','[-]','\\d','\\d','\\d','\\d');
    var current_value = document.getElementById(nama_text).value;            
    var len = document.getElementById(nama_text).value.length;       
    var result_value = '';
    //alert(current_value);
    var current_regex = '';
    var i=0;
    for (i=0; i<len; i++) {
      current_regex += arr_regex[i];
      //alert(arr_regex[i]);
    }
    
    //alert(current_value.substring(0,len-1)+'---'+current_value.substring(len, len));
    
    if (!current_value.match(current_regex)) {
        //alert(arr_regex[len-1]+'---');
      if (!isNaN(current_value.substring(len-1, len))) {
        /*if(arr_regex[len-1] == '[.]')
          current_value = current_value.substring(0,len-1) + '.' + current_value.substring(len-1, len);                  
        else */if(arr_regex[len-1] == '[-]')
          current_value = current_value.substring(0,len-1) + '-' + current_value.substring(len-1, len);
          document.getElementById(nama_text).value = current_value;      
      } else {        
        current_value = current_value.substring(0,len-1);                  
        document.getElementById(nama_text).value = current_value;      
      }
    }    
  }

function hapus_data(linkdata)
{
	$.messager.confirm('Confirm','Apakah anda yakin ingin menghapus data terpilih ? Perlu anda ingat bahwa data yang anda hapus akan hilang secara permanen.',function(r){
		if (r){
			document.location.href = linkdata;
		}
	});
	
	
}  

function get_day_between(date1, date2)
{
	var minutes = 1000*60;
	var hours = minutes*60;
	var days = hours*24;
	
	var foo_date1 = getDateFromFormat(date1, "d-M-y");
	var foo_date2 = getDateFromFormat(date2, "d-M-y");
	
	var diff_date = Math.round((foo_date2 - foo_date1)/days);
	return (diff_date + 1);
}


// ===================================================================
// Author: Matt Kruse <matt@mattkruse.com>
// WWW: http://www.mattkruse.com/
//
// NOTICE: You may use this code for any purpose, commercial or
// private, without any further permission from the author. You may
// remove this notice from your final code if you wish, however it is
// appreciated by the author if at least my web site address is kept.
//
// You may *NOT* re-distribute this code in any way except through its
// use. That means, you can include it in your product, or your web
// site, or any other form where the code is actually being used. You
// may not put the plain javascript up on your site for download or
// include it in your javascript libraries for download. 
// If you wish to share this code with others, please just point them
// to the URL instead.
// Please DO NOT link directly to my .js files from your site. Copy
// the files to your server and use them there. Thank you.
// ===================================================================

// HISTORY
// ------------------------------------------------------------------
// May 17, 2003: Fixed bug in parseDate() for dates <1970
// March 11, 2003: Added parseDate() function
// March 11, 2003: Added "NNN" formatting option. Doesn't match up
//                 perfectly with SimpleDateFormat formats, but 
//                 backwards-compatability was required.

// ------------------------------------------------------------------
// These functions use the same 'format' strings as the 
// java.text.SimpleDateFormat class, with minor exceptions.
// The format string consists of the following abbreviations:
// 
// Field        | Full Form          | Short Form
// -------------+--------------------+-----------------------
// Year         | yyyy (4 digits)    | yy (2 digits), y (2 or 4 digits)
// Month        | MMM (name or abbr.)| MM (2 digits), M (1 or 2 digits)
//              | NNN (abbr.)        |
// Day of Month | dd (2 digits)      | d (1 or 2 digits)
// Day of Week  | EE (name)          | E (abbr)
// Hour (1-12)  | hh (2 digits)      | h (1 or 2 digits)
// Hour (0-23)  | HH (2 digits)      | H (1 or 2 digits)
// Hour (0-11)  | KK (2 digits)      | K (1 or 2 digits)
// Hour (1-24)  | kk (2 digits)      | k (1 or 2 digits)
// Minute       | mm (2 digits)      | m (1 or 2 digits)
// Second       | ss (2 digits)      | s (1 or 2 digits)
// AM/PM        | a                  |
//
// NOTE THE DIFFERENCE BETWEEN MM and mm! Month=MM, not mm!
// Examples:
//  "MMM d, y" matches: January 01, 2000
//                      Dec 1, 1900
//                      Nov 20, 00
//  "M/d/yy"   matches: 01/20/00
//                      9/2/00
//  "MMM dd, yyyy hh:mm:ssa" matches: "January 01, 2000 12:30:45AM"
// ------------------------------------------------------------------

var MONTH_NAMES=new Array('January','February','March','April','May','June','July','August','September','October','November','December','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var DAY_NAMES=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sun','Mon','Tue','Wed','Thu','Fri','Sat');
function LZ(x) {return(x<0||x>9?"":"0")+x}

// ------------------------------------------------------------------
// isDate ( date_string, format_string )
// Returns true if date string matches format of format string and
// is a valid date. Else returns false.
// It is recommended that you trim whitespace around the value before
// passing it to this function, as whitespace is NOT ignored!
// ------------------------------------------------------------------
function isDate(val,format) {
	var date=getDateFromFormat(val,format);
	if (date==0) { return false; }
	return true;
	}

// -------------------------------------------------------------------
// compareDates(date1,date1format,date2,date2format)
//   Compare two date strings to see which is greater.
//   Returns:
//   1 if date1 is greater than date2
//   0 if date2 is greater than date1 of if they are the same
//  -1 if either of the dates is in an invalid format
// -------------------------------------------------------------------
function compareDates(date1,dateformat1,date2,dateformat2) {
	var d1=getDateFromFormat(date1,dateformat1);
	var d2=getDateFromFormat(date2,dateformat2);
	if (d1==0 || d2==0) {
		return -1;
		}
	else if (d1 > d2) {
		return 1;
		}
	return 0;
	}

// ------------------------------------------------------------------
// formatDate (date_object, format)
// Returns a date in the output format specified.
// The format string uses the same abbreviations as in getDateFromFormat()
// ------------------------------------------------------------------
function formatDate(date,format) {
	format=format+"";
	var result="";
	var i_format=0;
	var c="";
	var token="";
	var y=date.getYear()+"";
	var M=date.getMonth()+1;
	var d=date.getDate();
	var E=date.getDay();
	var H=date.getHours();
	var m=date.getMinutes();
	var s=date.getSeconds();
	var yyyy,yy,MMM,MM,dd,hh,h,mm,ss,ampm,HH,H,KK,K,kk,k;
	// Convert real date parts into formatted versions
	var value=new Object();
	if (y.length < 4) {y=""+(y-0+1900);}
	value["y"]=""+y;
	value["yyyy"]=y;
	value["yy"]=y.substring(2,4);
	value["M"]=M;
	value["MM"]=LZ(M);
	value["MMM"]=MONTH_NAMES[M-1];
	value["NNN"]=MONTH_NAMES[M+11];
	value["d"]=d;
	value["dd"]=LZ(d);
	value["E"]=DAY_NAMES[E+7];
	value["EE"]=DAY_NAMES[E];
	value["H"]=H;
	value["HH"]=LZ(H);
	if (H==0){value["h"]=12;}
	else if (H>12){value["h"]=H-12;}
	else {value["h"]=H;}
	value["hh"]=LZ(value["h"]);
	if (H>11){value["K"]=H-12;} else {value["K"]=H;}
	value["k"]=H+1;
	value["KK"]=LZ(value["K"]);
	value["kk"]=LZ(value["k"]);
	if (H > 11) { value["a"]="PM"; }
	else { value["a"]="AM"; }
	value["m"]=m;
	value["mm"]=LZ(m);
	value["s"]=s;
	value["ss"]=LZ(s);
	while (i_format < format.length) {
		c=format.charAt(i_format);
		token="";
		while ((format.charAt(i_format)==c) && (i_format < format.length)) {
			token += format.charAt(i_format++);
			}
		if (value[token] != null) { result=result + value[token]; }
		else { result=result + token; }
		}
	return result;
	}
	
// ------------------------------------------------------------------
// Utility functions for parsing in getDateFromFormat()
// ------------------------------------------------------------------
function _isInteger(val) {
	var digits="1234567890";
	for (var i=0; i < val.length; i++) {
		if (digits.indexOf(val.charAt(i))==-1) { return false; }
		}
	return true;
	}
function _getInt(str,i,minlength,maxlength) {
	for (var x=maxlength; x>=minlength; x--) {
		var token=str.substring(i,i+x);
		if (token.length < minlength) { return null; }
		if (_isInteger(token)) { return token; }
		}
	return null;
	}
	
// ------------------------------------------------------------------
// getDateFromFormat( date_string , format_string )
//
// This function takes a date string and a format string. It matches
// If the date string matches the format string, it returns the 
// getTime() of the date. If it does not match, it returns 0.
// ------------------------------------------------------------------
function getDateFromFormat(val,format) {
	val=val+"";
	format=format+"";
	var i_val=0;
	var i_format=0;
	var c="";
	var token="";
	var token2="";
	var x,y;
	var now=new Date();
	var year=now.getYear();
	var month=now.getMonth()+1;
	var date=1;
	var hh=now.getHours();
	var mm=now.getMinutes();
	var ss=now.getSeconds();
	var ampm="";
	
	while (i_format < format.length) {
		// Get next token from format string
		c=format.charAt(i_format);
		token="";
		while ((format.charAt(i_format)==c) && (i_format < format.length)) {
			token += format.charAt(i_format++);
			}
		// Extract contents of value based on format token
		if (token=="yyyy" || token=="yy" || token=="y") {
			if (token=="yyyy") { x=4;y=4; }
			if (token=="yy")   { x=2;y=2; }
			if (token=="y")    { x=2;y=4; }
			year=_getInt(val,i_val,x,y);
			if (year==null) { return 0; }
			i_val += year.length;
			if (year.length==2) {
				if (year > 70) { year=1900+(year-0); }
				else { year=2000+(year-0); }
				}
			}
		else if (token=="MMM"||token=="NNN"){
			month=0;
			for (var i=0; i<MONTH_NAMES.length; i++) {
				var month_name=MONTH_NAMES[i];
				if (val.substring(i_val,i_val+month_name.length).toLowerCase()==month_name.toLowerCase()) {
					if (token=="MMM"||(token=="NNN"&&i>11)) {
						month=i+1;
						if (month>12) { month -= 12; }
						i_val += month_name.length;
						break;
						}
					}
				}
			if ((month < 1)||(month>12)){return 0;}
			}
		else if (token=="EE"||token=="E"){
			for (var i=0; i<DAY_NAMES.length; i++) {
				var day_name=DAY_NAMES[i];
				if (val.substring(i_val,i_val+day_name.length).toLowerCase()==day_name.toLowerCase()) {
					i_val += day_name.length;
					break;
					}
				}
			}
		else if (token=="MM"||token=="M") {
			month=_getInt(val,i_val,token.length,2);
			if(month==null||(month<1)||(month>12)){return 0;}
			i_val+=month.length;}
		else if (token=="dd"||token=="d") {
			date=_getInt(val,i_val,token.length,2);
			if(date==null||(date<1)||(date>31)){return 0;}
			i_val+=date.length;}
		else if (token=="hh"||token=="h") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<1)||(hh>12)){return 0;}
			i_val+=hh.length;}
		else if (token=="HH"||token=="H") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<0)||(hh>23)){return 0;}
			i_val+=hh.length;}
		else if (token=="KK"||token=="K") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<0)||(hh>11)){return 0;}
			i_val+=hh.length;}
		else if (token=="kk"||token=="k") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<1)||(hh>24)){return 0;}
			i_val+=hh.length;hh--;}
		else if (token=="mm"||token=="m") {
			mm=_getInt(val,i_val,token.length,2);
			if(mm==null||(mm<0)||(mm>59)){return 0;}
			i_val+=mm.length;}
		else if (token=="ss"||token=="s") {
			ss=_getInt(val,i_val,token.length,2);
			if(ss==null||(ss<0)||(ss>59)){return 0;}
			i_val+=ss.length;}
		else if (token=="a") {
			if (val.substring(i_val,i_val+2).toLowerCase()=="am") {ampm="AM";}
			else if (val.substring(i_val,i_val+2).toLowerCase()=="pm") {ampm="PM";}
			else {return 0;}
			i_val+=2;}
		else {
			if (val.substring(i_val,i_val+token.length)!=token) {return 0;}
			else {i_val+=token.length;}
			}
		}
	// If there are any trailing characters left in the value, it doesn't match
	if (i_val != val.length) { return 0; }
	// Is date valid for month?
	if (month==2) {
		// Check for leap year
		if ( ( (year%4==0)&&(year%100 != 0) ) || (year%400==0) ) { // leap year
			if (date > 29){ return 0; }
			}
		else { if (date > 28) { return 0; } }
		}
	if ((month==4)||(month==6)||(month==9)||(month==11)) {
		if (date > 30) { return 0; }
		}
	// Correct hours value
	if (hh<12 && ampm=="PM") { hh=hh-0+12; }
	else if (hh>11 && ampm=="AM") { hh-=12; }
	var newdate=new Date(year,month-1,date,hh,mm,ss);
	return newdate.getTime();
	}

// ------------------------------------------------------------------
// parseDate( date_string [, prefer_euro_format] )
//
// This function takes a date string and tries to match it to a
// number of possible date formats to get the value. It will try to
// match against the following international formats, in this order:
// y-M-d   MMM d, y   MMM d,y   y-MMM-d   d-MMM-y  MMM d
// M/d/y   M-d-y      M.d.y     MMM-d     M/d      M-d
// d/M/y   d-M-y      d.M.y     d-MMM     d/M      d-M
// A second argument may be passed to instruct the method to search
// for formats like d/M/y (european format) before M/d/y (American).
// Returns a Date object or null if no patterns match.
// ------------------------------------------------------------------
function parseDate(val) {
	var preferEuro=(arguments.length==2)?arguments[1]:false;
	generalFormats=new Array('y-M-d','MMM d, y','MMM d,y','y-MMM-d','d-MMM-y','MMM d');
	monthFirst=new Array('M/d/y','M-d-y','M.d.y','MMM-d','M/d','M-d');
	dateFirst =new Array('d/M/y','d-M-y','d.M.y','d-MMM','d/M','d-M');
	var checkList=new Array('generalFormats',preferEuro?'dateFirst':'monthFirst',preferEuro?'monthFirst':'dateFirst');
	var d=null;
	for (var i=0; i<checkList.length; i++) {
		var l=window[checkList[i]];
		for (var j=0; j<l.length; j++) {
			d=getDateFromFormat(val,l[j]);
			if (d!=0) { return new Date(d); }
			}
		}
	return null;
	}

function PegawaiApproval(pegawaiId, ijinKoreksiId)
{
	$("tr[id^='trDataPermohonan']").remove();
	
	$(function () {
		$.get("app/loadUrl/main/permohonan_cuti_add_template/?reqPegawaiId="+pegawaiId+"&reqIjinKoreksiId="+ijinKoreksiId, function (data) {
			$("#tbDataPermohonan").append(data);
		});
	});	
}

function getNameMonth(val)
{
	var months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  	return months[val];
}