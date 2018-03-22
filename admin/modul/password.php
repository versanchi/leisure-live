<html>
<head>
    <style type="text/css">
        h1,h2{text-align:center;}
        h1{color:#222;text-shadow:1px 1px 1px #ddd;margin-bottom:0.5em;}
        h2{color:#888;width:80%;margin:0.5em auto 30px auto;font-family:"Palantino",Georgia;font-size:80%;font-style:italic;font-weight:normal;}
        p,label, span{text-shadow:1px 1px 1px #f2f2f2;}
        label{color:#444;display:block;font-variant:small-caps;text-transform:lowercase;}
        p{font-size:77%;color:#444;}
        input{width:240px;font-size:1.5em;margin-bottom:0.75em;}
        .explanation{text-align:center;}
        a{color:#444;}
        a:hover{background:#ddd;}
        a:visited{color:#565656;}
        a:active{color:#fff;background:#444;text-shadow:none;}
        form{width:240px;margin:10px auto;border:none;}
        form ul.helper-text {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            line-height: 22px;
            color: #808080;
        }

        form ul.helper-text li.valid {
            color: #1fd34a;
        }

        form.valid input {
            border: 2px solid #1fd34a;
        }
    </style>
</head>
<body>
    <?php
    $employee_code=$_SESSION[employee_code];
    $edit=mssql_query("SELECT DivisiNO,Employee.DivisiID,EmployeeID,Category,EmployeeName,CompanyGroup,BirthDate,Password FROM [HRM].[dbo].[Employee]
                      inner join [HRM].[dbo].[Divisi] on Employee.IndexDivisi = Divisi.IndexDivisi
                      WHERE EmployeeID ='$employee_code'");
    $r=mssql_fetch_array($edit);
    $birth = date('d-m-Y', strtotime($r[BirthDate]));
    switch($_GET[act]) {
        // Tampil Visa
        default:
            if ($r[Password] == 'panorama') {
                echo "<center><font color='red'><b>PLEASE CHANGE YOUR PASSWORD FIRST</b></font></center>";
            }
            echo "
            <form name='example' onsubmit='return validateFormOnSubmit(this)' method='POST' action='?module=mspassword&act=update'>
                <input type='hidden' name='employeeid' value='$employee_code'>
                <input type='hidden' name='oldpass' value='$r[Password]'>
                <label>Birth Date </label>
                <input type='text' value='$birth'  name='birthdate' size='10' onClick=" . "cal.select(document.forms['example'].birthdate,'ActIn1','dd-MM-yyyy'); return false;" . " NAME='anchor3' ID='ActIn1' required>
                <label>Password</label>
                <input type='password' class='password' name='password' value='' id='password' required>
                <label>Confirm Password</label>
                <input type='password' name='confirmpassword' value='' id='confirmpassword' onkeyup='cekulang()' required>
                <input type='submit' name='submit' value='Update' disabled>
                <ul class='helper-text'><font size='1'>
                <li class='length'>Must be at least 8 characters long.</li>
                <li class='lowercase'>Must contain a lowercase letter.</li>
                <li class='uppercase'>Must contain an uppercase letter.</li>
                <li class='special'>Must contain a number or special character.</li></font>
                </ul>
            </form>";
            break;

        case "update":
            $employee_code = $_POST[employeeid];
            $Description = "Change password Employee (" . $employee_code . ")";
            //$pass = strtolower($_POST[password]);
            $pass1 = MD5($_POST[password]);
            $pass = SHA1($pass1);
            $birth = date('Y-m-d', strtotime($_POST[birthdate]));
            mssql_query("UPDATE [HRM].[dbo].[Employee] SET Password = '$pass',BithDate='$birth'
                               WHERE EmployeeID = '$_POST[employeeid]'");
            mysql_query("INSERT INTO tbl_logtour(EmployeeName,
                                   Description,
                                   LogTime)
                            VALUES ('$EmpName',
                                   '$Description',
                                   '$today')");
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=media.php?module=mspassword&act=success'>";
            break;

        case "success":
            echo "<center>Your Password has been changed</center>";
            break;
    }

?>
    <script type="text/javascript" charset="utf-8">
        (function(){
            var password = document.querySelector('.password');

            var helperText = {
                charLength: document.querySelector('.helper-text .length'),
                lowercase: document.querySelector('.helper-text .lowercase'),
                uppercase: document.querySelector('.helper-text .uppercase'),
                special: document.querySelector('.helper-text .special')
            };

            var pattern = {
                charLength: function() {
                    if( password.value.length >= 8 ) {
                        return true;
                    }
                },
                lowercase: function() {
                    var regex = /^(?=.*[a-z]).+$/; // Lowercase character pattern

                    if( regex.test(password.value) ) {
                        return true;
                    }
                },
                uppercase: function() {
                    var regex = /^(?=.*[A-Z]).+$/; // Uppercase character pattern

                    if( regex.test(password.value) ) {
                        return true;
                    }
                },
                special: function() {
                    var regex = /^(?=.*[0-9_\W]).+$/; // Special character or number pattern

                    if( regex.test(password.value) ) {
                        return true;
                    }
                }
            };

            // Listen for keyup action on password field
            password.addEventListener('keyup', function (){
                // Check that password is a minimum of 8 characters
                patternTest( pattern.charLength(), helperText.charLength );

                // Check that password contains a lowercase letter
                patternTest( pattern.lowercase(), helperText.lowercase );

                // Check that password contains an uppercase letter
                patternTest( pattern.uppercase(), helperText.uppercase );

                // Check that password contains a number or special character
                patternTest( pattern.special(), helperText.special );

                // Check that all requirements are fulfilled
                if( hasClass(helperText.charLength, 'valid') &&
                    hasClass(helperText.lowercase, 'valid') &&
                    hasClass(helperText.uppercase, 'valid') &&
                    hasClass(helperText.special, 'valid')
                ) {
                    addClass(password.parentElement, 'valid');
                    if(document.example.elements['confirmpassword'].value.length > 0) {
                        if (document.example.elements['password'].value == document.example.elements['confirmpassword'].value
                        ) {
                            document.example.elements['submit'].disabled = false;
                        }
                        else {
                            document.example.elements['submit'].disabled = true;
                        }
                    }
                }
                else {
                    removeClass(password.parentElement, 'valid');
                    //document.example.elements['submit'].disabled=true;
                }
            });

            function patternTest(pattern, response) {
                if(pattern) {
                    addClass(response, 'valid');
                }
                else {
                    removeClass(response, 'valid');
                }
            }

            function addClass(el, className) {
                if (el.classList) {
                    el.classList.add(className);
                }
                else {
                    el.className += ' ' + className;
                }
            }

            function removeClass(el, className) {
                if (el.classList)
                    el.classList.remove(className);
                else
                    el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
            }

            function hasClass(el, className) {
                if (el.classList) {
                    console.log(el.classList);
                    return el.classList.contains(className);
                }
                else {
                    new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
                }
            }

        })();
        function validateFormOnSubmit(theForm) {
            var reason = "";
            reason += validateCek(theForm.birthdate);
            reason += validateIsi(theForm.password);
            if (reason != "") {
                alert("Attention:\n" + reason);
                return false;
            }

            return true;
        }
        function validateIsi(fld) {
            var error = "";
            var confpass = example.confirmpassword;
            var oldpass = example.oldpass;
            var pass1 = fld.value;
            var pass = pass1.toLowerCase();

            if(pass == 'panorama' ){
                fld.style.background = 'Yellow';
                error = "Please DONT use PANORAMA.\n"
            }else if(fld.value != confpass.value ){
                confpass.style.background = 'Yellow';
                error = "Re-enter Your Password.\n"
            }else if(fld.value == oldpass.value ){
                fld.style.background = 'Yellow';
                error = "Please enter NEW Password.\n"
            }else{
                confpass.style.background = 'white';
            }

            return error;
        }
        function validateCek(fld) {
            var error = "";
            if(fld.value=='00-00-0000'){
                fld.style.background = 'Yellow';
                error = "Please Input Your Birth Date.\n"
            }else{
                fld.style.background = 'White';
            }
            return error;
        }
        function cekulang() {
            if( document.example.elements['password'].value == document.example.elements['confirmpassword'].value
                ) {
                document.example.elements['submit'].disabled = false;
            }
                else {
                document.example.elements['submit'].disabled = true;
            }
        }
    </script>
</body>
</html>