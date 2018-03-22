<script language="JavaScript"  type="text/javascript">
     
function delfile(ID, Competitor)
{
if (confirm("Are you sure you want to delete "+Competitor ))
{
 window.location.href = '?module=msproductdoc&act=delete&id=' + ID;
 
} 
}
</script>
<?php 
switch($_GET[act]){
  // Tampil Product
  default:
    echo "<h2>Category</h2>
          <input type=button value='Add' onclick=location.href='?module=msproductdoc&act=tambahmsproductdoc'>
          <table>
          <tr><th>no</th><th>product</th><th>aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM product  ORDER BY prodname ASC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>  
             <td>$r[prodname]</td>
             <td><a href=?module=msproductdoc&act=editmsproductdoc&id=$r[prodid]>Edit</a> 
             | <a href=\"javascript:delfile('$r[prodid]','$r[prodname]')\">Delete</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  case "tambahmsproductdoc":
    echo "<h2>Add Categoty</h2>
          <form method=POST action='./aksi.php?module=msproductdoc&act=input'>
          <table> 		  
          <tr><td>Product</td> <td> : <input type=text name='prodname' size=30></td></tr>  
          <tr><td colspan=2><input type=submit value=Save>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;
    
  case "editmsproductdoc":
    $edit=mysql_query("SELECT * FROM product WHERE prodid ='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Category</h2>
          <form method=POST action=./aksi.php?module=msproductdoc&act=update>
          <input type=hidden name=id value='$r[prodid]'>
          <table>
          <tr><td>Product</td> <td>  <input type=text name='prodname' size=30  value='$r[prodname]'></td></tr>
          <tr><td colspan=2><center><input type=submit value=Update>
                            <input type=button value=Cancel onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
    
    case "delete":
    $edit=mysql_query("DELETE FROM  product WHERE prodid = '$_GET[id]'");              
     echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=msproductdoc'>";   
     break;
}
?>
