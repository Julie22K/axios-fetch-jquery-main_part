<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              clifford: '#da373d',
            }
          }
        }
      }
    </script>
    <title>Fetch</title>
</head>
<body class="bg-orange-50">
    <div class="m-10 p-10 shadow-xl rounded-xl bg-white">
      <h1 class="font-bold text-2xl mb-4 underline underline-offset-2">Fetch</h1>
      <div id="list" class="transision">
        <h3 class="font-bold">Students:</h3>
        <ol class="list-decimal ml-8">
            loading...
        </ol>
        <button class="bg-sky-400 text-white p-2 m-2 cursor-pointer rounded-sm" id="openForm">Add student</button>
    </div>
    <div id="form" class="hidden transision">
        <div class="flex flex-col">
            <legend class="font-bold">Додати студента</legend>
            <label for="first_name"></label>
            <input class="border rounded my-3 h-8" type="text" id="first_name" name="first_name">
            <label for="last_name"></label>
            <input class="border rounded my-3 h-8" type="text" id="last_name" name="last_name">
            <div class="flex w-full justify-between">
                <button class="w-20 cursor-pointer bg-green-400 text-white p-2 m-2 rounded-sm" id="submitForm">Submit</button>
                <button class="w-20 cursor-pointer bg-gray-400 text-white p-2 m-2 rounded-sm" id="closeForm">Back</button>
            </div>
        </div>
    </div>
  </div>
  <script>
    //example
    /*
    document.getElementById("myDIV").addEventListener("click", function(){
      document.getElementById("demo").innerHTML = "Hello World";
    });
    
    function myFunction() {
      var element = document.getElementById("myDIV");
      element.classList.toggle("mystyle");
    }
    */

    document.getElementById("openForm").addEventListener("click", ToggleForm);
    document.getElementById("closeForm").addEventListener("click", ToggleForm);

    document.getElementById("submitForm").addEventListener("click", function(){
      //add student
      const first_name= document.getElementById("first_name").value;
        const last_name= document.getElementById("last_name").value;
        const data={"first_name":first_name,"last_name":last_name}
        //alert(data);
        AddData(data);
    });
    
    function ToggleForm(){
        document.getElementById("list").classList.toggle("hidden");
        document.getElementById("form").classList.toggle("hidden");
    }
    function AddData(data){
        fetch('http://localhost:8000/api/student', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data), 
        })
        .then(response => response.json())
        .then((data) => {
          console.log(data)
          
          ToggleForm();
          LoadData();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
    function LoadData(){
        fetch('http://localhost:8000/api/students', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
            },
            })
        .then(response => response.json())
        .then(response =>  FillList(response));
    }
    function FillList(data){
        let li="";
        data.forEach((item) => {
            li+="<li>"+item.first_name+" "+item.last_name+"</li>";
        });
        document.querySelector("#list ol").innerHTML=li;
    }
    document.addEventListener("DOMContentLoaded", function(event) { 
        LoadData();
    });
</script>
</body>
</html>