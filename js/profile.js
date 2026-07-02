window.onload = function () {

    fetch("api/profile.php")

    .then(function(response){

        return response.json();

    })

    .then(function(data){

        if(data.success){

            document.getElementById("fullname").innerHTML = data.fullname;
            document.getElementById("regno").innerHTML = data.regno;
            document.getElementById("email").innerHTML = data.email;
            document.getElementById("phone").innerHTML = data.phone;
            document.getElementById("faculty").innerHTML = data.faculty;
            document.getElementById("department").innerHTML = data.department;
            document.getElementById("level").innerHTML = data.level;

        }else{

            alert(data.message);

            window.location.href = "login.html";

        }

    })

    .catch(function(error){

        console.error(error);

        alert("Server Connection Failed.");

    });

}