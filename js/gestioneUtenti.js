function addUser(){
    let addUser = document.getElementById('addUser').value;
    let fPwd = document.getElementById('firstPassword').value;
    let cPwd = document.getElementById('confirmPassword').value;
    if(addUser===""){
        alert("Username non inserito");
    }
    if(fPwd===""){
        alert("Password non inserita");
    }
    if(cPwd===""){
        alert("Password non inserita");
    }
    if(cPwd!=fPwd){
        alert("Le due password non corrispondono");
    }
}

function updatePassword(){
    let pwdN = document.getElementById('passwordNuova').value;
    let nuova = document.getElementById('confirmPassword').value;

    if(pwdN===""){
        alert("Password non inserita");
    }
    if(confirm!=nuova){
        alert("Le due password non corrispondono");
    }
}