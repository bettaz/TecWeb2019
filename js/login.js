function check(){
    let name = document.getElementById('uname').value;
    let pwd = document.getElementById('password').value;
    if(name===""){
        alert('Username non inserito');
    }
    if(pwd===""){
        alert('Password non inserita');
    }
}