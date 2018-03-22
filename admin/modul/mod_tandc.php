<script type="text/javascript" src="./fckeditor/ckeditor.js"></script> 
<?PHP
switch($_GET[act]){
  // Tampil Employee
  default:
  	$employee_code=$_SESSION[employee_code];  
    $edit=mysql_query("SELECT * FROM tour_tandc order by TcID asc");
    $r=mysql_fetch_array($edit);
    $BValue = $r[TCBahasa];
    $EValue = $r[TCEnglish];
    echo "<h2>TMR Terms and Condition</h2>
          <form method=POST action=./aksi.php?module=tandc&act=update>
          <input type=hidden name='id' value='$r[TcID]'>    
          <table width=900 style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <textarea cols='50' id='tcb' name='tcb' rows='5'>$BValue</textarea>
          ";?>   
           <script type="text/javascript">
            //<![CDATA[

                CKEDITOR.replace( 'tcb', {
                    extraPlugins : 'autogrow',
                    autoGrow_maxHeight : 400,
                    removePlugins : 'resize'
                });

            //]]>
            </script>
          <?PHP echo"
          </td></tr></table>      
          <br><center><input type=submit value=Update>
                            <input type=button value=Close onclick=location.href='?module=home'>
          </form>";
     break;
case "edittmr":
    $edit=mysql_query("SELECT * FROM tour_mstmrreq WHERE IDTmr = '$_GET[no]'");
    $r=mysql_fetch_array($edit);
    $BValue = $r[TnC];
    echo "<h2>TMR $r[TmrNo] Terms and Condition</h2>
          <form method=POST action=./aksi.php?module=tandc&act=updatetmr>
          <input type=hidden name='id' value='$r[IDTmr]'>
          <table width=900 style='border: 0px solid #000000;'>
          <tr><td style='border: 0px solid #000000;'>
          <textarea cols='50' id='tcb' name='tcb' rows='5'>$BValue</textarea>
          ";?>
    <script type="text/javascript">
        //<![CDATA[

        CKEDITOR.replace( 'tcb', {
            extraPlugins : 'autogrow',
            autoGrow_maxHeight : 400,
            removePlugins : 'resize'
        });

        //]]>
    </script>
    <?PHP echo"
          </td></tr></table>
          <br><center><input type=submit value=Update>
                            <input type=button value=Close onclick=location.href='?module=mstmr&act=showtmr&no=$_GET[no]'>
          </form>";
    break;
}
?>
