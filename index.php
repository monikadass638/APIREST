
<html>
    <head>
        <title>API Code</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <table border="2" width="100%" cellspacing="0" cellpadding="0">
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
        <div id="modal">
            <div class="modal-form">
                <h2>Edit Form</h2>
                <form action="" id="edit-form">
                    <div>
                        <label>Name</label>
                        <input type="text" name="sname" id="sname">
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="text" name="sage" id="sage">
                    </div>
                    <div>
                        <label>City</label>
                        <input type="text" name="scity" id="scity">
                    </div>
                    <div>
                        <button>Edit Record</button>
                    </div>
                </form>
                <div id="close-btn">x</div>
            </div>
        </div>
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
                console.log(data);
                
            }
        });
    });


    //hide the modal box
    $(document).on('click' , '#close-btn' , function(){
        $("#modal").hide();
    });

});
</script>