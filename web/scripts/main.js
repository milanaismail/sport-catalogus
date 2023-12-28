document.addEventListener('DOMContentLoaded', function () {
    var sortSelect = document.getElementById('sortSelect');
    var productContainer = document.getElementById('productContainer');
    sortSelect.addEventListener('change', function () {
        var sortValue = parseInt(sortSelect.value);

        switch (sortValue) {
            case 1:
                sortProductsByPriceLowToHigh();
                break;
            case 2:
                sortProductsByPriceHighToLow();
                break;
            default:
                // Default: Do nothing or reset to original order
                break;
        }
    });

    function sortProductsByPriceLowToHigh() {
        sortProducts(function (a, b) {
            var priceA = parseFloat(a.querySelector('p').textContent.replace('€ ', ''));
            var priceB = parseFloat(b.querySelector('p').textContent.replace('€ ', ''));
            return priceA - priceB;
        });
    }

    function sortProductsByPriceHighToLow() {
        sortProducts(function (a, b) {
            var priceA = parseFloat(a.querySelector('p').textContent.replace('€ ', ''));
            var priceB = parseFloat(b.querySelector('p').textContent.replace('€ ', ''));
            return priceB - priceA;
        });
    }

    function sortProducts(comparator) {
        var products = Array.from(productContainer.querySelectorAll('.product'));
        products.sort(comparator);
        products.forEach(function (product) {
            productContainer.appendChild(product);
        });
    }
});