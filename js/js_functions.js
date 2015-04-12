<script language="javascript" type="text/javascript">
  function validate_login(formid) {
    var form = document.forms[formid];
    var name = form.name.value;
    var pass = form.password.value;
    
    // code for IE7+, Firefox, Chrome, Opera, Safari
    if (window.XMLHttpRequest)  {
      xmlhttp=new XMLHttpRequest();
    } else {
    // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        alert("lll");
        alert(xmlhttp.responseText);
      }
    }
    xmlhttp.open("GET","check_login.php?name="+name+"&pass="+pass,true);
    xmlhttp.send();
  }

</script>