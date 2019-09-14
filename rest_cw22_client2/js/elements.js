// creat a table from JSON
function jsonToTable(json, classes)
{
    var creatTable = document.querySelector("#tableArticle");
    var keys = json['message'][0];
    var jsonArticles = json['message'];
    var cols = Object.keys(keys);
    var headerRow = '';
    var bodyRows = '';
    var table = '';

    var classes = classes || '';

    cols.forEach(col => {
        headerRow += '<th scope="col">' + col.toUpperCase() + '</th>';
    });

    headerRow += '<th scope="col">ACTION</th>';

    for (var i in jsonArticles) {
        bodyRows += '<tr>';
        var article = jsonArticles[i]
        for (var j in article) {
            bodyRows += '<td>' + article[j] + '</td>';
        }

        // Btn edit
        bodyRows += '<td><button type="button" class="btn btn-outline-success" id="editRow" value="'+ article['id'] +'">Edit</button></td>';
        // Btn delete
        bodyRows += '<td><button type="button" class="btn btn-outline-danger" id="deleteRow" value="'+ article['id'] +'">X</button></td>';
        bodyRows += '</tr>';
    }

    table =  '<table class="table ' + classes + '">' 
                + '<thead><tr>' + headerRow + '</tr></thead>'  
                + '<tbody class="tbody">' + bodyRows + '</body></table>';
    
    return creatTable.innerHTML = table;
}

// creat a table from JSON
function addRowToTable(json)
{
    var tbody = document.querySelector('.tbody');
    var keys = json['message'][0];
    var jsonArticles = json['message'];
    var cols = Object.keys(keys);
    var headerRow = '';
    var bodyRow = '';
    var table = '';

    for (var i in jsonArticles) {
        bodyRow += '<tr>';
        var article = jsonArticles[i]
        for (var j in article) {
            bodyRow += '<td>' + article[j] + '</td>';
        }

        // Btn edit
        bodyRow += '<td><button type="button" class="btn btn-outline-success" id="editRow" value="'+ article['id'] +'">Edit</button></td>';
        // Btn delete
        bodyRow += '<td><button type="button" class="btn btn-outline-danger" id="deleteRow" value="'+ article['id'] +'">X</button></td>';
        bodyRow += '</tr>';
    }

    var newRow = tbody.insertRow(tbody.rows.length);
    return newRow.innerHTML = bodyRow;
    
    // return parent.append(bodyRow);
}