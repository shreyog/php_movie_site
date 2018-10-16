<?php
		
		//---------Database Configuration----------
		session_start();
		define('DB_SERVER','localhost');
		define('DB_USER','root');
		define('DB_PASS' ,'');
		define('DB_NAME', 'moviedb');
		//-------------------------



					class DB_con
					{

					//---------connecting to the databasae
					 function __construct()
					 {

					$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
					$this->dbh=$con;

					// Check connection
					if (mysqli_connect_errno())
					{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
					 }

					 }

					 //--------------------------------------

					 
					 //------function for pagination to return the number of result

					 	public function pgno()
					 {

					 		$no_of_records_per_page=5;

					 		if(isset($_POST['search']))
						{
							
							///--------------for getting the search query count
					 		$valueToSearch = $_POST['searcher'];

							/*$total_pages_sql = "SELECT COUNT(*) FROM `moviedetails` WHERE CONCAT(`mId`, `mName`, `Rating`, `releaseDate`, `genreId`, `languageId`) LIKE '%".$valueToSearch."%'" or die("Error: " . mysqli_error($this->dbh));*/

							$total_pages_sql= "SELECT * FROM `moviedetails` WHERE CONCAT(`mId`, `mName`, `Rating`, `releaseDate`,`genrename`,`languagename`) LIKE '%".$valueToSearch."%'"or die("Error: " . mysqli_error($this->dbh));		

							//----------------
							
							echo "<script>console.log( 'records per page:" . $no_of_records_per_page . "' );</script>";
							/////-----------------
						}
							else if(isset($_POST['sort']))
						{
							//---------for getting count of the sort query
							$sorter=$_POST['dropdown'];
							$total_pages_sql = "SELECT COUNT(*) FROM `moviedetails` order by $sorter desc"or die("Error: " . mysqli_error($this->dbh));		
						}
						else if(isset($_POST['filter']))
						{
				   
						    //---------------for getting the filter query count
						$dropgenre=$_POST['dropdowng'];
						$droplanguage=$_POST['dropdownl'];

							if($dropgenre=="All" && $droplanguage=="All")
							{
							 $total_pages_sql = "SELECT COUNT(*)  FROM moviedetails"or die("Error: " . mysqli_error($this->dbh));
							}
							else if($dropgenre!="All"&&$droplanguage=="All")
							{
								$total_pages_sql="SELECT COUNT(*)  FROM `moviedetails` WHERE `genrename`= '".$dropgenre."' "or die("Error: " . mysqli_error($this->dbh));		
							}
							else if($dropgenre=="All" and $droplanguage!="All")
							{

								$total_pages_sql="SELECT COUNT(*) FROM `moviedetails` WHERE `languagename`= '".$droplanguage."'"or die("Error: " . mysqli_error($this->dbh));		
							}
							else
							{
								$total_pages_sql="SELECT COUNT(*) FROM `moviedetails` WHERE `languagename`= '".$droplanguage."' and `genrename`= '".$dropgenre."'"or die("Error: " . mysqli_error($this->dbh));
							}

						  
						    
						} 
						else
						{

					         $total_pages_sql = "SELECT COUNT(*) FROM moviedetails" or die("Error: " . mysqli_error($this->dbh));
							
						}

						//----------pagination formula
					 	  $presult = mysqli_query($this->dbh,$total_pages_sql);
					 	  $total_rows = mysqli_fetch_array($presult)[0];
					 	  $total_pages = ceil($total_rows / $no_of_records_per_page);


					 	  echo "<script>console.log( 'total pages" . $total_pages . "' );</script>";

					 	  return $total_pages;
					 }


					 //--------function for fetching the data depending on the query

								public function fetchdata()
								 {

								if (isset($_GET['pageno'])) {
								            $pageno = $_GET['pageno'];
							        } else {
							            $pageno = 1;
							        }


								// Formula for pagination  
								        $no_of_records_per_page = 5;
								        $offset = ($pageno-1) * $no_of_records_per_page;

								//-----------------------------
								        echo "<script>console.log( 'fetcher " . $offset . "' );</script>";




									if(isset($_POST['search']))
									{
									   $valueToSearch = $_POST['searcher'];
									    // search in all table columns
									    // using concat mysql function
									   //using limit query for pagina
									   ///------------testing of inner join query
									 /*  $query = "SELECT *,genre.genreName FROM 
												`moviedetails` 
												INNER JOIN `genre` ON moviedetails.genreId=genre.genreId
												INNER JOIN `language` ON moviedetails.languageId=language.languageId 
												WHERE CONCAT(`mId`, `mName`, `Rating`, `releaseDate`) LIKE '%".$valueToSearch."%' LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));*/
										$query = "SELECT * FROM `moviedetails` WHERE CONCAT(`mId`, `mName`, `Rating`, `releaseDate`,`genrename`,`languagename`) LIKE '%".$valueToSearch."%' LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));		


									   $result = mysqli_query($this->dbh,$query);
									   return $result;
									    
									}
										else if(isset($_POST['sort']))
										{
										   
										    // search in all table columns
										    // using concat mysql function
										   //using limit query for pagina
											//---for sorting
										$sorter=$_POST['dropdown'];

													
											$query = "SELECT * FROM `moviedetails` order by $sorter desc LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));		
											

										   $result = mysqli_query($this->dbh,$query);
										   return $result;
										    
										}
										else if(isset($_POST['filter']))
										{
										   
										    // search in all table columns
										    // using concat mysql function
										   //using limit query for pagina
											//---code for filter query
										$dropgenre=$_POST['dropdowng'];
										$droplanguage=$_POST['dropdownl'];
										
										if($dropgenre=="All" and $droplanguage=="All")
											{
											 $query = "SELECT * FROM moviedetails LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));
											}
											else if($dropgenre!="All" and $droplanguage=="All")
											{

												$query="SELECT * FROM `moviedetails` WHERE `genrename`= '".$dropgenre."' LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));		
											}
											else if($dropgenre=="All" and $droplanguage!="All")
											{

												$query="SELECT * FROM `moviedetails` WHERE `languagename`= '".$droplanguage."' LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));		
											}
											else
											{
												
												$query="SELECT * FROM `moviedetails` WHERE `languagename`= '".$droplanguage."' AND `genrename`= '".$dropgenre."' LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));
											}

										   $result = mysqli_query($this->dbh,$query);
										   return $result;
										    
										}
				 		else {


				 	 
				    $query = "SELECT * FROM moviedetails LIMIT $offset, $no_of_records_per_page"or die("Error: " . mysqli_error($this->dbh));

				 $result=mysqli_query($this->dbh,$query);
				  
				    return $result;
				}


 }




}
?>