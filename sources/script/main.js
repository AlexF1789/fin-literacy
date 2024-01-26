window.onload = (event) => {
  if(getCookie("opendyslexic")=="yes")
    changeFont();

  swaller()
        
 };

function swaller() {
  var urlParams = new URLSearchParams(window.location.search); 
  
  if(urlParams.get('state')!=null) {
    var state = urlParams.get('state');

    Swal.fire(
      '',
      message[state],
      type[state]
    )
  }

}

function help() {
  Swal.fire({
    title: 'More info',
    icon: 'info',
    html:
    '<div class="contacts" onclick="redirect(1)">' +
      '<img src="/sources/images/mailLogo.png" type="image/png" alt="Mail"/><a>Send an email</a>' +
    '</div>' +
    '<div class="contacts" onclick="redirect(2)">' +
      '<img src="/sources/images/git.png" type="image/png" alt="GitHub"/><a>GitHub repo</a>' +
    '</div>',
    showCloseButton: true,
    imageHeight: 500
  })
}

function redirect(a) {
	var link;
	switch(a) {
		case 1:
			link = "mailto:info@fin-literacy.eu";
			break;
		case 2:
			link = "https://github.com/AlexF1789/fin-literacy";
			break;
		default:
			link = "";
			break;
	}
	
	window.open(link, '_blank');
}

function logout() {
  Swal.fire({
  	title: 'Are you sure?',
  	text: "You're going to logoff from the website.",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: 'var(--secondBlack)',
  	cancelButtonColor: 'var(--redColor)',
	  cancelButtonText: 'Cancel',
	  confirmButtonText: 'Confirm'
	}).then((result) => {
 		 if (result.isConfirmed) {
    		location.replace("/sources/pages/logout.php");
  		}
  })
}

function reconizeLanguage() {
	var i = -1;
	var temp;
	do {
		i++;
		temp=navigator.languages[i];
	} while(temp.length!=2 && i<navigator.languages.length);
	
	return temp;
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  
  function deleteCookie(name) {
      setCookie(name,"",0);
  }
  
  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  
  function closeCookies() {
      setCookie("cookies","yes",7);
      document.getElementById("cookies").style.display="none";
  }

  function changeFont() {
    if(document.body.style.fontFamily!="OpenDyslexic") {
      document.body.style.fontFamily = "OpenDyslexic";
      if(getCookie("opendyslexic")=="")
        setCookie("opendyslexic","yes",1);
      
    } else {
      document.body.style.fontFamily = "";
      deleteCookie("opendyslexic");
    }
  }
  
  function changeLanguage() {
    if(homepage===undefined)
      var homepage=false;
    if(window.location.href[12]=='-') {
        if(!homepage)
            var path = window.location.href.substring(39, window.location.href.search(".php")+4);
        else
            var path = '/';
        location.replace("https://fin-literacy.eu"+path);
    } else {
        if(window.location.href.includes("?"))
          var special = "&";
        else
          var special = "?";
        var path = window.location.href.substring(23)+special;
        location.replace("https://fin--literacy-eu.translate.goog"+path+"_x_tr_sl=auto&_x_tr_tl="+reconizeLanguage()+"&_x_tr_hl="+reconizeLanguage()+"&_x_tr_pto=wapp");
    }
  }

function comment(idArt) {
  Swal.fire({
  	title: 'Comment',
  	html: "<form method='POST' action='/sources/pages/auto/insertComment.php'><input type='hidden' name='idArt' value='"+idArt+"' required readonly='readonly'><textarea name='comment' maxlength='240' rows='10' cols='50' placeholder='Write your comment here (max 240 characters)'></textarea><br><br><input type='submit' class='button' value='Pubblish'></form>",
	  showCancelButton: false,
    showConfirmButton: false,
    showCloseButton: true
  })
}

function addImage(idArt) {
  Swal.fire({
  	title: 'Add image',
  	html: "<form method='POST' action='/sources/pages/auto/insertImage.php' enctype='multipart/form-data'><input type='hidden' name='idArt' value='"+idArt+"' required readonly='readonly'><input type='hidden' name='MAX_FILE_SIZE' value='300000000'/><input type='file' name='file' id='file' required><br><br><input type='submit' class='button' value='Upload'></form>",
	  showCancelButton: false,
    showConfirmButton: false,
    showCloseButton: true
  })
}

function newDocument() {
  Swal.fire({
  	title: 'Upload document',
  	html: "<form method='POST' action='/sources/pages/auto/insertDocument.php' enctype='multipart/form-data'><input name='object' type='text' class='textField' style='width: 60%' placeholder='Object' required><br><br><input type='hidden' name='MAX_FILE_SIZE' value='300000000'><input type='file' name='file' id='file' required accept='.pdf, .txt, .doc, .docx, .odt, .xls, .xlsx, .ods, .ppt, .pptx, .odp, .png, .jpg, .jpeg, .tiff, .bmp, .gif, .mp3, .aac, .oga, .mp4, .ogg, .zip, .rar, .7z'><br><br><input type='submit' class='button' value='Upload'></form>",
	  showCancelButton: false,
    showConfirmButton: false,
    showCloseButton: true
  })
}

function delArticle(idArt) {
  Swal.fire({
      title: 'Are you sure?',
      text: "You're going to definitely delete the article and comments. This action cannot be cancelled.",
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
              location.replace("/sources/pages/auto/removeArticle.php?id="+idArt);
          }
  })
}
