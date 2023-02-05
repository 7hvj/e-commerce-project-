var emailError = document.getElementById('email-error');
var passwordError = document.getElementById('password-error');

function vaildateEmail() {

var email = document.getElementById('contact-email').value;

   // email should not empty!
if(email.length == 0){
    emailError.style.display = 'block';
    emailError.innerHTML='Email is required';
    setTimeout(function(){emailError.style.display = 'none';}, 3000);
    return false;
}

   // email should contain @ , .com
if(!email.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/)){
    emailError.style.display = 'block';
    emailError.innerHTML='Email Invaild';
    setTimeout(function(){emailError.style.display = 'none';}, 3000);
    return false;
}

   // if both return true then
emailError.innerHTML='Vaildate';
return true;
}

function vaildatepass() {

    var password = document.getElementById('contact-pass').value;
    
       // password should not empty!
    if(password.length == 0){
        passwordError.style.display = 'block';
        passwordError.innerHTML='Password is required';
        setTimeout(function(){passwordError.style.display = 'none';}, 3000);
        return false;
    }
       // if both return true then
    passwordError.innerHTML='Vaildate';
    return true;
    }