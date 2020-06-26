window.addEventListener('load',(event)=>{
    document.getElementById("frmLogin").addEventListener("submit",(event)=> {
            event.preventDefault();
            check(event.target);
        }
    )});

function check(form){
    let suggest = ["Username non inserito",
        "Password non inserito"];
    let name = document.getElementById('uname').value;
    let pwd = document.getElementById('password').value;


    console.log("function");
    if(name===""){
        document.getElementById('usernamep').innerHTML=suggest[0];

    }
    else {
        if(pwd===""){
            document.getElementById('passwordp').innerHTML=suggest[1];

        }
        else {

            form.submit();
        }
    }

}


