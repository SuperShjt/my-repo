var CryptoJS = require('crypto-js');
var AdmZip = require('adm-zip');
var https = require('https');

const { decrypt } = require('vigenere-cipher');

var download_shared_btn = document.getElementById('download-shared-file');
download_shared_btn.onclick = function(){decryptAndDownload_SHARED_Unzipped();}

async function decryptAndDownload_SHARED_Unzipped() {
    file_url = "";
    var key = document.getElementById('shared-key').value;
    let formData = new FormData();
    formData.append("isJScall", false);
    formData.append("file_url", window.location.href);
    let response = await fetch('Backend/shared-file-details.php', {       
        method: "POST",        
        body: formData
      }).then(response => response.text()
      ).then(function(text){
        file_url = text;
      }
      )

    var filename = file_url.split("/")
    filename = filename[1];
    file_url = "https://www.myrepo.online/uploads/" + file_url + ".zip";
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

var no_key_option = document.getElementById("no-key");
no_key_option.addEventListener('change', function() {
  if (this.checked) {
    // Grey out Enc Key
    document.getElementById('shared-key').disabled = true;
  } else {
    document.getElementById('shared-key').disabled = false;
  }
});