var xmlHTTP = createXmlHttpRequestObject();
function createXmlHttpRequestObject() {
    var xmlHttp;

    if (window.ActiveXObject) {
        try {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            xmlHttp = false;
        }
    } else {

        try {
            xmlHttp = new XMLHttpRequest();
        } catch (e) {
            xmlHttp = false;
        }
    }
    if (!xmlHttp)
        alert("can't create that object hoss!");
    else
        return xmlHttp;

}
function process() {
    if (xmlHTTP.readyState == 0 || xmlHTTP.readyState == 4) {
        food = encodeURIComponent(document.getElementById("userInput").valueOf);
        xmlHTTP.open("POST", "foodstore.php", true);
        xmlHTTP.onreadystatechange = handleServerResponse;
        xmlHTTP.send();
    } else {
        setTimeout('process()', 1000);
    }
}
function handleServerResponse() {
    if (xmlHTTP.readyState == 4) {
        if (xmlHTTP.status == 200) {
            xmlResponse = xmlHTTP.responseXML;
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            document.getElementById("underInput").innerHTML = '<span style ="color:blue">' + message + '</span>';
            setTimeout('process()', 1000);
        } else {
            alert('something went wrong!');
        }
    }
}