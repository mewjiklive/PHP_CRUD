<?php
// connecting to the database 
$servername= "localhost"; 
$username= "root"; 
$password= ""; 
$database= "database"; 
// connecting the database 
$conn=mysqli_connect($servername, $username, $password,$database);  
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title= $_POST["title"]; 
    $description= $_POST["Description"]; 
    $sql= "INSERT INTO `databook` (`Title`, `Description`) VALUES ('$title', '$description');"; 
    $result = mysqli_query($conn, $sql); 

}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD_Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
</head>
<body>

  <!-- Edit modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledb="editmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <div>     
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">iNotes</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                  </li>
                </ul>
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
            </nav> 
            <div class="container">
              <form action="index.php" method="post">
                <div class="mb-3 mt-3">
                  <h1 class="">Add a note</h1>
                  <h4 class="text-secondary">CRUD->Create, Read, Update, Delete</h4>
                  <label for="exampleInputEmail1" class="form-label">Note Title</label>
                  <input type="text" class="form-control" name="title" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Add Note Description</label>
                  <textarea class="form-control" name="Description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Note</button>
              </form>
            </div>
            <div class="container mt-1 mb-5">
               
  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Note Title</th>
      <th scope="col">Note Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
                 $sql= "SELECT * from `databook`";  
                 $result= mysqli_query($conn, $sql); 
                 $num = mysqli_num_rows($result); 
                 echo "<br>";  
                  // fetch in a better way using while loop 
                  if($num>0){
                  while($row= mysqli_fetch_assoc($result)){
                    echo "
                    <tr>
                      <td>".$row['Title']."</td>
                      <td>".$row['Description']."</td>
                      <td> <a href='/del'>Delete</a>  <a href='/edit'>Edit</a> </td>
                    </tr>
                    "; 
                  }
                }
                ?>
  </tbody>
</table>
            </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>