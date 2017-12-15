<?php include("./includes/header.inc"); ?>

					<h2>Setup / Reset</h2>
                  
                    
                    <?php
						if (!empty($_POST["submit"]))
						{
							include('./includes/dbscript.inc');
							echo "Destroy database script started!<br />";
							@launchDbScript("./scripts/destroy_db.sql", true, false);
							echo "Destroy database script finished!<br /><br />";
							
							echo "Create database script started!<br />";
							launchDbScript("./scripts/create_db.sql", false, true);
							echo "Create database script finished!<br /><br />";
							
							echo "Create tables script started!<br />";
							launchDbScript("./scripts/create_tables.sql", true, true);
							echo "Create tables script finished!<br /><br />";
							
							echo "Insert data script started!<br />";
							launchDbScript("./scripts/insert_data.sql", true, true);
							echo "Insert data script finished!</br /><br />";
							
							echo "END!";
							echo "<br /><br /><br />If you changed database structure it may be normal that you get some errors. Everything sould work fine!";
							
							
						}
						else
						{
					?>
                    	<p>This page allows you to create or reset the database of the simulation environment (including its content). After installing 
                    web server you will need to run this script to create the simulation schema.</p><br />
                    <div class="messagebox">
                    	<font class="important">**Warning**</font><br /><br />
                        The database setup script will destroy the schema <font style="color:#fff;"><?php echo DB_NAME; ?></font> and all its content. 
                        If you have an existing project using this schema take care to edit the configuration  used by the simulation environment. The file is 
                        named <i>&quot;config.inc&quot;</i> and it is located in the <i>&frasl;includes</i> directory.
                    </div><br /><br /><br />
                    
                    <div id="control" style="text-align:center;padding-bottom:35px;">
	                    <form id="setup_form" method="post">
   	                 		<input type="submit" name="submit" value="Launch database script" style="padding:10px;font-weight:bold;" />
                    	</form>
                        <br /><i>Database setup script may take a few seconds to execute. Please be patient.</i>
                    </div>
                    
                    <?php
						}
					?>
                    


                

                                
<?php include("./includes/footer.inc"); ?>
