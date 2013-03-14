$(function() {
    $('button#create-event-save').click(function() {
        var clicked, formElement, occurrence, form1, form2;
        clicked = $("#event-occurrence .active").length > 0;
        if (clicked) {
            occurrence = $("#event-occurrence .active").data("value");
            formElement = document.createElement("input");
            formElement.setAttribute("name", "occurrence-type");
            formElement.setAttribute("type", "hidden");
            formElement.setAttribute("value", occurrence);
            $('form[name="event-form"]').append(formElement);
        }
        form1 = $('form[name="multiform"]');
        $('form[name="view-timeslot-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
        $('form[name="event-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
        return form1.submit();
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

    $('button#add-timeslot').click(function() {
        var count;
        count = 1;
        $('form[name="view-timeslot-form"]').append('<div id="timeslot-input">\
                          <h4>Time slot ' + count + ': &nbsp; &nbsp;\
                          <input class="span2" type="text" name="slot-start-time[]" placeholder="Start Time" />\
                          &nbsp;\
                          <input class="span2" type="text" name="slot-end-time[]" placeholder="End Time"/>\
                          &nbsp;\
                          <input class="span2" type="text" name="slot-capacity[]" placeholder="Capacity"/>\
                          </h4>\
                      </div>');
        return count = count + 1;
    });

    $('button#add-timeslot-table').click(function() {
        return $('tbody#timeslot-table-tbody')
                  .append('<tr>\
                                <td>\
                                    <input class="span" type="text" name="slot-name[]" placeholder="Name"/>\
                                </td>\
                                <td>\
                                    <input class="span5" type="text" name="slot-duration[]" placeholder="Minutes"/>\
                                </td>\
                                <td>\
                                    <input class="span" type="text" name="slot-capacity[]" placeholder="Capacity"/>\
                                </td>\
                                <td>\
                                </td>\
                          </tr>');
    });
});
