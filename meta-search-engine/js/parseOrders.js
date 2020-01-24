
var	URLS = {
    softgamer_orders: "http://apijjimenez.000webhostapp.com/PAPI/SOFTGAMER/search_get_json_orders.php",
    energydrink_orders: "http://apiatomas.000webhostapp.com/individual-assignment-two/getOrdersJSON.php"
}

var DATA = {
    table_elements : ["Order_Number", "Name", "Description", "Price", "Date", "Quantity"],
    orders_energy_products : [],
    orders_softgamer_products: [],
    orders_energy_order_prod : [],
    orders_softgamer_order_prod: [],
    orders_energy_order : [],
    orders_softgamer_order: [],
}

var MSE_Credentials = {
    mail: "mseadmin@meta.com",
    pass: "mseadmin"
}

var booleans = 
{
    BoolSoftGamer_order: false,
    BoolSoftGamer_order_prod: false,
    BoolSoftGamer_product: false,
}


function getJSONEnergy(url)
{
    var def = "&ordertype=";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            DATA.orders_energy_order = JSON.parse(this.responseText);}
    }
    xhttp.open('GET', url+def+"1", false);
    xhttp.send();

    var xhttp2 = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            DATA.orders_energy_order_prod = JSON.parse(this.responseText);}
    }
    xhttp.open('GET', url+def+"2", false);
    xhttp.send();

    var xhttp3 = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            DATA.orders_energy_products = JSON.parse(this.responseText);}
    }
    xhttp.open('GET', url+def+"3", false);
    xhttp.send();
}

function getJSONSoftgamer(url)
{
    var def = "&ordertype=";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            DATA.orders_softgamer_order = JSON.parse(this.responseText);
        }
    }
    xhttp.open('GET', url+def+"1", false);
    xhttp.send();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            DATA.orders_softgamer_order_prod = JSON.parse(this.responseText);
            }
    }
    xhttp.open('GET', url+def+"2", false);
    xhttp.send();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            DATA.orders_softgamer_products = JSON.parse(this.responseText);
            }
    }

    xhttp.open('GET', url+def+"3", false);
    xhttp.send();



    
}

function performSearchOrders(mailPassed){

    var url_softgamer = URLS.softgamer_orders + "?mail=" + MSE_Credentials.mail + "&pass=" + MSE_Credentials.pass + "&mailuser=" + mailPassed;
    var url_energydrink = URLS.energydrink_orders + "?mail=" + MSE_Credentials.mail + "&pass=" + MSE_Credentials.pass + "&mailuser=" + mailPassed;


    generateTableIndexes();
    getJSONSoftgamer(url_softgamer);

    populateSoftGamer();
    
}

function generateTableIndexes(){

    var sel = document.getElementById('orders');
    sel.innerHTML="";
    var tr = document.createElement('tr');
    tr.id = "trheader";
    
    for(var i = 0; i < DATA.table_elements.length; i++) {
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

    //Name = brand + name*/

}

function populateSoftGamer(){

    var sel = document.getElementById('orders');

    for(var x = 0;  x < DATA.orders_softgamer_order.length; x++)
    {

        for(var i = 0; i < DATA.orders_softgamer_order_prod.length; i++){
        
            var tr = document.createElement('tr');
    
            for(var j = 0; j < DATA.table_elements.length; j++){
                
                var opt = document.createElement('td');
    
                switch(j)
                {
                    case 0:
                        opt.innerHTML = DATA.orders_softgamer_order_prod[i].ID_Order;
                        opt.value = DATA.orders_softgamer_order_prod[i].ID_Order;
                        break;
    
                    case 1:
                        opt.innerHTML = DATA.orders_softgamer_products[i].Name;
                        opt.value = DATA.orders_softgamer_order_prod[i].Name;
                        break;
                
                    case 2:
                        opt.innerHTML = DATA.orders_softgamer_products[i].Description;
                        opt.value = DATA.orders_softgamer_order_prod[i].Description;
                        break;
                    
                    case 3:
                        opt.innerHTML = DATA.orders_softgamer_order_prod[i].Price_At_The_Moment;
                        opt.value = DATA.orders_softgamer_order_prod[i].Price_At_The_Moment;
                        break;
    
                    case 4:
                        opt.innerHTML = DATA.orders_softgamer_order[x].Time;
                        opt.value = DATA.orders_softgamer_order_prod[x].Time;
                        break;
    
                    case 5:
                        opt.innerHTML = DATA.orders_softgamer_order_prod[i].Number_Quantity;
                        opt.value = DATA.orders_softgamer_order_prod[i].Number_Quantity;
                        break;
                }
                console.log(opt);
                tr.appendChild(opt);
            }
    
            sel.appendChild(tr);
        }
    }
}

