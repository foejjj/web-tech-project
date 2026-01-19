document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("regForm");
  const role = document.getElementById("role");
  const doctorBox = document.getElementById("doctorBox");

  const nameEl = document.getElementById("name");
  const emailEl = document.getElementById("email");
  const phoneEl = document.getElementById("phone");
  const dobEl = document.getElementById("dob");
  const genderEl = document.getElementById("gender");
  const passEl = document.getElementById("password");
  const confirmEl = document.getElementById("confirm_password");
  const specEl = document.getElementById("specialization");

  const liveMsg = document.getElementById("liveMsg");
  const submitBtn = document.getElementById("submitBtn");

  function showMsg(type, text) {
    liveMsg.style.display = "block";
    liveMsg.className = "alert " + (type === "success" ? "success" : "error");
    liveMsg.textContent = text;
  }
  function hideMsg() {
    liveMsg.style.display = "none";
    liveMsg.textContent = "";
  }
