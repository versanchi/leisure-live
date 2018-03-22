function MM_jumpMenu(targ,selObj,restore){
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;}

function cekformopt() {
	var PNRNo=document.example.PNRNo.value;
	var DateLimit=document.example.DateLimit.value;
	var TimeLimit=document.example.TimeLimit.value;
	var FareBasis=document.example.FareBasis.value;
	var FOP=document.example.FOP.value;
	var Endorsment=document.example.Endorsment.value;
	var NettFareA=document.example.NettFareA.value;
	var NettFareC=document.example.NettFareC.value;
	var NettFareI=document.example.NettFareI.value;
	var SellingPriceA=document.example.SellingPriceA.value;
	var SellingPriceC=document.example.SellingPriceC.value;
	var SellingPriceI=document.example.SellingPriceI.value;
	if (PNRNo=="") {
		alert ("Please input the PNR No.");
		example.PNRNo.focus();
		return false;
	}
	if (DateLimit=="") {
		alert ("Please input the Date Limit");
		example.DateLimit.focus();
		return false;
	}
	if (TimeLimit=="") {
		alert ("Please input the Time Limit");
		example.TimeLimit.focus();
		return false;
	}
	if (FareBasis=="") {
		alert ("Please input the Fare Basis");
		example.FareBasis.focus();
		return false;
	}
	if (FOP=="") {
		alert ("Please input the Form Of Payment");
		example.FOP.focus();
		return false;
	}
	if (Endorsment=="") {
		alert ("Please input the Endorsment");
		example.Endorsment.focus();
		return false;
	}
	if (NettFareA=="" && NettFareC=="" && NettFareI=="") {
		alert ("You have to input at least 1 Nett Fare");
		example.NettFareA.focus();
		return false;
	}
	if (SellingPriceA=="" && SellingPriceC=="" && SellingPriceI=="") {
		alert ("You have to input at least 1 Selling Price");
		example.SellingPriceA.focus();
		return false;
	}
	var jawaban = window.confirm("Are you sure to save this OPT and continue to the next page?");
	if (jawaban==false) {
		return false;
	}
	return true;
}

function cekformopt1() {
	var AirlinesCheck=0;
	var FlightCheck=0;
	var ClassCheck=0;
	var FromCheck=0;
	var ToCheck=0;
	var TimeCheck=0;
	var StatusCheck=0;
	for (i=0; i<form.elements['Airlines[]'].length; i++) {
		if (form.elements['Airlines[]'][i].value!= '') {
			AirlinesCheck=AirlinesCheck+1;
		}
	}
	for (i=0; i<form.elements['FlightNo[]'].length; i++) {
		if (form.elements['FlightNo[]'][i].value!= '') {
			FlightCheck=FlightCheck+1;
		}
	}
	for (i=0; i<form.elements['Class[]'].length; i++) {
		if (form.elements['Class[]'][i].value!= '') {
			ClassCheck=ClassCheck+1;
		}
	}
	for (i=0; i<form.elements['From[]'].length; i++) {
		if (form.elements['From[]'][i].value!= '') {
			FromCheck=FromCheck+1;
		}
	}
	for (i=0; i<form.elements['To[]'].length; i++) {
		if (form.elements['To[]'][i].value!= '') {
			ToCheck=ToCheck+1;
		}
	}for (i=0; i<form.elements['Time[]'].length; i++) {
		if (form.elements['Time[]'][i].value!= '') {
			TimeCheck=TimeCheck+1;
		}
	}
	for (i=0; i<form.elements['Status[]'].length; i++) {
		if (form.elements['Status[]'][i].value!= '') {
			StatusCheck=StatusCheck+1;
		}
	}
	if (AirlinesCheck==0 || FlightCheck==0 || ClassCheck==0 || FromCheck==0 || Tocheck==0 || TimeCheck==0 || StatusCheck==0) {
		alert ("You have to complete at least 1 segment")
		return false
	}
	var jawaban = window.confirm("Are you sure that these informations are correct?");
	if (jawaban==false) {
		return false
	}
	return true
}