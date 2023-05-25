var file_url = 'http://83b6-41-44-88-220.ngrok.io/uploads/blob.zip';

var AdmZip = require('adm-zip');
var http = require('http');
unZipper();
function unZipper(){
    http.get(file_url, function(res) {
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
          console.log("zipEntries.length = " + zipEntries.length)
      
          for (var i = 0; i < zipEntries.length; i++) {
            console.log(zip.readAsText(zipEntries[i]));
          }
        return zipEntries;

        });
      });
    
    
}

export { unZipper };

