
<html>
    <head>
        <title>API Code</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-12 bg-primary "> <h1>PHP REST API CURD</h1></div>
            </div>
            <form id="add-form" action="">
                <div class="row">
                
                    
                    <div class="col-3">
                    <input class="form-control" type="text" name="sname" id="sname" placeholder="Name:">
                    </div>
                    <div class="col-3">
                    <input type="text" class="form-control" name="sage" id="sage" placeholder="Age">
                    </div>
                    <div class="col-3">
                    <input type="text" class="form-control" name="scity" id="scity" placeholder="city">
                    </div>
                    <div class="col-3">
                    <button>Add Record</button>
                    </div>
                
                
            </div>
            </form>

            <div class="row text-center">
            <div class="col-12">
                <table class="table  table-hover table-striped">
                    <tr>
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
                    <input type="hidden" name="id" id="edit-id">
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
                        <button>Edit Record</button>
                    </div>
                </form>
                <div id="close-btn">x</div>
            </div>
        </div>
        <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    function loadTable(){
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
                        $("#loadTable").append("<tr><td>"+value.id+"</td><td>"+value.name+"</td><td>"+value.age+"</td><td>"+value.city+"</td><td><a  class='btn-edit' data-eid = '"+value.id+"'>Edit</a></td><td><a class='btn-delete'>Delete</a></td></tr>");
                    });
                }
            }
        });

    }
    loadTable();

    //add a new record

    //fetch single record through API
    $(document).on('click' , '.btn-edit' , function(){
        $("#modal").show();
        var StudentId = $(this).data("eid");
        var obj = {sid : StudentId};
        var dJSON = JSON.stringify(obj);
        console.log(dJSON);

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


    //hide the modal box
    $(document).on('click' , '#close-btn' , function(){
        $("#modal").hide();
    });

});
</script>