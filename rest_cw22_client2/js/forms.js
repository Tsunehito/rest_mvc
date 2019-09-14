// Display a table
document.addEventListener('DOMContentLoaded', (event) => {
    getAllArticle();
});

// Event to add title & content
var formAddArticle = document.querySelector('#formAddArticle');
formAddArticle.addEventListener("submit", (event)=>{
    postArticle(event.srcElement.title.value, event.srcElement.content.value);
    event.preventDefault();
});

// Delete a row of the table
// document.addEventListener('DOMContentLoaded', function() {
//     var tableDeleteArticle = document.querySelectorAll('#deleteRow');
//     console.log(tableDeleteArticle);
//     tableDeleteArticle.addEventListener("click", (event) => {
//         event.preventDefault();
//         console.log(event.srcElement);
//         formDeleteArticle(event.srcElement)
//     });
// });

// window.addEventListener('DOMContentLoaded', (event) =>{

// });

// const tableDeleteArticle = document.querySelector('#tableArticle table');
// console.log(tableDeleteArticle);

// tableDeleteArticle.addEventListener("click", (event) => {
//     event.preventDefault();
//     console.log(event.srcElement);
//     formDeleteArticle(event.srcElement)
// });