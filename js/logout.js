function logoutUser(){

    if(confirm("Are you sure you want to logout?")){

        fetch("api/logout.php")

        .then(response => response.json())

        .then(data => {

            alert(data.message);

            window.location.href = "login.html";

        })

        .catch(error => {

            console.log(error);

            alert("Server Connection Failed.");

        });

    }

}