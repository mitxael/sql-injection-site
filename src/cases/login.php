<?php include("../includes/header.inc"); ?>

				<div class="col">
					<h2>Login</h2>
                    
                    
                    <?php
						$username = "";
						$password = "";
						if (isset($_POST["username"]))
							$username = $_POST["username"];
						if (isset($_POST["password"]))
							$password = $_POST["password"];

						// Define vars.
						$message = "";
						$loginSuccess = 0;
	                    $conn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD);
						$securePwd = str_replace("'", "''", $password);
						$query = "SELECT first_name, last_name FROM members WHERE username='$username' AND password='$securePwd'";
						
						// Visitor is logging in and connection is OK.
						if (isset($_POST["submit"]) && $conn)
						{
							if (isset($_POST["username"]) && isset($_POST["password"]))
							{
								@mysql_select_db(DB_NAME);
								$result = @mysql_query($query);
								
								// Failed login.
								if (@mysql_num_rows($result)==0)
								{
									$message = '<div class="messagebox"><font class="errorTitle">Login failed! Invalid username or password.</font></div>';
								}
								else
								{
									// Display welcome message.
									$row = @mysql_fetch_array($result);
									$message = '<div class="messagebox">Welcome <font style="color:#fff; font-weight:bold;">'.htmlentities($row['first_name']).' '.
										 htmlentities($row['last_name']).'</font> !<br /><br />You are now logged in and you can buy products '.
										 'on our website.</div>';
									$loginSuccess = 1;
								}
							}
						}
						else
						{
							$query = "<i>No query was executed because login button was not pressed.</i>";
						}
						
						if ($loginSuccess != 1)
						{
					?>
                    
                    <form method="post">
                    	<table>
                            <tr>
                                <td class="formLabel">
                                    Username : 
                                </td>
                                <td class="formField">
                                    <input name="username" type="text" value="<?php echo htmlentities($username); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="formLabel">
                                    Password : 
                                </td>
                                <td class="formField">
                                    <input name="password" type="password">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;">
                                    <br /><input name="submit" type="submit" value="Login" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br /><br /><br />
                  
                    <?php
						}
						
						echo $message;
						
						// Show debug boxes (MySQL error and Query generated).
						include("../includes/debug.inc");
					?>
				</div>
                    
                <div class="col last">
					<h3>Context</h3>
					<div class="case">
						<p><font class="caseTitle">Page purpose</font><br />
						This page allows the customer log in.</p>
					</div>
					<div class="case">
						<p><font class="caseTitle">Goal</font><br />
						Try to log into a member's account (anyone). Then you could try to login as the administrator. 
                        Finally, try to achieve some blind SQL injection to find additionnal information 
                        about structure and data.</p>
					</div>
					<div class="lastcase">
						<p><font class="caseTitle">Parameters</font><br />
						Both parameters are sent to the PHP script through &quot;POST&quot; method.
					</div>
                </div>
				<div class="divclear"></div>

                

                                
<?php include("../includes/footer.inc"); ?>
