// ==============================
// CampusConnect Registration JS
// ==============================

// Profile Image Preview
const profileImage = document.getElementById("profileImage");
const previewImage = document.getElementById("previewImage");

profileImage.addEventListener("change", function () {

    const file = this.files[0];

    if (!file) return;

    // Maximum file size = 2MB
    if (file.size > 2 * 1024 * 1024) {

        alert("Profile image must not exceed 2 MB.");

        this.value = "";

        return;

    }

    const reader = new FileReader();

    reader.onload = function (e) {

        previewImage.src = e.target.result;

    };

    reader.readAsDataURL(file);

});


// ==============================
// Register Student
// ==============================

function registerUser() {

    let fullname = document.getElementById("fullname").value.trim();
    let regno = document.getElementById("regno").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let faculty = document.getElementById("faculty").value.trim();
    let department = document.getElementById("department").value.trim();
    let level = document.getElementById("level").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    // Validate Inputs
    if (
        fullname === "" ||
        regno === "" ||
        email === "" ||
        phone === "" ||
        faculty === "" ||
        department === "" ||
        level === "" ||
        password === ""
    ) {

        alert("Please complete all fields.");

        return;

    }

    // Confirm Password
    if (password !== confirmPassword) {

        alert("Passwords do not match.");

        return;

    }

    // Create Student Object
    const student = {

        fullname: fullname,
        regno: regno,
        email: email,
        phone: phone,
        faculty: faculty,
        department: department,
        level: level,
        password: password

    };

    // Send Data to Backend
   fetch("api/register.php", {

        method: "POST",

        headers: {

            "Content-Type": "application/json"

        },

        body: JSON.stringify(student)

    })

    .then(response => response.json())

    .then(data => {

        if (data.success) {

            alert(data.message);

            window.location.href = "success.html";

        } else {

            alert(data.message);

        }

    })

    .catch(error => {

        console.error(error);

        alert("Server Connection Failed.");

    });

}