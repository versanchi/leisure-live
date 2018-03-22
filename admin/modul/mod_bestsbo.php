
<?php 
$username=$_SESSION[employee_code];
$sqluser=mysql_query("SELECT employee_name FROM tbl_msemployee WHERE employee_code='$username'");
$tampiluser=mysql_fetch_array($sqluser);
$EmpName=$tampiluser[employee_name];
$timezone_offset = -1;
$tz_adjust = ($timezone_offset * 60 * 60);
$jam = time();
$waktu = ($jam + $tz_adjust);
$today = date("Y-m-d G:i:s");
$hariini = date("Y-m-d ");
$thisyear = date("Y");
switch($_GET[act]){
  // Tampil Office
  default:
  	  
      $satu=mysql_query("SELECT Season,Year FROM tour_msproduct   
                                WHERE Status = 'PUBLISH'  
                                and DateTravelFrom > '$hariini' 
                                ORDER BY DateTravelFrom ASC LIMIT 1");
      $satu1=mysql_fetch_array($satu);
      $season=$_GET['season'];
      $year=$_GET['year'];
      if($season==''){$season=$satu1[Season];}
      if($year==''){$year=$satu1[Year];}
    echo "<h2>Report SBO Sales</h2>
          <form method=get action='media.php?'>
                <input type=hidden name=module value='bestsbo'>
              Season  <select name='season'>
            <option value='0' selected>- Select Season -</option>";         
            $tampil=mysql_query("SELECT * FROM tour_msseason ORDER BY SeasonName");
            while($r=mysql_fetch_array($tampil)){
                if($season==$r[SeasonName]){
                    echo "<option value='$r[SeasonName]' selected>$r[SeasonName]</option>";     
                }else{
                    echo "<option value='$r[SeasonName]'>$r[SeasonName]</option>"; 
                }
                
            }
    echo "</select> <select name='year'>
            <option value='0' selected>- Select Year -</option>";         
            $tamp=mysql_query("SELECT Year FROM tour_msproduct GROUP BY Year asc");
            while($rt=mysql_fetch_array($tamp)){
                if($year==$rt[Year]){
                    echo "<option value='$rt[Year]' selected>$rt[Year]</option>";     
                }else{
                    echo "<option value='$rt[Year]'>$rt[Year]</option>"; 
                }
                
            }
    echo "</select>    
              <input type=submit name=oke value=Search>
          </form>";
          $oke=$_GET['oke'];
      
     
    $tampil2=mysql_query("SELECT TCDivision,sum(AdultPax)as apax,sum(ChildPax)as cpax,(sum(AdultPax) + sum(ChildPax))as totalpax FROM tour_msbooking   
                                left join tour_msproduct on tour_msproduct.TourCode=tour_msbooking.TourCode
                                WHERE tour_msproduct.Season ='$season'
                                AND tour_msproduct.Year ='$year'
                                AND tour_msbooking.Status ='ACTIVE'       
                                and tour_msproduct.Status <> 'VOID'
                                AND tour_msbooking.TCDivision <>'LTM' 
                                GROUP BY TCDivision order by totalpax DESC,TCName ASC ");
      $muncul=mysql_num_rows($tampil2);
      if($muncul>0){
      echo"
      <table><tr><th>no</th><th width='250'>TC Name</th><th>Adult</th><th>Child</th><th>Total Pax</th></tr>";
      $n=1;           
      while($r=mysql_fetch_array($tampil2)){ 
        echo "<tr><td>$n</td>
             <td><center>$r[TCDivision]</td> 
             <td><center>$r[apax]</td>
             <td><center>$r[cpax]</td>
             <td><center>$r[totalpax]</td>    
             </tr>";
      $n++;
                                                       
    }
    echo"</table><center><input type=button value='Close' onclick=location.href='?module=home'><br><br>";}
    break;
                 
}
?>
