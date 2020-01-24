
var	URLS = {
    softgamer_items: "http://apijjimenez.000webhostapp.com/PAPI/SOFTGAMER/search_get_json_items.php",
    energydrink_items: "http://apiatomas.000webhostapp.com/individual-assignment-two/getItemsJSON.php"
}

var DATA = {
    table_elements : ["Name", "Description", "Price"],
    products_energy : [],
    products_softgamer: []
}

var MSE_Credentials = {
    mail: "mseadmin@meta.com",
    pass: "mseadmin"
}


function performSearchItems(searchString){

    var url_softgamer = URLS.softgamer_items + "?search=" + searchString + "&mail=" + MSE_Credentials.mail + "&pass=" + MSE_Credentials.pass;
    var url_energydrink = URLS.energydrink_items + "?search=" + searchString + "&mail=" + MSE_Credentials.mail + "&pass=" + MSE_Credentials.pass;
    console.log(url_softgamer);
    console.log(url_energydrink);


    generateTableIndexes();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            populateEnergyDrink(this.responseText);}
    }
    xhttp.open('GET', url_energydrink, true);
    xhttp.send();
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            populateSoftGamer(this.responseText);}
    }
    xhttp.open('GET', url_softgamer, true);
    xhttp.send();
}

function generateTableIndexes(){

    var sel = document.getElementById('products');
    sel.innerHTML="";
    var tr = document.createElement('tr');
    tr.id = "trheader";
    
    for(var i = 0; i < 3; i++) {
        var opt = document.createElement('th');
        opt.innerHTML = DATA.table_elements[i];
        opt.value = DATA.table_elements[i];
        tr.appendChild(opt);
    }

    sel.appendChild(tr);
}

function populateEnergyDrink(data){

    DATA.products_energy = JSON.parse(data);
    console.log(DATA.products_energy);

    var sel = document.getElementById('products');
    for(var i = 0; i < DATA.products_energy.length; i++){
        
        var tr = document.createElement('tr');

        for(var j = 0; j < 3; j++){
            
            var opt = document.createElement('td');

            if(j == 0){        
                opt.innerHTML = DATA.products_energy[i].Brand + " " + DATA.products_energy[i].Name;
                opt.value = DATA.products_energy[i].Brand +  " " + DATA.products_energy[i].Name;
            }

            if(j == 1){        
                opt.innerHTML = DATA.products_energy[i].Description;
                opt.value = DATA.products_energy[i].Description;
            }

            if(j == 2){        
                opt.innerHTML = DATA.products_energy[i].Price;
                opt.value = DATA.products_energy[i].Price;
            }


            tr.appendChild(opt);
        }

        sel.appendChild(tr);
    }

    //Name = brand + name

}

function populateSoftGamer(data){

    DATA.products_softgamer = JSON.parse(data);
    console.log(DATA.products_softgamer);

    var sel = document.getElementById('products');
    for(var i = 0; i < DATA.products_softgamer.length; i++){
        
        var tr = document.createElement('tr');

        for(var j = 0; j < 3; j++){
            
            var opt = document.createElement('td');

            if(j == 0){        
                opt.innerHTML = DATA.products_softgamer[i].Name;
                opt.value = DATA.products_softgamer[i].Name;
            }

            if(j == 1){        
                opt.innerHTML = DATA.products_softgamer[i].Description;
                opt.value = DATA.products_softgamer[i].Description;
            }

            if(j == 2){        
                opt.innerHTML = DATA.products_softgamer[i].Price;
                opt.value = DATA.products_softgamer[i].Price;
            }


            tr.appendChild(opt);
        }

        sel.appendChild(tr);
    }
}

