<?php include("../includes/header.inc"); ?>

				<div class="col">
					<h2>Products By Category</h2>
                    
                    <?php
						// Define vars.
	                    $conn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD);
						$category = isset($_GET["category"]) ? $_GET["category"] : "";
						$query = "SELECT name, description, price FROM products WHERE category=".$category;
						
						// List elements.
						if ($conn)
						{
							@mysql_select_db(DB_NAME);
							$result = @mysql_query($query);
							
							// ----------- Secure code to show category name - Not vulnerable to SQL injection.
							// ----------- This was secured to avoid double vulnerability (this could be confusing for begginers).
							$secureCat = is_numeric($category) ? $category : -1;
							$secureName = "[unknown category]";
							if ($secureCat <> -1)
							{
								$secureRes = @mysql_query("SELECT name FROM categories WHERE id=$secureCat");
								$secureRow = @mysql_fetch_array($secureRes);
								if ($result && @mysql_num_rows($result)>0)
									$secureName = htmlentities($secureRow["name"]);
							}
							echo "Below are listed all products in ".strtolower($secureName)." category.<br /><br />";
							// ----------- End of secure code.
							
							// Table head.
							echo '<table class="listTable" cellspacing="0" cellpadding="0">';
							echo '<tr>';
							echo '<td class="listHead">Name</td>';
							echo '<td class="listHead">Description</td>';
							echo '<td class="listHead">Price</td>';
							echo '</tr>';
							
							// Empty table?
							if (@mysql_num_rows($result)==0)
							{
								echo '<tr>';
								echo '<td colspan="3" class="listRow" style="text-align:center;"><i>No data for this category - See information about parameter in the section on the right of the page.</i></td>';
								echo '</tr>';
							}
							
							// Listing data in table.
							while ($row = @mysql_fetch_array($result))
							{
								echo '<tr>';
								echo '<td class="listRow">'.$row['name'].'</td>';
								echo '<td class="listRow">'.$row['description'].'</td>';
								echo '<td class="listRow">'.$row['price'].'</td>';
								echo '</tr>';
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
						This page lists all products related to a category. This way the customer can see all alternatives to a 
                        product he was interested to buy. From every product's page, a text indicating &quot;see other products 
                        in this category&quot; could link to this page.</p>
					</div>
					<div class="case">
						<p><font class="caseTitle">Goal</font><br />
						Verify if there is a SQL injection with testing techniques explained on the website. Then try to
                        retrieve information from other tables.</p>
					</div>
					<div class="lastcase">
						<p><font class="caseTitle">Parameter</font><br />
						The parameter for the SQL injection is in the URL (&quot;category&quot;). Here is a link that will list all
                        products in the <a href="./productsCategory.php?category=1">category #1</a>. You can change the parameter's
                        value to list another category or to attempt SQL injection.</p>
					</div>
                </div>
				<div class="divclear"></div>
                

                                
<?php include("../includes/footer.inc"); ?>
