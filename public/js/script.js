const form = document.getElementById("form");
const email = document.getElementById("email");
const password = document.getElementById("password");
const username = document.getElementById("username");
const setError = (element,message,validator) =>{
    validator.innerText = message;
    element.classList.add("is-invalid");
    element.classList.remove("is-valid");
}

const setSuccess = (element,validator) =>{
    validator.innerText = '';
    element.classList.add("is-valid");
    element.classList.remove("is-invalid");
}
const validateEmail = () =>
{
    let error = false;
    const email = document.getElementById("email");
    const re_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    const emailValue = email.value.trim();
    if(emailValue === '')
    {
        const message = "Please enter a Email";
        const validator = document.getElementById("email-validation");
        setError(email,message,validator);
        error = true;
    }
    else if(!re_email.test(emailValue))
    {
        const message = "Please provide a valid Email";
        const validator = document.getElementById("email-validation");
        setError(email,message,validator);
        error = true;
    }else{
        const validator = document.getElementById("email-validation");
        setSuccess(email,validator);
        error = false;
    }
    return error;
}
const validatePassword = () =>
{
    let error = false;
    const password = document.getElementById("password");
    const re_pass =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,20}$/;
    
    const passwordValue = password.value.trim();
    if(passwordValue === '')
    {
        const message = "Please enter a password";
        const validator = document.getElementById("password-validation");
        setError(password,message,validator);
        error = true;
    }else if(passwordValue.length < 8 || passwordValue.length > 20)
    {
        const message = "Password length must be between 8 and 20 characters";
        const validator = document.getElementById("password-validation");
        setError(password,message,validator);
        error = true;
    }else if(!re_pass.test(passwordValue))
    {
        const message = "Password must contain atleast one number and special character";
        const validator = document.getElementById("password-validation");
        setError(password,message,validator);
        error = true;
    }else{
        const validator = document.getElementById("password-validation");
        setSuccess(password,validator);
        error = false;
    }
    return error;
}
const validateUsername = () =>
{
    let error = false;
    const username = document.getElementById("username");
    const usernameValue = username.value.trim();
    if(usernameValue === '')
    {
        const message = "Please enter a username";
        const validator = document.getElementById("username-validation");
        setError(username,message,validator);
        error = true;
    }else{
        const validator = document.getElementById("username-validation");
        setSuccess(username,validator);
        error = false;
    }
    return error;
}
const validateInput = () =>{
    const email = validateEmail();
    const pwd = validatePassword();
    const user = validateUsername();
    return (user || email || pwd);
}
username.addEventListener("blur",e =>{
    validateUsername();
})
password.addEventListener("blur",e =>{
    validatePassword();
})
email.addEventListener("blur",e =>{
    validateEmail();
})

form.addEventListener("submit", e => {
    if(validateInput())
    {
        e.preventDefault();
    }
    
})
