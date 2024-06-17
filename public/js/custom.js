function applyCategoryFilter() {
    var categoryId = document.getElementById('category').value;
    axios.get('/tasks?category=' + categoryId)
        .then(function (response) {
            // Xử lý dữ liệu response và cập nhật giao diện
        })
        .catch(function (error) {
            console.error(error);
        });
}
function applySearch() {
    var searchKeyword = document.getElementById('search').value;
    axios.get('/tasks?search=' + searchKeyword)
        .then(function (response) {
            // Xử lý dữ liệu response và cập nhật giao diện
        })
        .catch(function (error) {
            console.error(error);
        });
}