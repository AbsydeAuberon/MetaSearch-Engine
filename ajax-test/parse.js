

var	URLS = {
    cities : "getCities.php"
}

var DATA = {
cities : []
}

function ajax(url,params,callback){
var urlGET = url+"?"+params;
console.log(urlGET);
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        callback(this.responseText);
    }
};
xhttp.open('GET', urlGET, true);
xhttp.send();
}

function populateSelect(data){

DATA.cities = JSON.arse(data);

var sel = document.getElementById('city');
sel.innerHTML="";
var fragment = document.createDocumentFragment();

for(var i = 0; i < DATA.cities.length; i++) {
    var opt = document.createElement('option');
    opt.innerHTML = DATA.cities[i].name;
    opt.value = DATA.cities[i].name;
    fragment.appendChild(opt);
}
sel.appendChild(fragment);

}


function doThings(country){
var url = "getCities.php?country="+country;
console.log(url);
var xhttp;
xhttp=new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        gotData(this.responseText);
    }
};
xhttp.open('GET', url, true);
xhttp.send();
}

function gotData(data) {
document.getElementById('data').innerHTML = data;
}

