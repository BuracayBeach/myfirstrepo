		<form name="userForm" action="<?php echo base_url();?>index.php/user_account/update" method="post" >
			
			<div id="container">
				<h1>Update Form</h1>

				<div id="body">
					Sex: <input type="radio" name="sex" value="male" id="male" 
						<?php
							if($sex=="male")
								echo "checked";
						?> />
						 <label for="male">Male</label>
						 <input type="radio" name="sex" value="female" id="female"
						 <?php
							if($sex=="female")
								echo "checked";
						?> />
						 <label for="female">Female</label><br/>

					Email: <input type="text" name="email" value="<?php echo $email; ?>" required/><span name="spanEmail"></span><br/>
					First Name: <input type="text" name="name_first" value="<?php echo $name_first; ?>" required/><span name="spanName_first"></span><br/>
					Middle Name: <input type="text" name="name_middle" value="<?php echo $name_middle; ?>" required/><span name="spanName_middle"></span><br/>
					Last Name: <input type="text" name="name_last" value="<?php echo $name_last; ?>" required/><span name="spanName_last"></span><br/>
					Mobile Number: <input type="text" name="mobile_no" name="name_last" value="<?php echo $mobile_no; ?>" required /><span name="spanMobile_no"></span><br/>
					College: 
					<select name="college" value="<?php echo $college; ?>">						
						<option value="CA"
							<?php
								if($college=="CA")
									echo "selected";
							?>
						>CA (College of Agriculture)</option>
						<option value="CAS"
							<?php
								if($college=="CAS")
									echo "selected";
							?>
						>CAS (College of Arts and Sciences)</option> 
						<option value="CDC"
							<?php
								if($college=="CDC")
									echo "selected";
							?>
						>CDC (College of Development Communication)</option>
						<option value="CEM"
							<?php
								if($college=="CEM")
									echo "selected";
							?>
						>CEM (College of Economics and Management)</option>
						<option value="CEAT"
							<?php
								if($college=="CEAT")
									echo "selected";
							?>
						>CEAT (College of Engineering and Agro-Industrial Technology)</option>
						<option value="CFNR"
							<?php
								if($college=="CFNR")
									echo "selected";
							?>
						>CFNR (College of Forestry and Natural Resources)</option>	
						<option value="CHE"
							<?php
								if($college=="CHE")
									echo "selected";
							?>
						>CHE (College of Human Ecology)</option>	
						<option value="CVM"
							<?php
								if($college=="CVM")
									echo "selected";
							?>
						>CVM (College of Veterinary Medicine)</option>
					</select>
					Course:
					<select name="course" id="course" value="<?php echo $course; ?>" >
						<option value="BSABT" id="BSABT" 
							<?php
								if($course=="BSABT")
									echo "selected";
							?>
						>BS Agricultural Biotechnology</option>
						<option value="BSABM" id="BSABM" 
							<?php
								if($course=="BSABM")
									echo "selected";
							?>
						>BS Agribusiness Management</option>
						<option value="BSABE" id="BSABE" 
							<?php
								if($course=="BSABE")
									echo "selected";
							?>
						>BS Agricultural and Biosystems Engineering</option>
						<option value="BSAC" id="BSAC" 
							<?php
								if($course=="BSAC")
									echo "selected";
							?>
						>BS Agricultural Chemistry</option>	
						<option value="BSAE" id="BSAE" 
							<?php
								if($course=="BSAE")
									echo "selected";
							?>
						>BS Agricultural Economics</option>
						<option value="BSA" id="BSA" 
							<?php
								if($course=="BSA")
									echo "selected";
							?>
						>BS Agriculture</option>
						<option value="BSAM" id="BSAM" 
							<?php
								if($course=="BSAM")
									echo "selected";
							?>
						>BS Applied Mathematics</option>
						<option value="BSAP" id="BSAP" 
							<?php
								if($course=="BSAP")
									echo "selected";
							?>
						>BS Applied Physics</option>
						<option value="BSB" id="BSB" 
							<?php
								if($course=="BSB")
									echo "selected";
							?>
						>BS Biology</option>
						<option value="BSChE" id="BSChE" 
							<?php
								if($course=="BSChE")
									echo "selected";
							?>
						>BS Chemical Engineering</option>
						<option value="BSC" id="BSC" 
							<?php
								if($course=="BSC")
									echo "selected";
							?>
						>BS Chemistry</option>
						<option value="BSCE" id="BSCE" 
							<?php
								if($course=="BSCE")
									echo "selected";
							?>
						>BS Civil Engineering</option>
						<option value="BACA" id="BACA" 
							<?php
								if($course=="BACA")
									echo "selected";
							?>
						>BA Communication Arts</option>
						<option value="BSCS" id="BSCS" 
							<?php
								if($course=="BSCS") 
									echo "selected";
							?>
						>BS Computer Science</option>
						<option value="BSDC" id="BSDC" 
							<?php
								if($course=="BSDC")
									echo "selected";
							?>
						>BS Development Communication</option>
						<option value="BSE" id="BSE" 
							<?php
								if($course=="BSE")
									echo "selected";
							?>
						>BS Economics</option>
						<option value="BSEE" id="BSEE" 
							<?php
								if($course=="BSEE")
									echo "selected";
							?>
						>BS Electrical Engineering</option>
						<option value="BSF" id="BSF" 
							<?php
								if($course=="BSF")
									echo "selected";
							?>
						>BS Forestry</option>
						<option value="BSFT" id="BSFT" 
							<?php
								if($course=="BSFT")
									echo "selected";
							?>
						>BS Food Technology</option>
						<option value="BSHE" id="BSHE" 
							<?php
								if($course=="BSHE")
									echo "selected";
							?>
						>BS Human Ecology</option>
						<option value="BSIE" id="BSIE" 
							<?php
								if($course=="BSIE")
									echo "selected";
							?>
						>BS Industrial Engineering</option>
						<option value="BSM" id="BSM" 
							<?php
								if($course=="BSM")
									echo "selected";
							?>
						>BS Mathematics</option>
						<option value="BSMST" id="BSMST" 
							<?php
								if($course=="BSMST")
									echo "selected";
							?>
						>BS Mathematics and Science Teaching</option>
						<option value="BSN" id="BSN" 
							<?php
								if($course=="BSN")
									echo "selected";
							?>
						>BS Nutrition</option>
						<option value="BAP" id="BAP" 
							<?php
								if($course=="BAP")
									echo "selected";
							?>
						>BA Philosophy</option>
						<option value="BAS" id="BAS" 
							<?php
								if($course=="BAS")
									echo "selected";
							?>
						>BA Sociology</option>						
						<option value="BSS" id="BSS" 
							<?php
								if($course=="BSS")
									echo "selected";
							?>
						>BS Statistics</option>
						<option value="BSVM" id="BSVM" 
							<?php
								if($course=="BSVM")
									echo "selected";
							?>
						>BS Vetererary Medicine</option>
					</select></br>

					<input type="submit" value="Submit" />
				</div>
			</div>
		</form>

		<form name="changePasswordForm" action="<?php echo base_url();?>index.php/user_account/change_password" method="post" >	
			<div id="container">
				<h1>Change Password</h1>

				<div id="body">
					Current Password: <input type="password" name="currentPassword" value="" required/><span name="spanCurrentPassword"></span><br/>
					New Password: <input type="password" name="newPassword" value=""required/><span name="spanNewPassword"></span><br/>
					Retype New Password: <input type="password" name="reNewPassword" value="" required/><span name="spanReNewPassword"></span><br/>
					<input type="submit" value="Change" />
				</div>
			</div>
		</form>
		<a href="<?php echo base_url();?>index.php/user_account/backtohome">Back</a>
		<script src="<?php echo base_url(); ?>js/update_account.js"></script>