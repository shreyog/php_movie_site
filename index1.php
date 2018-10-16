<?php
include_once("search1.php");
$fetchdata=new DB_con();
?>
<!DOCTYPE html>

<html>

<head>

	<title></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>
<div class="w-100 h-100 p-3  border border-secondary rounded-top">
<h1 style="text-align: center;">Movie Site</h1>
</div>

<div class="w-100 h-100 p-3  border border-secondary rounded-top">

	 <form action="index1.php" method="post">

    <!-- ###########Search############ -->

                          <div class="w-100 h-100 p-3">

                              <div class="row">

                                  <div class="col">
                                    
                                    <h3>Search  Movie </h3>
                                  </div>

                                  <div class="col-4">
                                  <input type="text" name="searcher" placeholder="Enter movie to be searched" class="form-control form-control-lg">
                                  </div>

                                  <div class="col">
                              		 <button type="submit" name="search" type="button" class="btn btn-secondary btn-lg btn-block">Search</button> 
                                  </div>

                              </div>

                            </div>
    <!-- ####################### -->

    <!-- ###########Sort############ -->
                            <div class="w-100 h-100 p-3">
                

                
                            <div class="row">

                            <div class="col"><h3>Sorting</h3></div>

                            <div class="col">

                            <select class="browser-default custom-select" name="dropdown">
                            <option selected>Open this sorting menu</option>
                            <option value="Rating">Rating</option>
                            <option value="releaseDate">Release Date</option>
                            </select>

                            </div>

                            <div class="col">
                                 <button type="submit" name="sort" type="button" class="btn btn-secondary btn-lg btn-block">Sort</button> 
                            </div>

                          </div>
                </div>
      <!-- ####################### -->

      <!-- ###########Filter############ -->

                             <div class="w-100 h-100 p-3">
                              

                              
                              <div class="row">

                              <div class="col">
                              <h3>Filter</h3>
                              </div>

                              <div class="col-4">

                              <select class="browser-default custom-select" name="dropdowng">
                              <option value="All" selected>All</option>
                              <option value="Sci-fi">Sci-fi</option>
                              <option value="Action">Action</option>
                              <option value="Drama">Drama</option>
                              <option value="Comedy">Comedy</option>
                              <option value="Animation">Animation</option>
                              </select>

                              </div>

                              <div class="col-4">

                              <select class="browser-default custom-select" name="dropdownl">
                              <option value="All" selected>All</option>
                              <option value="English">English</option>
                              <option value="Hindi">Hindi</option>
                              </select>

                              </div>

                              <div class="col">
                                 <button type="submit" name="filter" type="button" class="btn btn-secondary btn-lg btn-block">Filter</button> 
                              </div>

                                </div>

                            </div>

        <!-- ####################### -->
	
    </form>

</div>

<br>
<br>

      <h2 style="text-align: center;">LIST OF MOVIES</h2>

<br>

         <table width="100%"  border="0"  class="table">
          <tr>
            
            <th  scope="col">Movie Name</th>
            <th scope="col">Rating</th>
            <th scope="col">Release Date</th>
            <th scope="col">Genre</th>
            <th scope="col">Language</th>
          </tr>

 <!-- ###########Php part for pagination############ -->         
  <?php
  $sql=$fetchdata->fetchdata();
if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $total_pages=$fetchdata->pgno();
   $cnt=1;
  while($row=mysqli_fetch_array($sql))
  {
  ?>
<!-- ####################### -->

            <tr>
                
              <td scope="row"><a href="result.php?varname=<?php echo $row['mName']; ?>"><?php echo $row['mName'];?></a> </td>
              <td scope="row"><?php echo $row['Rating'];?></td>
              <td scope="row"><?php echo $row['releaseDate'];?></td>
              <td scope="row"><?php echo $row['genrename'];?></td>
              <td scope="row"><?php echo $row['languagename'];?></td>
             
           
            </tr>

<?php $cnt=$cnt+1;} ?>



            </table>


              <div align="center">
              <ul class="pagination" >
                  <li><a href="?pageno=1">First</a></li>
                  <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                      <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                  </li>
                  <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                      <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                  </li>
                  <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
              </ul>
              </div>

</body>
</html>