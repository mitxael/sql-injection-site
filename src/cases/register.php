<?php include("../includes/header.inc"); ?>

				<div class="col">
					<h2>Register</h2>
                    
                    
                    <?php
						$query = "<i>No query was executed because the register button was not pressed.</i>";
						$message = "";
						$register = 0;
					
						// Form's fields.
						$firstname = "";
						$lastname = "";
						$username = ""; // VULNERABLE PARAMETER!
						$password = "";
						$email = "";
						
						/// Error strings.
						$usernameError = "";
						$passwordError = "";
						$emailError = "";
						
						// Get from submitted form.
						if (isset($_POST["submit"]))
						{
							$firstname = str_replace("'", "''", $_POST["firstname"]);
							$lastname = str_replace("'", "''", $_POST["lastname"]);
							
							// Username validation (not vulnerable!).
							if ($_POST["username"] != "")
							{
								$username = $_POST["username"];
								$conn = @mysql_connect(DB_SERVER, DB_USER, DB_PWD);
								@mysql_select_db(DB_NAME);
								$queryUniqueUsername = "SELECT id FROM members WHERE username='".str_replace("'", "''", $username)."'";
								$userResult = @mysql_query($queryUniqueUsername);
								if (@mysql_num_rows($userResult) > 0)
									$usernameError = "This username is already take, choose another.";
							}
							else
								$usernameError = "You must enter a username.";
								
							// Password validation.
							if ($_POST["password"] != "")
								$password = str_replace("'", "''", $_POST["password"]);
							else
								$passwordError = "You must enter a password.";
							
							// Email validation.
							if ($_POST["email"] != "")
								$email = str_replace("'", "''", $_POST["email"]);
							else
								$emailError = "You must enter an email.";
								
							// Execute query if there's no error.
							if ($usernameError.$passwordError.$emailError == "")
							{
								$register = 1;
								$query = "INSERT INTO members (first_name, last_name, username, password, email, permission) ".
									 "VALUES ('$firstname', '$lastname', '$username', '$password', '$email', 3)";
								$result = @mysql_query($query);
								if (@mysql_affected_rows() > 0)
									$message = 'Thank you <font style="color:#fff;">'.htmlentities($username).'</font> ! Your profile was created.';
								else
									$message = "Oops! It seems that an error occured while creating your profile.";
							}
							else
							{
								$query = "<i>No query was executed because the form was not correctly completed.</i>";
							}
						}

				
						if ($register == 0)
						{
						?>
                            <form method="post">
                                <table>
                                    <tr>
                                        <td class="formLabel">
                                            First name : 
                                        </td>
                                        <td class="formField">
                                            <input name="firstname" type="text" value="<?php echo htmlentities($firstname); ?>">
                                        </td>
                                        <td class="formError">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="formLabel">
                                            Last name : 
                                        </td>
                                        <td class="formField">
                                            <input name="lastname" type="text" value="<?php echo htmlentities($lastname); ?>">
                                        </td>
                                        <td class="formError">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="formLabel">
                                            <font style="color:#9C0;">*</font> Username : 
                                        </td>
                                        <td class="formField">
                                            <input name="username" type="text" value="<?php echo htmlentities($username); ?>">
                                        </td>
                                        <td class="formError">
                                            <?php echo $usernameError; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="formLabel">
                                            <font style="color:#9C0;">*</font> Password : 
                                        </td>
                                        <td class="formField">
                                            <input name="password" type="password">
                                        </td>
                                        <td class="formError">
                                            <?php echo $passwordError; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="formLabel">
                                            <font style="color:#9C0;">*</font> Email : 
                                        </td>
                                        <td class="formField">
                                            <input name="email" type="text" value="<?php echo htmlentities($email); ?>">
                                        </td>
                                        <td class="formError">
                                            <?php echo $emailError; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center;">
                                            <br /><input name="submit" type="submit" value="Register" style="width:100px;" />
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </form>
                  
                    	<?php

						}
					
						// Display success/error message after registration.
						echo $message;
					
						// Show debug boxes (MySQL error and Query generated).
						include("../includes/debug.inc");

					?>
				</div>
                    
                <div class="col last">
					<h3>Context</h3>
					<div class="case">
						<p><font class="caseTitle">Page purpose</font><br />
						This page allows the user to register and become a member. Because every new customer application must be reviewed manually by an administrator, this registration procedure sets the member's status to &quot;new&quot;. Every member created with this form is inactive until an administrator changes its status.</p>
					</div>
					<div class="case">
						<p><font class="caseTitle">Goal</font><br />
                        Try to create a valid member, then try to create an administrator.
						</p>
					</div>
					<div class="lastcase">
						<p><font class="caseTitle">Parameters</font><br />
						Be sure you test all parameters. They are not all vulnerable!
					</div>
                </div>
				<div class="divclear"></div>

                

                                
<?php include("../includes/footer.inc"); ?>
