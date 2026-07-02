function saveSchedule(){

    let course=document.getElementById("course").value.trim();
    let day=document.getElementById("day").value;
    let time=document.getElementById("time").value;
    let venue=document.getElementById("venue").value.trim();

    if(course==""||day==""||time==""||venue==""){

        alert("Please complete all fields.");

        return;

    }

    fetch("api/schedule.php",{

        method:"POST",

        headers:{

            "Content-Type":"application/json"

        },

        body:JSON.stringify({

            course:course,
            day:day,
            time:time,
            venue:venue

        })

    })

    .then(response=>response.json())

    .then(data=>{

        alert(data.message);

        if(data.success){

            document.getElementById("scheduleForm").reset();

        }

    })

    .catch(error=>{

        console.log(error);

        alert("Server Connection Failed.");

    });

}