$ ->
  # Get the full pathname
  pathname = $(location).attr "pathname"
  # Splat and get the "could be" local path
  # because we don't know if it is a local path or not
  [first, path...] = pathname.split '/'
#  if path.length >= 3

  # Submit the create household form
  $('button#create-household-save').click ->
    $('form[name="household-create"]').submit()

  # Submit the create household member form
  $('button#add-household-member-save').click ->
    $('form[name="member-create"]').submit()

  $('button#flag-create-save').click ->
    clicked = $("#flag-types .active").length > 0;
    alert("Choose a Flag") if not clicked
    if clicked
        flagD_id = $("#flag-types .active").data("value")
        formElement = document.createElement("input")
        formElement.setAttribute("name", "flag-descriptor-id")
        formElement.setAttribute("type", "hidden");
        formElement.setAttribute("value", flagD_id)
        $('form[name="flag-create-form"]').append(formElement)  
        $('form[name="flag-create-form"]').submit()

  $('button.flag-delete-btn').click ->
    console.log "trying to delete a flag"
    $form = $(this).siblings("form")
    $.ajax({
      url: 'flag',
      data: $form.serialize(),
      type: 'DELETE',
      success: ->
        $group = $form.parents('div.accordion-group')
        $group.remove()
    })

  #####################################################################################
  # Bootstrap Typeahead for ORIGINS and LANGUAGES
  # Sexy way of doing typeahead with ajax & bootstrap
  # http://stackoverflow.com/questions/9232748/twitter-bootstrap-typeahead-ajax-example
  # http://tatiyants.com/how-to-use-json-objects-with-twitter-bootstrap-typeahead/
  #####################################################################################
  $("input[name='origin']").typeahead(
    source: (query, process) ->
      return $.ajax(
        url: $(this)[0].$element.data('link')
        type: 'get'
        data: {query : query}
        dataType: 'json'
        success: (json) ->
          countries = []
          $.each json, (code, country) ->
            countries.push country.trim().toUpperCase()
          return process(countries)
      )
  )

  $("input[name='language']").typeahead(
    source: (query, process) ->
      return $.ajax(
        url: $(this)[0].$element.data('link')
        type: 'get'
        data: {query : query}
        dataType: 'json'
        success: (json) ->
          languages = []
          $.each json, (name, languageObj) ->
            languages.push languageObj['name'].trim().toUpperCase()
          return process(languages)
      )
  )

  $("input[name='mother-tongue']").typeahead(
    source: (query, process) ->
      return $.ajax(
        url: $(this)[0].$element.data('link')
        type: 'get'
        data: {query : query}
        dataType: 'json'
        success: (json) ->
          languages = []
          $.each json, (name, languageObj) ->
            languages.push languageObj['name'].trim().toUpperCase()
          return process(languages)
      )
  )

  usermap = {}
  $("input.search-query").typeahead(
    source: (query, process) ->
      return $.ajax(
        url: $(this)[0].$element.data('link') + "/" + query
        type: 'get'
        dataType: 'json'
        success: (json) ->
          members = []
          usermap = {}
          if json?
            $.each json, (index, member) ->
              mapKey = (member['last_name'] + ", " + member['first_name']).toUpperCase()
              mapValue =
                household_id: member.household_id
                member_id: member.id
                mcare: member.mcare_number
              usermap[mapKey] = mapValue
              members.push mapKey
            process(members)
      )
    matcher: (item) ->
      console.log "Matcher called for item: #{item}"
      console.log usermap[item]
      if item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1 then return true
      if usermap[item]['mcare'].toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1 then return true
    updater: (item) ->
      url = "household/#{usermap[item].household_id}/#{usermap[item].member_id}"
      console.log url
      $(location).attr('href', url);
      $.get(url)
      return item
  )

  ###################
  # Auto Filling Form
  ###################

  ## Auto filling for postal code <-> district mapping
  $('input[name="postal-code"]').focus ->
    map = {}
    $.get 'postalcode', (data) ->
      $.each data, (index, value) ->
        $.each value, (postalcode, district) ->
          map[postalcode] = district

    $('input[name="postal-code"]').keyup ->
      val = $(this).val()
      $district = $('input[name="district"]')
      if val.length >= 3
        reg = /^\w\d\w/i
        match = (reg.exec val)[0].toUpperCase() if reg.exec val
        if map[match]?
          $district.css 'background-color', ''
          $district.val map[match]
        else
          $district.css({ 'background-color': '#f1dede' })
          $district.val "Invalid Postal Code"
  true
