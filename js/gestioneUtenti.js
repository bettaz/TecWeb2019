function addUser(){
    var addUser = document.getElementById('addUser').value;
    var fPwd = document.getElementById('firstPassword').value;
    var cPwd = document.getElementById('confirmPassword').value;
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
    var pwdN = document.getElementById('passwordNuova').value;
    var nuova = document.getElementById('confirmPassword').value;

    if(pwdN===""){
        alert("Password non inserita");
    }
    if(confirm!=nuova){
        alert("Le due password non corrispondono");
    }
}