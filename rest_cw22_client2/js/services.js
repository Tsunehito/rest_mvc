function getAllArticle() {

    var headers = new Headers();
    var params = {
        method: 'GET',
        headers: headers,
        mode: 'cors',
        cache: 'default',
    }

    var request = new Request('http://localhost/rest_mvc/rest_cw22_mvc2/article', params);

    fetch(request, params)
        .then(function(response) {
            return response.json();
        })
        .then(function(responseJson) {
            jsonToTable(responseJson, 'table table-dark table-hover table-striped');
        });
}

function postArticle(title, content) {
    var headers = new Headers();
    var params = {
        method: 'POST',
        headers: headers,
        mode: 'cors',
        cache: 'default',
        body: 'title=' + title + '&content=' + content
    };

    var request = new Request('http://localhost/rest_mvc/rest_cw22_mvc2/article', params);
    fetch(request, params)
        .then(function(response) {
            return response.json();
        })
        .then(function(responseJson) {
            addRowToTable(responseJson);
        });
}

function deleteArticle(id){
    var headers = new Headers();
    var params = {
        method: 'DELETE',
        headers: headers,
        mode: 'cors',
        cache: 'default',
        body: 'id=' + id
    };

    var request = new Request('http://localhost/rest_mvc/rest_cw22_mvc2/article', params);

    fetch(request, params)
        .then(function(response) {
            return response.json();
        })
        .then(function(responseJson) {
            console.log(responseJson);
        });
}
