<?php 
// Set email variables
$email_to = 'shargus@mac.com';
$email_subject = 'Form submission';

// Set required fields
$required_fields = array();'student','grade','email','address','parent','phone0','emergC','iName','parGuard','ind','name2','phone1','phys','phone2','emergC2','phone3','sig','date'

// set error messages
$error_messages = array(
	'student' => 'Please enter a Name to proceed.',
  'grade'  => 'Please enter students grade to continue.'
  'email'  => 'Please enter your email to continue.'
  'address'  => 'Please enter your adress to continue.'
  'parent'  => 'Please enter parent name to continue.'
  'phone0'  => 'Please enter parent phone to continue.'
  'emergC'  => 'Please enter name of emergency contact to continue.'
  'iName'  => 'Please enter name of parent/guardian to continue.'
  'parGuard'  => 'Please enter name of student to continue.'
  'ind'  => 'Please enter allergies and medications NOT to take -or enter none- to continue.'
  'name2'  => 'Please enter parent/guardian name to continue.'
  'phone1'  => 'Please enter parent/guardian cell number to continue.'
  'phys'  => 'Please enter your family physician to continue.'
  'phone2'  => 'Please enter physician phone to continue.'
  'emergC2'  => 'Please enter emergency contact name to continue.'
  'phone3'  => 'Please enter emergency contact cell number to continue.'
  'sig'  => 'Please enter your signature to continue.'
  'date'  => 'Please enter the date to continue.'
);

// Set form status
$form_complete = FALSE;

// configure validation array
$validation = array();

// check form submittal
if(!empty($_POST)) {
	// Sanitise POST array
	foreach($_POST as $key => $value) $_POST[$key] = remove_email_injection(trim($value));
	
	// Loop into required fields and make sure they match our needs
	foreach($required_fields as $field) {		
		// the field has been submitted?
		if(!array_key_exists($field, $_POST)) array_push($validation, $field);
		
		// check there is information in the field?
		if($_POST[$field] == '') array_push($validation, $field);
		
		// validate the email address supplied
		if($field == 'email') if(!validate_email_address($_POST[$field])) array_push($validation, $field);
	}
	
	// basic validation result
	if(count($validation) == 0) {
		// Prepare our content string
		$email_content = 'New Website Comment: ' . "\n\n";
		
		// simple email content
		foreach($_POST as $key => $value) {
			if($key != 'submit') $email_content .= $key . ': ' . $value . "\n";
		}
		
		// if validation passed ok then send the email
		mail($email_to, $email_subject, $email_content);
		
		// Update form switch
		$form_complete = TRUE;
	}
}

function validate_email_address($email = FALSE) {
	return (preg_match('/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i', $email))? TRUE : FALSE;
}

function remove_email_injection($field = FALSE) {
   return (str_ireplace(array("\r", "\n", "%0a", "%0d", "Content-Type:", "bcc:","to:","cc:"), '', $field));
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Register</title>
      <meta name="description" content="">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/reset.css">
      <link rel="stylesheet" href="css/register.css">
      <link rel="stylesheet" href="css/nav.css">
      <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@500&family=Cinzel&family=Kanit:wght@700&family=Montserrat:wght@589&family=Orbitron:wght@500;900&family=Oswald:wght@600&family=Source+Sans+Pro:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
      <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
      <script>
         function initPayPalButton() {
         paypal.Buttons({
            style: {
               shape: 'rect',
               color: 'gold',
               layout: 'vertical',
               label: 'paypal',
            },
            createOrder: function(data, actions) {
               return actions.order.create({
               purchase_units: [{"description":"Tuition","amount":{"currency_code":"USD","value":1}}]
               });
            },
            onApprove: function(data, actions) {
               return actions.order.capture().then(function(orderData) {
               // Full available details
               console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
               // Show a success message within this page, e.g.
               const element = document.getElementById('paypal-button-container');
               element.innerHTML = '';
               element.innerHTML = '<h3>Thank you for your payment!</h3>';
               // Or go to another URL:  actions.redirect('thank_you.html');
               });
            },
            onError: function(err) {
               console.log(err);
            }
         }).render('#paypal-button-container');
         }
         initPayPalButton();
      </script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools-yui-compressed.js"></script>

      <script type="text/javascript">
		    var nameError = '<?php echo $error_messages['student']; ?>';
		    var emailError = '<?php echo $error_messages['email']; ?>';
		    var gradeError = '<?php echo $error_messages['grade']; ?>';
        var addressError = '<?php echo $error_messages['address']; ?>';
        var parentError = '<?php echo $error_messages['parent']; ?>';
        var phone0Error = '<?php echo $error_messages['phone0']; ?>';
        var emergCError = '<?php echo $error_messages['emergC']; ?>';
        var iNameError = '<?php echo $error_messages['iName']; ?>';
        var parGuardError = '<?php echo $error_messages['parGuard']; ?>';
        var indError = '<?php echo $error_messages['ind']; ?>';
        var name2Error = '<?php echo $error_messages['name2']; ?>';
        var phone1Error = '<?php echo $error_messages['phone1']; ?>';
        var physError = '<?php echo $error_messages['phys']; ?>';
        var phone2Error = '<?php echo $error_messages['phone2']; ?>';
        var emergC2Error = '<?php echo $error_messages['emergC2']; ?>';
        var phone3Error = '<?php echo $error_messages['phone3']; ?>';
        var sigError = '<?php echo $error_messages['sig']; ?>';
        var dateError = '<?php echo $error_messages['date']; ?>';
	    </script>


<!-- Contact Form Designed by James Brand @ dreamweavertutorial.co.uk -->
<!-- Covered under creative commons license - http://dreamweavertutorial.co.uk/permissions/contact-form-permissions.htm -->

   </head>
   <body>
      <nav id="navbar" class="navigation">
         <input id="toggle1" type="checkbox" />
         <label class="hamburger1" for="toggle1">
            <div class="top"></div>
            <div class="meat"></div>
            <div class="bottom"></div>
         </label>
         <nav class="menu1">
            <ul>
               <li>
                  <h2>Events</h2>
               </li>
               <li><a class="link1" href="index.html">Home</a></li>
               <li><a class="link1" href="workshops.html">Workshops</a></li>
               <li><a class="link1" href="register.html">Register</a></li>
            </ul>
            <ul>
               <li>
                  <h2>About</h2>
               </li>
               <li><a class="link1" href="tenFaqs.html">FAQS</a></li>
               <li><a class="link1" href="aboutUs.html">About Us</a></li>
               <li><a class="link1" href="pastProductions.html">Past Shows</a></li>
            </ul>
            <ul>
               <li>
                  <h2>Support</h2>
               </li>
               <li><a class="link1" href="becomeInvolved.html">Get Involved</a></li>
               <li><a class="link1" href="internships.html">Internships</a></li>
               <li><a class="link1" href="donation.html">Donate</a></li>
            </ul>
            <ul>
               <li>
                  <h2>Media</h2>
               </li>
               <li><a class="link1" href="https://www.instagram.com/odysseytheatrellc/?hl=en">Instagram</a></li>
               <li><a class="link1" href="https://www.facebook.com/groups/133442666671631">Facebook</a></li>
            </ul>
         </nav>
      </nav>
      <main>
         <h3>Register</h3>
         <section class="imagesLeft">
            <img src="Images/register4.png" alt="youngGirlStageLeft">
            <img src="Images/register6.png" alt="frogboy">
            <img src="Images/register11.png" alt="dancingGirls">
            <img src="Images/register8.png" alt="HumptyDumpty">
            <img src="Images/register9.png" alt="princessInBlue">
         </section>
         <section class="imagesRight">
            <img src="Images/register7.png" alt="FourStarsWizard">
            <img src="Images/register1.png" alt="backstagePuttingOnMakeup">
            <img src="Images/register13.png" alt="tinMan">
            <img src="Images/register14.png" alt="OliverSitting">
            <img src="Images/register12.png" alt="seerBigHat">
            <img src="Images/register20.png" alt="girlBeingBullied">
         </section>
         
         <article id="OdysseyRegistrationForm">
            <form action="">
               <div>
                 
                  <b id="topText">For the Young of Art <br>
                  Summer Drama Workshop</b>
               </div>
               <img src="/assets/OdysseySquareLogofinal-KarlasChoice.png" alt="Odyssey Logo" width="80vw"><br>
               <b>&emsp;&emsp;WHO?</b> Any student K-12 grades interested in learning more about theatre and putting on a play---Tech and Acting students both welcome to apply--Tech students must be in at least 5th grade; Interns 8th and up!  Students 8th and up may also be "Acterns" if they wish to do both. <br>
               <br>
               <b>&emsp;&emsp;WHAT?</b> A three week long intensive workshop that meets Mon-Thurs noon till three, beginning Monday, of the classic play <br>
               <br>
               <div>
                  <b id = "middleText">(TBA)</b><br>
               </div>
               <br>
               <b>&emsp;&emsp;WHEN?</b> The workshop will begin at noon Monday, & ends with performances Friday at 7pm & Saturday at 2pm. <br>
               <br>
               <b>&emsp;&emsp;WHERE?</b> Workshop will be held at the MV District Auditorium. <br>
               <br>
               <b>&emsp;&emsp;HOW?</b> Mail in registration with your deposit of $100 to hold a spot.  Tuition for the intensive workshop is $225---for K-8th (which includes all materials, scripts, music) families with multiple student participants receive discount of $20 for each additional student.  Need-based scholarships are available upon inquiry.  High Schoolers and 8th grade interns are tuition-free.<br><br>
               <b>&emsp;&emsp;Questions?</b> <b id="numEmail"> (319)213-0147 / Steffran5@gmail.com</b> <b>ODYSSEY THEATRE, 315 Third St. SW, MV, IA 52314</b><br><br>
            <form id="registrationForm" post="">
            <?php if($form_complete === FALSE): ?>
            <form action="contact.php" method="post" id="registrationForm_form">
            <form> 
               <br>
               <label for="student">Student</label>
               <input type="text" id="student" name="student" size="30" value="<?php echo isset($_POST['student'])? $_POST['student'] : ''; ?>" /><?php if(in_array('student', $validation)): ?><span class="error"><?php echo $error_messages['student']; ?></span><?php endif; ?> 

               <label for="grade">Grade</label>
               <input type="text" id="grade" name="grade" size="4" value="<?php echo isset($_POST['grade'])? $_POST['grade'] : ''; ?>" /><?php if(in_array('grade', $validation)): ?><span class="error"><?php echo $error_messages['grade']; ?></span><?php endif; ?> 

               <label for="email">Email</label>
               <input type="text" id="email" name="email" size="22" value="<?php echo isset($_POST['email'])? $_POST['email'] : ''; ?> " /><?php if(in_array('email', $validation)): ?><span class="error"><?php echo $error_messages['email']; ?></span><?php endif; ?><br>

               <label for="address">Address</label>
               <input type="text" id="address" name="address" size="79" value="<?php echo isset($_POST['address'])? $_POST['address'] : ''; ?> " /><?php if(in_array('address', $validation)): ?><span class="error"><?php echo $error_messages['address']; ?></span><?php endif; ?><br>

               <label for="parent">Parent(s)</label>
               <input type="text" id="parent" name="parent" size="44" value="<?php echo isset($_POST['parent'])? $_POST['parent'] : ''; ?>" /><?php if(in_array('parent', $validation)): ?><span class="error"><?php echo $error_messages['parent']; ?></span><?php endif; ?> 

               <label for="work">Work#</label>
               <input type="text" id="work" name="work" size="22" value="<?php echo isset($_POST['work'])? $_POST['work'] : ''; ?>" /><?php if(in_array('work', $validation)): ?><span class="error"><?php echo $error_messages['work']; ?></span><?php endif; ?> <br>

               <label for="phone0">Phone/cell</label>
               <input type="text" id="phone0" name="phone0" size="77" value="<?php echo isset($_POST['phone0'])? $_POST['phone0'] : ''; ?>" /><?php if(in_array('phone0', $validation)): ?><span class="error"><?php echo $error_messages['phone0']; ?></span><?php endif; ?> <br>

               <label for="emergC">Emergency Contact#</label>
               <input type="text" id="emergC" name="emergC" size="67" value="<?php echo isset($_POST['emergC'])? $_POST['emergC'] : ''; ?>" /><?php if(in_array('emergC', $validation)): ?><span class="error"><?php echo $error_messages['emergC']; ?></span><?php endif; ?> 
               <button>Submit</button>
               </form> 
               <?php else: ?>
               <p>Thank you, Your registration has been received!</p>
               <?php endif; ?>
               <br><br><br><br>
            </form>
            </form>
            <br><br><br><br>
            <hr><br>
            <div id="smart-button-container">
               <div>
                  <div id="paypal-button-container"></div>
               </div>
            </div>
            <hr>
            <form id="emergencyForm" action="submit">
            <?php if($form_complete === FALSE): ?>
            <form action="contact.php" method="post" id="emergencyForm_form">
            <form    >
               <div> An Iowa Not-for-Profit Corporation</div>
               EMERGENCY MEDICAL TREATMENT AUTHORIZATION
               <br><br><br>
               <label for="iName">I,</label>
               <input type="text" id="iName" name="iName" size="22" value="<?php echo isset($_POST['iName'])? $_POST['iName'] : ''; ?>" /><?php if(in_array('iName', $validation)): ?><span class="error"><?php echo $error_messages['iName']; ?></span><?php endif; ?> 

               <label for="parGuard">(parent/guardian) of</label>
               <input type="text" id="parGuard" name="parGuard" size="22" value="<?php echo isset($_POST['parGuard'])? $_POST['parGuard'] : ''; ?>" /><?php if(in_array('parGuard', $validation)): ?><span class="error"><?php echo $error_messages['parGuard']; ?></span><?php endif; ?>  who is/will be a student enrolled in Odyssey Theatre for the Young of Art's workshop do hereby expressly authorize any of the following steps, when deemed necessary and appropriate by Odyssey personnel, to be taken by Odyssey staff in the event of a medical emergency involving my child/ward, which may arise on the premises of the school during an Odyssey sponsored activity.
               <br><br />
               -To notify and request aid, if appropriate, of trained emergency medical personnel for immediate treatment of my child/ward.
               <br />-To transport my child/ward to the nearest medical facility for appropriate medical treatment.
               <br />  <br />
               It is agreed that Odyssey personnel along with authorized medical personnel will have the exclusive and immediate right to determine when, in its judgment, such medical emergency shall exist. If in the judgment of Odyssey personnel it is appropriate, under the circumstances, Odyssey will also attempt to contact me and the person/persons I have named as my emergency contact on the Odyssey registration, before taking any of the above listed emergency steps. <br>
               It is agreed that if and when Odyssey personnel does report the matter to me, as the parent/guardian, Odyssey will then no longer have principal responsibility for the emergency care of my child/ward but will become the agent of myself, the parent/guardian. <br>
               It is agreed that any and all such emergency medical expense(s) for the necessary treatment will be the complete responsibility of myself, the parent/guardian.<br>
               It is agreed that I, the parent/guardian, will reimburse Odyssey for any expense incurred by Odyssey on behalf of my child/ward for such emergency treatment.
               It is agreed that I, the parent/guardian will indemnify and hold harmless, Odyssey Theatre for the Young of Art, and/or its agents, and/or employees, and/or the school district of Mount Vernon from any and all claims and losses which may be incurred or which may be claimed as a result of the alleged acts or alleged failures to act during the emergency.<br>
               As a parent/guardian of the above named individual, I advise that he/she has the following allergies and/or cannot take the following medications.
               <br><br>
               <section id="form2Input">
                  If none, 
                  <label for="ind">indicate:</label>
                  <input type="text" id="ind" name="ind" size="70" value="<?php echo isset($_POST['ind'])? $_POST['ind'] : ''; ?>" /><?php if(in_array('ind', $validation)): ?><span class="error"><?php echo $error_messages['ind']; ?></span><?php endif; ?>   <br>

                  <label for="name2">Name</label>
                  <input type="text" id="name2" name="name2" size="35" value="<?php echo isset($_POST['name2'])? $_POST['name2'] : ''; ?>" /><?php if(in_array('name2', $validation)): ?><span class="error"><?php echo $error_messages['name2']; ?></span><?php endif; ?> 

                  <label for="phone1">PHONE</label>
                  <input type="text" id="phone1" name="phone1" size="22" value="<?php echo isset($_POST['phone1'])? $_POST['phone1'] : ''; ?>" /><?php if(in_array('phone1', $validation)): ?><span class="error"><?php echo $error_messages['phone1']; ?></span><?php endif; ?>  <br>

                  <label for="phys">Family Physician</label>
                  <input type="text" id="phys" name="phys" size="28" value="<?php echo isset($_POST['phys'])? $_POST['phys'] : ''; ?>" /><?php if(in_array('phys', $validation)): ?><span class="error"><?php echo $error_messages['phys']; ?></span><?php endif; ?> 

                  <label for="phone2">PHONE</label>
                  <input type="text" id="phone2" name="phone2" size="22" value="<?php echo isset($_POST['phone2'])? $_POST['phone2'] : ''; ?>" /><?php if(in_array('phone2', $validation)): ?><span class="error"><?php echo $error_messages['phone2']; ?></span><?php endif; ?>  <br>

                  <label for="emergC2">Emergency Contact</label>
                  <input type="text" id="emergC2" name="emergC2" size="28" value="<?php echo isset($_POST['emergC2'])? $_POST['emergC2'] : ''; ?>" /><?php if(in_array('emergC2', $validation)): ?><span class="error"><?php echo $error_messages['emergC2']; ?></span><?php endif; ?> 

                  <label for="phone3">PHONE</label>
                  <input type="text" id="phone3" name="phone3" size="22" value="<?php echo isset($_POST['phone3'])? $_POST['phone3'] : ''; ?>" /><?php if(in_array('phone3', $validation)): ?><span class="error"><?php echo $error_messages['phone3']; ?></span><?php endif; ?>  <br>

                  <label for="sig">Parent/Guardian Signature:</label>
                  <input type="text" id="sig" name="sig" size="28" value="<?php echo isset($_POST['sig'])? $_POST['sig'] : ''; ?>" /><?php if(in_array('sig', $validation)): ?><span class="error"><?php echo $error_messages['sig']; ?></span><?php endif; ?> 

                  <label for="date">DATE</label>
                  <input type="text" id="date" name="date" size="10" value="<?php echo isset($_POST['date'])? $_POST['date'] : ''; ?>" /><?php if(in_array('date', $validation)): ?><span class="error"><?php echo $error_messages['date']; ?></span><?php endif; ?>  <br>

                  <label for="comments">Comments:</label>
                  <input type="text" id="comments" name="comments" size="80" value="<?php echo isset($_POST['comments'])? $_POST['comments'] : ''; ?>" /><?php if(in_array('comments', $validation)): ?><span class="error"><?php echo $error_messages['comments']; ?></span><?php endif; ?>  <br>

               </section>
               <button>Submit</button>
                  </form>
               <?php else: ?>
               <p>Thank you, Your EMERGENCY MEDICAL TREATMENT AUTHORIZATION form has been received!</p>
               <?php endif; ?>
               
               <br>
            </form>
         </article>
      </main>
   </body>
</html>