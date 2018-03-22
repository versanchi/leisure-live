  
<script src="../config/jcarousellite_1.0.1c4.js" type="text/javascript"></script>                               
<script type="text/javascript" src="../config/jquery.sticky.js"></script>
<script type="text/javascript" src="../config/jqClock.min.js"></script>
<link rel="stylesheet" type="text/css" href="../config/jqClock.css" />
<script type="text/javascript">
    $(document).ready(function(){    
      $("#clock1").clock({"langSet":"en"});                                                   
                                           
    });    
  </script>        
                      
<script>
$(window).load(function(){
  $("#stickmenu").sticky({ topSpacing: 0 });
});
</script>
 
<!-- <script type="text/javascript" src="../head/jquery-1.3.2.min.js"></script> -->  
<script type="text/javascript">
    $(function() {
      if ($.browser.msie && $.browser.version.substr(0,1)<7)
      {
        $('li').has('ul').mouseover(function(){
            $(this).children('ul').show();
            }).mouseout(function(){
            $(this).children('ul').hide();
            })
      }
    });        
</script>                                     
                                                                    
<link rel="stylesheet" href="../head/menu.css" type="text/css" /> 
<script language="JavaScript"  type="text/javascript">
     
function logoff(NAMA)         
{
if (confirm("Are you sure want to Log Out ?"))
{
 window.location.href = 'logout.php' ;
 
} 
}
</script>
<script type="text/javascript">
$(function() {
    $(".newsticker-jcarousellite").jCarouselLite({
        vertical: true,
        hoverPause:true,
        visible: 1,
        auto:5000,
        speed:1000
    });
});
</script>
                                   
<div id="newsticker-demo">    
    <div class="title"></div>
    <div class="newsticker-jcarousellite">
        <ul>
            <!--<li>
                <div class="thumbnail">
                    <img src="images/1.jpg">
                </div> 
                <div class="info">
                    The Knight and the Lady The Knight and the Lady The Knight and the Lady The Knight and the Lady The Knight and the Lady
                    <span class="cat">Category: Illustrations</span>
                </div>
                <div class="clear"></div>
            </li>--><?PHP
            $tampil=mysql_query("SELECT * FROM tour_information where InformationDesc <> ''ORDER BY InformationID");
            while($r=mysql_fetch_array($tampil)){ ?>  
                <li>                      
                <div class="info"><?PHP
                  echo  "$r[InformationDesc]"  ?>
                </div>
                <div class="clear"></div>
            </li>    
            <?PHP            
            }?>      
        </ul>
    </div>
    
</div>                        
<div id="stickmenu">
<ul id='menu'>
 
<?php 
    $employee_code=$_SESSION['employee_code'];
    $sqluser=mysql_query("SELECT tbl_msoffice.office_code,tbl_msemployee.ltm_authority,tbl_msemployee.employee_name,cim_msjob.JobLevel FROM tbl_msemployee   
                                left join tbl_msoffice on tbl_msoffice.office_id=tbl_msemployee.office_id
                                left join cim_msjob on cim_msjob.IDJob=tbl_msemployee.employee_title
                                WHERE tbl_msemployee.employee_code = '$employee_code'");
    $hasiluser=mysql_fetch_array($sqluser);
    $user=$hasiluser['employee_name'];
    $ltm_authority=$hasiluser['ltm_authority'];
    $team=$hasiluser['office_code'];
    $joblevel=$hasiluser['JobLevel'];
    if($ltm_authority=='ADMINISTRATOR'){ 
?>    
  <li><a href='?module=home'>Home</a></li>    
  <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li> 
        <li><a href='?module=tester'>&#164; Testing</a></li>
        
    </ul> 
  </li>
  <li><a href='#'>L T M</a>
    <ul>                                                         
      <li><a href='#'>&#187; Product</a>
      	<ul>
			<li><a href='?module=msproduct'>&#164; Product</a></li>
		</ul>   
      </li>
      <li><a href='#'>&#187; Operation</a>      
            <ul>
            <li><a href='?module=msvoucher'>&#164; Bonus Manage</a></li>
            <li><a href='?module=opbookingdetail'>&#164; Booking Manage</a></li> 
            <li><a href='?module=opbookingdetail&act=deviasi'>&#164; Deviasi list</a></li>
            <li><a href='?module=group'>&#164; Group Manage</a></li>   
            <li><a href='#'>&#187; Group List</a>
                <ul>
                <li><a href='?module=rptnamelist'>&#164; Name List</a></li>
                <li><a href='?module=rptpassportlist'>&#164; Passport List</a></li>
                <li><a href='?module=rptroominglist'>&#164; Rooming List</a></li>
                <li><a href='?module=rptgrpdep'>&#164; Group Departure</a></li>   
                <li><a href='?module=rptlugagetag'>&#164; Luggage Tag</a></li>                                
                </ul> 
            </li>     
            <li><a href='?module=msbookingdetail&act=ltmbook'>&#164; Internal Booking</a></li>
            <li><a href='?module=mstlassign'>&#164; TL Assignment</a></li>
            <li><a href='?module=rptvisa'>&#164; Visa</a></li>
            </ul>   
      </li>
                                                         
      <li><a href='#'>&#187; Sales</a>      
            <ul>
            <li><a href='#'>&#187; New Booking</a>
                <ul>
                <?php
                $gr=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
                while($grp=mysql_fetch_array($gr)){echo"
                    <li><a href='?module=msbooking&group=$grp[IDGroup]'>&#164; $grp[GroupName]</a></li>";     
                }   
               ?>                               
                </ul> 
            </li>
            <li><a href='?module=msbookingdetail'>&#164; Booking Details</a></li>
            <li><a href='?module=duplicatebook'>&#164; Duplicate Booking</a></li>
            <li><a href='?module=formbookingtour'>&#164; Tour Reservation Form</a></li>
                              
            </ul>   
      </li>
      <li><a href='?module=msgrv'>&#164; GRV</a></li>
      <li><a href='#'>&#187; Approval</a>
        <ul>
            <li><a href='?module=msproduct&act=appmsproduct'>&#164; Product</a></li>
        </ul>
      </li>
    </ul>
  </li>             
  <li><a href='?module=mstmr'>TMR</a></li>
  <li><a href='?module=questioner'>Questioner</a></li>      
  <li><a href='#'>Dashboard</a>
        <ul>
        <li><a href='?module=dashdailybooking'>&#164; Daily Booking</a></li>
        <li><a href='?module=dashdepartment'>&#164; Department</a></li> 
        <li><a href='?module=dashcustomer'>&#164; Customer</a></li>                                   
        </ul> 
  </li> 
  <li><a href='#'>Report</a>
    <ul>             
      <li><a href='#'>&#187; Sales</a>      
            <ul>
            <li><a href='?module=rptproduct'>&#164; Destination</a></li>
            <!--<li><a href='#'>&#187; Destination</a>
                <ul>
                <li><a href='?module=rptdivgroup'>&#164; POS</a></li>
                <li><a href='?module=rptproduct'>&#164; Product</a></li>                               
                </ul> 
            </li>-->
            <li><a href='?module=rptdivision'>&#164; POS</a></li>
            <li><a href='?module=rpttc'>&#164; Tour Consultant</a></li>
            <li><a href='?module=rpttourcode'>&#164; Tour Code</a></li>
            <li><a href='?module=rpsalesex'>&#164; Exhibition</a></li>
            <!--<li><a href='?module=rptbooking'>&#164; Product</a></li>                                                         
            <li><a href='?module=rptrealisasi'>&#164; Realisasi</a></li>-->
            <!--<li><a href='?module=bestsbo'>&#164; Best SBO</a></li>-->    
            </ul>   
      </li>
      <li><a href='#'>&#187; Operation</a>
            <ul>
            <li><a href='?module=rptairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptsummary'>&#164; Agent</a></li>
            <li><a href='?module=rpttoday'>&#164; Daily Status</a></li>
            <li><a href='?module=rpttl'>&#164; Tour Leader</a></li>
            </ul>   
      </li>
      <li><a href='#'>&#187; Yearly Report</a>
      <ul>
            <li><a href='?module=rptyearairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptyearairlinesnew'>&#164; Airlines (PNR)</a></li>
            <li><a href='?module=rptyeardest'>&#164; Destination</a></li>
            <li><a href='?module=rptyeardept'>&#164; Department</a></li>
            <li><a href='?module=rptyearpos'>&#164; POS</a></li>
            </ul>   
      </li>
      <li><a href='?module=rptquestioner'>&#164; Questioner</a></li>
      <li><a href='?module=rptgrv'>&#164; GRV</a></li>
      <li><a href='?module=rptvbonus'>&#164; Voucher Bonus</a></li>
      <!--<li><a href='#'>&#187; Target vs actual</a>
            <ul>
              <li><a href='?module=rptinc'>&#164; Destination</a></li>                    
            </ul>   
      </li>-->                  
    </ul>
  </li>
  <li><a href='#'>Search</a>
    <ul>
      <li><a href='?module=searchdata'>&#164; Booking</a></li>  
      <li><a href='?module=searchbooking'>&#164; Product</a></li>
      <li><a href='?module=searchpaxname'>&#164; Pax Name</a></li>
    </ul>
  </li>
  <li><a href='?module=fntest'>Info</a></li>
  <li><a href='#'>Setup</a> 
    <ul>
      <li><a href='?module=information'>&#164; News Update</a></li>
      <li><a href='?module=dtpameran'>&#164; Exhibition</a></li>
      <li><a href='?module=dtiklan'>&#164; Advertisement</a></li>     
      <li><a href='#'>&#187; General</a>
        <ul>   
      <!--  <li><a href='?module=msdivision'>&#164; Division</a></li>
        <li><a href='?module=msemployee'>&#164; Employee</a></li> -->
        <li><a href='?module=msairlines'>&#164; Airlines</a></li>     
        <li><a href='?module=mscountry'>&#164; Destination</a></li> 
        <li><a href='?module=mshotel'>&#164; Hotel</a></li>
        <li><a href='?module=msproducttype'>&#164; Product Department</a></li> 
        <li><a href='?module=mssupplier'>&#164; Supplier</a></li>      
        <li><a href='?module=msseason'>&#164; Season</a></li>
        <li><a href='?module=mstourleader'>&#164; Tour Leader</a></li> 
        <li><a href='?module=msvisagroup'>&#164; Visa Time Frame</a></li>         
        </ul>
      </li>  
      <li><a href='#'>&#187; Sales</a>
        <ul>                                                                              
        <li><a href='#'>&#187; Target</a>
            <ul>
            <li><a href='?module=mstarget'>&#164; Target POS</a></li>   
            <li><a href='?module=mstargetpw'>&#164; Target PW</a></li>
            </ul>
        </li>  
        </ul>
      </li>
      <li><a href='#'>&#187; Product</a>
        <ul>                                                                              
        <li><a href='?module=msproductcode'>&#164; Product Code</a></li>
        <li><a href='?module=msgroup'>&#164; Product Type</a></li>    
        <li><a href='?module=tandc'>&#164; TMR T&C</a></li>
        </ul>
      </li>
      <li><a href='?module=sendemail'>&#164; Send Email</a></li>    
    </ul>
  </li>	
  
  
<?php 
    } else if($ltm_authority=='LEISURE SALES SUPPORT'){
    ?>    
    <li><a href='?module=home'>Home</a></li>
    <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li>                                
    </ul> 
  </li>
  <li><a href='#'>L T M</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Sales</a>      
            <ul>
            <li><a href='#'>&#187; New Booking</a>
                <ul>
                <?php
                $gr=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
                while($grp=mysql_fetch_array($gr)){echo"
                    <li><a href='?module=msbooking&group=$grp[IDGroup]'>&#164; $grp[GroupName]</a></li>";     
                }   
               ?>                               
                </ul> 
            </li>
            <li><a href='?module=msbookingdetail'>&#164; Booking Details</a></li>
            <li><a href='?module=duplicatebook'>&#164; Duplicate Booking</a></li>
            <li><a href='?module=formbookingtour'>&#164; Tour Reservation Form</a></li>                  
            </ul>   
      </li>
    </ul>
  </li>      
  <li><a href='?module=mstmr'>TMR</a></li>
  <li><a href='?module=questioner'>Questioner</a></li>  
   <li><a href='#'>Report</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Sales</a>      
            <ul>
                <li><a href='?module=rptproduct'>&#164; Destination</a></li>
                <!--<li><a href='#'>&#187; Destination</a>
                    <ul>
                    <li><a href='?module=rptdivgroup'>&#164; POS</a></li>
                    <li><a href='?module=rptproduct'>&#164; Product</a></li>
                    </ul>
                </li>-->
                <li><a href='?module=rptdivision'>&#164; POS</a></li>
            <li><a href='?module=rpttc'>&#164; Tour Consultant</a></li>
            <li><a href='?module=rpttourcode'>&#164; Tour Code</a></li>
            <li><a href='?module=rpsalesex'>&#164; Exhibition</a></li>
            <!--<li><a href='?module=rptbooking'>&#164; Product</a></li>-->                                                         
            <!--<li><a href='?module=bestsbo'>&#164; Best SBO</a></li>-->    
            </ul>   
      </li>
      <li><a href='#'>&#187; Operation</a>
            <ul>
            <li><a href='?module=rptairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptsummary'>&#164; Agent</a></li>
            <li><a href='?module=rpttoday'>&#164; Daily Status</a></li>
            </ul>   
      </li>
      <li><a href='#'>&#187; Yearly Report</a>
      <ul>
            <li><a href='?module=rptyearairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptyearairlinesnew'>&#164; Airlines (PNR)</a></li>
            <li><a href='?module=rptyeardest'>&#164; Destination</a></li>
            <li><a href='?module=rptyeardept'>&#164; Department</a></li>
            <li><a href='?module=rptyearpos'>&#164; POS</a></li>
            </ul>   
      </li>
      <li><a href='?module=rptquestioner'>&#164; Questioner</a></li>
      <!--<li><a href='#'>&#187; Target vs actual</a>
            <ul>
              <li><a href='?module=rptinc'>&#164; Destination</a></li>                    
            </ul>   
      </li>-->                  
    </ul>
  </li>
  <li><a href='#'>Search</a>
    <ul>
      <li><a href='?module=searchdata'>&#164; Booking</a></li>
      <li><a href='?module=searchbooking'>&#164; Product</a></li>
      <li><a href='?module=searchpaxname'>&#164; Pax Name</a></li>
    </ul>
  </li>
  <li><a href='?module=fntest'>Info</a></li>
  <li><a href='#'>Setup</a> 
      <ul>
      <li><a href='?module=dtpameran'>&#164; Exhibition</a></li>
      <li><a href='?module=dtiklan'>&#164; Advertisement</a></li> 
      <li><a href='#'>&#187; Sales</a>
        <ul>                                                                              
        <li><a href='#'>&#187; Target</a>
            <ul>
            <li><a href='?module=mstarget'>&#164; Target POS</a></li>   
            <li><a href='?module=mstargetpw'>&#164; Target PW</a></li>
            </ul>
        </li>  
        </ul>
      </li>
      </ul>
  </li>
  
<?php 
    }else if($ltm_authority=='LEISURE OPERATION'){
    ?>    
     <li><a href='?module=home'>Home</a></li>
     <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li>                                
    </ul> 
  </li>
  <li><a href='#'>L T M</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Operation</a>      
            <ul>
            <li><a href='?module=msvoucher'>&#164; Bonus Manage</a></li>
            <li><a href='?module=opbookingdetail'>&#164; Booking Manage</a></li>
            <li><a href='?module=opbookingdetail&act=deviasi'>&#164; Deviasi list</a></li>
            <li><a href='?module=group'>&#164; Group Manage</a></li>   
            <li><a href='#'>&#187; Group List</a>
                <ul>
                <li><a href='?module=rptnamelist'>&#164; Name List</a></li>
                <li><a href='?module=rptpassportlist'>&#164; Passport List</a></li>
                <li><a href='?module=rptroominglist'>&#164; Rooming List</a></li>
                <li><a href='?module=rptgrpdep'>&#164; Group Departure</a></li>     
                <li><a href='?module=rptlugagetag'>&#164; Luggage Tag</a></li>                                
                </ul> 
            </li>     
            <li><a href='?module=msbookingdetail&act=ltmbook'>&#164; Internal Booking</a></li>                  
            <li><a href='?module=mstlassign'>&#164; TL Assignment</a></li>
            <li><a href='?module=rptvisa'>&#164; Visa</a></li>              
            </ul>   
      </li>
      <li><a href='?module=msgrv'>&#164; GRV</a></li>
    </ul>
  </li>      
  <li><a href='?module=mstmr'>TMR</a></li>
  <li><a href='?module=questioner'>Questioner</a></li>   
   <li><a href='#'>Report</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Sales</a>      
            <ul>
                <li><a href='?module=rptproduct'>&#164; Destination</a></li>
                <!--<li><a href='#'>&#187; Destination</a>
                    <ul>
                    <li><a href='?module=rptdivgroup'>&#164; POS</a></li>
                    <li><a href='?module=rptproduct'>&#164; Product</a></li>
                    </ul>
                </li>-->
                <li><a href='?module=rptdivision'>&#164; POS</a></li>
            <li><a href='?module=rpttc'>&#164; Tour Consultant</a></li>
            <li><a href='?module=rpttourcode'>&#164; Tour Code</a></li>
            <li><a href='?module=rpsalesex'>&#164; Exhibition</a></li>
            <!--<li><a href='?module=rptbooking'>&#164; Product</a></li>-->                                                        
            <!--<li><a href='?module=bestsbo'>&#164; Best SBO</a></li>-->    
            </ul>   
      </li>
      <li><a href='#'>&#187; Operation</a>
            <ul>
            <li><a href='?module=rptairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptsummary'>&#164; Agent</a></li>
            <li><a href='?module=rpttoday'>&#164; Daily Status</a></li>
            <li><a href='?module=rpttl'>&#164; Tour Leader</a></li>
            </ul>   
      </li>
      <li><a href='#'>&#187; Yearly Report</a>
      <ul>
            <li><a href='?module=rptyearairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptyearairlinesnew'>&#164; Airlines (PNR)</a></li>
            <li><a href='?module=rptyeardest'>&#164; Destination</a></li>
            <li><a href='?module=rptyeardept'>&#164; Department</a></li>
            <li><a href='?module=rptyearpos'>&#164; POS</a></li>
            </ul>   
      </li>
      <li><a href='?module=rptquestioner'>&#164; Questioner</a></li>
      <!--<li><a href='#'>&#187; Target vs actual</a>
            <ul>
              <li><a href='?module=rptinc'>&#164; Destination</a></li>                    
            </ul>   
      </li>-->                  
    </ul>
  </li>
  <li><a href='#'>Search</a>
    <ul>
      <li><a href='?module=searchdata'>&#164; Booking</a></li>
      <li><a href='?module=searchbooking'>&#164; Product</a></li>
      <li><a href='?module=searchpaxname'>&#164; Pax Name</a></li>
    </ul>
  </li>
  <li><a href='?module=fntest'>Info</a></li>
  <li><a href='#'>Setup</a>
    <ul>                                                            
      <li><a href='#'>&#187; General</a>
        <ul>                                                        
        <li><a href='?module=msairlines'>&#164; Airlines</a></li>     
        <li><a href='?module=mscountry'>&#164; Destination</a></li> 
        <li><a href='?module=mshotel'>&#164; Hotel</a></li>
        <li><a href='?module=msproducttype'>&#164; Product Department</a></li> 
        <li><a href='?module=mssupplier'>&#164; Supplier</a></li>      
        <li><a href='?module=msseason'>&#164; Season</a></li>
        <li><a href='?module=mstourleader'>&#164; Tour Leader</a></li> 
        <li><a href='?module=msvisagroup'>&#164; Visa Time Frame</a></li>        
        </ul>
      </li>  
      <li><a href='#'>&#187; Sales</a>
        <ul>                                                                              
        <li><a href='#'>&#187; Target</a>
            <ul>
            <li><a href='?module=mstarget'>&#164; Target POS</a></li>   
            <li><a href='?module=mstargetpw'>&#164; Target PW</a></li>
            </ul>
        </li>  
        </ul>
      </li>
    </ul>
  </li>
  
<?php 
    }else if($ltm_authority=='LEISURE PRODUCT'){
    ?>    
    <li><a href='?module=home'>Home</a></li>
    <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li>                                 
    </ul> 
  </li>
  <li><a href='#'>L T M</a>
    <ul>                                                         
      <li><a href='#'>&#187; Product</a>      
            <ul>
            <li><a href='?module=msproduct'>&#164; Product</a></li>                  
            </ul>   
      </li>         
    </ul>
  </li>      
  <li><a href='?module=mstmr'>TMR</a></li>
  <li><a href='?module=questioner'>Questioner</a></li>  
   <li><a href='#'>Report</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Sales</a>      
            <ul>
                <li><a href='?module=rptproduct'>&#164; Destination</a></li>
                <!--<li><a href='#'>&#187; Destination</a>
                    <ul>
                    <li><a href='?module=rptdivgroup'>&#164; POS</a></li>
                    <li><a href='?module=rptproduct'>&#164; Product</a></li>
                    </ul>
                </li>-->
                <li><a href='?module=rptdivision'>&#164; POS</a></li>
            <li><a href='?module=rpttc'>&#164; Tour Consultant</a></li>
            <li><a href='?module=rpttourcode'>&#164; Tour Code</a></li>
            <li><a href='?module=rpsalesex'>&#164; Exhibition</a></li>
            <!--<li><a href='?module=rptbooking'>&#164; Product</a></li>-->                                                        
            <!--<li><a href='?module=bestsbo'>&#164; Best SBO</a></li>-->    
            </ul>   
      </li>
      <li><a href='#'>&#187; Operation</a>
            <ul>
            <li><a href='?module=rptairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptsummary'>&#164; Agent</a></li>
            <li><a href='?module=rpttoday'>&#164; Daily Status</a></li>
            </ul>   
      </li>
      <li><a href='#'>&#187; Yearly Report</a>
      <ul>
            <li><a href='?module=rptyearairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptyearairlinesnew'>&#164; Airlines (PNR)</a></li>
            <li><a href='?module=rptyeardest'>&#164; Destination</a></li>
            <li><a href='?module=rptyeardept'>&#164; Department</a></li>
            <li><a href='?module=rptyearpos'>&#164; POS</a></li>
            </ul>   
      </li>
      <li><a href='?module=rptquestioner'>&#164; Questioner</a></li>
      <!--<li><a href='#'>&#187; Target vs actual</a>
            <ul>
              <li><a href='?module=rptinc'>&#164; Destination</a></li>                    
            </ul>   
      </li>-->                  
    </ul>
  </li>
  <li><a href='#'>Search</a>
    <ul>
      <li><a href='?module=searchdata'>&#164; Booking</a></li>
      <li><a href='?module=searchbooking'>&#164; Product</a></li>
      <li><a href='?module=searchpaxname'>&#164; Pax Name</a></li>
    </ul>
  </li>
  <li><a href='?module=fntest'>Info</a></li>
  <li><a href='#'>Setup</a> 
    <ul>
      <li><a href='#'>&#187; General</a>
        <ul>                                                        
        <li><a href='?module=msairlines'>&#164; Airlines</a></li>     
        <li><a href='?module=mscountry'>&#164; Destination</a></li> 
        <li><a href='?module=mshotel'>&#164; Hotel</a></li>
        <li><a href='?module=msproducttype'>&#164; Product Department</a></li> 
        <li><a href='?module=mssupplier'>&#164; Supplier</a></li>      
        <li><a href='?module=msseason'>&#164; Season</a></li>
        <li><a href='?module=mstourleader'>&#164; Tour Leader</a></li> 
        <li><a href='?module=msvisagroup'>&#164; Visa Time Frame</a></li>        
        </ul>
      </li>  
      <li><a href='#'>&#187; Sales</a>
        <ul>                                                                              
        <li><a href='#'>&#187; Target</a>
            <ul>
            <li><a href='?module=mstarget'>&#164; Target POS</a></li>   
            <li><a href='?module=mstargetpw'>&#164; Target PW</a></li>
            </ul>
        </li>  
        </ul>
      </li>
      <li><a href='#'>&#187; Product</a>
        <ul>                                                                              
        <li><a href='?module=msproductcode'>&#164; Product Code</a></li>
        <li><a href='?module=msproducttype'>&#164; Product Type</a></li>
        <li><a href='?module=tandc'>&#164; TMR T&C</a></li>
        </ul>
      </li>    
    </ul>
  </li>
<?php 
    }else if($ltm_authority=='LEISURE TRAVEL MANAGEMENT' OR $ltm_authority=='LEISURE ADMINISTRATOR'){
    ?>    
    <li><a href='?module=home'>Home</a></li>
    <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li>                                
    </ul> 
  </li>
  <li><a href='#'>L T M</a>
    <ul>                                                         
      <li><a href='#'>&#187; Product</a>      
            <ul>
            <li><a href='?module=msproduct'>&#164; Product</a></li>                  
            </ul>   
      </li>
                                                             
      <li><a href='#'>&#187; Operation</a>      
            <ul>
            <li><a href='?module=msvoucher'>&#164; Bonus Manage</a></li>
            <li><a href='?module=opbookingdetail'>&#164; Booking Manage</a></li>
            <li><a href='?module=opbookingdetail&act=deviasi'>&#164; Deviasi list</a></li>
            <li><a href='?module=group'>&#164; Group Manage</a></li>   
            <li><a href='#'>&#187; Group List</a>
                <ul>
                <li><a href='?module=rptnamelist'>&#164; Name List</a></li>
                <li><a href='?module=rptpassportlist'>&#164; Passport List</a></li>
                <li><a href='?module=rptroominglist'>&#164; Rooming List</a></li>
                <li><a href='?module=rptgrpdep'>&#164; Group Departure</a></li>   
                <li><a href='?module=rptlugagetag'>&#164; Luggage Tag</a></li>                                
                </ul> 
            </li>     
            <li><a href='?module=msbookingdetail&act=ltmbook'>&#164; Internal Booking</a></li>                  
            <li><a href='?module=mstlassign'>&#164; TL Assignment</a></li>
            <li><a href='?module=rptvisa'>&#164; Visa</a></li>                
            </ul>   
      </li>
                                                         
      <li><a href='#'>&#187; Sales</a>      
            <ul>
            <li><a href='#'>&#187; New Booking</a>
                <ul>
                <?php
                $gr=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
                while($grp=mysql_fetch_array($gr)){echo"
                    <li><a href='?module=msbooking&group=$grp[IDGroup]'>&#164; $grp[GroupName]</a></li>";     
                }   
               ?>                               
                </ul> 
            </li>
            <li><a href='?module=msbookingdetail'>&#164; Booking Details</a></li>
            <li><a href='?module=duplicatebook'>&#164; Duplicate Booking</a></li>
            <li><a href='?module=formbookingtour'>&#164; Tour Reservation Form</a></li>                  
            </ul>   
      </li>
      <li><a href='?module=msgrv'>&#164; GRV</a></li>
      <?PHP
        if($ltm_authority=='LEISURE ADMINISTRATOR'){?>
        <li><a href='#'>&#187; Approval</a>
            <ul>
                <li><a href='?module=msproduct&act=appmsproduct'>&#164; Product</a></li>
            </ul>
        </li>
        <?PHP
        }?>
    </ul>
  </li>      
  <li><a href='?module=mstmr'>TMR</a></li> 
  <li><a href='?module=questioner'>Questioner</a></li> 
  <li><a href='#'>Dashboard</a>
        <ul>
        <li><a href='?module=dashdailybooking'>&#164; Daily Booking</a></li>
        <li><a href='?module=dashdepartment'>&#164; Department</a></li>
        <li><a href='?module=dashcustomer'>&#164; Customer</a></li>                                    
        </ul> 
  </li> 
  <li><a href='#'>Report</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Sales</a>      
            <ul>
                <li><a href='?module=rptproduct'>&#164; Destination</a></li>
                <!--<li><a href='#'>&#187; Destination</a>
                    <ul>
                    <li><a href='?module=rptdivgroup'>&#164; POS</a></li>
                    <li><a href='?module=rptproduct'>&#164; Product</a></li>
                    </ul>
                </li>-->
                <li><a href='?module=rptdivision'>&#164; POS</a></li>
            <li><a href='?module=rpttc'>&#164; Tour Consultant</a></li>
            <li><a href='?module=rpttourcode'>&#164; Tour Code</a></li>
            <li><a href='?module=rpsalesex'>&#164; Exhibition</a></li>
            <!--<li><a href='?module=rptbooking'>&#164; Product</a></li>-->                                                          
            <!--<li><a href='?module=bestsbo'>&#164; Best SBO</a></li>-->    
            </ul>   
      </li>
      <li><a href='#'>&#187; Operation</a>
            <ul>
            <li><a href='?module=rptairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptsummary'>&#164; Agent</a></li>
            <li><a href='?module=rpttoday'>&#164; Daily Status</a></li>
            <li><a href='?module=rpttl'>&#164; Tour Leader</a></li>
            </ul>   
      </li>
      <li><a href='#'>&#187; Yearly Report</a>
      <ul>
            <li><a href='?module=rptyearairlines'>&#164; Airlines</a></li>
            <li><a href='?module=rptyearairlinesnew'>&#164; Airlines (PNR)</a></li>
            <li><a href='?module=rptyeardest'>&#164; Destination</a></li>
            <li><a href='?module=rptyeardept'>&#164; Department</a></li>
            <li><a href='?module=rptyearpos'>&#164; POS</a></li>
            </ul>   
      </li>
      <li><a href='?module=rptquestioner'>&#164; Questioner</a></li>
      <!--<li><a href='#'>&#187; Target vs actual</a>
            <ul>
              <li><a href='?module=rptinc'>&#164; Destination</a></li>                    
            </ul>   
      </li>-->                  
    </ul>
  </li>
  <li><a href='#'>Search</a>
    <ul>
      <li><a href='?module=searchdata'>&#164; Booking</a></li>
      <li><a href='?module=searchbooking'>&#164; Product</a></li>
      <li><a href='?module=searchpaxname'>&#164; Pax Name</a></li>
    </ul>
  </li>
  <li><a href='?module=fntest'>Info</a></li>
  <li><a href='#'>Setup</a> 
    <ul>
      <li><a href='?module=information'>&#164; News Update</a></li>
      <li><a href='?module=dtpameran'>&#164; Exhibition</a></li>
      <li><a href='?module=dtiklan'>&#164; Advertisement</a></li>     
      <li><a href='#'>&#187; General</a>
        <ul>                                                       
        <li><a href='?module=msairlines'>&#164; Airlines</a></li>     
        <li><a href='?module=mscountry'>&#164; Destination</a></li> 
        <li><a href='?module=mshotel'>&#164; Hotel</a></li>
        <li><a href='?module=msproducttype'>&#164; Product Department</a></li> 
        <li><a href='?module=mssupplier'>&#164; Supplier</a></li>      
        <li><a href='?module=msseason'>&#164; Season</a></li>
        <li><a href='?module=mstourleader'>&#164; Tour Leader</a></li> 
        <li><a href='?module=msvisagroup'>&#164; Visa Time Frame</a></li>        
        </ul>
      </li>  
      <li><a href='#'>&#187; Sales</a>
        <ul>                                                                              
        <li><a href='#'>&#187; Target</a>
            <ul>
            <li><a href='?module=mstarget'>&#164; Target POS</a></li>   
            <li><a href='?module=mstargetpw'>&#164; Target PW</a></li>
            </ul>
        </li>  
        </ul>
      </li>
      <li><a href='#'>&#187; Product</a>
        <ul>                                                                              
        <li><a href='?module=msproductcode'>&#164; Product Code</a></li>
        <li><a href='?module=msproducttype'>&#164; Product Type</a></li>
        <li><a href='?module=tandc'>&#164; TMR T&C</a></li>
        </ul>
      </li>    
    </ul>
  </li>
  <!-- Start Siscom operation 1-->


<?php 
    }else if($ltm_authority=='SISCOM OPERATION'){
    ?>    
     <li><a href='?module=home'>Home</a></li>
     <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li>                                
    </ul> 
  </li>
  <li><a href='#'>L T M</a>
    <ul>                                                         
      
      <li><a href='#'>&#187; Operation</a>      
            <ul>
            <li><a href='?module=groupsiscom'>&#164; Group Manage</a></li>
            </ul>   
      </li>
      <li><a href='?module=msgrv'>&#164; GRV</a></li>
    </ul>
  </li>      
  <li><a href='#'>Search</a>
    <ul>
      <!--<li><a href='?module=searchdata'>&#164; Booking</a></li>!-->
      <li><a href='?module=searchbooking'>&#164; Product</a></li>
      <li><a href='?module=searchpaxname'>&#164; Pax Name</a></li>
    </ul>
  </li>
  <li><a href='?module=fntest'>Info</a></li>

  <!--end siscom operation accesss !-->
<?php   
  }else if($ltm_authority=='OTHERS'){
    ?>    
  <li><a href='?module=home'>Home</a></li>   
  <li><a href='#'>Daily Status</a>
    <ul>
        <li><a href='?module=dailyreport'>&#164; Booking</a></li>
        <li><a href='?module=dailysummary'>&#164; Summary</a></li>
        <li><a href='?module=pricelist'>&#164; Price List</a></li>                                
    </ul> 
  </li>
      <li><a href='#'>Sales</a>      
            <ul>
            <li><a href='#'>&#187; New Booking</a>
                <ul>
                <?php
                $gr=mysql_query("SELECT * FROM tour_msgroup where Status = 'ACTIVE' order by GroupName asc ");
                while($grp=mysql_fetch_array($gr)){echo"
                    <li><a href='?module=msbooking&group=$grp[IDGroup]'>&#164; $grp[GroupName]</a></li>";     
                }   
               ?>                               
                </ul> 
            </li>
            <li><a href='?module=msbookingdetail'>&#164; Booking Details</a></li>
            <li><a href='?module=duplicatebook'>&#164; Duplicate Booking</a></li>
            <li><a href='?module=formbookingtour'>&#164; Tour Reservation Form</a></li>                  
            </ul>   
      </li>
      <li><a href='?module=mstmr'>TMR</a></li>
      <li><a href='#'>Search</a>
    <ul>
      <li><a href='?module=searchdata'>&#164; Booking</a></li>
      <li><a href='?module=searchbooking'>&#164; Product</a></li>     
    </ul>
  </li>
    <li><a href='?module=fntest'>Info</a></li>
<?php 
    }
?>
    <li style="float: right"><?php  echo"&nbsp&nbsp"?>  
  </li> 	
  <li style="float: right" id="clock1">  
  </li>    
  <li style="float: right;"><a href='#'><?php  echo"$user ($team)"?></a>
    <ul>
      <li><a href='?module=profile'>&#164; My Profile</a></li>
      <li><a href='?module=mspassword'>&#164; Change Password</a></li>
      <li><?php  echo"<a href=\"javascript:logoff('$user')\">&#164; Log Out </a>"?></li>   
    </ul>
  </li>                                                                         
</ul>  
</div>
  