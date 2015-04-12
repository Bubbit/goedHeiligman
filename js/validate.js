function validate_aanvraag() {
      var form = document.forms['request'];
      var error = "none";
    
      var email = form.email.value;
      if(email == "") {
        error = "error";
      }
      
      if(error == "none") {
        var e = document.getElementById('submit');
        e.style.display = 'block';
        return true;
      } else {
        var e = document.getElementById('submit');
        e.style.display = 'none';
        return false;
      }   
    }
    
    function validate_piet() {
      var form = document.forms['piet'];
      var error = "none";
      var first_name = form.first_name.value;
      if(first_name == "") {
        error = "error";
      }
      var last_name = form.last_name.value;
      if(last_name == "") {
        error = "error";
      }
      var BSN = form.BSN.value;
      if(BSN == "") {
        error = "error";
      }
      var email = form.email.value;
      if(email == "") {
        error = "error";
      }
      var dob = form.date_of_birth.value;
      if(dob == "") {
        error = "error";
      }
      var phone = form.phone.value;
      if(phone == "") {
        error = "error";
      }
      
      var how = form.how.value;
      if(how == "") {
        error = "error";
      }
           
      if(error == "none") {
        var e = document.getElementById('submit');
        e.style.display = 'block';
        return true;
      } else {
        var e = document.getElementById('submit');
        e.style.display = 'none';
        return false;
      }   
    }
    
    function validate_login() {
      var form = document.forms['login'];
      var name = form.name.value;
      var pass = form.password.value;
      
      if(name == "") {
        alert("U moet een gebruikersnaam invullen");
        return false;
      }
      
      if(pass == "") {
        alert("U moet een wachtwoord opgeven");
        return false;
      }
      
      return true;
    }