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
        updateDashboard;
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
  console.log("show donations")
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
        donationname_arr = data.eventid_arr;
        eventdate_arr = data.eventdate_arr;
        group_share_arr = data.group_share_arr;

        let donation_container = document.getElementById("donation-cards");

        //create card for each donation
        for (let i = 0; i < eventdate_arr.length; i++) {
          let card = document.createElement("div").classList.add("card");
          let donor_name = document.createTextNode(donationname_arr[i]);
          card.appendChild(donor_name);
          card.appendChild(createLevelSvg(2));

          donation_container.append(card);
        }
      }
    })
    .catch((err) => console.error(err));
}

function createLevelSvg(reward_data) {
  var svgns = "http://www.w3.org/2000/svg";
  var container = document.createElementNS(svgns, "SVG");
  for (var x = 0; x < 500; x += 50) {
    for (var y = 0; y < 300; y += 50) {
      var circle = document.createElementNS(svgns, "circle");
      circle.setAttributeNS(null, "cx", x);
      circle.setAttributeNS(null, "cy", y);
      circle.setAttributeNS(null, "r", 50);
      circle.setAttributeNS(
        null,
        "style",
        "fill: none; stroke: blue; stroke-width: 1px;"
      );
      container.appendChild(circle);
    }
  }

  /*
  if (reward_data <= 25) {
    return 1;
  } else if (reward_data <= 50) {
    return 2;
  } else if (reward_data <= 75) {
    return 3;
  } else if (reward_data <= 100) {
    return 4;
  } else {
    return 5;
  }
  */

  return container;
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
