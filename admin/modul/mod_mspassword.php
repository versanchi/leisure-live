<?php
switch($_GET[act]) {
// Tampil Employee
    default:
        $employee_code = $_SESSION[employee_code];
        $edit = mssql_query("SELECT * FROM Employee WHERE EmployeeID = '$employee_code'");
        $r = mssql_fetch_array($edit);

        echo "<h2>Change Password</h2>
                <form method=POST action=./aksi.php?module=mspassword&act=update>
                <input type=hidden name='id' value='$r[EmployeeID]'>
                <table>
                <tr><td>Employee ID</td> <td>  <input type=text name='employee_code' size=30  value='$r[EmployeeID]' readonly></td></tr>
                <tr><td>New Password</td> <td>  <input type=password name='employee_password' size=30> </td></tr>
                <tr><td colspan=2><center><input type=submit value=Update>
                                          <input type=button value=Cancel onclick=self.history.back()></td></tr>
                </table></form>";
        break;
}
?>
