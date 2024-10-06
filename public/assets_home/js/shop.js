(function ($) {
    "use strict";

    // Khởi tạo Isotope
    var $grid = $(".product-lists").isotope({
        itemSelector: ".single-product-item",
        layoutMode: "fitRows",
        getSortData: {
            price: function(itemElem) {
                // Lấy giá từ phần tử
                var price = $(itemElem).find(".product-price").text().match(/\d+/);
                return price ? parseInt(price[0], 10) : 0; // Nếu không có giá, trả về 0
            }
        }
    });

    // Filter items on button click
    $(".product-filters ul li").on("click", function () {
        $(".product-filters ul li").removeClass("active");
        $(this).addClass("active");

        var filterValue = $(this).attr("data-filter");
        // Lọc sản phẩm theo danh mục
        $grid.isotope({ filter: filterValue });
    });

    // Sắp xếp sản phẩm khi chọn thay đổi
    $("#price-sort").on("change", function() {
        var sortValue = $(this).val();
        $grid.isotope({
            sortBy: "price",
            sortAscending: sortValue === "asc" // Sắp xếp tăng dần nếu chọn "asc"
        });
    });
    
}(jQuery));
