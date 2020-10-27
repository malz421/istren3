$(".modaladdperiode").on("click", function (e) {
  var dataURL = $(this).attr("data-href");
  e.preventDefault();
  $(".modal-content").load(dataURL, function () {
    $("#modalperiode").modal({
      backdrop: 'static'
    });
  });
});