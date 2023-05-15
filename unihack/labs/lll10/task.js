var casper = require("casper").create();
var system = require('system');
var fs = require('fs');
var args = system.args;
var filename = args[4];

casper.start("http://challenge01.root-me.org/web-client/ch21/index.php?f="+filename);

var cookie = "PHPSESSID=qa26f3ugb5tqv7o0mbvtv414u8";
var domain = "challenge01.root-me.org";
cookie.split(";").forEach(function(pair){
    pair = pair.split("=");
    phantom.addCookie({
        'name': pair[0],
        'value': pair[1],
        'domain': domain,
        'httponly': false
    });
});

casper.userAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:43.0) Gecko/20100101 Firefox/43.0");

casper.then(function(){
    this.evaluate(function() { });
});



casper.run(function() {
    this.echo(filename);
    this.exit();
});

