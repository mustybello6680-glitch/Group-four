window.onload = function(){

fetch("api/home.php")

.then(response=>response.json())

.then(data=>{

if(data.success){

document.getElementById("welcomeName").innerHTML="Welcome, "+data.fullname;

}else{

alert(data.message);

window.location.href="login.html";

}

})

.catch(error=>{

console.log(error);

alert("Server Connection Failed.");

});

}