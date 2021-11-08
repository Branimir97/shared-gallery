$(document).ready(function() {
  $("button").click(function() {
      $.ajax({
      type: "GET",
      url: "/management/countPhotos",
      success: function(data) {
        $("div.result").text('Total number of shared gallery photos is ' + data + '.')
      }
    });
  })
})