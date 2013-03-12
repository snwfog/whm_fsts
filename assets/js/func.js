$(function() {
    $('button#create-event-save').click(function() {
        var clicked, formElement, occurrence;
        clicked = $("#event-occurrence .active").length > 0;
        if (clicked) {
            occurrence = $("#event-occurrence .active").data("value");
            formElement = document.createElement("input");
            formElement.setAttribute("name", "occurrence-type");
            formElement.setAttribute("type", "hidden");
            formElement.setAttribute("value", occurrence);
            $('form[name="event-form"]').append(formElement);
        }
        return $('form[name="event-form"]').submit();
    });
    $('button#create-template-save').click(function() {
        var formElement;
        formElement = document.createElement("input");
        formElement.setAttribute("name", "is_template");
        formElement.setAttribute("type", "hidden");
        formElement.setAttribute("value", 1);
        $('form[name="event-form"]').append(formElement);
        return $('form[name="event-form"]').submit();
    });
});
