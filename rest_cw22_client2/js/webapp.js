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
            console.log(responseJson);
        });
}

getAllArticle();