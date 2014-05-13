 $(function() {
                navigator.userLanguage = 'de';


                var defaultOptions = {
                    //availableListPosition: 'bottom',
                    moveEffect: 'blind',
                    moveEffectOptions: {direction:'vertical'},
                    moveEffectSpeed: 'fast'
                };

                var widgets = {
                    'simple': $.extend($.extend({}, defaultOptions), {
                        sortMethod: 'standard',
                        sortable: true
                    }),
                    'disabled': $.extend({}, defaultOptions),
                    'groups': $.extend($.extend({}, defaultOptions), {
                        sortMethod: 'standard',
                        showEmptyGroups: true,
                        sortable: true
                    }),
                    'dynamic': $.extend({}, defaultOptions)
                };

                $.each(widgets, function(k, i) {
                    $('#multiselect_'+k).multiselect(i).on('multiselectChange', function(evt, ui) {
                        var values = $.map(ui.optionElements, function(opt) {return $(opt).attr('value'); }).join(', ');
                        //$('#debug_'+k).prepend( $('<div></div>').text('Multiselect change event! ' + (ui.optionElements.length == $('#multiselect_'+k).find('option').size() ? 'all ' : '') + (ui.optionElements.length + ' value' + (ui.optionElements.length > 1 ? 's were' : ' was')) + ' ' + (ui.selected ? 'selected' : 'deselected') + ' (' + values + ')') );
                       //$('#test').prepend( $('<div ></div>').text('(' + values + ')') );
                        $("#test").val(values);
                        }).on('multiselectSearch', function(evt, ui) {
                        $('#debug_'+k).prepend( $('<div></div>').text('Multiselect beforesearch event! searching for "' + ui.term + '"') );
                    }).closest('form').submit(function(evt) {
                    //}).onsubmit(function(evt) { 

                    	$('#mytest').append("<input type='hidden' name='submitValue' value='"+$(this).serialize()+"' />");
                    	$('input[name=mytest]').val("Submit query = " + $(this).serialize());
                    	//var test3 = $("<input>")
                        //.attr("type", "hidden")
                        //.attr("name", "mydata").val("Submit query = " + $(this).serialize() );
         //$('form').append($(test3));

         
                        $('#test').prepend( $('<input type="text" name="test1">').val("Submit query = " + $(this).serialize() ) );

                        return true;
                    });

                    $('#btnToggleOriginal_'+k).click(function() {
                        var _m = $('#multiselect_'+k);
                        if (_m.is(':visible')) {
                            _m.next().toggle().end().toggleClass('uix-multiselect-original').multiselect('refresh');
                        } else {
                            _m.toggleClass('uix-multiselect-original').next().toggle();
                        }
                        return false;
                    });
                    $('#btnSearch_'+k).click(function() {
                        $('#multiselect_'+k).multiselect('search', $('#txtSearch_'+k).val());
                    });

                });

                $('#btnGenerate_dynamic').click(function() {
                    var start = new Date().getTime();
                    var temp = $('<select></select>');
                    var count = parseInt($('#txtGenerate_dynamic').val());
                    for (var i=0; i<count; i++) {
                        temp.append($('<option></option>').val('item'+(i+1)).text("Item " + (i+1)));
                    }
                    $('#multiselect_dynamic').empty().html(temp.html()).multiselect('refresh', function() {
                        var diff = new Date().getTime() - start;
                        if (diff > 1000) {
                            diff /= 1000;
                            if (diff > 60) {
                                diff = (diff / 60) + " min";
                            } else {
                                diff += " sec";
                            }
                        } else {
                            diff += " ms";
                        }
                        $('#debug_dynamic').prepend($('<div></div>').text("Generated " + count + " options in " + diff));
                    });
                });


            });