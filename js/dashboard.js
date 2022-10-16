/**** Dashboard JS ***/
let logged_in = false;
//checks if user is logged in everytime script loads (prevent logout on refresh)
function check_login() {
  fetch("../pages/PHP/login.php", {
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
  fetch("../pages/PHP/getDashboardData.php", {
    method: "POST",
    body: JSON.stringify(),
    headers: { "content-type": "application/json" },
  })
    .then((response) => response.json())
    .then(function (data) {
      if (data.success) {
        charity_arr = data.charityNames;
        reward_arr = data.charityDonuts;
        donut_balance_arr = data.donutBalance;

        console.log(data.message);
        console.log(charity_arr);
        console.log(reward_arr);
        console.log(donut_balance_arr);
      
        //create card for each donation
        let donation_container = document.getElementById("donation-cards");
        
        for (let i = 0; i < charity_arr.length; i++) {
          console.log("making cards");
          let card = document.createElement("div").classList.add("card");

          //append donor
          let donor_name = document.createTextNode(charity_arr[i]);
          console.log(donor_name);
          card.appendChild(donor_name);

          //append image
          let img = document.createElement("img");
          let reward_data = document.createTextNode(reward_arr[i]);

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

          card.appendChild(img);

          //append donut balance
          let donut_balance = document.createTextNode(donut_balance_arr[i]);
          card.appendChild(donut_balance);

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
/*
document
  .getElementsByClass("view_details")
  .addEventListener("click", viewDetails, false);

function viewDetails() {
  console.log("view details modules");
}
*/
