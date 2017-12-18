$(document).ready(function(){
    // Initialize collapse button
    $(".button-collapse").sideNav();
    // initialize parrallax component
    $('.parallax').parallax();

    // then we close the menu on click
    $('#nav-items').click(function() {
        if ($( window ).width() < 1000) {
            $(".button-collapse").sideNav('hide');
        }            
    });

    /*
    Form Submit
    */
    $(".form-contact").submit(OnSubmit);

    function OnSubmit(data) {
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: OnSuccess
        });
        return false;
    } // OnSubmit()

    function OnSuccess(result) {
        if (result != "Ok") {
            Materialize.toast(result, 4000);
        } else {
            Materialize.toast('Message bien envoyé !', 6000);
        }
    } // OnSuccess()
});

