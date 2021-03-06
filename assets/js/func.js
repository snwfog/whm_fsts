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
        form1 = $('form[name="event-form"]');
        $('form[name="view-timeslot-form"] :input').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
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
                                    <input class="span12" type="text" name="slot-name[]" placeholder="Name"/>\
                                </td>\
                                <td>\
                                    <input class="span12" type="number" name="slot-duration[]" placeholder="Minutes"/>\
                                </td>\
                                <td>\
                                    <input class="span12" type="text" name="slot-capacity[]" placeholder="Size"/>\
                                </td>\
                                <td>\
                                  <button type="button" class="btn btn-danger" name="delete-timeslot" id="{{timeslot.id}}" onclick="this.parentNode.parentNode.remove();">\
                                      <i class="icon-white icon-trash"></i>\
                                  </button>\
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

    $('button[name="delete-timeslot"]').click(function() {
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

    $('a[name="delete-new-timeslot"]').click(function() {
        $(this).parents("tr").remove();
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
        $('form[name="event-form"] :input, :text').not(':submit').clone().hide().attr('isacopy','y').appendTo(form1);
        return form1.submit();
    });
	
	// Javascript for dynamic fields depending on work_status

	$('#work_status').change(function() {
		var workstatusObj = document.getElementById("work_status");
		var schoolObj = document.getElementById("school");
		var schoolIdObj = document.getElementById("student-id");
    var grade = document.getElementById("grade");
    var bursary = document.getElementById("bursary");
		var welfareObj = document.getElementById("welfare-number");
		if(workstatusObj.value == "student")
		{
		  schoolObj.type ="text";
		  schoolIdObj.type ="text";
      grade.type ="text";
      bursary.type ="text";
		  welfareObj.type ="hidden";
		}
		else if(workstatusObj.value == "welfare")
		{
		  welfareObj.type ="text";
		  schoolObj.type ="hidden";
		  schoolIdObj.type="hidden";
      grade.type ="hidden";
      bursary.type ="hidden";
		}
		else
		{
		  welfareObj.type ="hidden";
		  schoolObj.type ="hidden";
		  schoolIdObj.type="hidden";
      grade.type ="hidden";
      bursary.type ="hidden";
		}
	});	
		// Javascript for dynamic fields depending on work_status MODAL ADD HOUSEHOLD

	$('#work_status1').change(function() {
		var workstatusObj1 = document.getElementById("work_status1");
		var schoolObj1 = document.getElementById("school1");
		var schoolIdObj1 = document.getElementById("student-id1");
    var grade1 = document.getElementById("grade1");
    var bursary1 = document.getElementById("bursary1");
		var welfareObj1 = document.getElementById("welfare-number1");
		if(workstatusObj1.value == "student")
		{
		  schoolObj1.type ="text";
		  schoolIdObj1.type ="text";
      grade1.type ="text";
      bursary1.type ="text";
		  welfareObj1.type ="hidden";
		}
		else if(workstatusObj1.value == "welfare")
		{
		  welfareObj1.type ="text";
		  schoolObj1.type ="hidden";
		  schoolIdObj1.type="hidden";
      grade1.type ="hidden";
      bursary1.type ="hidden";
		}
		else
		{
		  welfareObj1.type ="hidden";
		  schoolObj1.type ="hidden";
		  schoolIdObj1.type="hidden";
      grade1.type ="hidden";
      bursary1.type ="hidden";
		}
	});	
		// Javascript for dynamic fields depending on work_status MODAL ADD MEMBER

	$('#work_status2').change(function() {
		var workstatusObj2 = document.getElementById("work_status2");
		var schoolObj2 = document.getElementById("school2");
		var schoolIdObj2 = document.getElementById("student-id2");
    var grade2 = document.getElementById("grade2");
    var bursary2 = document.getElementById("bursary2");
		var welfareObj2 = document.getElementById("welfare-number2");
		if(workstatusObj2.value == "student")
		{
		  schoolObj2.type ="text";
		  schoolIdObj2.type ="text";
      grade2.type ="text";
      bursary2.type ="text";
		  welfareObj2.type ="hidden";
		}
		else if(workstatusObj2.value == "welfare")
		{
		  welfareObj2.type ="text";
		  schoolObj2.type ="hidden";
		  schoolIdObj2.type="hidden";
      grade2.type ="hidden";
      bursary2.type ="hidden";
		}
		else
		{
		  welfareObj2.type ="hidden";
		  schoolObj2.type ="hidden";
		  schoolIdObj2.type="hidden";
      grade2.type ="hidden";
      bursary2.type ="hidden";
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

    Mousetrap.bind("4", function() { //EVENT
        window.location.href = document.getElementById("todayseventsJS").href;
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
