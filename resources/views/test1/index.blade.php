<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
    <title>JQuery</title>
</head>
<body class="bg-orange-50">
    <div class="m-10 p-10 shadow-xl rounded-xl bg-white">
        <h1 class="font-bold text-2xl mb-4 underline underline-offset-2">JQuery</h1>
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
                <input class="border rounded my-4" type="text" id="first_name" name="first_name">
                <label for="last_name"></label>
                <input class="border rounded my-4" type="text" id="last_name" name="last_name">
                <div class="flex w-full justify-between">
                    <button class="w-20 cursor-pointer bg-green-400 text-white p-2 m-2 rounded-sm" id="submitForm">Submit</button>
                    <button class="w-20 cursor-pointer bg-gray-400 text-white p-2 m-2 rounded-sm" id="closeForm">Back</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        $("#openForm").click(function(){
            ToggleForm();
        });
        $("#submitForm").click(function(){
            //add student
            //$("#")
            /*$.ajax({url: "demo_test.txt", success: function(result){
                $("#div1").html(result);
            }});*/
            const first_name=$("#first_name").val();
            const last_name=$("#last_name").val();
            const data={"first_name":first_name,"last_name":last_name}
            AddData(data);
            ToggleForm();
        });
        $("#closeForm").click(function(){
            ToggleForm();
        });
        
        function ToggleForm(){
            $("#list").toggleClass('hidden');
            $("#form").toggleClass('hidden');
            //$("#list").toggle();
            //$("#form").toggle();
        }
        function AddData(data){
            $.ajax({
                url: 'http://localhost:8000/api/student',
                method: 'post',
                dataType: 'json',
                data: data,
                success: function(res){
                    console.log("Post data`s result:",res);
                    LoadData();
                }
            });
        }
        function LoadData(){
            $.ajax({
                url: "http://localhost:8000/api/students",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    FillList(result);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", status, error);
                }
            });
        }
        function FillList(data){
            let li="";
            data.forEach((item) => {
                li+="<li>"+item.first_name+" "+item.last_name+"</li>";
            });

            $("#list ol").html(li);
        }
        $(document).ready(function(){
            LoadData();
        });
    </script>
</body>
</html>