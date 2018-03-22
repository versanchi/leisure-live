<script language = "JavaScript">

function cekformopt() {
	var PNRNo=document.example.PNRNo.value;
	var DateLimit=document.example.DateLimit.value;
	var TimeLimit=document.example.TimeLimit.value;
	var TourCode=document.example.TourCode.value;
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
	if (TimeLimit.indexOf(":",1)==-1) {
		alert ("Please input the Time Limit on the right format");
		example.TimeLimit.focus();
		return false;
	}
	if (TourCode=="") {
		alert ("Please input the Tour Code");
		example.TourCode.focus();
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
	var data=document.example.elements;
	var count=0;
	for (i=1; i<9; i++) {
		if (data[i].value=="") {
			count=count+1;
		}
	}
	if (count>0) {
		alert ("You have to complete at least 1 route for this OPT");
		return false;
	}
	var jawaban = window.confirm("Are you sure that these informations are correct?");
	if (jawaban==false) {
		return false;
	}
	return true;
}

function cekformopt2() {
	var data=document.example.elements;
	var AirlinesUsed=document.example.AirlinesUsed.value;
	var FinalRoute=document.example.FinalRoute.value;
	var count=0;
	if (AirlinesUsed=="0") {
		alert ("Please select the Airlines Used");
		example.AirlinesUsed.focus();
		return false;
	}
	if (FinalRoute=="0") {
		alert ("Please select the Ticket Destination");
		example.FinalRoute.focus();
		return false;
	}
	if (data[1].value=="" || data[3].value=="") {
			count=count+1;
	}
	if (count>0) {
		alert ("You have to complete at least 1 passenger information for this OPT");
		return false;
	}
	var jawaban = window.confirm("Are you sure that these informations are correct?");
	if (jawaban==false) {
		return false;
	}
	return true;
}

function cekformopt3() {
	var data=document.example.elements;
	var data1="";
	var count=0;
	var OprProc=document.example.OprProc.value;
	if (OprProc==0 || OprProc==1) {
		for (i=0; i<data.length; i++) {
			for (j=0; j<9; j++) {
				data1="TixNo["+j+"]";
				if (data[i].name==data1) {
					if (data[i].value=="") {
						alert ("You have to complete all ticket numbers for this OPT");
						return false;
					}
				}
			}
		}
	}
	var jawaban = window.confirm("Are you sure that these informations are correct?");
	if (jawaban==false) {
		return false;
	}
	return true;
}

function cekformopt4() {
	var data=document.example.elements;
	var AirlinesUsed=document.example.AirlinesUsed.value;
	var FinalRoute=document.example.FinalRoute.value;
	var count=0;
	if (AirlinesUsed=="0") {
		alert ("Please select the Airlines Used");
		example.AirlinesUsed.focus();
		return false;
	}
	if (FinalRoute=="0") {
		alert ("Please select the Ticket Destination");
		example.FinalRoute.focus();
		return false;
	}
	if (data[2].value=="" || data[4].value=="") {
			count=count+1;
	}
	if (count>0) {
		alert ("You have to complete at least 1 passenger information for this OPT");
		return false;
	}
	var jawaban = window.confirm("Are you sure that these informations are correct?");
	if (jawaban==false) {
		return false;
	}
	return true;
}
</script>