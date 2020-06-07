/*
External Script
*/

$(document).ready(function() {

	$("#icon").click(function() {
		var x = document.getElementById("topNav");

  		if (x.className === "col-md-9 customnav") {
    		x.className += " responsive";
  		} else {
    		x.className = "col-md-9 customnav";
  		}
	});

	var ulSubjects = $(".subjects");

	var liSubjects = $(".subject_main");

	var householdServices = liSubjects[2];

	var businessServices = liSubjects[3];

	var pages = $(".pages");

	householdServices.onmouseover = displayHouseholdNav;

	householdServices.onmouseout = hideHouseholdNav;

	businessServices.onmouseover = displayBusinessNav;

	businessServices.onmouseout = hideBusinessNav;

	function displayHouseholdNav(){
		$(".pages").eq(2).show("slow");
	}

	function hideHouseholdNav(){
		$(".pages").eq(2).hide("slow");
	}

	function displayBusinessNav(){
		$(".pages").eq(3).show("slow");
	}

	function hideBusinessNav(){
		$(".pages").eq(3).hide("slow");
	}

	var selA = $(".selected a");

	// var homeText = liSubjects.eq(0).children().text();

	// console.log(homeText.trim());


	// liSubjects.eq(0).addClass(homeText);

	document.getElementById("service_name_id").value = selA.html().trim();


});