function check(){
    var name = document.getElementById('uname').value;
    var pwd = document.getElementById('password').value;
    if(name===""){
        alert('Username non inserito');
    }
    if(pwd===""){
        alert('Password non inserita');
    }
}