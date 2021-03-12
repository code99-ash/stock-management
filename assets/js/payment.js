
var feedback = document.querySelector('#feedback--cash');
var clientName = document.querySelector('#name--cash').value;
var stockId = document.querySelector('#stock_id--cash');
var price = document.querySelector('#price--cash').value;
var quantity = document.querySelector('#quantity--cash');

var staff = JSON.parse(sessionStorage.getItem('_ud'));
var staffId = staff['id'];
var paidWith = null;


var multiSale = new Array();

var selectTag = document.createElement('select');
    selectTag.classList.add('form-control');

var stocks = JSON.parse(sessionStorage.getItem('stocks'));
var option1 = `<option value="">Choose Item</option>`;
    selectTag.innerHTML += option1;

stocks.forEach(each => {
    // var option = document.createElement('option');
    // option.value = each.id;
    // option.innerHTML = each.name;
    var option  =   `<option value="${each.id}">${each.name}</option>`;
    selectTag.innerHTML += option;
});

// console.log(multiSale)


const addMoreToSale = () => {

    const lastElement = multiSale.length;
    // console.log("lastElement",lastElement)
    const lastElementIndex = lastElement - 1;
    // console.log("lastIndex", lastElementIndex);
    var lastElementId = (lastElementIndex < 0) ? 1 : multiSale[lastElementIndex]['id'] + 1;
    
    newObj = {   
                id: lastElementId,
                saleId: null, 
                price: null,
                quantity: 1, 
                total: null
            };
    multiSale = [...multiSale, newObj];
    
    console.log(multiSale);
    addMoreSale(newObj.id);
}

const removeItemFromSale = id => {
    multiSale = multiSale.filter(each => each.id !== id);
    addMoreSale(id);
}

const addMoreSale = (id) => {
    var id = id;
    // console.log("addMOreSaleID", id)
    var tbody = document.querySelector('tbody#more_tr');
        tbody.innerHTML = '';


        // var id = multiSale[i]['id'];
        // var id = id;
    for (let i = 0; i < multiSale.length; i++) {


        let selectTag = document.createElement('select');
            selectTag.classList.add('form-control');
            selectTag.setAttribute('id', id);
            
            selectTag.onchange = (event) => setPrice(event);

        let stocks = JSON.parse(sessionStorage.getItem('stocks'));

        stocks.forEach(each => {
            var option  =   `<option value="${each.id}">${each.name}</option>`;
            selectTag.innerHTML += option;
        });
            

        const element = multiSale[i];
        var tr = document.createElement('tr');
            tr.setAttribute('id', multiSale[i]['id'])

        // const entries = Object.entries(element);
        let tdZero = document.createElement('td'); // td For Deleting
        let btnMinus = `<button 
                                type="button" 
                                class="px-3 py-2 btn-danger text-light"
                                onclick="removeItemFromSale(${multiSale[i]['id']})"
                                style="border: 0 !important; outline:none !important; box-shadow: none !important; font-size: 18px"
                        >-</button>`;
            tdZero.innerHTML = btnMinus;

        tr.appendChild(tdZero);

        let tdFirst = document.createElement('td'); // First td For item
            tdFirst.appendChild(selectTag);
        tr.appendChild(tdFirst);

        let tdSecond = document.createElement('td'); // Second td  for Price
            tdSecond.innerHTML = '   ';
            tdSecond.setAttribute('id',`multiPrice${multiSale[i]['id']}`);
        tr.appendChild(tdSecond);

        let tdThird = document.createElement('td'); // Third td for quantity
        let input = document.createElement('input');
            input.setAttribute('type', 'number');
            input.setAttribute('min', 1);
            input.setAttribute('id', `quantity${id}`);
            input.value = 1;
            input.addEventListener('change', (event) => setTotal(event, multiSale[i]['id']));
            input.addEventListener('keyup', (event) => setTotal(event, multiSale[i]['id']));
            input.classList.add('form-control');

            tdThird.appendChild(input);
            tr.appendChild(tdThird);

        let tdFourth = document.createElement('td'); // Fourth td for total
            tdFourth.innerHTML = '   ';
            tdFourth.setAttribute('id',`multiTotal${multiSale[i]['id']}`);
            tr.appendChild(tdFourth);
            
            // console.log(entries);
        tbody.append(tr);
        // console.log(tr);


    }

}

const setPrice = (evt) => {
    let target = evt.target
    let id = target.id;
    let value = target.value;

    console.log(`id: ${id} ; value: ${value}`)

    var stocks = JSON.parse(sessionStorage.getItem('stocks'));
    var stockId = value; // ID in our Stock array;

    var stk = stocks.find(i => i.id == stockId);
    let price = stk.price;
    let saleId = stk.id;
    
    multiSale.find(i => {
        if(i.id == id) {

            i.price = price;
            var qty = document.querySelector(`#quantity${id}`).value;

            document.querySelector(`#multiPrice${id}`).innerHTML = price;
            document.querySelector(`#multiTotal${id}`).innerHTML = price * qty;
            i.saleId = saleId;
            i.total = i.price * qty;
        }
        // console.log(multiSale)
    });

}

const setTotal = (event, id) => {
    // console.log(`event : id => ${event.target.value} : ${id}`)
    let value = event.target.value;

    multiSale.forEach(i => {
        if(i.id == id) {
            multiSale[i]['quantity'] = value;
            // multiSale[i]['total'] = multiSale[i]['quantity'] * multiSale[i]['price'];
        }
    });
    console.log(multiSale[i])
}


const paySingleWithCash = (e) => {
    e.preventDefault();
    
    paidWith = 'cash';
    var newSale = [];
    

    if((quantity.value == '' || quantity.value < 1)) {

        feedback.innerHTML = 'All fields with * are required';

    } else {
        feedback.innerHTML = '';
        
        total = price * quantity.value;
            var obj = {stockId: stockId.value, price, quantity: quantity.value, total}

            // let test = newSale.find(i => i.stockId == stockId.value);
            
            // if(test == undefined) {
            //     newSale = [...newSale, obj];
            // }
            // console.log(obj);
            // return;

            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200){
                    // --------------------->
                    // ----------------------->
                    let res = xhr.response;
                    console.log(res)
                }
            };

            xhr.open("post", `server/api/sales.php?singleCashSale=true&id=${obj.stockId}&price=${obj.price}&qty=${obj.quantity}&total=${obj.total}&staffId=${staffId}`, true);
            xhr.send(null);
    }

}

const setTotalPrice = () => {
    //
    var total = document.querySelector('#total--cash').innerHTML;
    
    let stocks = JSON.parse(sessionStorage.getItem('stocks'));
    let stock = stocks.find(i => i.id == stockId.value);
    
    price = stock.price;

    document.querySelector('#price--cash').value = price;
    document.querySelector('.displayPrice').innerHTML = `#${price}`;

    if(parseFloat(price) > 0 && quantity.value > 0) {
        document.querySelector('#total--cash').innerHTML = `Total: #${price * quantity.value}`;
    }



}

const getAllStocks = () => {
    var xhr = new XMLHttpRequest();
    const allSelect = document.querySelectorAll('select.stock_select');
        // console.log("allSelect", allSelect)
        // console.log("length", allSelect.length)

    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200){

            var stocks = JSON.parse(xhr.response);

            sessionStorage.setItem('stocks', JSON.stringify(stocks));

            for (let k = 0; k < allSelect.length; k++) {
                
                for (let i = 0; i < stocks.length; i++) {
    
                    var option = document.createElement('option');
                        option.value = stocks[i].id;
                        option.innerHTML = stocks[i].name;
                   
                    
                    allSelect[k].appendChild(option)
                }
            
            }

        }
    };

    xhr.open("get", `server/api/stocks.php?allStocks=true`, true);
    xhr.send(null);
}

getAllStocks();

const showMoreSale = (event) => {

    var target = event.target;
    
    var more_sale = document.querySelector('#moreSale');
    if(document.querySelector('#moreSale').style.display == 'block') {
        document.querySelector('#moreSale').style.display = 'none';
        target.innerHTML = 'Multiple Product';
        document.querySelector('#singleSale').style.display = 'block';
        document.querySelector('#addMoreBtn').style.display = 'none';

    } else {
        document.querySelector('#moreSale').style.display = 'block';
        target.innerHTML = 'Single Product';
        document.querySelector('#singleSale').style.display = 'none';
        document.querySelector('#addMoreBtn').style.display = 'block';
    }
}