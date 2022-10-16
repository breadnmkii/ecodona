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
        updateDashboard;
      } else {
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
        donut_balance = data.donutBalance;

        //create card for each donation
        let donation_container = document.getElementById("donation-cards");

        for (let i = 0; i < charity_arr.length; i++) {
          let card = document.createElement("div");
          card.classList.add("card");

          //append donor
          const donor_node = document.createElement("h4");
          const donor_textnode = document.createTextNode(charity_arr[i]);
          donor_node.appendChild(donor_textnode);
          card.appendChild(donor_node);

          //append image
          let img = document.createElement("img");
          let reward_data = document.createTextNode(reward_arr[i]);

          if (reward_data <= 24) {
            img.src = "../images/reward_images/level0.png";
          } else if (reward_data <= 49) {
            img.src = "../images/reward_images/level1.png";
          } else if (reward_data <= 74) {
            img.src = "../images/reward_images/level2.png";
          } else if (reward_data <= 99) {
            img.src = "../images/reward_images/level3.png";
          } else if (reward_data <= 499) {
            img.src = "../images/reward_images/level4.png";
          } else {
            img.src = "../images/reward_images/level5.png";
          }

          card.appendChild(img);

          //append Details button
          let btn = document.createElement("button");
          btn.classList.add("secondaryblk");
          btn.innerHTML = "Details";
          card.appendChild(btn);

          //append card to donation containera
          donation_container.append(card);
        }

        //append donut balance
        let donut_balance_container = document.getElementById("donut-balance");
        const donut_balance_node = document.createElement("h4");
        const donut_balance_textnode = document.createTextNode(donut_balance);
        donut_balance_node.appendChild(donut_balance_textnode);
        donut_balance_container.appendChild(donut_balance_node);

        const balance_node = document.createElement("h6");
        const balance_textnode = document.createTextNode("Donut Balance");
        balance_node.appendChild(balance_textnode);
        donut_balance_container.appendChild(balance_node);
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
