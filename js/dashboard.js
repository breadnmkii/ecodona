/**** Dashboard JS ***/
let logged_in = false;
//checks if user is logged in everytime script loads (prevent logout on refresh)
function check_login() {
  fetch("check_logged_in.php", {
    method: "POST",
    body: JSON.stringify(),
    headers: { "content-type": "application/json" },
  })
    .then((response) => response.json())
    .then(function (data) {
      if (data.success) {
        console.log("logged in");
      } else {
        console.log("not logged in");
      }
    })
    .catch((error) => console.error("Error:", error));
}

window.onload = function () {
  updateDashboard();
};

/*** UPDATE DASHBOARD ***/
function updateDashboard() {
  showDonations();
}

/*****************************************************************************************************/
/***  showDonations(): shows all donations on the dashboard                                        ***/
/*****************************************************************************************************/
function showDonations() {
  let charity_arr, total_arr, group_share_arr;

  const data = { token: csrf_token };
  //get arrays with all events stored
  fetch("getallevents.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: { "content-type": "application/json" },
  })
    .then((response) => response.json())
    .then(function (data) {
      if (data.success) {
        eventid_arr = data.eventid_arr;
        eventdate_arr = data.eventdate_arr;
        group_share_arr = data.group_share_arr;

        //display each event inside the proper cells
        for (let i = 0; i < eventdate_arr.length; i++) {
          //get id of the cell the event should be in
          let cell = document.getElementById(eventdate_arr[i]);

          //check if cell id is currently present
          if (cell == null) {
            //this means the cell for the current event doesn't exist on the page, go to next element
          } else {
            //create the div for where the event will be displayed

            let event_box = document.createElement("div");
            let event_display = document.createTextNode(title_arr[i]);
            event_box.appendChild(event_display);
            //if it is null, not a shared event
            if (!group_share_arr[i]) {
              event_box.setAttribute("class", "event_box");
              event_box.setAttribute("id", eventid_arr[i]);
              cell.appendChild(event_box);
            } else {
              console.log("shared: " + group_share_arr[i]);
              event_box.setAttribute("class", "locked_event_box");
              event_box.setAttribute("id", eventid_arr[i]);
              cell.appendChild(event_box);
            }
          }
        }
      }
    })
    .catch((err) => console.error(err));
}

/**********************************************************************************************/
/***  viewDetails(): shares event with another user ****************************/
/**********************************************************************************************/
document
  .getElementsByClass("view_details")
  .addEventListener("click", viewDetails, false);

function shareEvent() {
  let share_with_username = document.getElementById("share_username").value;
  let event_id = document.getElementById("display_id").innerHTML;

  //connect to php and send variables

  const data = {
    event_id: event_id,
    share_user: share_with_username,
    token: csrf_token, //csrf token
  };

  fetch("shareevent.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: { "content-type": "application/json" },
  })
    .then((response) => response.json())
    .then(function (data) {
      console.log(data.message);
      updateCalendar();
    })
    .catch((err) => console.error(err));
}
