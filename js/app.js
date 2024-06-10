let create = document.querySelector("#create");
let modal = document.querySelector("#create-client");
let update_model = document.querySelector("#update-client");
let close = document.querySelector("#close");
let update_close = document.querySelector("#update_close");
let save = document.querySelector("#save");
let update = document.querySelector("#update");
let success = document.querySelector(".alert-success");
let error = document.querySelector(".alert-danger");

create.addEventListener("click", () => {
  modal.style.display = "flex";
});
close.addEventListener("click", () => {
  modal.style.display = "none";
});
update_close.addEventListener("click", () => {
  update_model.style.display = "none";
});

// create client
$("#save").click(function () {
  const name = document.querySelector("#name").value;
  const age = document.querySelector("#age").value;
  const country = document.querySelector("#country").value;

  //  const data = { name, age, country };

  $.ajax({
    url: "php/insert-data.php",
    method: "POST",
    data: JSON.stringify({ name: name, age: age, country: country }),
    contentType: "application/json",
    success: function (output) {
      getclients();

      if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        name = "";
        age = "";
        country = "";
        modal.style.display = "none";

        getTotalCount();
        setTimeout(() => {
          success.style.display = "none";
          success.innerText = "";
        }, 1000);
      } else {
        error.style.display = "flex";
        error.innerText = output.message;
        setTimeout(() => {
          error.style.display = "none";
          error.innerText = "";
        }, 1000);
      }
    },
    catch(error) {
      error.style.display = "flex";
      error.innerText = error.message;
      setTimeout(() => {
        error.style.display = "none";
        error.innerText = "";
      }, 1000);
    },
  });
});
/* save.addEventListener("click", async () => {
		try {
				let name = document.querySelector("#name").value;
				let age = document.querySelector("#age").value;
				let country = document.querySelector("#country").value;


				const res = await fetch("php/insert-data.php", {
						method: "POST",
						body: JSON.stringify({ "name": name, "age": age, "country": country }),
						headers: {
								"Content-Type": "application/json"
						}
				});
				const output = await res.json();

				if (output.success) {
						success.style.display = "flex";
						success.innerText = output.message;
						name = "";
						age = "";
						country = "";
						modal.style.display = "none";
						getclients();
						getTotalCount();
						setTimeout(() => {
								success.style.display = "none";
								success.innerText = "";

						}, 1000)

				} else {
						error.style.display = "flex";
						error.innerText = output.message;
						setTimeout(() => {
								error.style.display = "none";
								error.innerText = "";

						}, 1000)
				}
		} catch (error) {
				error.style.display = "flex";
				error.innerText = error.message;
				setTimeout(() => {
						error.style.display = "none";
						error.innerText = "";

				}, 1000)
		}
});*/

document.addEventListener("DOMContentLoaded", () => {
  getclients();
});

// select client
function getclients() {
  $.ajax({
    url: "php/select-data.php",
    method: "GET",
    dataType: "json",
    success: function (output) {
      const tbody = $("#tbody");
      tbody.html(""); // Clear existing content

      //console.log("Helos", output);

      if (output.empty === "empty") {
        tbody.html("<tr><td>Record Not Found</td></tr>");
      } else {
        let tr = "";
        $.each(output, function (i, clients) {
          tr += `
							<tr>
								<td>${parseInt(i) + 1}</td>
								<td>${clients.std_name}</td>
								<td>${clients.std_age}</td>
								<td>${clients.std_country}</td>
								<td><button onclick="editclient(${
                  clients.id
                })" class="btn btn-success">Edit</button></td>
								<td><button onclick="deleteclient(${
                  clients.id
                })" class="btn btn-danger">Delete</button></td>
								<td><input type="checkbox" id="delete_all" data-id="${clients.id}"></td>
							</tr>`;
        });
        tbody.html(tr);
      }
    },
    error: function (error) {
      console.error("Error fetching clients:", error);
      // Handle error appropriately, e.g., display an error message to the user
    },
  });
}
/*const getclients = async () => {
		try {
				const tbody = document.querySelector("#tbody");
				let tr = "";
				const res = await fetch("php/select-data.php", {
						method: "GET",
						headers: {
								"Content-Type": "application/json"
						}
				});

				const output = await res.json();
				if (output.empty === "empty") {
						tr = "<tr>Record Not Found</td>"
				} else {
						for (var i in output) {
								tr += `
						<tr>
						<td>${parseInt(i) + 1}</td>
						<td>${output[i].std_name}</td>
						<td>${output[i].std_age}</td>
						<td>${output[i].std_country}</td>
						<td><button onclick="editclient(${output[i].id})" class="btn btn-success">Edit</button></td>
						<td><button onclick="deleteclient(${output[i].id})"  class="btn btn-danger">Delete</button></td>
						</tr>`
						}
				}
				tbody.innerHTML = tr;
		} catch (error) {
				console.log("error " + error)
		}
}

getclients();*/

// edit clients

const editclient = async (id) => {
  update_model.style.display = "flex";

  const res = await fetch(`php/edit-data.php?id=${id}`, {
    method: "GET",
    headers: { "Content-Type": "application/json" },
  });
  const output = await res.json();
  if (output["empty"] !== "empty") {
    for (var i in output) {
      document.querySelector("#id").value = output[i].id;
      document.querySelector("#edit_name").value = output[i].std_name;
      document.querySelector("#edit_age").value = output[i].std_age;
      document.querySelector("#edit_country").value = output[i].std_country;
    }
  }
};

// update client
$("#update").click(function () {
  let id = $("#id").val();
  let name = $("#edit_name").val();
  let age = $("#edit_age").val();
  let country = $("#edit_country").val();

  $.ajax({
    url: "php/update-data.php",
    method: "POST",
    data: JSON.stringify({
      id: id,
      name: name,
      age: age,
      country: country,
    }),
    dataType: "json",
    success: function (output) {
      if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        $("#id").val(""); // Clear input fields
        $("#edit_name").val("");
        $("#edit_age").val("");
        $("#edit_country").val("");
        update_model.style.display = "none";
        getclients();
        setTimeout(function () {
          success.style.display = "none";
          success.innerText = "";
        }, 1000);
      } else {
        error.style.display = "flex";
        error.innerText = output.message;
        setTimeout(function () {
          error.style.display = "none";
          error.innerText = "";
        }, 1000);
      }
    },
    error: function (error) {
      console.error("Error updating client:", error);
      // Handle error appropriately, e.g., display an error message to the user
    },
  });
});
/*update.addEventListener("click", async () => {
		let id = document.querySelector("#id").value;
		let name = document.querySelector("#edit_name").value;
		let age = document.querySelector("#edit_age").value;
		let country = document.querySelector("#edit_country").value;

		const res = await fetch("php/update-data.php", {
				method: "POST",
				body: JSON.stringify({
						"id": id,
						"name": name,
						"age": age,
						"country": country
				})
		});

		const output = await res.json();
		if (output.success) {
				success.style.display = "flex";
				success.innerText = output.message;
				name = "";
				age = "";
				country = "";
				update_model.style.display = "none";
				getclients();
				setTimeout(() => {
						success.style.display = "none";
						success.innerText = "";

				}, 1000)
		} else {
				error.style.display = "flex";
				error.innerText = output.message;
				setTimeout(() => {
						error.style.display = "none";
						error.innerText = "";
				}, 1000)
		}

});*/

// delete client
function deleteclient(id) {
  $.ajax({
    url: `php/delete-data.php?id=${id}`,
    method: "GET",
    dataType: "json",
    success: function (output) {
      if (output.success) {
        success.style.display = "flex";
        success.innerText = output.message;
        setTimeout(function () {
          success.style.display = "none";
          success.innerText = "";
        }, 1000);
        getclients();
        getTotalCount();
      } else {
        error.style.display = "flex";
        error.innerText = output.message;
        setTimeout(function () {
          error.style.display = "none";
          error.innerText = "";
        }, 1000);
      }
    },
    error: function (error) {
      console.error("Error deleting client:", error);
      // Handle error appropriately, e.g., display an error message to the user
    },
  });
}
/*const deleteclient = async (id) => {
		const res = await fetch("php/delete-data.php?id=" + id, {
				method: "GET",
		});
		const output = await res.json();
		if (output.success) {
				success.style.display = "flex";
				success.innerText = output.message;
				setTimeout(() => {
						success.style.display = "none";
						success.innerText = "";
				}, 1000)
				getclients();
				getTotalCount();
		} else {
				error.style.display = "flex";
				error.innerText = output.message;
				setTimeout(() => {
						error.style.display = "none";
						error.innerText = "";
				}, 1000)
		}
}*/

// get total count  client;

const getTotalCount = () => {
  try {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "php/get-total-count.php");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          const output = JSON.parse(xhr.responseText);
          const total = document.querySelector("#total");
          total.innerText = output;
        } else {
          // Error handling for HTTP errors
        }
      }
    };

    xhr.send();
  } catch (error) {
    // Handle general errors
  }
};

//search bar
$(document).ready(function () {
  $("#live_search").keyup(function () {
    var input = $(this).val();

    $.ajax({
      url: "php/livesearch.php",
      method: "post",
      data: { input: input },
      success: function (data) {
        $("#searchresult").html(data);
      },
    });
  });
});
//pagination
$(document).ready(function () {
  load_data();
  function load_data(page) {
    $.ajax({
      url: "php/pagination.php",
      method: "POST",
      data: { page: page },
      success: function (data) {
        $("#pagination_data").html(data);
      },
    });
  }
  $(document).on("click", ".pagination_link", function () {
    var page = $(this).attr("id");
    load_data(page);
  });
});
//selected delete
$(document).ready(function () {
  $("#btn_delete").click(function () {
    var id = [];
    $("#delete_all:checked").each(function (i, ele) {
      id[i] = ele.dataset.id;
    });
    if (id.length === 0) {
      //tell you if the array is empty
      alert("Please Select atleast one checkbox");
    } else {
      $.ajax({
        url: "php/delete.php",
        method: "POST",
        data: { ids: JSON.stringify(id) },
        success: function () {
          getclients();
          // for (var i = 0; i < id.length; i++) {
          //   alert("you deleted the record");
          // }
        },
      });
    }
  });
});
