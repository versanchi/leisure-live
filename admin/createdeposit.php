<form id="login" target="frame" method="post" action="http://10.10.200.4/testingra/">
    <input type="hidden" name="username" value="login" />
    <input type="hidden" name="password" value="pass" />
</form>

<iframe src='http://10.10.200.4/testingra/' id="frame" name="frame" width='1024' height='768' frameborder='0'></iframe>
<script type="text/javascript">
    // submit the form into iframe for login into remote site
    document.getElementById('login').submit();

    // once you're logged in, change the source url (if needed)
    var iframe = document.getElementById('frame');
    iframe.onload = function() {
        if (iframe.src != "http://10.10.200.3/PTES/") {
            iframe.src = "http://10.10.200.3/PTES/";
        }
    }
</script>