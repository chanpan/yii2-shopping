var popup_name;
var addFunc;
var updateFunc;
var loadFunc;
var whatVal;
var linkFunc;
function gcalendar_init(id, options, pname, addFunc_name, updateFunc_name, linkFunc_name, loadFunc_name) {
	popup_name = pname;
	addFunc = addFunc_name;
	updateFunc = updateFunc_name;
	loadFunc = loadFunc_name;
	linkFunc = linkFunc_name;
	var op = {
		showday:new Date(),
		EditCmdhandler:Edit,
		DeleteCmdhandler:Delete,
		ViewCmdhandler:View,    
		onWeekOrMonthToDay:wtd,
		onBeforeRequestData: cal_beforerequest,
		onAfterRequestData: cal_afterrequest,
		onRequestDataError: cal_onerror   
	};
	for (var v in options) {
		op[v] = options[v];
	}

	var $dv = $("#calhead");
	var _MH = document.documentElement.clientHeight-75;
	var dvH = $dv.height() + 2;
	op.height = _MH - dvH;
	op.eventItems =[];
	
	var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
	if (p && p.datestrshow) {
		$("#txtdatetimeshow").text(p.datestrshow);
	}
	else
	{
		var pp = $("#gridcontainer").gotoDate().BcalGetOp();
		$("#txtdatetimeshow").text(pp.datestrshow);
	}
	$("#caltoolbar").noSelect();
            
	$("#hdtxtshow").datepicker({
		picker: "#txtdatetimeshow", 
		showtarget: $("#txtdatetimeshow"),
		onReturn:function(r){                          
			var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
			if (p && p.datestrshow) {
				$("#txtdatetimeshow").text(p.datestrshow);
			}
		} 
	});
	
	if(op['view']=='day'){
		$("#showdaybtn").addClass("fcurrent");
	} else if(op['view']=='week'){
		$("#showweekbtn").addClass("fcurrent");
	} else if(op['view']=='month'){
		$("#showmonthbtn").addClass("fcurrent");
	}
	
	//to show day view
	$("#showdaybtn").click(function(e) {
		//document.location.href="#day";
		$("#caltoolbar div.fcurrent").each(function() {
			$(this).removeClass("fcurrent");
		})
		$(this).addClass("fcurrent");
		var p = $("#gridcontainer").swtichView("day").BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}
	});
            	
	//to show week view
	$("#showweekbtn").click(function(e) {
		//document.location.href="#week";
		$("#caltoolbar div.fcurrent").each(function() {
			$(this).removeClass("fcurrent");
		})
		$(this).addClass("fcurrent");
		var p = $("#gridcontainer").swtichView("week").BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}
	});
	//to show month view
	$("#showmonthbtn").click(function(e) {
		//document.location.href="#month";
		$("#caltoolbar div.fcurrent").each(function() {
			$(this).removeClass("fcurrent");
		})
		$(this).addClass("fcurrent");
		var p = $("#gridcontainer").swtichView("month").BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}
	});
            
	$("#showreflashbtn").click(function(e){
		$("#gridcontainer").reload();
	});
            
	//Add a new event
	$("#faddbtn").click(function(e) {
		addFunc();
		$('#'+popup_name).modal('show');
	});
	//go to today
	$("#showtodaybtn").click(function(e) {
		var p = $("#gridcontainer").gotoDate().BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}


	});
	//previous date range
	$("#sfprevbtn").click(function(e) {
		var p = $("#gridcontainer").previousRange().BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}
	});
	//next date range
	$("#sfnextbtn").click(function(e) {
		var p = $("#gridcontainer").nextRange().BcalGetOp();
		if (p && p.datestrshow) {
			$("#txtdatetimeshow").text(p.datestrshow);
		}
	});
	
}

function cal_beforerequest(type)
{
	var t="Loading data...";
	switch(type)
	{
		case 1:
			t="Loading data...";
			break;
		case 2:                      
		case 3:  
		case 4:
			t="The request is being processed ...";                                   
			break;
	}
	$("#errorpannel").hide();
	$("#loadingpannel").html(t).show();    
}
function cal_afterrequest(type)
{
	switch(type)
	{
		case 1:
			$("#loadingpannel").hide();
			break;
		case 2:
		case 3:
		case 4:
			$("#loadingpannel").html("Success!");
			window.setTimeout(function(){
				$("#loadingpannel").hide();
			},2000);
			break;
	}              
               
}
function cal_onerror(type,data)
{
	$("#errorpannel").show();
}
function Edit(data)
{
	if(data)
	{
		updateFunc(data[0], data[2], data[3], data[4], data[1]);
		$('#'+popup_name).modal('show');
	}
}    
function View(data)
{
	var str = "";
//	$.each(data, function(i, item){
//		str += "[" + i + "]: " + item + "<br/>";
//	});
	var st = new Date(data[2]);
	var et = new Date(data[3]);

	str += '<table class="view"><tbody>';
	str += '<tr><th>เหตุการณ์: </th><td>'+data[1]+'</td></tr>';
	str += '<tr><th>วันที่: </th><td>'+st.format('dd/mm/yyyy')+ ((data[4]==0)?' <strong> เวลา </strong> '+st.format('HH:MM'):'')+' </td></tr>';
	str += '<tr><th>ถึง: </th><td>'+et.format('dd/mm/yyyy')+ ((data[4]==0)?' <strong> เวลา </strong> '+et.format('HH:MM'):'')+' </td></tr>';
	if(data[4]==1){
		str += '<tr><th></th><td>ทั้งวัน</td></tr>';
	}
	str += '<tr><th>สถานที่: </th><td>'+data[9]+'</td></tr>';
	str += '<tr><th>รายละเอียด: </th><td>'+data[10]+'</td></tr>';
	str += '</tbody></table>';
	
	bootbox.alert(str, function() {
		
	});    
}    
function Delete(data,callback)
{           
	bootbox.confirm("คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?", function(result) {
		if (result) {
			result && callback(0);
		} 
	});
}
function wtd(p)
{
	if (p && p.datestrshow) {
		$("#txtdatetimeshow").text(p.datestrshow);
	}
	$("#caltoolbar div.fcurrent").each(function() {
		$(this).removeClass("fcurrent");
	})
	$("#showdaybtn").addClass("fcurrent");
}
