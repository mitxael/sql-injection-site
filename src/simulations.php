<?php include("./includes/header.inc"); ?>


					<h2>Simulations</h2>
					<p>Below are listed the different simulations of this environment.</p>
                    <p>Keep in mind that <font class="important">PHP/MySQL do not allow query stacking</font>. Therefore any attempt to execute multiple statements in the same query will be impossible.</p>
                    
                    <table class="listTable" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td class="listHead">Case</td>
                            <td class="listHead">Description</td>
                            <td class="listHead">Link</td>
                        </tr>
                        <tr>
                        	<td class="listRow"><strong># 1</strong></td>
                        	<td class="listRow">
                            	<font style="color:#AAA;">List of products related to a category</font><br />
                            	<font style="color:#555;">Basic SQL injection vulnerability on a numeric parameter passed directly in URL.</font></td>
                        	<td class="listRow"><a href="<?php echo BASE_SIM_PATH; ?>cases/productsCategory.php?category=1">View</a></td>
                       	</tr>
                        <tr>
                        	<td class="listRow"><strong># 2</strong></td>
                        	<td class="listRow">
                            	<font style="color:#AAA;">List of products that match a search</font><br />
                                <font style="color:#555;">Simple SQL injection vulnerability in a search field (text).</font></td>
                        	<td class="listRow"><a href="<?php echo BASE_SIM_PATH; ?>cases/searchProducts.php">View</a></td>
                       	</tr>
                        <tr>
                        	<td class="listRow"><strong># 3</strong></td>
                        	<td class="listRow">
                            	<font style="color:#AAA;">Member login page</font><br />
                                <font style="color:#555;">Classic SQL injection vulnerability in login form.</font></td>
                        	<td class="listRow"><a href="<?php echo BASE_SIM_PATH; ?>cases/login.php">View</a></td>
                       	</tr>
                        <tr>
                        	<td class="listRow"><strong># 4</strong></td>
                        	<td class="listRow">
                            	<font style="color:#AAA;">Registration form</font><br />
                                <font style="color:#555;">A SQL injection vulnerability in an INSERT statement.</font></td>
                        	<td class="listRow"><a href="<?php echo BASE_SIM_PATH; ?>cases/register.php">View</a></td>
                       	</tr>
                        <tr>
                        	<td class="listRow"><strong># 5</strong></td>
                        	<td class="listRow">
                            	<font style="color:#AAA;">Search by budget</font><br />
                                <font style="color:#555;">A classic SQLI vulnerability inside a slightly more complex query.</font></td>
                        	<td class="listRow"><a href="<?php echo BASE_SIM_PATH; ?>cases/budgetListing.php">View</a></td>
                       	</tr>
                    </table>
                    
                    <br /><br /><br />

                                
<?php include("./includes/footer.inc"); ?>
