 var RdAcara = new Array();
 RdAcara["3"]=3;
 RdAcara["2"]=2;
 RdAcara["1"]=1;

 var RdTerbang = new Array();
 RdTerbang["3"]=3;
 RdTerbang["2"]=2;
 RdTerbang["1"]=1;
 
 var RdTrans = new Array();
 RdTrans["3"]=3;
 RdTrans["2"]=2;
 RdTrans["1"]=1;
 
 var RdWisata = new Array();
 RdWisata["3"]=3;
 RdWisata["2"]=2;
 RdWisata["1"]=1;
 
 var RdHotel = new Array();
 RdHotel["3"]=3;
 RdHotel["2"]=2;
 RdHotel["1"]=1;
 
 var RdMakan = new Array();
 RdMakan["3"]=3;
 RdMakan["2"]=2;
 RdMakan["1"]=1;
 
 var RdBelanja = new Array();
 RdBelanja["3"]=3;
 RdBelanja["2"]=2;
 RdBelanja["1"]=1;
 
 var RdPemandu = new Array();
 RdPemandu["3"]=3;
 RdPemandu["2"]=2;
 RdPemandu["1"]=1;
 
 var RdTL = new Array();
 RdTL["3"]=3;
 RdTL["2"]=2;
 RdTL["1"]=1;
 
//----------------------------------------------------------------------------------------------//
var RdPetugas = new Array();
 RdPetugas["3"]=3;
 RdPetugas["2"]=2;
 RdPetugas["1"]=1;
 
 var RdConsultant = new Array();
 RdConsultant["3"]=3;
 RdConsultant["2"]=2;
 RdConsultant["1"]=1;
 
 var RdKasir = new Array();
 RdKasir["3"]=3;
 RdKasir["2"]=2;
 RdKasir["1"]=1;
 
 var RdDoc = new Array();
 RdDoc["3"]=3;
 RdDoc["2"]=2;
 RdDoc["1"]=1;
 
 var RdAirport = new Array();
 RdAirport["3"]=3;
 RdAirport["2"]=2;
 RdAirport["1"]=1;
 
 var RdPerjalanan = new Array();
 RdPerjalanan["3"]=3;
 RdPerjalanan["2"]=2;
 RdPerjalanan["1"]=1;
 
 var RdInfo = new Array();
 RdInfo["3"]=3;
 RdInfo["2"]=2;
 RdInfo["1"]=1;
 
 var RdHidup = new Array();
 RdHidup["3"]=3;
 RdHidup["2"]=2;
 RdHidup["1"]=1;
 
 var RdAturacara = new Array();
 RdAturacara["3"]=3;
 RdAturacara["2"]=2;
 RdAturacara["1"]=1;
 
 var RdMasalah = new Array();
 RdMasalah["3"]=3;
 RdMasalah["2"]=2;
 RdMasalah["1"]=1;
//----------------------------------------------------------------------------------------//


//Radio button Acara
function getRdAcara()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Acara = theForm.elements["acara"];
    for(var i = 0; i < Acara.length; i++)
    {
        if(Acara[i].checked)
        {
            awal = RdAcara[Acara[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Terbang
function getRdTerbang()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Terbang = theForm.elements["terbang"];
    for(var i = 0; i < Terbang.length; i++)
    {
        if(Terbang[i].checked)
        {
            awal = RdTerbang[Terbang[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Transformasi
function getRdTrans()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Trans = theForm.elements["trans"];
    for(var i = 0; i < Trans.length; i++)
    {
        if(Trans[i].checked)
        {
            awal = RdTrans[Trans[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Obyek Wisata
function getRdWisata()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Wisata = theForm.elements["wisata"];
    for(var i = 0; i < Wisata.length; i++)
    {
        if(Wisata[i].checked)
        {
            awal = RdWisata[Wisata[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Hotel
function getRdHotel()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Hotel = theForm.elements["hotel"];
    for(var i = 0; i < Hotel.length; i++)
    {
        if(Hotel[i].checked)
        {
            awal = RdHotel[Hotel[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Makan
function getRdMakan()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Makan = theForm.elements["makan"];
    for(var i = 0; i < Makan.length; i++)
    {
        if(Makan[i].checked)
        {
            awal = RdMakan[Makan[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Belanja
function getRdBelanja()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Belanja = theForm.elements["belanja"];
    for(var i = 0; i < Belanja.length; i++)
    {
        if(Belanja[i].checked)
        {
            awal = RdBelanja[Belanja[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Pemandu
function getRdPemandu()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Pemandu = theForm.elements["pemandu"];
    for(var i = 0; i < Pemandu.length; i++)
    {
        if(Pemandu[i].checked)
        {
            awal = RdPemandu[Pemandu[i].value];
            break;
        }
    }
    return awal;
}

//Radio button TL
function getRdTL()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var TL = theForm.elements["tl"];
    for(var i = 0; i < TL.length; i++)
    {
        if(TL[i].checked)
        {
            awal = RdTL[TL[i].value];
            break;
        }
    }
    return awal;
}
//---------------------------------------------------------------------------------//

//Radio button Petugas Operator
function getRdPetugas()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Petugas = theForm.elements["petugas"];
    for(var i = 0; i < Petugas.length; i++)
    {
        if(Petugas[i].checked)
        {
            awal = RdPetugas[Petugas[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Petugas Operator
function getRdConsultant()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Consultant = theForm.elements["consultant"];
    for(var i = 0; i < Consultant.length; i++)
    {
        if(Consultant[i].checked)
        {
            awal = RdConsultant[Consultant[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Kasir
function getRdKasir()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Kasir = theForm.elements["kasir"];
    for(var i = 0; i < Kasir.length; i++)
    {
        if(Kasir[i].checked)
        {
            awal = RdKasir[Kasir[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Doc
function getRdDoc()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Doc = theForm.elements["doc"];
    for(var i = 0; i < Doc.length; i++)
    {
        if(Doc[i].checked)
        {
            awal = RdDoc[Doc[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Airport
function getRdAirport()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Airport = theForm.elements["airport"];
    for(var i = 0; i < Airport.length; i++)
    {
        if(Airport[i].checked)
        {
            awal = RdAirport[Airport[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Perjalanan
function getRdPerjalanan()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Perjalanan = theForm.elements["perjalanan"];
    for(var i = 0; i < Perjalanan.length; i++)
    {
        if(Perjalanan[i].checked)
        {
            awal = RdPerjalanan[Perjalanan[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Informasi
function getRdInfo()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Info = theForm.elements["info"];
    for(var i = 0; i < Info.length; i++)
    {
        if(Info[i].checked)
        {
            awal = RdInfo[Info[i].value];
            break;
        }
    }
    return awal;
}

//Radio button Menghidupkan
function getRdHidup()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Hidup = theForm.elements["hidup"];
    for(var i = 0; i < Hidup.length; i++)
    {
        if(Hidup[i].checked)
        {
            awal = RdHidup[Hidup[i].value];
            break;
        }
    }
    return awal;
}

//Radio button AturAcara
function getRdAturacara()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Aturacara = theForm.elements["aturacara"];
    for(var i = 0; i < Aturacara.length; i++)
    {
        if(Aturacara[i].checked)
        {
            awal = RdAturacara[Aturacara[i].value];
            break;
        }
    }
    return awal;
}

//getRdMasalah
function getRdMasalah()
{  
    var awal=0;
    var theForm = document.forms["cakeform"];
    var Masalah = theForm.elements["masalah"];
    for(var i = 0; i < Masalah.length; i++)
    {
        if(Masalah[i].checked)
        {
            awal = RdMasalah[Masalah[i].value];
            break;
        }
    }
    return awal;
}
//------------------------------------------------------------------------------------//
function calculateTotal()
{
    //Here we get the total price by calling our function
    //Each function returns a number so by calling them we add the values they return together
	if(getRdAcara() !=0 || getRdTerbang() !=0 || getRdTrans() !=0 || getRdWisata() !=0 || getRdHotel() !=0 || getRdMakan() !=0 || getRdBelanja() !=0 || getRdPemandu() !=0 || getRdTL() !=0){
	var cakeTotal = getRdAcara() + getRdTerbang() + getRdTrans() + getRdWisata() + getRdHotel() + getRdMakan() + getRdBelanja() + getRdPemandu() + getRdTL();
	
	var modcakeTotal = (cakeTotal / 9).toFixed(2);
    //display the result
    var divobj = document.getElementById('totalPrice');
		divobj.style.display='block';
	if(modcakeTotal < 3){
		divobj.style.background = '#ff5d5d';
	}
	else{
		divobj.style.background = '#FFFFFF';
	}
	//divobj.innerHTML = "Total Rate Perjalanan : "+cakeTotal;
	divobj.innerHTML = modcakeTotal;
	}
	
	if(getRdPetugas() !=0 || getRdConsultant() !=0 || getRdKasir() !=0 || getRdDoc() !=0 || getRdAirport() !=0){
		var TotalTC = getRdPetugas() + getRdConsultant() + getRdKasir() + getRdDoc() + getRdAirport();
		var modTotalTC = (TotalTC / 5).toFixed(2);
		var divobj2 = document.getElementById('totalTConsult');
		divobj2.style.display='block';

		if(modTotalTC < 3){
			divobj2.style.background = '#ff5d5d';
		}
		else{
			divobj2.style.background = '#FFFFFF';
		}
		//divobj2.innerHTML = "Total Rate Tour Consultant : "+TotalTC;
		divobj2.innerHTML = modTotalTC;
	}
	
	if(getRdPerjalanan() !=0 || getRdInfo() !=0 || getRdHidup() !=0 || getRdAturacara() !=0 || getRdMasalah() !=0){
		var TotalTL = getRdPerjalanan() + getRdInfo() + getRdHidup() + getRdAturacara() + getRdMasalah();
		var modTotalTL = (TotalTL / 5).toFixed(2);
		var divobj3 = document.getElementById('totalTL');
		divobj3.style.display='block';
		
		if(modTotalTL < 3){
			divobj3.style.background = '#ff5d5d';
		}
		else{
			divobj3.style.background = '#FFFFFF';
		}
		//divobj3.innerHTML = "Total Rate Tour Leader : "+TotalTL;
		divobj3.innerHTML = modTotalTL;
	}
	
	var TotalSemua = getRdAcara() + getRdTerbang() + getRdTrans() + getRdWisata() + getRdHotel() + getRdMakan() + getRdBelanja() + getRdPemandu() + getRdTL() + getRdPetugas() + getRdConsultant() + getRdKasir() + getRdDoc() + getRdAirport() + getRdPerjalanan() + getRdInfo() + getRdHidup() + getRdAturacara() + getRdMasalah();
	var TotalAVG = TotalSemua / 19;
	var result = TotalAVG.toFixed(2);
	var divobj4 = document.getElementById('totalAvg');
	divobj4.style.display='block';
	
	if(result < 3){
		divobj4.style.background = '#ff5d5d';
	}
	else{
		divobj4.style.background = '#FFFFFF';
	}
	//divobj4.innerHTML = "Total Average : "+result;
	divobj4.innerHTML = result;
}

function TotalTC()
{
	var TotalTC = getRdPetugas() + getRdConsultant() + getRdKasir() + getRdDoc() + getRdAirport();
	var divobj2 = document.getElementById('totalTConsult');
	divobj2.style.display='block';
	divobj2.innerHTML = "Total Rate Tour Consultant : "+TotalTC;
}

function TotalTL()
{
	var TotalTL = getRdPerjalanan() + getRdInfo() + getRdHidup() + getRdAturacara() + getRdMasalah();
	var divobj3 = document.getElementById('totalTL');
	divobj3.style.display='block';
	divobj3.innerHTML = "Total Rate Tour Leader : "+TotalTL;
}

function TotalAverage()
{
	var TotalSemua = getRdAcara() + getRdTerbang() + getRdTrans() + getRdWisata() + getRdHotel() + getRdMakan() + getRdBelanja() + getRdPemandu() + getRdTL() + getRdPetugas() + getRdConsultant() + getRdKasir() + getRdDoc() + getRdAirport() + getRdPerjalanan() + getRdInfo() + getRdHidup() + getRdAturacara() + getRdMasalah();
	var TotalAVG = TotalSemua / 19;
	var result = TotalAVG.toFixed(2);
	var divobj4 = document.getElementById('totalAvg');
    var divobj41 = document.getElementById('totalAvg2');
	divobj4.style.display='block';
	divobj4.innerHTML = "Total Average : "+result;
    example.totalAvg2.value = "tes";
}

function hideTotal()
{
    var divobj = document.getElementById('totalPrice');
	var divobj2 = document.getElementById('totalTConsult');
	var divobj3 = document.getElementById('totalTL');
	var divobj4 = document.getElementById('totalAvg');
    
	divobj.style.display='none';
	divobj2.style.display='none';
	divobj3.style.display='none';
	divobj4.style.display='none';
}