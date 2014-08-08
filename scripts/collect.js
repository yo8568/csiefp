
          var urls='http://140.118.155.213/m10215040/public_html/csiefp/csie.php';
           
      do {
        
        Fingerprint.init();
        Fingerprint.events.add(Fingerprint.initFlash,['http://140.118.155.213/m10215040/public_html/csiefp/scripts/Fonts.swf'])
        .add(Fingerprint.updateRTT,[10,urls])
        .add(Fingerprint.updatePlugins,[])
        .add(Fingerprint.updateCSSFonts,[cssFontList])
        .run();
        statusTimeout = setTimeout(onFinish,15000);
        setTimeout(function(){Fingerprint.onFinish(onFinish);},0);
Fingerprint.getUID();
        /*  Fingerprint.onFinish(Fingerprint.submit(urls,'error','success'));*/
        
        var i =0;
	}while(i);
  console.log(Fingerprint.status.get());
   function show(){
     var jsonString = JSON.stringify(Fingerprint.getFingerprint());
   
    /* ouput the JSON string to html */
    document.write("<h1>Your fingerprint</h1> <pre>"+jsonString+"</pre>"+"<br />");

var newArr = JSON.parse(jsonString);

while (newArr.length > 0) {
    document.write(newArr.pop() + "<br/>");
};

   

   };
   function onFinish()
{
   
    clearTimeout(statusTimeout);
    Fingerprint.onFinish = function() {};
    Fingerprint.status.onChange = function() {};

    /*$('#status').text('Sending data...');*/
    Fingerprint.submit(
  urls,
  function error()
  {
      Fingerprint.status.onChange = updateStatus;
      //console.log('error');
     /* $('#loading').fadeToggle('fast',function(){
    $('#error').fadeToggle('fast');
      });*/
      /* show error msg (highlight) and return to start page here */
      
  },
  function success()
  {
      /*$('#cookie').attr('src','/img/cookie_eaten.gif');
      $('#loading').fadeToggle('fast',function(){
    $('#thanks').fadeToggle('fast');
      });*/
      /* show thank you message here */
      //console.log('success');
  }
    );
}

function updateStatus()
{
      var status = Fingerprint.status.get();
  /*$('#status').text(status); */
    
}
/**
 * JavaScript code to detect available availability of a
 * particular font in a browser using JavaScript and CSS.
 *
 * Author : Lalit Patel
 * Website: http://www.lalit.org/lab/javascript-css-font-detect/
 * License: Apache Software License 2.0
 *          http://www.apache.org/licenses/LICENSE-2.0
 * Version: 0.15 (21 Sep 2009)
 *          Changed comparision font to default from sans-default-default,
 *          as in FF3.0 font of child element didn't fallback
 *          to parent element if the font is missing.
 * Version: 0.2 (04 Mar 2012)
 *          Comparing font against all the 3 generic font families ie,
 *          'monospace', 'sans-serif' and 'sans'. If it doesn't match all 3
 *          then that font is 100% not available in the system
 * Version: 0.3 (24 Mar 2012)
 *          Replaced sans with serif in the list of baseFonts
 */

/**
 * Usage: d = new Detector();
 *        d.detect('font name');
 */
var Detector = function() {
    // a font will be compared against all the three default fonts.
    // and if it doesn't match all 3 then that font is not available.
    var baseFonts = ['monospace', 'sans-serif', 'serif'];

    //we use m or w because these two characters take up the maximum width.
    // And we use a LLi so that the same matching fonts can get separated
    var testString = "mmmmmmmmmmlli";

    //we test using 72px font size, we may use any size. I guess larger the better.
    var testSize = '72px';

    var h = document.getElementsByTagName("body")[0];

    // create a SPAN in the document to get the width of the text we use to test
    var s = document.createElement("span");
    s.style.fontSize = testSize;
    s.innerHTML = testString;
    var defaultWidth = {};
    var defaultHeight = {};
    for (var index in baseFonts) {
        //get the default width for the three base fonts
        s.style.fontFamily = baseFonts[index];
        h.appendChild(s);
        defaultWidth[baseFonts[index]] = s.offsetWidth; //width for the default font
        defaultHeight[baseFonts[index]] = s.offsetHeight; //height for the defualt font
        h.removeChild(s);
    }

    function detect(font) {
        var detected = false;
        for (var index in baseFonts) {
            s.style.fontFamily = font + ',' + baseFonts[index]; // name of the font along with the base font for fallback.
            h.appendChild(s);
            var matched = (s.offsetWidth != defaultWidth[baseFonts[index]] || s.offsetHeight != defaultHeight[baseFonts[index]]);
            h.removeChild(s);
            detected = detected || matched;
        }
        return detected;
    }

    this.detect = detect;
};