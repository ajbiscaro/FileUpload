//function to check all and uncheck all
checked=false;
function checkedAll (form) {
<!-- Script by hscripts.com -->
	var aa= document.getElementById(form);
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = checked;
	}
}

function performTask(action,form)
 {
    // ASSIGN THE ACTION
    var action = action;
 
    // UPDATE THE HIDDEN FIELD
    //document.getElementById("task").value = action;
	
	//seach for check fields
    flg = 0;
	var aa= document.getElementById(form);
	for (var i =0; i < aa.elements.length; i++) 
	{
		if(aa.elements[i].checked == true){
			flg = 1;
			break;
		}else{
			flg = 0;
		}
	}
	
	if(action =='Close'){
		opener.location.reload();
		window.close();
	}
	
	if(action =='Delete'){
	
		//alerts if no fields is selected
		if(flg == 0){
			alert("None is Selected");
			return false;
		}
		//ask confirmation for delete action
		var answer = confirm("Delete Selected entry/ies?")
		if (answer){
			document.getElementById(form).submit();
		}
		else{
			return false;
		}
	}
	
	// SUBMIT THE FORM
	document.getElementById(form).submit();	
 }
 
  function search_enter(myfield,e)
 {
     var keycode;
     if (window.event) keycode = window.event.keyCode;
     else if (e) keycode = e.which;
     else return true;

     if (keycode == 13)
     {
     		document.getElementById("task").value = "Search";
         myfield.form.submit();
     }
 }


