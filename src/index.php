<?php include("./includes/header.inc"); ?>

	
					<h2>Home</h2>
                    
                  	<?php
						// Display database connection error (if any).
						$error_msg = "";
	                    $conn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD);
						if (!$conn) {
						?>
                        	<div class="messagebox">
							<font class="errorTitle">DATABASE CONNECTION ERROR</font><br /><br />
                            The script was unable to connect to your database with the current settings.<br /><br /><br />
                            <font class="important">Solution #1</font><br />
                            Database connection parameters are incorrect. Edit the configuration file 
                            used by the simulation environment. The file is named <i>&quot;config.inc&quot;</i> and it is located 
                            in the <i>&frasl;includes</i> directory.
                            <br /><br />
                            <font class="important">Solution #2</font><br />
                            MySQL is not installed, it is not started or you have not correctly configured it. Refer to the installation 
                            guide on the website if you want to learn how to make a default installation of this environment.
                        	<br /><br /><br />
                        	<i><?php echo mysql_error(); ?></i><br /><br />
                        	</div>
                    <?php
						}
						else
						{
							// Display database setup (if database does not exist).
							$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '".DB_NAME."'";
							$result = mysql_query($query);
							if (mysql_num_rows($result)==0) {
								?>
                                <div class="messagebox">
                                <font class="errorTitle" style="color:#99cc00;">SCHEMA DOES NOT EXIST</font><br /><br />
                                The schema used by the simaulation environment (<font style="color:#fff;"><?php echo DB_NAME; ?></font>) does not exist on the database. 
                                You must create it to have a functionnal testing environment.<br /><br /><br />
                                <font class="important">Solution #1</font><br />
                                Launch the database <a href="./setup.php">setup script</a> if you have not launched it yet.
                                <br /><br />
                                <font class="important">Solution #2</font><br />
                                If the database setup script has not solved your problem or if it generated an error, verify that your database user has enough 
                                permissions to delete tables, create a schema, create tables, etc.
                                <br /><br /><br />
                                </div>
							<?php
							}
							else
							{
                            	// Display normal homepage.
								?>
              					<p>Congratulations, you got your PHP server working!</p>
                                
           
                                <h2 style="padding-top:30px;">Context of the simulation</h2>
                                <p>
                                This environment intend to immitate scripts and webpages that could be found on an online shop selling
                                computer parts. To shorten the learning curve of the environment and allow easy attack testing, only some specific sections of the
                                e-commerce website where created. It is also important to mention that those scripts have been simplified and real cases
                                are often more complex.<br /><br />
                                
                                It is strongly recommended to take a look at the <a href="./instructions.php">instructions</a> before jumping to the simulation cases!<br /><br />
                                
                                N.B.: No information contained in the database is encrypted.
            
                                </p>
                                <?php
							}
						}
					?>
					
                    
                    
                    
    

                                
<?php include("./includes/footer.inc"); ?>
