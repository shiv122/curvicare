window.addEventListener("load", function () {
    var load_screen = document.getElementById("custom-loader");
    document.body.removeChild(load_screen);
    if ($('.dataTables_scrollBody').length > 0) {
        const pss = new PerfectScrollbar('.dataTables_scrollBody');
    }
    // $("body").wrapInner("<div class='bodyScroll' style='overflow:auto;height:100%;position:relative'></div>");
    // const body_ps = new PerfectScrollbar('.bodyScroll');
});




