<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.00.00
    </div>
    <strong>2017 <a href="http://www.acsistec.com.ar">ACSIS</a>.</strong>
</footer>
    <script type="text/javascript">
    let getUrl = function (url, success, failure) {
    	let xmlhttp;

    	if (window.XMLHttpRequest) {
    		xmlhttp = new XMLHttpRequest();
    	} else {
    		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    	}
    	xmlhttp.onreadystatechange = function() {
    		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
   				let objeto = JSON.parse(xmlhttp.responseText);
   				success(objeto);
    		} else {
    			failure(xmlhttp.responseText);
    		}
    	}
    	xmlhttp.open("GET",url,true);
    	xmlhttp.send();

    }
    
		let timedEvent = function () {
			getUrl("./users/rehash.json", console.log, console.log);
		}
    
    	window.setInterval(timedEvent, 20000);
    </script>
