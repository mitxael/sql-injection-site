<?php include("../includes/header.inc"); ?>

				<div class="col">
					<h2>Budget Listing</h2>
                    
                    
                    <?php
						$search = "";
						if (isset($_POST["search"]))
							$search = $_POST["search"];
					?>
                    
                    <form method="post">
                    	Enter your budget (no decimals - ex: 50) : <input type="text" name="search" size="40" value="<?php echo htmlentities($search); ?>" />
                        <input type="submit" name="submit" value="Go!" />
                    </form><br /><br />
                    
                    
                    <?php
						// Define vars.
	                    $conn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD);
						$query = "SELECT id, name, description, (SELECT MAX(price) FROM products WHERE price <= $search AND ".
								 "categories.id = category) AS maxamount  FROM categories HAVING maxamount IS NOT NULL";
						
						// Connection is OK.
						if ($conn)
						{
							// Table head.
							echo '<table class="listTable" cellspacing="0" cellpadding="0">';
							echo '<tr>';
							echo '<td class="listHead">Category</td>';
							echo '<td class="listHead">Best item price</td>';
							echo '</tr>';
							
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
									echo '<td colspan="2" class="listRow" style="text-align:center;"><i>No product match - Try with a higher budget.</i></td>';
									echo '</tr>';
								}
								else
								{
									// Listing data in table.
									while ($row = @mysql_fetch_array($result))
									{
										echo '<tr>';
										echo '<td class="listRow">'.$row[1].'</td>';
										echo '<td class="listRow">'.$row[3].'</td>';
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
						This page allows the customer to do a budget search. The listing on the left should be read as follows : 
                        &quot;The best item you can buy under [budget entered in textbox] costs [price]&quot;.</p>
					</div>
					<div class="case">
						<p><font class="caseTitle">Goal</font><br />
						Try to find out what is the structure of the query and then list all the products of the database. 
                        Then you could try to recover data from other tables (complete SQL injection attack).</p>
					</div>
					<div class="lastcase">
						<p><font class="caseTitle">Parameter</font><br />
						The parameter for the SQL injection is given by the search field and it is transfered to the PHP script through 
                        &quot;POST&quot; method. You can try to enter &quot;RAM&quot; in the search field. This will generate a query
                        that returns results.
					</div>
                </div>
				<div class="divclear"></div>
                

                                
<?php include("../includes/footer.inc"); ?>
