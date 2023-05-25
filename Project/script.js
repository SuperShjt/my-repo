var xhr = new XMLHttpRequest();
var CryptoJS = require('crypto-js');
var AdmZip = require('adm-zip');
var https = require('https');
const crypto = require('crypto');
const { encrypt } = require('vigenere-cipher');
const { decrypt } = require('vigenere-cipher');

var loading_screen = document.getElementById('loading-screen');

// Key Generation
var gen_key = document.getElementById('generate-key');
gen_key.addEventListener('click', generate_key);


// close-popup
var close_popup = document.getElementById('close-popup');
close_popup.addEventListener('click', hide_popup);

function hide_popup(){
  document.getElementById('containerx').style.display = "none";
}

// Upload File upon clicking on "Upload" Button
var upload_button = document.getElementById('upload-button');
upload_button.addEventListener('click', uploadFile);

var no_key_option = document.getElementById("no-key");
no_key_option.addEventListener('change', function() {
  if (this.checked) {
    // Grey out Enc Key
    document.getElementById('enc_key').disabled = true;
    document.getElementById('generate-key').disabled = true;
    document.getElementById('generate-key').style.backgroundColor = "grey";
    document.getElementById('generate-key').style.cursor = "not-allowed";
    document.getElementById('generate-key').style.transform = "scale(1)";
    
  } else {
    document.getElementById('enc_key').disabled = false;
    document.getElementById('generate-key').disabled = false;
    document.getElementById('generate-key').style.backgroundColor= "#4caf52";
    document.getElementById('generate-key').style.cursor = "pointer";
  }
});

var sharable_file = document.getElementById("sharable");
sharable_file.addEventListener('change', function() {
  if (this.checked) {
    // Grey out Enc Key
    document.getElementById('enc_key_inp').innerHTML = "Enter your <strong> Shared </strong>encryption key: <span id='bad-css'>03;</span> ";
  } else {
    document.getElementById('enc_key_inp').innerHTML = "Enter your encryption key: <span id='bad-css'>0ssddsas3;</span> ";
  }
});

// Show X button

/*****   To be fixed later    *****
var show_delete = document.getElementsByClassName('file-card');
Array.from(show_delete).forEach((element, index) => {
  element.addEventListener('mouseover', function(){showRemoveButton(); i=i+1}
  , false)
});
******/


var i = 0;
var download_file = document.getElementsByClassName('download-file');
Array.from(download_file).forEach((element, index) => {
  element.addEventListener('click', function(){
    show_popup(index);
    i=i+1
  }, false)
});


function show_popup(index){
  // Enable pop-up
  document.getElementById('containerx').style.display = "block";

  // Add ability to download file 
  document.getElementById('download-btn-popup').onclick = function(){decryptAndDownload_Unzipped(index);}
  document.getElementById('pop-up-dec-key').innerHTML = document.getElementById("dec_key").value;
  
  // Add ability to share file
  document.getElementById('share-btn-popup').onclick = async function(){

    var x = document.getElementById("snackbar");

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);

    
    var filename = document.getElementsByClassName("download-file")[index].innerHTML;
    let formData = new FormData();
    formData.append("filename", filename);
    formData.append("id",document.getElementById('userIdInput').value);
    formData.append("saltedID",document.getElementById('saltedID').value);
    formData.append("isJScall", true);
    

    let response = await fetch('Backend/getLink.php', {       
      method: "POST",        
      body: formData
    }).then(response => response.text()
    ).then(function(text){
      document.getElementById('shared-link-header').style.display= "block";
      document.getElementById('shared-link').innerHTML = text;
      
      /* Copy the text inside the text field */
      navigator.clipboard.writeText(document.getElementById('link-clipboard').innerHTML);
    }
    )
    }
}


var i = 0;
var delete_file = document.getElementsByClassName('delete-button');
Array.from(delete_file).forEach((element, index) => {
  element.addEventListener('click', function(){deleteFile(index); i=i+1}
  , false)
});

function generate_key(){
  const randomString = crypto.randomBytes(8).toString("hex");
  document.getElementById("enc_key").value = randomString;
}

function showRemoveButton() {
  //document.querySelector(".delete-button").style.visibility = "visible";
  var x = document.getElementsByClassName('delete-button');
  Array.from(x).forEach((element, index) => {
    if (element.style.visibility === "hidden"){
      element.style.visibility = "visible";
    } else {
      element.style.visibility = "hidden";
    }
    
  });
}   

function random_string(length) {
  var result           = '';
  var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  for ( var i = 0; i < length; i++ ) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
 }
 return result;
}

function convertWordArrayToUint8Array(wordArray) {
  var arrayOfWords = wordArray.hasOwnProperty("words") ? wordArray.words : [];
  var length = wordArray.hasOwnProperty("sigBytes") ? wordArray.sigBytes : arrayOfWords.length * 4;
  var uInt8Array = new Uint8Array(length), index=0, word, i;
  for (i=0; i<length; i++) {
      word = arrayOfWords[i];
      uInt8Array[index++] = word >> 24;
      uInt8Array[index++] = (word >> 16) & 0xff;
      uInt8Array[index++] = (word >> 8) & 0xff;
      uInt8Array[index++] = word & 0xff;
  }
  return uInt8Array;
}
  
function uploadFile() {
  var key = document.getElementById("enc_key").value;
  if (key.length < 8 && !no_key_option.checked){
    var box = document.getElementById('enc_key');
    box.style.borderColor = "#e61919";
    box.style.borderWidth = "medium";
    alert("Key Cannot be less than 8 characters. Please enter a more secure key.");
    return;
  }
  var file = fileupload.files[0];
  var reader = new FileReader();
  var fileEnc = null;
  reader.onload = function() {
      // var key = "abc123"; // Will later be replaced with user's private key
      var wordArray = CryptoJS.lib.WordArray.create(reader.result);
      //console.log("before: " + wordArray);
      var encrypted = CryptoJS.AES.encrypt(wordArray, key).toString();
      //console.log("after [from encryption]: " + encrypted);
      var fileEnc = new Blob([encrypted]);
      encryptAndUpload(fileEnc);
    }
    reader.readAsArrayBuffer(file); 
}

async function encryptAndUpload(file) {
  var key = document.getElementById("enc_key").value;
  var filename = document.getElementById("user_file_name").value;
  var fileInput = document.getElementById('fileupload');  
  var file_type = (fileInput.files[0].name.split("."));
  
  if(filename == ""){ // User didn't enter a custom name
    filename = fileInput.files[0].name;
  } else { // Add the extension the custom name 
    filename = filename + '.' + file_type[file_type.length - 1];;
  }
  filename = fileNameFix(filename);
  filename = filename.substr(0, filename.length - file_type.length - 1) // if filename is "test.txt" -> just get "test"
  file_type = file_type[file_type.length - 1];  // filetype = "txt" 
  var enc_type = encrypt(file_type, key.replace(/[0-9]/g, '')) // encrypt "txt" with the only the characters of the key
  if(filename.slice(-1) == '.'){
    filename = filename + enc_type; 
  } else {
    filename = filename + '.' + enc_type; 
  }
  
  let formData = new FormData();
  formData.append('file', file, filename);
  formData.append("id",document.getElementById('userIdInput').value);
  formData.append("saltedID",document.getElementById('saltedID').value);


  loading_screen.style.display = "block";
  let response = await fetch('upload-form.php', {       
    method: "POST",        
    body: formData 
  });
  loading_screen.style.display = "none";
  alert("Upload, Encryption, and Compression Completed Successfully.");
  document.location.reload(true);

}

async function decryptAndDownload_Unzipped(index) {
  var filename = document.getElementsByClassName("download-file")[index].innerHTML;
  var key = document.getElementById("dec_key").value;
  var userLocation = document.getElementById("saltedID").value;
  var file_url = window.location.href + 'uploads/' + userLocation + '/' + filename + '.zip';
  file_url = file_url.replace('Userpage.php','');
  file_url = file_url.replace('#',''); // for anchor tags -- if any.
  //var file_url = 'https://c656-41-44-88-220.ngrok.io/uploads/test_new.zip';

  https.get(file_url,  function(res) {
    var data = [], dataLen = 0; 
  
    res.on('data', function(chunk) {
      data.push(chunk);
      dataLen += chunk.length;

    }).on('end', function() {
      var buf = Buffer.alloc(dataLen);
  
      for (var i = 0, len = data.length, pos = 0; i < len; i++) { 
        data[i].copy(buf, pos); 
        pos += data[i].length; 
      } 

      var zip = new AdmZip(buf);
      var zipEntries = zip.getEntries();
      var decrypted = (CryptoJS.AES.decrypt(zip.readAsText(zipEntries[0]), key));

      var typedArray = convertWordArrayToUint8Array(decrypted);
      var fileDec = new Blob([typedArray]);

      //File Name
      var file_type = (filename.split("."));
      filename = filename.substr(0, filename.length - file_type[1].length - 1) // if filename is "test.cyu" -> just get "test"
      file_type = file_type[file_type.length - 1];  // filetype = "cyu" 
      var enc_type = decrypt(file_type, key.replace(/[0-9]/g, '')) // decrypt "cyu" with the only the characters of the key
      filename = filename +'.' + enc_type; 

      // DOWNLOAD
      var a = document.createElement("a");
      var url = window.URL.createObjectURL(fileDec);
      a.href = url;
      a.download = filename;
      a.click();
      window.URL.revokeObjectURL(url);

    });
  });
}


async function deleteFile(index){

  var filename = document.getElementsByClassName("delete-button")[index].name;
  let isSure = confirm("Are you sure to remove " + filename + "?");
  if (!isSure) return;
  let formData2 = new FormData();
  formData2.append('filename', filename);
  formData2.append("id",document.getElementById('userIdInput').value);
  formData2.append("saltedID",document.getElementById('saltedID').value);

  let response = await fetch('Backend/DeleteFolder.php', {       
    method: "POST",        
    body: formData2 
  })
  alert("File Removed Successfully.");
  document.location.reload(true);
}

function fileNameFix(str){
  // Replace spaces with '-'
  var editedStr = str.split(' ').join('-')

  // Replace '.' with '-' except for the last . 
  var indexOfLastDot = editedStr.lastIndexOf('.');
  editedStr = editedStr.split('.').join('-');
  
  function setCharAt(str,index,chr) {
    if(index > str.length-1) return str;
    return str.substring(0,index) + chr + str.substring(index+1);
  }

  if (indexOfLastDot != -1){
    editedStr = setCharAt(editedStr, indexOfLastDot, '.');
  }
  
  return editedStr;
}


