function recover() {
    Swal.fire({
        title: 'Recover password',
        html: '<form method="POST" action="/sources/pages/auto/sendMailRecovery.php"><input name="mail" placeholder="Email Address" required type="text" class="textField" style="width: 60%"><br><br><input type="submit" class="button" value="Recover"></form>',
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true
    })
}

function register() {
    Swal.fire({
        title: 'Sign in',
        html: '<form method="POST" action="/sources/pages/auto/newRegistration.php"><input name="mail" type="text" placeholder="Email address" class="textField" style="width: 60%" required><br><input type="text" name="surname" placeholder="Surname" class="textField" style="width: 60%" required><br><input type="text" name="name" placeholder="Name" class="textField" style="width: 60%" required><br><input type="password" name="password" placeholder="Password" class="textField" style="width: 60%" required><br><input type="password" name="confirmPassword" placeholder="Confirm Password" class="textField" style="width: 60%" required><br><br><a>Nationality</a>&emsp;<select name="nationality" required>'+nations()+'</select><br><br><a>I accept the </a><a href="/sources/docs/privacyPolicy.pdf" target="_blank" class="link">privacy policy</a></a>&emsp;<input type="checkbox" required><br><br><input type="submit" value="Register" class="button"></post>',
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true
    })
}

function editData(surname,name) {
    Swal.fire({
        title: 'Edit data',
        html: '<form method="POST" action="/sources/pages/auto/editData.php"><input type="text" name="surname" placeholder="Surname" style="width: 60%;" value="'+surname+'" required class="textField"><br><br><input type="text" name="name" placeholder="Name" style="width: 60%;" value="'+name+'" required class="textField"><br><br><a>Nationality</a>&emsp;<select name="nationality" required>'+nations()+'</select><br><br><input type="submit" class="button" value="Edit"></form>',
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true
    })
}

function editPwd() {
    Swal.fire({
        title: 'Edit your password',
        text: "In order to edit your password you'll be logged out and you have to recover your password. Pressing confirm will take you to the login page where you'll find the password recovery link.",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: 'var(--secondBlack)',
        cancelButtonColor: 'var(--redColor)',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Confirm'
      }).then((result) => {
            if (result.isConfirmed)
                location.replace("/sources/pages/logout.php");
    })
}

function deleteAccount() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You're going to definitely delete your account and comments. This action cannot be cancelled.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'var(--redColor)',
        cancelButtonColor: 'var(--secondBlack)',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Confirm'
      }).then((result) => {
            if (result.isConfirmed) {
              var a = Math.floor(Math.random() * 10);
              var b = Math.floor(Math.random() * 10);
              var somma = a*1+b*1

              if(window.prompt("In order to confirm you understood what you are doing enter the sum of "+a+" and "+b,"")==somma)
                location.replace("/sources/pages/auto/sendMailRemotion.php");
            }
    })
}

function configTelegram() {
    Swal.fire({
        title: 'Configure Telegram',
        html: '<p style="text-align: left">Here you can setup the Telegram notifications for your account. In order to configure them you have to follow the following steps:</p><ul><li>download and open Telegram on your mobile device</li><li>press the search icon in the upper right angle of the screen and write <i>@showmeidbot</i>, then press the first result</li><li>press <i>Start</i> at the bottom of the chat</li><li>remind the bold text has been sent to you by the bot</li><li>go back to the search box and write <i>@fliteracy_bot</i>, then press <i>Start</i> at the bottom of the page</li><li>paste the bold text of the fourth step in the following text field</li></ul></p><form method="POST" action="/sources/pages/auto/configTG.php"><input type="number" name="chatID" class="textField" style="width: 60%" required placeholder="chat ID"><br><br><input type="submit" class="button" value="Save"></form>',
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true
    })
}

function nations() {
    /*for(var i=0;i<225;i++) {
        document.writeln("<img src=\"/sources/images/flags/"+stati[i][0]+".png\" type='image/png' alt='MISSING' style='height: 25px; margin-right: 10px;'>")
    }*/

    var optionNations = '';
    
    for(var i=0;i<225;i++)
        optionNations += "<option value='"+stati[i][0]+"'>"+stati[i][1]+"</option>";

    return optionNations;
}

// CONSTANT ARRAY WITH ALL THE 225 STATES 

const stati = [
    ["af", "Afghanistan"],
    ["al", "Albania"],
    ["dz", "Algeria"],
    ["ad", "Andorra"],
    ["ao", "Angola"],
    ["ai", "Anguilla"],
    ["ag", "Antigua and Barbuda"],
    ["ar", "Argentina"],
    ["am", "Armenia"],
    ["aw", "Aruba"],
    ["au", "Australia"],
    ["at", "Austria"],
    ["az", "Azerbaijan"],
    ["bs", "Bahamas"],
    ["bh", "Bahrain"],
    ["bd", "Bangladesh"],
    ["bb", "Barbados"],
    ["by", "Belarus"],
    ["be", "Belgium"],
    ["bz", "Belize"],
    ["bj", "Benin"],
    ["bm", "Bermuda"],
    ["bt", "Bhutan"],
    ["bo", "Bolivia"],
    ["ba", "Bosnia and Herzegovina"],
    ["bw", "Botswana"],
    ["br", "Brazil"],
    ["vg", "British Virgin Islands"],
    ["bn", "Brunei"],
    ["bg", "Bulgaria"],
    ["bf", "Burkina Faso"],
    ["bi", "Burundi"],
    ["kh", "Cambodia"],
    ["cm", "Cameroon"],
    ["ca", "Canada"],
    ["cv", "Cape Verde"],
    ["ky", "Cayman Islands"],
    ["cf", "Central African Republic"],
    ["td", "Chad"],
    ["cl", "Chile"],
    ["cn", "China"],
    ["co", "Colombia"],
    ["km", "Comoros"],
    ["cg", "Congo"],
    ["ck", "Cook Islands"],
    ["cr", "Costa Rica"],
    ["ci", "Côte d'Ivoire"],
    ["hr", "Croatia"],
    ["cu", "Cuba"],
    ["cy", "Cyprus"],
    ["cz", "Czech Republic"],
    ["cd", "Democratic Republic of the Congo"],
    ["dk", "Denmark"],
    ["dj", "Djibouti"],
    ["dm", "Dominica"],
    ["do", "Dominican Republic"],
    ["ec", "Ecuador"],
    ["eg", "Egypt"],
    ["sv", "El Salvador"],
    ["gq", "Equatorial Guinea"],
    ["er", "Eritrea"],
    ["ee", "Estonia"],
    ["et", "Ethiopia"],
    ["fk", "Falkland Islands"],
    ["fo", "Faroe Islands"],
    ["fj", "Fiji"],
    ["fi", "Finland"],
    ["fr", "France"],
    ["gf", "French Guiana"],
    ["pf", "French Polynesia"],
    ["ga", "Gabon"],
    ["gm", "Gambia"],
    ["ge", "Georgia"],
    ["de", "Germany"],
    ["gh", "Ghana"],
    ["gi", "Gibraltar"],
    ["gr", "Greece"],
    ["gl", "Greenland"],
    ["gd", "Grenada"],
    ["gp", "Guadeloupe"],
    ["gt", "Guatemala"],
    ["gn", "Guinea"],
    ["gw", "Guinea-Bissau"],
    ["gy", "Guyana"],
    ["ht", "Haiti"],
    ["hn", "Honduras"],
    ["hk", "Hong Kong"],
    ["hu", "Hungary"],
    ["is", "Iceland"],
    ["in", "India"],
    ["id", "Indonesia"],
    ["ir", "Iran"],
    ["iq", "Iraq"],
    ["ie", "Ireland"],
    ["il", "Israel"],
    ["it", "Italy"],
    ["jm", "Jamaica"],
    ["jp", "Japan"],
    ["jo", "Jordan"],
    ["kz", "Kazakhstan"],
    ["ke", "Kenya"],
    ["ki", "Kiribati"],
    ["kw", "Kuwait"],
    ["kg", "Kyrgyzstan"],
    ["la", "Laos"],
    ["lv", "Latvia"],
    ["lb", "Lebanon"],
    ["ls", "Lesotho"],
    ["lr", "Liberia"],
    ["ly", "Libya"],
    ["li", "Liechtenstein"],
    ["lt", "Lithuania"],
    ["lu", "Luxembourg"],
    ["mo", "Macao"],
    ["mk", "Macedonia"],
    ["mg", "Madagascar"],
    ["mw", "Malawi"],
    ["my", "Malaysia"],
    ["mv", "Maldives"],
    ["ml", "Mali"],
    ["mt", "Malta"],
    ["mh", "Marshall Islands"],
    ["mq", "Martinique"],
    ["mr", "Mauritania"],
    ["mu", "Mauritius"],
    ["yt", "Mayotte"],
    ["mx", "Mexico"],
    ["fm", "Micronesia"],
    ["md", "Moldova"],
    ["mc", "Monaco"],
    ["mn", "Mongolia"],
    ["me", "Montenegro"],
    ["ms", "Montserrat"],
    ["ma", "Morocco"],
    ["mz", "Mozambique"],
    ["mm", "Myanmar"],
    ["na", "Namibia"],
    ["nr", "Nauru"],
    ["np", "Nepal"],
    ["nl", "Netherlands"],
    ["nc", "New Caledonia"],
    ["nz", "New Zealand"],
    ["ni", "Nicaragua"],
    ["ne", "Niger"],
    ["ng", "Nigeria"],
    ["nu", "Niue"],
    ["nf", "Norfolk Island"],
    ["kp", "North Korea"],
    ["mp", "Northern Mariana Islands"],
    ["no", "Norway"],
    ["om", "Oman"],
    ["pk", "Pakistan"],
    ["pw", "Palau"],
    ["ps", "Palestine"],
    ["pa", "Panama"],
    ["pg", "Papua New Guinea"],
    ["py", "Paraguay"],
    ["pe", "Peru"],
    ["ph", "Philippines"],
    ["pl", "Poland"],
    ["pt", "Portugal"],
    ["pr", "Puerto Rico"],
    ["qa", "Qatar"],
    ["re", "Réunion"],
    ["ro", "Romania"],
    ["ru", "Russia"],
    ["rw", "Rwanda"],
    ["bl", "Saint Barthélemy"],
    ["sh", "Saint Helena"],
    ["kn", "Saint Kitts and Nevis"],
    ["lc", "Saint Lucia"],
    ["mf", "Saint Martin"],
    ["pm", "Saint Pierre and Miquelon"],
    ["vc", "Saint Vincent and the Grenadines"],
    ["ws", "Samoa"],
    ["sm", "San Marino"],
    ["st", "São Tomé and Príncipe"],
    ["sa", "Saudi Arabia"],
    ["sn", "Senegal"],
    ["rs", "Serbia"],
    ["sc", "Seychelles"],
    ["sl", "Sierra Leone"],
    ["sg", "Singapore"],
    ["sk", "Slovakia"],
    ["si", "Slovenia"],
    ["sb", "Solomon Islands"],
    ["so", "Somalia"],
    ["za", "South Africa"],
    ["kr", "South Korea"],
    ["es", "Spain"],
    ["lk", "Sri Lanka"],
    ["sd", "Sudan"],
    ["sr", "Suriname"],
    ["sz", "Swaziland"],
    ["se", "Sweden"],
    ["ch", "Switzerland"],
    ["sy", "Syria"],
    ["tw", "Taiwan"],
    ["tj", "Tajikistan"],
    ["tz", "Tanzania"],
    ["th", "Thailand"],
    ["tl", "Timor-Leste"],
    ["tg", "Togo"],
    ["to", "Tonga"],
    ["tt", "Trinidad and Tobago"],
    ["tn", "Tunisia"],
    ["tr", "Turkey"],
    ["tm", "Turkmenistan"],
    ["tc", "Turks and Caicos Islands"],
    ["tv", "Tuvalu"],
    ["ug", "Uganda"],
    ["ua", "Ukraine"],
    ["ae", "United Arab Emirates"],
    ["gb", "United Kingdom"],
    ["us", "United States"],
    ["uy", "Uruguay"],
    ["uz", "Uzbekistan"],
    ["vu", "Vanuatu"],
    ["va", "Vatican City"],
    ["ve", "Venezuela"],
    ["vn", "Vietnam"],
    ["wf", "Wallis and Futuna"],
    ["ye", "Yemen"],
    ["zm", "Zambia"],
    ["zw", "Zimbabwe"]
  ];
  