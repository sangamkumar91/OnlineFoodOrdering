// IMPORTANT:::  Always edit the data length conditions in javascript.js  as soon as up update  ajax.php with a single line or character or comment or code or anything...    -->


(function($) {

    $.fn.scroll = function(options) {

        var begin = 1;
        var settings = {
            notfound: 'No Results Found',
            nop: 3, // The number of posts per scroll to be loaded
            offset: 0, // Initial offset, begins at 0 in this case
            error: 'No More Restuarants In This Area', // When the user reaches the end this is the message that is
            // displayed. You can change this if you want.
            delay: 500, // When you scroll down the posts will load after a delayed amount of time.
            // This is mainly for usability concerns. You can alter this as you see fit
            scroll: false // The main bit, if set to false posts will not load as the user scrolls. 
                    // but will still load if the user clicks.

        }

        // Extend the options so they work with the plugin
        if (options) {
            $.extend(settings, options);
        }

        // For each so that we keep chainability.
        return this.each(function() {

            // Some variables 
            $this = $(this);
            $settings = settings;
            var offset = $settings.offset;
            var busy = false; // Checks if the scroll action is happening 
            // so we don't run it multiple times
            // alert("11111");

            var closetime = document.getElementById("closetime").value;
            //alert(closetime);
            var opentime = document.getElementById("opentime").value;
            //alert(opentime);
            //below are the filter variables which are set if they satisfy their corresponding if conditions
            cf2min = $("#cf2min").val();
            
            cf2max =  $("#cf2max").val();
            
            currenttime  ="";
            if ($("#currenttime1").is(':checked'))
            currenttime = $("#time").val();

            veg = "";
            if ($("#veg").is(':checked'))
                veg = "veg";
             nonveg = "";
            if ($("#nonveg").is(':checked'))
                nonveg = "nonveg";
             credit = "";
            if ($("#credit").is(':checked'))
                credit = "1";
            freedev = "";
            if ($("#freedev").is(':checked'))
                freedev = "1";
            alcohol = "";
            if ($("#alcohol").is(':checked'))
                alcohol = "1";
            catering = "";
            if ($("#catering").is(':checked'))
                catering = "1";
            wifi = "";
            if ($("#wifi").is(':checked'))
                wifi = "1";
            ac = "";
            if ($("#ac").is(':checked'))
                ac = "1";
            
            // Custom messages based on settings
            if ($settings.scroll == true)
                $initmessage = 'Scroll for more or click here';
            else
                $initmessage = 'Click for more';

            // Append custom messages and extra UI
            $this.append('<div class="content"></div><div class="loading-bar">' + $initmessage + '</div>');

            function getData() {
 // Post data to ajax.php
                $.post('ajax.php', {
                    action: 'scrollpagination',
                    number: $settings.nop,
                    offset: offset,
                    veg: veg,
                    nonveg: nonveg,
                    credit: credit,
                    ac: ac,
                    catering: catering,
                    wifi: wifi,
                    freedev: freedev,
                    alcohol: alcohol,
                    
                    currenttime : currenttime,
                    opentime : opentime,
                    closetime : closetime,
                    cf2min: cf2min,
                    cf2max: cf2max,
                    
                    
                }, function(data) {

                    // Change loading bar content (it may have been altered)
                    $this.find('.loading-bar').html($initmessage);

                    // If there is no data returned, there are no more posts to be shown. Show error

                    // alert(data.length);
                    // alert(offset);
                  
                    // 240 is for no rows found, 150 is when no field is inserted and 22  when no more results else...data diplayed in div content 
                   
                if (data.length == "1531") {


                        $this.find('.loading-bar').html($settings.notfound);


                    }

                    else if (data.length == "1313") {
                        $this.find('.loading-bar').html($settings.error);
                    }

                    else if (data.length == "1441") {

                        $this.find('.loading-bar').hide();
                        begin = 0;
                        alert("Enter Atleast One Search Field ");

                    }
                    else {
                        //alert(offset)
                        // Offset increases
                        offset = offset + $settings.nop;

                        // Append the data to the content div
                        $this.find('.content').append(data);

                        // No longer busy!	
                        //alert("else");
                        busy = false;

                    }

                });

            }
            //	alert("beginning");
            getData(); // Run function initially
            //	alert("data entering "+begin);
            // If scrolling is enabled

            if ($settings.scroll == true) {
                // .. and the user is scrolling
                $(window).scroll(function() {

                    // Check the user is at the bottom of the element
                    if ($(window).scrollTop() + $(window).height() > $this.height() && !busy) {

                        // Now we are working, so busy is true
                        busy = true;
                        //alert("begin value"+begin);
                        if (begin != 0)
                        {
                            // Tell the user we're loading posts
                            $this.find('.loading-bar').html('Loading Posts');

                            // Run the function to fetch the data inside a delay
                            // This is useful if you have content in a footer you
                            // want the user to see.
                            setTimeout(function() {
                                //alert("timeout");
                                getData();

                            }, $settings.delay);

                        }
                    }
                });
            }
            // Also content can be loaded by clicking the loading bar/
            $this.find('.loading-bar').click(function() {

                if (busy == false) {
                    busy = true;
                   // alert("click");
                    getData();
                }

            });

        });
    }

})(jQuery);
