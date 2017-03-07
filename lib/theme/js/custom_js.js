/* browse file type*/
    var fileinput=$('input[type=file]');
        fileinput.change(function() {
        $(this).next('.result_browsefile').html('<span class="brows">Browse </span>'+$(this).val());
     });
  /* browse file type end*/