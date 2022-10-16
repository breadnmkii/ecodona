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
  console.log("show donations");
  let charity_arr, total_arr, group_share_arr;

  //get arrays with all events stored
  fetch("dashboard.php", {
    method: "POST",
    body: JSON.stringify(),
    headers: { "content-type": "application/json" },
  })
    .then((response) => response.json())
    .then(function (data) {
      if (data.success) {
        donationname_arr = data.eventid_arr;
        eventdate_arr = data.eventdate_arr;
        group_share_arr = data.group_share_arr;
      
        //create card for each donation
        let donation_container = document.getElementById("donation-cards");
        for (let i = 0; i < eventdate_arr.length; i++) {
          let card = document.createElement("div").classList.add("card");
          let donor_name = document.createTextNode(donationname_arr[i]);
          card.appendChild(donor_name);

          var img = document.createElement("img");

          if (reward_data <= 24) {
            img.src = "images/reward_images/level0.jpeg";
          } else if (reward_data <= 49) {
            img.src = "images/reward_images/level1.jpeg";
          } else if (reward_data <= 74) {
            img.src = "images/reward_images/level2.jpeg";
          } else if (reward_data <= 99) {
            img.src = "images/reward_images/level3.jpeg";
          } else if (reward_data <= 499) {
            img.src = "images/reward_images/level4.jpeg";
          } else {
            img.src = "images/reward_images/level5.jpeg";
          }

          donation_container.append(card);
        }


        //create card for total balance
        let balance_container = document.getElementById("donut-balance");
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

function viewDetails() {
  console.log("view details modules");
}
