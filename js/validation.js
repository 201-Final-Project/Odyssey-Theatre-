window.addEvent('domready', function() {
	// Get the form
	var form = $('comments_form');

	//  if the form is found...
	if (form) {
		// obtain error fields
		var name = $('student');
		var email = $('email');
		var grade = $('grade');
    var address = $('address');
    var parent = $('parent');
    var phone0 = $('phone0');
    var emergC = $('emergC');
    var iName = $('iName');
    var parGuard = $('parGuard');
    var ind = $('ind');
    var name2 = $('name2');
    var phone1 = $('phone1');
    var phys = $('phys');
    var phone2 = $('phone2');
    var emergC2 = $('emergC2');
    var phone3 = $('phone3');
    var sig = $('sig');
    var date = $('date');

	// Set the default status
	var isValid = true;

		// input error function for the error messages
		var addError = function (field, msg) {
			field.addClass('error'); // Add error class to field
			var error = field.getParent().getElement('span') || new Element('span', {'class': 'error'}); // add error message if not already placed
			error.set('text', msg); // error text msg
			error.inject(field, 'after'); // Insert error message after field
		};

		// detach error function used to delete any error messages and remove the error class
		var removeError = function (field) {
			field.removeClass('error'); // Remove error class from form fields
			var error = field.getParent().getElement('span'); // find any existing error messages

			// destroy if error message
			if (error) {
				error.destroy();
			}
		};

		//  insert submit form event
		form.addEvent('submit', function (e) {
			// Test name length
			if (name.get('value').length === 0) {
				isValid = false;
				addError(name, nameError);
			} else {
				isValid = true;
				removeError(name);
			}

			// check email length
			if (email.get('value').length === 0) {
				isValid = false;
				addError(email, emailError);
			// check email validity
			} else if (!email.get('value').test(/^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/)) {
				isValid = false;
				addError(email, emailError);
			} else {
				isValid = true;
				removeError(email);
			}

			// check comment length
			if (comment.get('value').length === 0) {
				isValid = false;
				addError(comment, commentError);
			} else {
				isValid = true;						
				removeError(comment);
			}

			// If form invalid then stop event happening
			if (!isValid) {
				e.stop();
			}
		});
	}	
});