<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"  >

    <title>spacecats.tech</title>
</head>
<body>

    <div class="container">
        <div class="row flex justify-content-center mt-5">
          <div class="col-md-4">
            <div class="card">
                <form class="m-5">
                    <div class="form-group">
                      <label >Enter Launch Time</label>
                      <input type="datetime-local" id="launchtime" name="launchtime">
                    </div>
                    <button type="button" class="btn btn-primary">Submit</button>
                  </form>
            </div>
          </div>

          <div class="col-md-8">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Rocket</th>
                  <th scope="col">Launch Time</th>
                  <th scope="col">Est. time of coming back</th>
                </tr>
              </thead>

              <tbody id="launch_table">

              </tbody>
            </table>
          </div>
        </div>

      </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

$(document).ready( function () {
    $('#launch_table').DataTable();
} );



getLaunchData();

function getLaunchData(){
axios.get('/getLaunchData')
.then(function (response){
  if(response.status==200)
  {
    $('#serviceDatatable').DataTable().destroy();
    $('#servicetable').empty();
    var jsonData=response.data;
    $.each(jsonData,function(i,item){
    $('<tr>').html(
    "<td>"+jsonData[i].diamond+ "</td>"+
    "<td>"+jsonData[i].price+"</td>"+
    "<td>"+jsonData[i].sale_price+"</td>"
     ).appendTo('#servicetable');
    });


$('#serviceDatatable').DataTable({"order":false});
$('.dataTables_length').addClass('bs-select');
  }else{

  }
}).catch(function (error) {

});
}








</script>

</body>
</html>
