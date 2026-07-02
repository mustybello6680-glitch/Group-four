function loginUser() {

    let regno = document.getElementById("regno").value.trim();
    let password = document.getElementById("password").value.trim();

    if (regno === "" || password === "") {

        alert("Please enter Registration Number and Password.");
        return;

    }

    fetch("api/login.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify({
            regno: regno,
            password: password
        })

    })

    .then(function(response) {

        return response.json();

    })

    .then(function(data) {

        if (data.success) {

            alert(data.message);

            // Redirect to Home Page
            window.location.href = "home.html";

        } else {

            alert(data.message);

        }

    })

    .catch(function(error) {

        console.error(error);

        alert("Server Connection Failed.");

    });

}