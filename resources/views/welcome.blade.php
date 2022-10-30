<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"  >
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.bootstrap.min.css"  >

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
                    <button type="button" id="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
            <div class="container">
      <div class="card m-2" id="details" hidden>
        <div class="m-2">
          
      Rocket A  Est. time of coming back: <input id="rocketa" type="text"  class="form-control mb-3" readonly ><br>
      Rocket B  Est. time of coming back: <input id="rocketb" type="text"  class="form-control mb-3" readonly><br>
      Rocket C  Est. time of coming back: <input id="rocketc" type="text"  class="form-control mb-3" readonly>

        </div>

        
      </div>


    </div>
          </div>
          <div class="col-md-8">
            <table id="LaunchDatatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th >Sl</th>
                  <th >Rocket</th>
                  <th >Launch Time</th>
                  <th >Est. time of coming back</th>
                </tr>
              </thead>
              <tbody id="launch_table">

              </tbody>
            </table>
          </div>

        </div>

    </div>




<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" ></script>



<script>

getLaunchData();

function getLaunchData(){
axios.get('/getLaunchData')
.then(function (response){
  if(response.status==200)
  {
    $('#LaunchDatatable').DataTable().destroy();
    $('#launch_table').empty();
    var jsonData=response.data;
    $.each(jsonData,function(i){
    $('<tr>').html(
    "<td>"+ jsonData[i].id +"</td>"+
    "<td>"+ jsonData[i].roket_no +"</td>"+
    "<td>"+ jsonData[i].launch_time +"</td>"+
    "<td>"+ jsonData[i].come_back_time +"</td>"
     ).appendTo('#launch_table');
    });
    

$('#launch_table').DataTable();
// $('.dataTables_length').addClass('bs-select');


  }else{

  }
}).catch(function (error) {

});
}




$('#submit').click(function(){
  var luanchtime=$('#launchtime').val();
  getLuanchTime(luanchtime);
});


function getLuanchTime(luanchtime){
      if(luanchtime.length==0){
        alert("launch time is empty");  
      }else{ 
        // alert(launchtime);
        axios.post('/launchtime',{ 
          luanchtime:luanchtime,

                      })
                      .then(function(response){
                        if(response.status==200)
                        {
                          $('#details').removeAttr('hidden');
                          $('#rocketa').val(response.data.rocketA);
                          $('#rocketb').val(response.data.rocketB);
                          $('#rocketc').val(response.data.rocketC);

                          getLaunchData();
                        }else{
                          getLaunchData();
                        }
                      }).catch(function (error) {
                    
                    });
        }
}

</script>

</body>
</html>
