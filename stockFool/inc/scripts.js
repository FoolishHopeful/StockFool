(function() {
  //Check is AJAX DATA Sent
  if (stockFool_ajax_object.length !== 0) {
    let ajaxData = stockFool_ajax_object;
    //Determine Short Code Type (IE Bar or Box)
    if (ajaxData.type == "bar") {
      var actionBar = document.querySelector('.action-bar');
      var stock = document.querySelector(".activeSymbol");
      var close = document.querySelector(".close");
      stock.onmouseover = stock.onmouseout = handler;
    }

    // Asyc grab json data function
    async function fetchStock(url) { // (1)
      let response = await fetch(url); // (2)
      if (response.status == 200) {
        let json = await response.json(); // (3)
        return json;
      }
      throw new Error(response.status);
    }


    // right now, promises is an array of promises -- let's turn that into values - lets get those values!
    // Only works with singe instace of shortcode per page right now. Would expand with more time.
    let stockData = fetchStock("https://financialmodelingprep.com/api/v3/profile/" + ajaxData.symbol + "?apikey=" + ajaxData.apikey).catch(alert);
    const promisedStocks = [];
    const promises = [];
    console.log(stockData);
    promises.push(stockData);
    (async () => {
      const promisedStocks = await Promise.any(promises);

      if (ajaxData.type == "bar") {
        setBar(promisedStocks[0])
      } else if (ajaxData.type == "box") {
        setBox(promisedStocks[0])
      }

    })();

    // Creates Stock Box
    function setBox(stockData) {
      var newPrice = (stockData['price'] - Math.abs(stockData['changes']));

      // Calculate Change Percentage instead of calling two api calls
      var changePercentage = eval(((stockData['price'] - newPrice) / stockData['price']) * 100);
      if (Math.sign(stockData['changes']) == 1) {
        document.getElementById("changes").classList.add("positive");
      } else {
        document.getElementById("changes").classList.add("negative");
      }
      // colors select values, makes its more pretty.
      if (changePercentage > 1) {
        document.getElementById("changePercentage").classList.add("positive");
      } else if (changePercentage < 1) {
        document.getElementById("changePercentage").classList.add("negative");
      }
      // If time, make the document writting a function so it's cleaner.
      document.getElementById("companyName").innerHTML = stockData['companyName'];
      document.getElementById("symbol").innerHTML = stockData['symbol'];
      document.getElementById("price").innerHTML = "$" + stockData['price'].toFixed(2);
      document.getElementById("changes").innerHTML = "$" + stockData['changes'].toFixed(2);
      document.getElementById("changePercentage").innerHTML = changePercentage.toFixed(2) + "%";
      document.getElementById("range").innerHTML = "$" + stockData['range'];
      document.getElementById("beta").innerHTML = stockData['beta'].toFixed(2);
      document.getElementById("volAvg").innerHTML = stockData['volAvg'];
      document.getElementById("mktCap").innerHTML = stockData['mktCap'];
      document.getElementById("lastDiv").innerHTML = "$" + stockData['lastDiv'].toFixed(2);
    }


      // Reners values on Stock Bar
    function setBar(stockData) {
      // If time, make the document writting a function so it's cleaner.
      document.getElementById("companyName").innerHTML = stockData['companyName'];
      document.getElementById("symbol").innerHTML = stockData['symbol'];
      document.getElementById("image").src = stockData['image'];
      document.getElementById("exchange").innerHTML = stockData['exchange'];
      document.getElementById("description").innerHTML = stockData['description'];
      document.getElementById("industry").innerHTML = stockData['industry'];
      document.getElementById("sector").innerHTML = stockData['sector'];
      document.getElementById("ceo").innerHTML = stockData['ceo'];
      document.getElementById("website").innerText = stockData['website'];
      document.getElementById("website").src = stockData['website'];
    }


//Simple Event handler function
    function handler(event) {

      function str(el) {
        if (!el) return "null"
        return el.className || el.tagName;
      }

      if (event.type == 'mouseover') {
        actionBar.classList.add('js-is-visible')
      }
      if (event.type == 'mouseout') {
        actionBar.classList.remove('js-is-visible')
      }
    }
  } // End Check for ajaxdata



})();
