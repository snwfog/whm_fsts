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

    $('button#add-timeslot-table').click(function() {
        $('tbody#timeslot-table-tbody')
                  .append('<tr>\
                                <td>\
                                </td>\
                                <td>\
                                    <input class="span" type="text" name="slot-name[]" placeholder="Name"/>\
                                </td>\
                                <td>\
                                    <input class="span5" type="number" name="slot-duration[]" placeholder="Minutes"/>\
                                </td>\
                                <td>\
                                    <input class="span5" type="text" name="slot-capacity[]" placeholder="Capacity"/>\
                                </td>\
                                <td>\
                                </td>\
                          </tr>\
                          <input class="span" type="hidden" name="slot-id[]" value=""/>');
        var table = document.getElementById('timeslot-table');
        var tableDnD = new TableDnD();
        return tableDnD.init(table);
    });


    $('button#activate-event').click(function() {
        return $('form[name="event-active-status"]').submit();
    });

    $('a[name="delete-timeslot"]').click(function() {
        var formElement;
        console.log("Deleting Timeslot");
        $deleteform = $('form[name="delete-timeslot"]')
        $row = $('tr#timeslot-row-'+this.id);
        formElement = document.createElement("input");
        formElement.setAttribute("name", "timeslot-id");
        formElement.setAttribute("type", "hidden");
        formElement.setAttribute("value", this.id);
        $deleteform.append(formElement);
        return $.ajax({
          url: '../event',
          data: $deleteform.serialize(),
          type: 'DELETE',
          success: function() {
              return $row.remove();
          }
        });

    });


    $('button#new-date-create').click(function() {
        var clicked, formElement, occurrence, form1;
        clicked = $("#event-occurrence .active").length > 0;
        if (clicked) {
            occurrence = $("#event-occurrence .active").data("value");
            formElement = document.createElement("input");
            formElement.setAttribute("name", "occurrence-type");
            formElement.setAttribute("type", "hidden");
            formElement.setAttribute("value", occurrence);
            $('form[name="event-form"]').append(formElement);
        }

        //Disabled field cannot be submit
        $("#view-event-form input").prop("disabled", false);
        $("#view-event-form textarea").prop("disabled", false);
        $("#timeslot-form input").prop("disabled", false);

        //Disable common fields
        $('#view-event-form input[name="start-date"]').prop("disabled", true)
        $('#view-event-form input[name="start-time"]').prop("disabled", true)

        form1 = $('form[name="event-date-form"]');
        $('form[name="view-timeslot-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
        $('form[name="event-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
        return form1.submit();
    });
	
	// Javascript for dynamic fields depending on work_status
	$('#work_status').blur(function() {
		var workstatusObj = document.getElementById("work_status");
		var schoolObj = document.getElementById("school");
		var schoolIdObj = document.getElementById("school-id");
		var welfareObj = document.getElementById("welfare-number");
		if(workstatusObj.value == "St")
		{
		  schoolObj.type ="text";
		  schoolIdObj.type ="text";
		  welfareObj.type ="hidden";
		}
		else if(workstatusObj.value == "Wf")
		{
		  welfareObj.type ="text";
		  schoolObj.type ="hidden";
		  schoolIdObj.type="hidden";
		}
		else
		{
		  welfareObj.type ="hidden";
		  schoolObj.type ="hidden";
		  schoolIdObj.type="hidden";
		}
	});
	
	//More complex keyboard shortcuts
	 Mousetrap.bind("0", function() { //SWITCH THEME
		var $secondStyleSheet, href, pattern;
		$secondStyleSheet = $('link[rel="stylesheet"]').first().next();
		if ($secondStyleSheet.attr("href").match("darkstrap")) {
		  $secondStyleSheet.attr("href", "");
				document.cookie = "theme=0";
		} else {
		  href = $secondStyleSheet.prev().attr("href");
		  pattern = /\/[^\/]*\.css/i;
		  $secondStyleSheet.attr("href", href.replace(pattern, "/bootstrap.darkstrap.css"));
		  document.cookie = "theme=1";
		}
	 });
	
	 Mousetrap.bind("1", function() { //STATISTIC REPORT
        window.location.href = document.getElementById("statJS").href;
     });
	
	 Mousetrap.bind("2", function() { //FUNCTIONAL REPORT
        window.location.href = document.getElementById("funcJS").href;
     });
	 
	 Mousetrap.bind("3", function() { //EVENT
        window.location.href = document.getElementById("eventJS").href;
     });
	
	 Mousetrap.bind("k", function() { //Toggle KB Legend

      var legend = document.getElementById('legendJS'); //Store the legend element object
      
      if(legend.style.display == "") //Check that the display style is empty (none) and invisible.
      {
        legend.style.display = 'block';//Make it visible
      }
      else if(legend.style.display == "block")//Case that the display style is block and visible.
      {
        legend.style.display = "";//Hide it.
      }
     });

	
});
