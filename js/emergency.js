function sendAlert(){

    let type=document.getElementById("type").value;
    let location=document.getElementById("location").value.trim();
    let description=document.getElementById("description").value.trim();

    if(type==""||location==""||description==""){

        alert("Please complete all fields.");

        return;

    }

    fetch("api/emergency.php",{

        method:"POST",

        headers:{

            "Content-Type":"application/json"

        },

        body:JSON.stringify({

            type:type,
            location:location,
            description:description

        })

    })

    .then(response=>response.json())

    .then(data=>{

        alert(data.message);

        if(data.success){

            document.getElementById("emergencyForm").reset();

        }

    })

    .catch(error=>{

        console.log(error);

        alert("Server Connection Failed.");

    });

}