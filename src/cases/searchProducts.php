<?php include("../includes/header.inc"); ?>

				<div class="col">
					<h2>Search Products</h2>
                    
                    <?php
						$search = "";
						if (isset($_POST["search"]))
							$search = $_POST["search"];
					?>
                    
                    <form method="post">
                    	Search for a product : <input type="text" name="search" value="<?php echo htmlentities($search); ?>" />
                        <input type="submit" name="submit" value="Search" />
                    </form><br /><br /><br />
                    
                    
                    <?php
						// Define vars.
	                    $conn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD);
						$query = "SELECT name, description FROM products WHERE description LIKE '%$search%'";
						
						// Connection is OK.
						if ($conn)
						{
							// Table head.
							echo '<table class="listTable" cellspacing="0" cellpadding="0">';
							echo '<tr>';
							echo '<td class="listHead">Name</td>';
							echo '<td class="listHead">Description</td>';
							echo '</tr>';
							
							// Display message when search is empty.
							if ($search == "")
							{
								echo '<tr>';
								echo '<td colspan="2" class="listRow" style="text-align:center;"><i>Enter something in the search box</i></td>';
								echo '</tr>';
								$query = "<i>No query was executed because search is empty.</i>";
							}
							// Execute query.
							else
							{
								@mysql_select_db(DB_NAME);
								$result = @mysql_query($query);
								
								if (@mysql_num_rows($result)==0)
								{
									echo '<tr>';
									echo '<td colspan="2" class="listRow" style="text-align:center;"><i>No product match - Try &quot;RAM&quot; if you want a search that returns results.</i></td>';
									echo '</tr>';
								}
								else
								{
									// Listing data in table.
									while ($row = @mysql_fetch_array($result))
									{
										echo '<tr>';
										echo '<td class="listRow">'.$row['name'].'</td>';
										echo '<td class="listRow">'.$row['description'].'</td>';
										echo '</tr>';
									}
								}
							}
							echo '</table>';
						}
                    	
						// Show debug boxes (MySQL error and Query generated).
						include("../includes/debug.inc");
					?>
				</div>
                    
                <div class="col last">
					<h3>Context</h3>
					<div class="case">
						<p><font class="caseTitle">Page purpose</font><br />
						This page allows the customer to search a product.</p>
					</div>
					<div class="case">
						<p><font class="caseTitle">Goal</font><br />
						List all products in a single search by making the WHERE clause always true then 
                        use advanced SQL injection attack and try to extract information from other tables.</p>
					</div>
					<div class="lastcase">
						<p><font class="caseTitle">Parameter</font><br />
						The parameter for the SQL injection is given by the search field and it is transfered to the PHP script through 
                        &quot;POST&quot; method (not visible in URL). You can try to enter &quot;RAM&quot; in the search field to generate a query
                        that returns results.
					</div>
                </div>
				<div class="divclear"></div>
                

                                
<?php include("../includes/footer.inc"); ?>
