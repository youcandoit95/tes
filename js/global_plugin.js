(function(d){d.fn.redirect=function(a,b,c){void 0!==c?(c=c.toUpperCase(),"GET"!=c&&(c="POST")):c="POST";if(void 0===b||!1==b)b=d().parse_url(a),a=b.url,b=b.params;var e=d("<form target='_blank'></form");e.attr("method",c);e.attr("action",a);for(var f in b)a=d("<input />"),a.attr("type","hidden"),a.attr("name",f),a.attr("value",b[f]),a.appendTo(e);d("body").append(e);e.submit()};d.fn.parse_url=function(a){if(-1==a.indexOf("?"))return{url:a,params:{}};var b=a.split("?"),a=b[0],c={},b=b[1].split("&"),e={},d;for(d in b){var g= b[d].split("=");e[g[0]]=g[1]}c.url=a;c.params=e;return c}})(jQuery);
(function(d){d.fn.redirect_pageself=function(a,b,c){void 0!==c?(c=c.toUpperCase(),"GET"!=c&&(c="POST")):c="POST";if(void 0===b||!1==b)b=d().parse_url(a),a=b.url,b=b.params;var e=d("<form></form");e.attr("method",c);e.attr("action",a);for(var f in b)a=d("<input />"),a.attr("type","hidden"),a.attr("name",f),a.attr("value",b[f]),a.appendTo(e);d("body").append(e);e.submit()};d.fn.parse_url=function(a){if(-1==a.indexOf("?"))return{url:a,params:{}};var b=a.split("?"),a=b[0],c={},b=b[1].split("&"),e={},d;for(d in b){var g= b[d].split("=");e[g[0]]=g[1]}c.url=a;c.params=e;return c}})(jQuery);
(function(e){var t,o={className:"autosizejs",id:"autosizejs",append:"\n",callback:!1,resizeDelay:10,placeholder:!0},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o=window.getComputedStyle?window.getComputedStyle(u,null):!1;o?(t=u.getBoundingClientRect().width,(0===t||"number"!=typeof t)&&(t=parseInt(o.width,10)),e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){t-=parseInt(o[i],10)})):t=p.width(),s.style.width=Math.max(t,0)+"px"}function a(){var a={};if(t=u,s.className=i.className,s.id=i.id,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a).attr("wrap",p.attr("wrap")),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=!u.value&&i.placeholder?(p.attr("placeholder")||"")+i.append:u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width(),y=p.css("resize");p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word"}),"vertical"===y?p.css("resize","none"):"both"===y&&p.css("resize","horizontal"),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

$(document).ready(function(){
	$(".ttip").tooltip();
	$('input.act').tooltip();
	$('button.act').tooltip();
	
	$(".datepicker").datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth: true,
		changeYear: true
	});
	
	$(".datepicker").keydown(function(k){
		if (k.keyCode!=9)
		{
			return false;
		}
	});
	
	$(".datepicker_tgl_lahir").datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		yearRange: "1940:"
	});
	
	$(".datepicker_tgl_lahir").keydown(function(k){
		if (k.keyCode!=9)
		{
			return false;
		}
	});
	
	var dateToday = new Date();
	
	$(".datepicker_disabled_before").datepicker({
		dateFormat : 'dd-mm-yy',
		changeMonth: true,
		minDate: dateToday,
		changeYear: true
	});
	
	$(".datepicker_disabled_before").keydown(function(k){
		if (k.keyCode!=9)
		{
			return false;
		}
	});
	
	$('.combobox').combobox();
	
	$('.datetimepicker').datetimepicker({
		dateFormat: 'dd-mm-yy',
		timeFormat: "HH:mm:ss"
	});
	
    $('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
	
	$('textarea').autosize();
	
	// Add slideDown animation to dropdown
	$('.dropdown').on('show.bs.dropdown', function(e){
	  $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
	});

	// Add slideUp animation to dropdown
	$('.dropdown').on('hide.bs.dropdown', function(e){
	  $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
	});
});

function count_length(x)
{
	var m = document.getElementById(x).value.length;
	var d = 400;
	var n = d - m;
	$(document).ready(function(){
		$("#"+x+"_char_left").val(n);
	});
}

function checkFile(valFile,idFile)
{
	var ext=/\b(zip|rar|doc|docx|xls|xlsx|pdf|jpeg|jpg|png|PNG|txt|oft|OFT|msg|MSG)/g;
	var x = valFile;
	var spl = x.split(".");
	if (spl[1].match(ext)!=null)
	{
		
	}
	else
	{
		alert("extension '."+spl[1]+"' not allowed");
		document.getElementById(''+idFile).value = "";
	}
}

function updateClock ( )
{
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 24 ) ? "WIB" : "WIB";
 
    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 24 ) ? currentHours - 24 : currentHours;
 
    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 24 : currentHours;
 
    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
     
     
    $("#clock").html(currentTimeString);
 }
 
function get_time_now(x)
{
	var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 24 ) ? "WIB" : "WIB";
 
    // Convert the hours component to 12-hour format if needed
    //currentHours = ( currentHours > 24 ) ? currentHours - 24 : currentHours;
 
    // Convert an hours component of "0" to "12"
    //currentHours = ( currentHours == 0 ) ? 24 : currentHours;
 
    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
	
	if (x=="h")
	{
		return currentHours;
	}
	else
	{
		return currentMinutes;
	}
} 
 
$(document).ready(function()
{
   setInterval('updateClock()', 1000);
});