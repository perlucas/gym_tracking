function setUpAlertCloseButtons() {
    let alertButtons = $("button[data-dismiss='alert']");

    alertButtons.on('click', function() {
        $(this).parent().remove();
    });
    
    setTimeout(function() {
        alertButtons
            .parent()
            .fadeOut(400, function() {
                $(this).remove();
            });
    }, 5000);
}

$(document).ready(function() {
    
    // set up alert close event for existing alerts
    setUpAlertCloseButtons();

    // periodically check for new alerts
    setTimeout(setUpAlertCloseButtons, 10000);

});