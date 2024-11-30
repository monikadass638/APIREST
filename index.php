
<html>
    <head>
        <title>API Code</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


        <div class="container  p-5 bg-primary text-white ">
            <div class="row  ">
                <div class="col-12 text-center text-white"> <h1>PHP REST API CURD</h1></div>
            </div>
        </div>
        <div class="container  p-5 text-center ">
            <form id="add-form" action="">
                <div class="row inline-block">
                    <div class="col-12 bg-success " id="success-message" ></div>
                </div>
                <div class="row">
                    <div class="col-3">
                    <input class="form-control text-center" type="text" name="sname" id="sname" placeholder="Name:">
                    </div>
                    <div class="col-3">
                    <input type="text" class="form-control text-center" name="sage" id="sage" placeholder="Age">
                    </div>
                    <div class="col-3">
                    <input type="text" class="form-control text-center" name="scity" id="scity" placeholder="city">
                    </div>
                    <div class="col-3">
                    <button id="btn-click" class="btn btn-primary btn-lg text-start">Add Record</button>
                    </div>
                
                
            </div>
            </form>
    </div>
    <div class="container">
            <div class="row text-center">
            <div class="col-12">
                <table class="table  table-hover table-striped">
                    <tr >
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <tbody id="loadTable">

                    </tbody>
                </table>
            </div>
        </div>
        </div>

      
        
        <div id="modal">
            <div class="modal-form">
                <h2>Edit Form</h2>
                <form action="" id="edit-form">
                    <input type="hidden" name="sid" id="edit-id">
                    <div>
                        <label>Name</label>
                        <input type="text" name="sname" id="edit-sname">
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="text" name="sage" id="edit-sage">
                    </div>
                    <div>
                        <label>City</label>
                        <input type="text" name="scity" id="edit-scity">
                    </div>
                    <div>
                        <button id="btn-update">Edit Record</button>
                    </div>
                </form>
                <div id="close-btn">x</div>
            </div>
        </div>

 
        
       
    </body>
</html>
<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
    //delete the record
    $(document).on('click' , '.btn-delete' , function(){
         var record_id = $(this).data("did");
         var record_obj ={sid :  record_id};
         var record_json = JSON.stringify(record_obj);
         var row =this;
         
         $.ajax({
            url:"http://localhost:8080/Monika/REST-API/delete-record.php",
            data: record_json,
            type:"DELETE",
            success: function(data)
            {
                //console.log(data.message);
                $("#success-message").append(data.message);
                
                $(row).closest("tr").fadeOut();
            }

         });
    });

 //fetch all teh record   
$(document).ready(function()
{
    function loadTable(){
        $("#loadTable").empty();
        $.ajax({
            url:"http://localhost:8080/Monika/REST-API/fetch-all.php",
            type:"Get",
            success :function(data){
                //console.log(data);
                if(data.status == false)
                {
                    $("#loadTable").append("<tr><td colspan='6'>"+data.message+"</td></tr>");
                }
                else
                {
                    $.each(data, function(key , value)
                    {
                        $("#loadTable").append("<tr><td>"+key+"</td><td>"+value.name+"</td><td>"+value.age+"</td><td>"+value.city+"</td><td><a  class='btn-edit btn btn-primary' data-eid = '"+value.id+"'>Edit</a></td><td><a class='btn-delete btn btn-danger' data-did='"+value.id+"'>Delete</a></td></tr>");
                    });
                }
            }
        });

    }
    loadTable();

    //add a new record
    $(document).on('click' , '#btn-click' , function(e){
        e.preventDefault();
        var arrt = $("#add-form").serializeArray();
        //console.log(arr);
        var obj={};
        for(var a=0 ; a< arrt.length; a++)
        {
            
            obj[arrt[a].name] = arrt[a].value;
        }
        //console.log(obj);
        var djson = JSON.stringify(obj);
        //console.log(djson);
        $.ajax({
            url:"http://localhost:8080/Monika/REST-API/insert-record.php",
            data:djson,
            type:"Put",
            success :function(data)
            {
                //console.log(data);
                $("#success-message").append(data.message);

            }
        });


    });

    //fetch single record through API
    $(document).on('click' , '.btn-edit' , function(){
        $("#modal").show();
        var StudentId = $(this).data("eid");
        var obj = {sid : StudentId};
        var dJSON = JSON.stringify(obj);
       // console.log(dJSON);

        $.ajax({
            url:'http://localhost:8080/Monika/REST-API/fetch-single.php',
            type:"Post",
            data:dJSON,
            dataType:"json",
            success :function(data){
                //console.log(data);
                $("#edit-sname").val( data[0].name);
                $("#edit-sage").val( data[0].age);
                $("#edit-scity").val( data[0].city);
                $("#edit-id").val( data[0].id);
                
            }
        });
    });

    //update record
    $(document).on('click' , '#btn-update' , function(e){
        e.preventDefault();
        var update_arr = $("#edit-form").serializeArray();
        //console.log(update_arr);
        var update_obj={};
        for(var i=0 ; i<update_arr.length; i++)
        {
            update_obj[update_arr[i].name] = update_arr[i].value
        }

        var update_json = JSON.stringify(update_obj);
        //console.log(update_json);
        $.ajax({
            url:"http://localhost:8080/Monika/REST-API/update-record.php",
            type:"PUT",
            dataType:"json",
            data:update_json,
            success:function(data)
            {
                $("#success-message").append(data.message);
                //console.log(data);
            }
        });

    });
    //hide the modal box
    $(document).on('click' , '#close-btn' , function(){
        $("#modal").hide();
    });

});
</script>