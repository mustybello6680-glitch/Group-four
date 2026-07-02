function submitLostFound(){

    let item=document.getElementById("item").value.trim();
    let category=document.getElementById("category").value;
    let description=document.getElementById("description").value.trim();
    let location=document.getElementById("location").value.trim();

    if(item==""||category==""||description==""||location==""){

        alert("Please complete all fields.");

        return;

    }

    fetch("api/lostfound.php",{

        method:"POST",

        headers:{

            "Content-Type":"application/json"

        },

        body:JSON.stringify({

            item:item,
            category:category,
            description:description,
            location:location

        })

    })

    .then(response=>response.json())

    .then(data=>{

        alert(data.message);

        if(data.success){

            document.getElementById("lostForm").reset();

        }

    })

    .catch(error=>{

        console.log(error);

        alert("Server Connection Failed.");

    });

}