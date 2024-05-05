// Author:       Amir Hosein Khanmohammadi
// Student ID:   991646689

const table = document.getElementById("table");
const buttons = document.querySelectorAll("button");
const clearBtn = document.getElementById("clear");
const updateBtn = document.getElementById("update");
let selectedColor = "black";

function createTd(table, rows, columns) {
  table.innerHTML = "";
  for (let i = 0; i < rows; i++) {
    let tr = document.createElement("tr");
    for (let j = 0; j < columns; j++) {
      let td = document.createElement("td");
      td.addEventListener("mouseover", function (e) {
        if (selectedColor) {
          e.target.style.backgroundColor = selectedColor;
          td.style.transition = "background-color 0.5s";
        }
      });
      tr.appendChild(td);
    }
    table.appendChild(tr);
  }
}

buttons.forEach(function (button) {
  button.addEventListener("click", function (e) {
      selectedColor = e.target.style.backgroundColor;
  });
});

clearBtn.addEventListener("click", function () {
  const tds = document.querySelectorAll("td");
  tds.forEach(function (td) {
    td.style.backgroundColor = "";
  });
});

updateBtn.addEventListener("click", function () {
  const rows = document.getElementById("rows").value;
  const columns = document.getElementById("columns").value;
  createTd(table, rows, columns);
});

let rows, columns;
if (window.matchMedia("(max-width: 400px)").matches) {
  rows = 10;
  columns = 10;
} else {
  rows = 10;
  columns = 30;
}
createTd(table, rows, columns);


const inputColumns = document.getElementById("columns");

if (window.innerWidth <= 400) {
  inputColumns.value = 10;
} else {
  inputColumns.value = 30;
}
